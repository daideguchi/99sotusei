
//
//  ArticleTableViewCell.swift
//  ChalkUp
//
//  Created by 芳賀陽介 on 2022/04/27.
//

import UIKit
import Alamofire
import SDWebImage

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
    
 
 
//    このセルの各パーツの構成を定義
    func configure(data :TopPageData){
        print(data)
        
        if let thumbnail = data.thumbnail{
            
            postThumnail.sd_setImage(with: URL(string: "https://zichitai-link.herokuapp.com/post/" + thumbnail))
            
        }
        
        postTitle.text = data.title
        userNameLabel.text  = data.username
        pref.text = data.pref
        city.text = data.city
        department.text = data.department
        textFierd.text = data.text
        
        createdAt.text = data.createdAt
        
        
    }
}

    

