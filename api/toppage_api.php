<?php

// .posts_table
//    .title　タイトル
//    .text　本文
//    .thumbnail　サムネイル画像

// .users_table
//   .username　ユーザーネーム
//   .pref　都道府県
//   .city　市町村
//  .department　所属


require_once __DIR__ . '/config.php';
// include("../functions.php");
class API {
    function Select(){
        $db = new Connect;
        $users = array();
        $data = $db->prepare('SELECT * FROM `users_table` JOIN `posts_table` 
ON users_table.id = posts_table.user_id');
        $data->execute();
        while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
            $users[$OutputData['id']] = array(
                 'username' => $OutputData['username'],
                 'pref' => $OutputData['pref'],                 
                 'city' => $OutputData['city'],                 
                 'department' => $OutputData['department'],   
                 'title' => $OutputData['title'],                 
                 'text' => $OutputData['text'],                 
                 'thumbnail' => $OutputData['thumbnail'], 
                 'prof_img' => $OutputData['prof_img'],   
                 'created_at' => $OutputData['created_at'],                               
            );
        }
        return json_encode($users);
    }
}

$API = new API;
header('Conetent-Type: application/json');
echo $API ->Select();
?>