<?php
session_start();
include("../functions.php");
check_session_id();


$username = $_SESSION["username"];
$title = $_POST["title"];
$text = $_POST["text"];



// ファイル関連の取得
$file = $_FILES["thumbnail"];
$filename = basename($file["name"]);
$tmp_path = $file["tmp_name"];
$file_err = $file["error"];
$filesize = $file["size"];
$upload_dir = "images/";

$save_filename = date("YmdHis") . $filename;
$save_path = $upload_dir . $save_filename;


//ファイルのバリデーション
//ファイルサイズが１MB以内か
if($filesize > 1048576 || $file_err == 2){
    echo "ファイルは１MB未満にしてください";
        echo"<br>";

}

//拡張子は画像形式か
$allow_ext = array("jpg","jpeg","png");
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if(!in_array(strtolower($file_ext),$allow_ext)){
    echo "画像ファイルを添付してください";
    echo"<br>";
}

//ファイルはあるかどうか
if(is_uploaded_file($tmp_path)){
    if(move_uploaded_file($tmp_path, $upload_dir . 
    $save_filename)){

    //DBに保存(ファイル名、ファイルパス、キャプション)
    // $result = fileSave($filename, $save_path,$caption,$username);
    


    }else{
    echo "ファイルが保存できませんでした";
    }

}else{
    echo "ファイルが選択されていません";
}
    echo"<br>";

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>file_upload</title>
      <!-- <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura-earthly.css" type="text/css"> -->

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/headers/">

     <!-- Bootstrap core CSS -->
 <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
</style>


<!-- Custom styles for this template -->
<link href="headers.css" rel="stylesheet">

</head>

<body class="landing is-preload">

     <!-- ヘッダー、ナビゲーションバー、選択時の色を変える -->
     <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
          <a href="../toppage.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4"><img id="nav_l" src="../images/IMG_5507.PNG" alt="アイコン">Chalk up</span>
          </a>

          <ul class="nav nav-pills">
            <li class="nav-item"><a href="../mypage.php" class="nav-link" aria-current="page">マイページ</a></li>
            <li class="nav-item"><a href="../search.php" class="nav-link">探す</a></li>
            <li class="nav-item"><a href="post/post.php" class="nav-link">書く</a></li>
            <li class="nav-item"><a href="../question.php" class="nav-link">質問する</a></li>
            <li class="nav-item"><a href="../background/todo_logout.php" class="nav-link">ログアウト</a></li>
          </ul>
        </header>
      </div>
    
  <main>

  <h1 class="account">投稿内容の確認</h1>
    <br>


  <p>タイトル</p>
    <fieldset> 
        <?php echo "$title"?>
    </fieldset>
  <br><br>

  <p>本文</p>
    <fieldset>
        <?php echo "$text"?>
    </fieldset>
  <br><br>

  <p>サムネイル画像</p>
  <fieldset id="thumbnail">
    <img src=./<?php echo "{$save_path}" ?> style="width: 200px;" alt="">
  </fieldset>


  <form action="post_act.php" method="POST">
<input type="hidden" name="title" value="<?php echo "{$title}" ?>">
<input type="hidden" name="text" value="<?php echo "{$text}" ?>">
<input type="hidden" name="thumbnail" value="<?php echo "{$save_path}" ?>">

<br>
<button>投稿</button>

  </form>

<!-- <input type="button" value="修正" src="post.php"> -->
<a href="post.php">修正</a>

</main>

</body>

    <style>
      main{

        display: flex;
        /* justify-content: center;
        text-align: center; */
        align-items: center;
        flex-direction: column;
        padding-left: 350px;
        padding-right: 350px;
}

.account{
    font-size: 30px;
    display: flex;
    text-align: center;
  }
        #thumbnail{
            width: 200px;
        }

        #output li {
            background-color: rgb(231, 235, 218);
            list-style-type: none

        }

        #send{
            width: 150px;
        }

        #nyuuryoku{
            margin-top: 30px;
        }

        #setumei{
            font-size: 10px;
        }

        #top{
            /* width: 100%; */
            display: flex;
          justify-content: space-between;
        }

        #top h1{
            width: 100%;
        }

        #top img{
            width: 30%;
        }

        #showPic{
            width: 200px;
        }

        #nav_l{
            height:50px;
        }
    </style>