//
//  User.swift
//  ChalkUp
//
//  Created by 芳賀陽介 on 2022/04/27.
//

import Foundation

//ログインAPI呼び出しに必要な構造体
//emailはオプショナル型なので？で宣言
struct User: Codable {
    let id: Int
    let username: String
    let email: String?
    let password: String
    
//    enum CodingKeys: String, CodingKey {
//        case id
//        case username
//        case email
//        case password
//    }
}
