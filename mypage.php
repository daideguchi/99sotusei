<?php
session_start();
include("functions.php");
check_session_id();
$userdata = userinfo();
$postData = getpost();
$good_total = good_total();
$question_total = question_total();

$id = $_SESSION["id"];


//   $status = $stmt->execute();
  $good_total = $good_total->fetch();

// var_dump($good_total);
if($good_total["SUM((good))"] === NULL){
    $good_total["SUM((good))"] = 0;
}
// var_dump($good_total["SUM((good))"]);
// exit();


$pdo = connect_to_db();




//ユーザーがいいねした総数を表示////
$sql = 'SELECT COUNT(*) FROM good WHERE session_user_id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$good_to_total = $stmt->fetch();

// var_dump($good_to_total);
// exit();

//--------いいねの表示に関するところ------------




////////もらったコメント/////////
$sql = 'SELECT SUM((comment)) FROM (posts_table) WHERE user_id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$comment_total = $stmt->fetch();

if($comment_total["SUM((comment))"] === NULL){
    $comment_total["SUM((comment))"] = 0;
}

///////送ったコメント////////
$sql = 'SELECT COUNT(*) FROM comment_table WHERE user_id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$comment_to_total = $stmt->fetch();


////////////////////////////////////////////////////////////////

///////送った回答////////
$sql = 'SELECT COUNT(*) FROM answer_table WHERE user_id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$answer_to_total = $stmt->fetch();

////////もらった回答/////////
$sql = 'SELECT SUM((answer)) FROM (question_table) WHERE user_id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$answer_total = $stmt->fetch();

if($answer_total["SUM((answer))"] === NULL){
    $answer_total["SUM((answer))"] = 0;
}
////////////////////////////////////

// var_dump($comment_to_total);
// exit();

// if($comment_to_total["SUM((user_id))"] === NULL){
//     $comment_to_total["SUM((user_id))"] = 0;
// }
//--------コメントの表示に関するところ------------





//--------フォローに関するところ--------------------
$sql = 'SELECT SUM((follow_to)) FROM (users_table) WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$follow_to_total = $stmt->fetch();

// var_dump($follow_to_total);
// exit();

$sql = 'SELECT SUM((follow_from)) FROM (users_table) WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$follow_from_total = $stmt->fetch();

//--------フォローに関するところ---------------------









foreach($userdata as $user):
    $prof_img = $user["prof_img"];
    $screen_img = $user["screen_img"];
    $username = $user["username"];
    $pref = $user["pref"];
    $city = $user["city"];
    $introduction = $user["introduction"];

endforeach;

$param = array(
    "住所" => $city,
);
$param_json = json_encode($param); //JSONエンコード

// var_dump($param_json);
// exit();
// var_dump($screen_img);
// exit();
?>


<!DOCTYPE html>
<html lang="ja">

</html>
<html>

<head>
 
    <title>マイページ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/css/main.css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura-earthly.css" type="text/css"> -->

	</head>
	<body class="landing is-preload">
		<div id="page-wrapper">

			<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    
    <a class="navbar-brand" href="toppage.php"><img id="nav_l" src="images/IMG_5507.PNG" alt=""></a>
    <a class="navbar-brand" href="#"><u><b>マイページ</b></u></a>
    <a class="navbar-brand" href="search.php">探す</a>
    <a class="navbar-brand" href="./post/post.php">書く</a>
    <a class="navbar-brand" href="question.php">質問する</a>  

      <!-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
      <a href="./background/todo_logout.php">ログアウト</a>
    </div>
  </div>
</nav>


    <body>

        <div class="screen_img">
            <img class="screen_img" src="./setting/<?php echo "{$screen_img}"?>" alt="">
        </div>
        <br>
        <div class="prof_area">
            <div class="prof_img">
                <img class="prof_img" src="./setting/<?php echo "{$prof_img}"?>" alt="">
            </div>
            <div class="prof">

                <div class="container">
                    


                    <div class="row row-cols-auto">
                    <div class="col"><?php echo h("{$username}") ?></div>
                    </div>
                    <div class="w-100"></div>
                    
                    <div class="row row-cols-auto">
                    <div>
                    <div ><?php echo h("{$pref}") ?> | <?php echo h("$city") ?> | <?php echo h("{$user["department"]}") ?></div>
                    <br />
                    <div ><?php echo h("{$introduction}") ?></div>
                    </div>

                    </div>
                </div>

            </div>
        <p>フォロー：<?php echo "{$follow_to_total["SUM((follow_to))"]}"?></p>
        <p>フォロワー：<?php echo "{$follow_from_total["SUM((follow_from))"]}"?></p>


        </div>
        <a href="./setting/mypage_set.php">設定</a>


        <p>活動記録トータルポイント：</p>
        <p>もらったいいね数：<?php echo "{$good_total["SUM((good))"]}"?></p>
        <p>おくったいいね数：<?php echo "{$good_to_total["COUNT(*)"]}"?></p>

        <p>もらったコメント数：<?php echo "{$comment_total["SUM((comment))"]}"?></p>
        <p>おくったコメント数：<?php echo "{$comment_to_total ["COUNT(*)"]}"?></p>

        <p>質問に答えた数：<?php echo "{$answer_to_total ["COUNT(*)"]}"?></p>
        <p>質問に答えてもらった数：<?php echo "{$answer_total ["SUM((answer))"]}"?></p>
 
        

