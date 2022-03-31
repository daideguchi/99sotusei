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
//   exit('全て必須項目です');
//     echo '<a href="../register1.php">新規登録画面へ</a>';

// }
// 次のPOSTで値を渡すため、一旦変数に入れる
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];


$pdo = connect_to_db();

// var_dump($pdo);
// exit();

$sql = 'SELECT COUNT(*) FROM users_table WHERE email=:email';



$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

if ($stmt->fetchColumn() > 0) {
  echo '<p>このメールアドレスは既に登録されています．</p>';
  echo '<a href="register1.php">戻る</a>';
  exit();
}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura-earthly.css" type="text/css">

  <title>アカウント作成</title>
</head>
<body>
    <div class="content">
        <form action="../background/todo_register_act.php" method="POST">
                <h1>所属の情報を入力</h1>
            <br>
 
            <div class="control">
                <label for="pref">都道府県</label>
                <select name="pref" name="pref">
                    <option value="">選択してください</option>
                    <option value="北海道">北海道</option>
                    <option value="青森県">青森県</option>
                    <option value="岩手県">岩手県</option>
                    <option value="宮城県">宮城県</option>
                    <option value="秋田県">秋田県</option>
                    <option value="山形県">山形県</option>
                    <option value="福島県">福島県</option>
                    <option value="茨城県">茨城県</option>
                    <option value="栃木県">栃木県</option>
                    <option value="群馬県">群馬県</option>
                    <option value="埼玉県">埼玉県</option>
                    <option value="千葉県">千葉県</option>
                    <option value="東京都" selected>東京都</option>
                    <option value="神奈川県">神奈川県</option>
                    <option value="新潟県">新潟県</option>
                    <option value="富山県">富山県</option>
                    <option value="石川県">石川県</option>
                    <option value="福井県">福井県</option>
                    <option value="山梨県">山梨県</option>
                    <option value="長野県">長野県</option>
                    <option value="岐阜県">岐阜県</option>
                    <option value="静岡県">静岡県</option>
                    <option value="愛知県">愛知県</option>
                    <option value="三重県">三重県</option>
                    <option value="滋賀県">滋賀県</option>
                    <option value="京都府">京都府</option>
                    <option value="大阪府">大阪府</option>
                    <option value="兵庫県">兵庫県</option>
                    <option value="奈良県">奈良県</option>
                    <option value="和歌山県">和歌山県</option>
                    <option value="鳥取県">鳥取県</option>
                    <option value="島根県">島根県</option>
                    <option value="岡山県">岡山県</option>
                    <option value="広島県">広島県</option>
                    <option value="山口県">山口県</option>
                    <option value="徳島県">徳島県</option>
                    <option value="香川県">香川県</option>
                    <option value="愛媛県">愛媛県</option>
                    <option value="高知県">高知県</option>
                    <option value="福岡県">福岡県</option>
                    <option value="佐賀県">佐賀県</option>
                    <option value="長崎県">長崎県</option>
                    <option value="熊本県">熊本県</option>
                    <option value="大分県">大分県</option>
                    <option value="宮崎県">宮崎県</option>
                    <option value="鹿児島県">鹿児島県</option>
                    <option value="沖縄県">沖縄県</option>
                    </select>
            </div>
                <br>
            <div class="control">
                <label for="city">区市町村</label>
                <input id="city" type="text" name="city">
            </div>
                <br>
            <div class="control">
                <label for="department">部署</label>
                <input id="department" type="depart" name="department">
            </div>
                <br>
                <!-- POSTされたユーザーネーム・メールアドレス・パスワードをさらにPOSTするために設置 -->
                <input type="hidden" name="username" value="<?php echo "{$username}" ?>">
                <input type="hidden" name="email" value="<?php echo "{$email}" ?>">
                <input type="hidden" name="password" value="<?php echo "{$password}" ?>">

            <div class="control">
                <button type="submit" class="btn">登録</button>
            </div>
        </form>
        <a href="register1.php">戻る</a>

    </div>
</body>
</html>


<style>
  body{
    background-image : url(design_image/topimg.jpeg);
    background-position: center;
    background-size: cover;
    width: 50%;
    height: 800px;
  }

  div{
    justify-content: center;
    /* text-align: center; */
    align-items: center;
  }

  fieldset{
    text-align: center;
    align-items: center;
    background-color: #f5deb3;
    margin: 0 auto;  
    }

  form{

    margin-right: auto;
    width: 350px;
    text-align: center;
  }

  legend{
  text-shadow: 1px 1px 2px silver;
  font-weight: bold;
    font-size: 20px;
  }