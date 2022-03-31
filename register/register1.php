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
        <form action="register2.php" method="POST">
            <h1>アカウント作成</h1>
            <br>
 
            <div class="control">
                <label for="username">ユーザーネーム<span class="required"></span></label>
                <input id="username" type="text" name="username">
                 <?php if (!empty($error["username"]) && $error['username'] === 'blank'): ?>
                <p class="error">＊パスワードを入力してください</p>
                <?php endif ?>
            </div>
            <br>

            <div class="control">
                <label for="email">メールアドレス<span class="required"></span></label>
                <input id="email" type="email" name="email">
                <?php if (!empty($error["email"]) && $error['email'] === 'blank'): ?>
                <p class="error">＊パスワードを入力してください</p>
                <?php endif ?>
            </div>
            <br>

            <div class="control">
                <label for="password">パスワード<span class="required"></span></label>
                <input id="password" type="password" name="password">
                <?php if (!empty($error["password"]) && $error['password'] === 'blank'): ?>
                    <p class="error">＊パスワードを入力してください</p>
                <?php endif ?>
            </div>
 
            <div class="control">
                <button type="submit" class="btn">次へ</button>
            </div>
        </form>
        <br>
        <br>

        <a href="../index.php">ログイン画面へ戻る</a>

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