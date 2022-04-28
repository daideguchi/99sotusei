<?php
require_once __DIR__ . '/config.php';

// var_dump($_POST);
// exit();

session_start();
$pdo = connect_to_db();
$username = $_POST["username"];
$password = $_POST["password"];
// include("../functions.php");
$sql = "SELECT * FROM users_table WHERE username=:username AND password=:password AND is_deleted=0";

$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
// ユーザ有無で条件分岐
$val = $stmt->fetch(PDO::FETCH_ASSOC);

$hantei_id = $val['id'];
// var_dump($hantei_id);
// exit();

if(!$val){
    echo"false";
    exit();

}
class API {
    function Select(){

        $db = new Connect;
        $users = array();
        $data = $db->prepare('SELECT * FROM users_table WHERE id=$hantei_id');
        $data->execute();
        while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
            $users = array(
                 'id' => $OutputData['id'],
                 'username' => $OutputData['username'],
                 'email' => $OutputData['email'],
                 'password' => $OutputData['password'],

            );
        }
        return json_encode($users);
    }
}

$API = new API;
header('Conetent-Type: application/json');
echo $API ->Select();
?>