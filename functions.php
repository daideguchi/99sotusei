<?php

// DB接続情報
// $dsn = ‘mysql;host=mysql153.phy.lolipop.lan;dbname=LAA1351624-3m2sih;charset=utf8mb4’;
// $user = ‘LAA1351624’;
// $password = ‘kdJayFzX’;

// try{
// $dbh = new PDO($dsn, $user, $password);

// print(‘connected to the database!!<br>’);

// }catch (PDOException $e){
// print(‘Error:’.$e->getMessage());
// die();
// }

// $dbh = null;

function connect_to_db()
{
  //localhost
  // $dbn = 'mysql:dbname=gsacf_d10_05;charset=utf8mb4;port=3306;host=localhost';
  // $user = 'root';
  // $pwd = '';

  //lolipop
  // $dbn = 'mysql:dbname=LAA1351624-3m2sih;charset=utf8mb4;port=3306;host=mysql153.phy.lolipop.lan';
  // $user = 'LAA1351624';
  // $pwd = 'kdJayFzX';

  //heroku
  $dbn = 'mysql:dbname=heroku_216b601f26418e8;charset=utf8mb4;port=3306;host=us-cdbr-east-05.cleardb.net';
  $user = 'b5184191d44d54';
  $pwd = 'cd70a3e5';

  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }
}


// ログイン状態のチェック関数
function check_session_id()
{
  if (!isset($_SESSION["session_id"]) ||$_SESSION["session_id"] != session_id()) {
    header('Location:index.php');
    exit();
  } else {

   //ログインがちゃんとされていれば一時idを更新する
    session_regenerate_id(true);
    $_SESSION["session_id"] = session_id();
  }
}


// ファイルデータの保存
// @param string $filename ファイル名
// @param string $save_path 保存先のパス
// @param string $caption 投稿の説明
// @return bool $result

function fileSave($filename, $save_path,$caption,$username){
  $result = False;

  $sql = "INSERT INTO file_table (file_name, file_path, description ,username) VALUE(?,?,?,?)";

  try{
    $stmt = connect_to_db()->prepare($sql);
    $stmt->bindValue(1,$filename);
    $stmt->bindValue(2,$save_path);
    $stmt->bindValue(3,$caption);
    $stmt->bindValue(4,$username);

    $result = $stmt->execute();
    return $result;
  }catch(\Exception $e){
    echo ($e->getMessage());
    return $result;
  }

}



/**
 * ファイルデータの取得
* @return array $fileData
*/
// var_dump($_SESSION["username"]);
// exit();

//お気に入り登録かついいねの多い順に表示させる３・２８未実装
function getAllpost(){

$sql = "SELECT * FROM `users_table` JOIN `posts_table` 
ON users_table.id = posts_table.user_id";

 $allpostData = connect_to_db()->query($sql);
// var_dump($fileData);
// exit();

 return $allpostData;

}


//idをキーにした方が良い
function getpost(){
$id = $_SESSION["id"];

 $sql = "SELECT * FROM `posts_table` WHERE `user_id`= '$id'";


 $postData = connect_to_db()->query($sql);


 return $postData;


}

function userinfo(){
  $id = $_SESSION["id"];

 $sql = "SELECT * FROM `users_table` WHERE `id`= '$id'";

 $userdata = connect_to_db()->query($sql);

 return $userdata;

}


function feedback_select(){

    $username = $_SESSION["username"];
//  var_dump($username);
//  exit();


  $sql = "SELECT * FROM `file_table` WHERE username <> '$username' AND feedback IS NULL AND koukai = 1";

//  var_dump($sql);
//  exit();
 $feedback_select = connect_to_db()->query($sql);

 return $feedback_select;

//  var_dump($feedback_select);
//  exit();

}


function kanjou(){
  $username = $_SESSION["username"];

 $sql = "SELECT * FROM `like_table` WHERE `username`= '$username'";


 $kanjoudata = connect_to_db()->query($sql);
// var_dump($fileData);
// exit();

 return $kanjoudata;

}


function h($s){
   return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}


function post(){
  $sql = "SELECT * FROM `like_table`";
  $posts = connect_to_db()->query($sql);
  return $posts;
}


function question_all(){

$sql = "SELECT * FROM `question_table` JOIN `users_table` 
ON question_table.user_id = users_table.id";

 $question_all = connect_to_db()->query($sql);
// var_dump($fileData);
// exit();

 return $question_all;

}