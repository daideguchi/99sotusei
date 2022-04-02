<?php
session_start();
include("functions.php");
check_session_id();
$userdata = userinfo();
$allpostData = getAllpost();


// var_dump($_GET);
// exit();
$user_id = $_SESSION["id"];
$username = $_SESSION["username"];
$post_id = $_GET["id"];

$pdo = connect_to_db();
$sql = "SELECT * FROM posts_table WHERE post_id=$post_id";
$stmt = $pdo->prepare($sql);


try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

foreach($stmt as $article): 
    $thumbnail = $article['thumbnail'];
    $title = $article['title'];
    $text = $article['text'];
 endforeach;


$sql_comment = "SELECT * FROM comment_table WHERE post_id=$post_id";
$stmt_comment = $pdo->prepare($sql_comment);


try {
  $status_comment = $stmt_comment->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
 
?>





<!DOCTYPE html>
<html lang="ja">

</html>
<html>

<head>
 
    <title>記事</title>
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
                        <a class="navbar-brand" href="toppage.php">トップページ</a>
                        <a class="navbar-brand" href="mypage.php">マイページ</a>
                        <a class="navbar-brand" href="search.php">探す</a>
                        <a class="navbar-brand" href="./post/post.php">書く</a>

                        <!-- <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> -->
                        <!-- <a href="./background/todo_logout.php">ログアウト</a> -->
                        </nav>
                    </div>
                </div>
            
            <img src=./post/<?php echo "{$thumbnail}"?> style="width:300px" alt="">
            <br>
            <h1><u><?php echo h("{$title}") ?></u></h1>
            <?php echo h("{$text}") ?>


<br><br><br>            
<hr>
<h2><u>コメント(<?php echo "{$comment_count}"?>)</u></h2>
<br>

	<div>
        <?php foreach($stmt_comment as $comment): ?>
            <div>
            <div><p>
			<a href='userspage.php?id=<?php echo "{$comment["user_id"]}" ?>'>
			<?php echo h("{$comment["username"]}") ?></a>
			</b></p></div>
            <div><p><?php echo h("{$comment["comment"]}")?></p></div>
            </div>
            </div>
            <br>
            <hr>
        <?php endforeach ?>
	</div>



<h3>コメントを書く</h3>
<form action="./background/todo_comment.php" method="POST">
  <textarea name="comment" cols="80" rows="5"></textarea>
<br>
<input type="hidden" name="post_id" value="<?php echo "{$post_id}" ?>">
<input type="hidden" name="user_id" value="<?php echo "{$user_id}" ?>">
<input type="hidden" name="username" value="<?php echo "{$username}" ?>">
<button type="submit" class="btn btn-primary">送信</button> 
</form>

</body>
</html>