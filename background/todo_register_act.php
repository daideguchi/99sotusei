<?php

include("../functions.php");

// var_dump($_POST);
// exit();

// 空欄だった時のバリデーション。後で考える3/31
// if (
//   !isset($_POST['username']) || $_POST['username'] == '' ||
//   !isset($_POST['email']) || $_POST['email'] == '' ||
//   !isset($_POST['password']) || $_POST['password'] == ''
// ) {
//   exit('paramError');
// }

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$pref = $_POST["pref"];
$city = $_POST["city"];
$department = $_POST["department"];


$pdo = connect_to_db();

// var_dump($pdo);
// exit();

$sql = 'INSERT INTO users_table(id, username, email, password, is_admin, pref, city, department, is_deleted, created_at, updated_at) VALUES(NULL, :username, :email, :password, 0, :pref, :city, :department, 0, now(), now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':pref', $pref, PDO::PARAM_STR);
$stmt->bindValue(':city', $city, PDO::PARAM_STR);
$stmt->bindValue(':department', $department, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// header("Location:../index.php");
// exit();
?>

<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>file_upload</title>
      <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura-earthly.css" type="text/css">

</head>
<body>
<h1>登録が完了しました</h1>
  <form action="todo_login_act.php" method="POST">
<input type="hidden" name="username" value="<?php echo "{$username}" ?>">
<input type="hidden" name="password" value="<?php echo "{$password}" ?>">
    <button>トップページへ</button>
  </form>
    </div>
</body>
</html>