<!-- 地図/////////////////////////////////////////////////////////////////////// -->


 <div id="gmap" style="height:400px;width:600px"></div> <!-- 地図を表示する領域 -->
  
<script>
 var param = JSON.parse('<?php echo $param_json; ?>'); //JSONデコード
    a = param.住所
    console.log(a);
function initMap() {
  //地図を表示する領域の div 要素のオブジェクトを変数に代入
  var target = document.getElementById('gmap');  
  //HTMLに記載されている住所の取得
  var address = a; 
  //ジオコーディングのインスタンスの生成
  var geocoder = new google.maps.Geocoder();  
  
  //geocoder.geocode() にアドレスを渡して、コールバック関数を記述して処理
  geocoder.geocode({ address: address }, function(results, status){
  //ステータスが OK で results[0] が存在すれば、地図を生成
     if (status === 'OK' && results[0]){  
        new google.maps.Map(target, {
        //results[0].geometry.location に緯度・経度のオブジェクトが入っている
          center: results[0].geometry.location,
          zoom: 14
        });
     }else{ 
     //ステータスが OK 以外の場合や results[0] が存在しなければ、アラートを表示して処理を中断
       alert('失敗しました。理由: ' + status);
       return;
     }
  });
}
</script> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhiWaH78BNWwF9BsDbPtyUzNVOhLrFjJQ&callback=initMap" async defer></script><!-- YOUR_API_KEYの部分は取得した APIキーで置き換えます -->  


<!-- /////////////////////////////////////////////////////////////////////// -->

<br><br>
        <?php foreach($postData as $post): ?>
            <div style="display: flex;"><img src=./post/<?php echo "{$post["thumbnail"]}" ?> class="img-thumbnail" style="width: 200px;" alt=""> 
            <div>
            <div><p><b>
			<a href='article.php?id=<?php echo "{$post["post_id"]}" ?>'>
			<?php echo h("{$post["title"]}") ?></a>
            <br>
            <p>　いいね♡<?php echo "{$post["good"]}"  ?>　|　コメント<?php echo "{$post["comment"]}"  ?>　|　<?php echo "{$post["p_created_at"]}"  ?><a href='./background/todo_delete.php?id=<?php echo "{$post["post_id"]}" ?>'>(削除する)</a></p>
			</b></p></div>
            <div><p><?php echo h("{$post["text"]}")?></p></div>
            </div>
            </div>
            <br>
        <?php endforeach ?>
        
<!-- 
<script src="./sample.js"></script>
  <script src="//maps.googleapis.com/maps/api/js?key={AIzaSyBAV-z7GyTMzJOheQmN5g1T9KD3QC11ym0}&callback=initMap" async></script>
 
   -->


<!-- <script>
var MyLatLng = new google.maps.LatLng(35.6811673, 139.7670516);
var Options = {
 zoom: 15,      //地図の縮尺値
 center: MyLatLng,    //地図の中心座標
 mapTypeId: 'roadmap'   //地図の種類
};
var map = new google.maps.Map(document.getElementById('map'), Options);
</script> -->

</body>

</html>


    <style>
        .screen_img{
            height: 250px;
            width: 100%;
            background-color: #dcdcdc;
            background:url(./setting/images/screen_img_defult.png);            
            background-position: center;
            background-size: cover;
            border: solid;
            text-align: center;
            object-fit: cover; 
        }

      .prof_img {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        border: 1px solid #000000;
        background:url(./setting/images/prof_defult.jpeg);   
        background-position: center;
        background-size: cover;       
      }

      .prof_area{
          display: flex;
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


        #sample {
            width: 700px;
            height: 400px;
        }


        html { height: 100% }
        body { height: 100% }
        #map { height: 300px; width: 300px}

        #nav_l{
            height:50px;
        }

    </style>