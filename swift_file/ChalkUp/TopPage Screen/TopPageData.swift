//
//  TopPageData.swift
//  ChalkUp
//
//  Created by 芳賀陽介 on 2022/04/29.
//

import Foundation


//トップページAPIに必要な構造体
struct TopPageData: Codable {
    let userId: Int
    let username: String
    let pref: String?
    let city: String?
    let department: String?
    let title: String
    let text: String
    let thumbnail: String?
    let profImg: String?
    let createdAt: String
    let good: Int
    let comment: Int
    
    enum CodingKeys: String, CodingKey {
        case userId = "user_id"
        case username
        case pref
        case city
        case department
        case title
        case text
        case thumbnail
        case profImg = "prof_img"
        case createdAt = "created_at"
        case good
        case comment
    }
}

//{
//    "user_id": 44,
//    "username": "deguchi",
//    "pref": "福岡県",
//    "city": "福岡市",
//    "department": "税務部",
//    "title": "aa",
//    "text": "aa",
//    "thumbnail": "images/2022042512563015a826bc62d3102f8934efea8e070fe9_t.jpeg",
//    "prof_img": "images/20220425122535mv_chara03.png",
//    "created_at": "2022-04-25 12:24:10",
//    "good": 0,
//    "comment": 1
//}
