//
//  ArticleTableViewCell.swift
//  ChalkUp
//
//  Created by 芳賀陽介 on 2022/04/27.
//

import UIKit
import Alamofire
import PromiseKit
import Nuke

class ArticleTableViewCell: UITableViewCell {
    
    //ArticleTableViewCellの接続
    
    @IBOutlet weak var postThumnail: UIImageView!
    @IBOutlet weak var postTitle: UILabel!
    
    @IBOutlet weak var userNameLabel: UILabel!
    @IBOutlet weak var pref: UILabel!
    @IBOutlet weak var city: UILabel!
    @IBOutlet weak var department: UILabel!
    @IBOutlet weak var createdAt: UILabel!
    @IBOutlet weak var textFierd: UILabel!
    
    
    @IBOutlet weak var likeButton: UIButton!
    @IBOutlet weak var commentButton: UIButton!
    
    
    private var currentUserDidLike: Bool = false
    
    var delegate: ArticleTableViewCell!
    
    //TopPageDataから情報を取ってきてUIを更新する
    //ここでalamofire接続で記事を引っ張ってきてUI更新？
    var post: TopPageData!{
    didSet {
        updateUI()
       }
    }
    
    private func updateUI(){
        
  
    }
    
    
    
    override func awakeFromNib() {
        super.awakeFromNib()
        // Initialization code
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }
 
    //このセルの各パーツに入る値を定義
//    func configure(with model:Movie){
//            self.movieTitleLabel.text = model.title
//            self.movieReleaseDateLabel.text = model.release_date
//            let url = model.poster_path
//            if let data = try? Data(contentsOf: URL(string: url!)!){
//                self.moviePosterImageView.image = UIImage(data: data)
//            }
//    }
}
    
//NukeでURLの画像を表示・キャッシュ
    extension UIImageView {
        func loadImage(with urlString: String) {
            guard let url = URL(string: urlString) else {
                return
            }
            loadImage(with: url)
        }

        func loadImage(with url: URL) {
            Nuke.loadImage(with: url, into: self)
        }
    }
    



