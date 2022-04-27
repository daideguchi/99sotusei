<?php
session_start();
include("../functions.php");
check_session_id();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
 
    <title>質問する</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura-earthly.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="../editer_tool/jquery.cleditor.css" />

    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../editer_tool/jquery.cleditor.min.js"></script>
    <!-- <script type="text/javascript">
      $(document).ready(function () {
        $("#input").cleditor();
      });
    </script> -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a href="#"><u><b>書く</b></u></a>
    <a href="../toppage.php">トップページ</a>
    <a href="../mypage.php">マイページ</a>
    <a href="../search.php">探す</a>

      <!-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
      <a href="../background/todo_logout.php">ログアウト</a>
    </div>
  </div>
</nav>

    <body>
        <div id="top">
        <h1><u>質問投稿</u></h1>
        </div>


        <form action="question_act.php" method="POST">

            <div>タイトル: <input type="text" name="ques_title" style="
                width: 622px;
                padding-left: 10px;
                padding-right: 10px;
            "></div>
            <br />

            <div>本文: </div>
            <textarea id="input" name="question"></textarea>
            <!-- <p>※現在、リッチテキストだとDB保存できない</p> -->
            <br />

            <!-- <div>サムネイル画像: </div>
            <input name="thumbnail" id="uploader" type="file" accept="image/*">
            <div id="showPic"></div> -->

            <div>
                <button>投稿</button>
            </div>

         </form>
         <br><br>
         <a href="../question.php">戻る</a>


    </body>

</html>


    <style>
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
    </style>