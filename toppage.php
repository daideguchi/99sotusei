<?php
session_start();
include("functions.php");
check_session_id();
$userdata = userinfo();
$allpostData = getAllpost();
// $topgood = topgood();

// var_dump($topgood);
// exit();
// $comment_count = comment_count();
// $count = $comment_count->fetchColumn();

?>


<!DOCTYPE html>
<html lang="ja">

</html>
<html>

<head>
 
    <title>Chalk up-自治体ではたらく人のためのナレッジ共有SNS-</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/css/main.css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura-earthly.css" type="text/css"> -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/headers/">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">

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
          <a href="toppage.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4"><img id="nav_l" src="images/IMG_5507.PNG" alt="アイコン">Chalk up</span>
          </a>

          <ul class="nav nav-pills">
            <li class="nav-item"><a href="mypage.php" class="nav-link" aria-current="page">マイページ</a></li>
            <li class="nav-item"><a href="search.php" class="nav-link">探す</a></li>
            <li class="nav-item"><a href="./post/post.php" class="nav-link">書く</a></li>
            <li class="nav-item"><a href="question.php" class="nav-link">質問する</a></li>
            <li class="nav-item"><a href="./background/todo_logout.php" class="nav-link">ログアウト</a></li>
          </ul>
        </header>
      </div>


    <!-- Main -->
    <section id="main" class="container">


            <!-- トップイメージの部分 -->
            <section class="py-5 text-center container">
            <div class="row py-lg-5">
              <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Chalk up</h1>
                <p class="lead text-muted">自治体で働く人のためのナレッジ共有SNS</p>
                <span class="image featured"><img id="top_img" src="images/IMG_5509.JPG" alt="" /></span>

                  <!-- <a href="#" class="btn btn-primary my-2">Main call to action</a>
                  <a href="#" class="btn btn-secondary my-2">Secondary action</a> -->
                </p>
              </div>
            </div>
          </section>

          <!-- 元のトップイメージ
          <section class="box special">
                <span class="image featured"><img id="top_img" src="images/IMG_5509.JPG" alt="" /></span>
              </section> -->

              <br>

            
            <!-- 記事が縦に追加されていく処理 -->
            <!-- ブートストラップでの１つの記事の処理 -->
            <!-- <div class="album py-5 bg-light">
              <div class="container">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <div class="col">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

                          <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                              <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <small class="text-muted">9 mins</small>
                          </div>
                        </div>
                      </div>
                    </div>

                </div>
              </div>
            </div> -->


          <!-- 元のコード -->
            <div class="album py-5 bg-light">
            <?php foreach($allpostData as $post): ?>
              <!-- サムネイル -->
                <div style="display: flex;"><img src=./post/<?php echo "{$post["thumbnail"]}" ?> class="img-thumbnail" style="width: 200px;" alt="記事サムネイル"> 
                <div style="margin-left: 20px;">
                <div>
                <p>
                <b>

                <!-- 記事のタイトル -->
            <a href='article.php?id=<?php echo "{$post["post_id"]}" ?>'>
          <?php echo h("{$post["title"]}") ?></a>
          <!-- ユーザー情報 -->
        <p><img src="images/pencil.svg" width="20px"><?php echo "{$post["username"]}"  ?></a> | <?php echo "{$post["pref"]}"?> | <?php echo "{$post["city"]}"?> | <?php echo "{$post["department"]}"?><br></p>


              <!-- いいね、コメント、投稿時間 -->
        <p>いいね♡<?php echo "{$post["good"]}"  ?> | コメント<?php echo "{$post["comment"]}"  ?> | <?php echo "{$post["p_created_at"]}"  ?></p>
          </b></p></div>
                <div><p><?php echo h("{$post["text"]}")?></p></div>
                </div>
                </div>
                <br>
            <?php endforeach ?>
      </div>


          <!-- Footer -->
          <br><br><br>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

	</body>
</html>


<style>
 #top_img{
   width: 100%;
   height:400px;
   text-align: center;
 }

 #nav_l{
            height:50px;
        }


</style>