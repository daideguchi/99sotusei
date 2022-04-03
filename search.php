<?php
session_start();
include("functions.php");
check_session_id();
$userdata = userinfo();
$allpostData = getAllpost();

?>

<html>
  <head>
    <title>記事を探す</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/css/main.css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura-earthly.css" type="text/css"> -->

  </head>

  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><u><b>探す</b></u></a>
        <a class="navbar-brand" href="toppage.php">トップページ</a>
        <a class="navbar-brand" href="mypage.php">マイページ</a>
        <a class="navbar-brand" href="./post/post.php">書く</a>

        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <!-- <a href="./background/todo_logout.php">ログアウト</a> -->
        </div>
    </div>
    </nav>

<img src="images/japan_map.png" usemap="#ImageMap" alt="" />
<map name="ImageMap">
  <area shape="rect" coords="327,15,503,141" href="search_index.php?id=北海道" name="北海道" alt="北海道" />
  <area shape="rect" coords="351,366,392,385" href="search_index.php?id=東京都" name= "東京" alt="東京" />
  <area shape="rect" coords="91,316,120,344" href="search_index.php?id=福岡県" name="福岡" alt="福岡" />
</map>
<p>※ベータ版のため、リンクは北海道・東京・福岡のみ</p>

<br><br>


    	<div>
        <?php foreach($allpostData as $post): ?>
            <div style="display: flex;">
            <img src=./post/<?php echo "{$post["thumbnail"]}" ?> class="img-thumbnail" style="width: 200px;" alt=""> 
            <div>
              
            <div><p><b>
			<a href='article.php?id=<?php echo "{$post["post_id"]}" ?>'>
			<?php echo h("{$post["title"]}") ?></a>
			</b></p></div>
            <p><img src="images/pencil.svg" width="20px"><?php echo "{$post["username"]}"  ?></a> | <?php echo "{$post["pref"]}"?> | <?php echo "{$post["city"]}"?> | <?php echo "{$post["department"]}"?><br><br></p>
            <div><p><?php echo h("{$post["text"]}")?></p></div>
            </div>
            </div>
            <br>
        <?php endforeach ?>
	</div>
  </body>
</html>


