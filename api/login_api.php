<?php
// データ受け取り
// var_dump($_POST);
// exit();
// session_start();


// DB接続
// var_dump($_POST);
// exit();

include("../functions.php");
// require_once __DIR__ . '/config.php';

$pdo = connect_to_db(); //接続に成功したらpdpにデータが入る


        $users = array();
        $data = $pdo->prepare('SELECT * FROM users_table ORDER BY id');
        $data->execute();
        while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
            $users = array(
                 'id' => $OutputData['id'],
                 'username' => $OutputData['username'],
                 'email' => $OutputData['email'],
                 'password' => $OutputData['password'],

            );
        }

        // var_dump($users);
        // exit();

        return json_encode($users);


// $email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];

// var_dump($username);
// var_dump($password);
// exit();
// var_dump("あ");
// exit();

// SQL実行
// $sql = "SELECT * FROM users_table WHERE email=:email AND password=:password AND is_deleted=0";
$sql = "SELECT * FROM users_table WHERE username=:username AND password=:password AND is_deleted=0";

$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

// var_dump($sql);
// exit();




try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
// ユーザ有無で条件分岐
$val = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($val);
// exit();
if(!$val){
    echo"false";
    exit();
}else{
    // $users = array();
    // $_SESSION["session_id"] = session_id();
    // $_SESSION["is_admin"] = $val["is_admin"];
    // $_SESSION["email"] = $val["email"];
    // $_SESSION["username"] = $val["username"];
    // $_SESSION["id"] = $val["id"];
 

    // $users = array(
    //     'session_id' => session_id(),
    //     'username' => $val['username'],
    //     'email' => $val["email"],
    //     'password' => $val['password'],

    // );
    



    echo "true";



    // var_dump($users);

    return json_encode($users);
    // echo $users;

    // exit();
}

$API = new API;
header('Conetent-Type: application/json');
echo $API ->Select();

