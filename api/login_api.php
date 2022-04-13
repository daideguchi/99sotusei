<?php
    session_start();

    header('Content-Type: application/json; charset=UTF-8');

    include("../functions.php");
    $pdo = connect_to_db(); //接続に成功したらpdpにデータが入る
    $email = $_POST["email"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM users_table WHERE email=:email AND password=:password AND is_deleted=0";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);

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
        break;
    }else{
        $_SESSION = array();
        $_SESSION["session_id"] = session_id();
        $_SESSION["is_admin"] = $val["is_admin"];
        $_SESSION["email"] = $val["email"];
        $_SESSION["username"] = $val["username"];
        $_SESSION["id"] = $val["id"];


    }


    // while(true) {

    //     if ($rec === false) {
    //         break;
    //     }
    //     $arr[] = $rec;
    // }

    print json_encode($val, JSON_PRETTY_PRINT);




