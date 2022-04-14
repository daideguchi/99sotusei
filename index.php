
<!-- ログイン画面 -->

<!DOCTYPE html>
<html lang="ja">

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura-earthly.css" type="text/css">

  <title>welbe-link</title>
</head>

<body>
<h1><u>welbe-link</u></h1>
<h3>自治体ではたらく人のための</h3>
<h3>ナレッジ共有SNS</h3>
  <form action="./background/todo_login_act.php" method="POST">
<br>
<br>
    <fieldset>
        <legend>サービスへログインする</legend>
        <div>
            ユーザーネーム: <input type="text" name="username">
        </div>
        <div>
            パスワード: <input type="password" name="password">
        </div>
        <div>
            <button>ログイン</button>
        </div>
        <br>
      </fieldset>
  </form>

 <a href="./register/register1.php">新規会員登録</a>
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
    text-align: center;
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