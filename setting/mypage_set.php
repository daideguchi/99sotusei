<?php
session_start();
include("../functions.php");
check_session_id();

?>


<!DOCTYPE html>
<html lang="ja">


<head>
 
    <title>設定</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura-earthly.css" type="text/css">
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../mypage.php">マイページ</a>
            <a class="navbar-brand" href="../toppage.php">トップページ</a>
            <a class="navbar-brand" href="../search.php">探す</a>
            <a class="navbar-brand" href="../post/post.php">書く</a>


            </div>
        </div>
        </nav>
            <br><br><br>
        <div id="top">


        <form action="mypage_set_act.php" method="POST" enctype="multipart/form-data">
        <p>自己紹介文</p>
            <textarea id="input" name="introduction"></textarea>

        <p>トップ画</p>
            <input name="prof_img" id="uploader1" type="file" accept="image/*">
            <div id="showPic1"></div>

        <p>背景画像</p>
            <input name="screen_img" id="uploader2" type="file" accept="image/*">
            <div id="showPic2"></div>

            <div>
                <button>確定</button>
            </div>

            <input type="hidden" name="max" value="1048576" />
         </form>

    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

        <script>
            $("#uploader1").change(function (evt) {
            let file = evt.target.files;
            let reader = new FileReader();
            let dataUrl = "";
            reader.readAsDataURL(file[0]);
            reader.onload = function () {
                dataUrl = reader.result;
                $("#showPic1").html("<img src='" + dataUrl + "'>");
            };
            });

            $("#uploader2").change(function (evt) {
            let file = evt.target.files;
            let reader = new FileReader();
            let dataUrl = "";
            reader.readAsDataURL(file[0]);
            reader.onload = function () {
                dataUrl = reader.result;
                $("#showPic2").html("<img src='" + dataUrl + "'>");
            };
            });
        </script>

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