//
//  LoginView.swift
//  ChalkUp
//
//  Created by 芳賀陽介 on 2022/04/27.
//

import Foundation
import UIKit
import Alamofire
import PromiseKit

class LoginView: UIViewController {
    
    //outlet接続
    
    @IBOutlet weak var usernameField: UITextField!
    
    @IBOutlet weak var passwordField: UITextField!
    
    @IBOutlet weak var onLogin: UIButton!
    
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        usernameField.textColor = UIColor.black
        passwordField.textColor = UIColor.black
    }
    
    
    override func viewDidAppear(_ animated: Bool) {
        super.viewDidAppear(animated)
        
        //もしユーザーネーム、パスワードが保存されているなら,TopPageViewに画面遷移
        //        if let _ = UserDefaults.standard.object(forKey: "UserData"){
        //            performSegue(withIdentifier: "toTopPage", sender: nil)
        //        }
    }
    
    //ユーザーデフォルト
    func saveUserData(userData: User) {
        let jsonEncoder = JSONEncoder()
        guard let data = try? jsonEncoder.encode(userData) else {
            return
        }
        UserDefaults.standard.set(data, forKey: "UserData")
    }
    
    //ログインボタンが押されたときの処理
    @IBAction func onLogin(_ sender: UIButton) {
        
        //パラメーター
        let parameters: [String: Any] = ["username": usernameField.text ?? "","password":passwordField.text ?? ""]
        
        //値をセットしてBASIC認証する
            AF.request("https://zichitai-link.herokuapp.com/api/login_api.php", method: .post ,parameters: parameters, encoding: URLEncoding.httpBody)
            .responseDecodable(of: User.self) { response in
                debugPrint(response)
                
                switch response.result{
                    
                case .success(let data):
                    
                    //successしたらユーザーデフォルトでkeyと値のペアを永続的に保存する
                    //自作した構造体UserをUserDefaultsに追加する
                    self.saveUserData(userData: data)
                    
                    //認証成功したらTopPageViewに画面遷移
                    let vc = self.storyboard?.instantiateViewController(identifier: "TopView") as! TopPageViewController
                    self.navigationController?.pushViewController(vc, animated: true)
                    
                    //失敗したらfunc showErrorが表示されるようにする：
                case .failure(let error):
                    self.showError()
                }
            }
        
    }
    //ログイン失敗した時に出るモーダル表示
    func showError(){
        let dialog = UIAlertController(title: "エラー", message: "ユーザー名、またパスワードが間違っています。", preferredStyle: .alert)
        dialog.addAction(UIAlertAction(title: "OK", style: .default, handler: nil))
        self.present(dialog, animated: true, completion: nil)
    }
    
    //UserDataの構造体はUserに
    
    //新規登録のボタンを押したら、WEB版の新規登録ページに遷移する
    @IBAction func onNewAccount(_ sender: UIButton) {
        
        // 遷移先のURL
        let url = NSURL(string: "https://zichitai-link.herokuapp.com/register/register1.php")
        // 外部ブラウザ（Safari）で開くif UIApplication.shared.canOpenURL(url! as URL){
        UIApplication.shared.open(url! as URL, options: [:], completionHandler: nil)
    }
    
    
}







