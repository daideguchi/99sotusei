//
//  ViewController.swift
//  ChalkUp
//
//  Created by 芳賀陽介 on 2022/04/27.
//

import UIKit
import Alamofire
import PromiseKit


class TopPageViewController: UIViewController, UITableViewDelegate, UITableViewDataSource {
    
    //tableViewの接続
    @IBOutlet private weak var tableView: UITableView!
    
    
    //変数 TopPageData=構造体
    var dataArray: [TopPageData] = []
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        
        tableView.register(UINib(nibName: "ArticleTableViewCell", bundle: nil), forCellReuseIdentifier: "ArticleCell")
       
        getData()
    }
    
    //UITableViewDelegate
    //行数を指定するメソッド
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return dataArray.count
    }
    
    // リストに表示するセルを設定するメソッド
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        //表示したいセルのデータを設定
        let article = dataArray[indexPath.row]
        // セルを作成する
        guard let cell = tableView.dequeueReusableCell(withIdentifier: "ArticleCell") as? ArticleTableViewCell else { return UITableViewCell() }
        
        
        cell.configure(data: article)
        

        return cell
    }
    
    
    //indexPathのcellの高さを指定する．
    func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        return 150
    }
    
    
    //APIからtopPageDataの記事データを引っ張ってきて、tableViewに表示する
    private func getData() {
        AF.request("https://zichitai-link.herokuapp.com/api/toppage_api.php/")
            .responseDecodable(of: TopPageData.self) { response in
                debugPrint(response)
                switch response.result {
                case .success(let dataArray):
                        
                    self.dataArray.append(dataArray)
                    
                    //Debug
                    print("デコードしました")
                    
                    self.tableView.reloadData()
                        
                   
                case .failure(let error):
                    print("エラー", error)
                }
            }
    }
    
    
    //ボタン：webに遷移
    //現在はWeb版の投稿画面に遷移する処理
    @IBAction func onWebSite(_ sender: UIButton){
        
        let url = NSURL(string: "https://zichitai-link.herokuapp.com/toppage.php")
        // 外部ブラウザ（Safari）で開く
        if UIApplication.shared.canOpenURL(url! as URL){
            UIApplication.shared.open(url! as URL, options: [:], completionHandler: nil)
            print("Webボタンが押されました。")
        }
        
        
    }
    
}
