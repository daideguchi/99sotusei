<?php
session_start();
include("functions.php");
check_session_id();

$question_all = question_all();
// $comment_count = comment_count();
// $count = $comment_count->fetchColumn();

// var_dump($question_all);
// exit;

?>


<!DOCTYPE html>
<html lang="ja">

</html>
<html>

<head>
 
    <title>質問する</title>
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
    <a class="navbar-brand" href="#"><u><b>トップページ</b></u></a>
    <a class="navbar-brand" href="mypage.php">マイページ</a>
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

<br>
<a href="question/question_post.php" class="btn btn-secondary" style="text-align: center;">質問する</a>
			<!-- Main -->
				<section id="main" class="container">


          <br><br>

	<div>
        <?php foreach($question_all as $question): ?>


        <?php 
          if ($question["ok"] === 0) {?>
              <p>未解決</p>
            <?php } else {?>
              <p>解決ずみ</p> 
           <?php }?>

			<a href='question_article.php?id=<?php echo "{$question["ques_id"]}" ?>'>
			<?php echo h("{$question["ques_title"]}") ?></a>
<p><img src="images/pencil.svg" width="20px"><?php echo "{$question["username"]}"  ?></a> | <?php echo "{$question["pref"]}"?> | <?php echo "{$question["city"]}"?> | <?php echo "{$question["department"]}"?><br><br></p>

			</b></p></div>
            <div><p><?php echo h("{$question["question"]}")?></p></div>
            </div>
            </div>
            <br>
        <?php endforeach ?>
	</div>








			<!-- Footer -->
				<footer id="footer">

					<ul class="copyright">
						<li>&copy; welbe-ing All rights reserved.</li>
					</ul>
				</footer>

		</div>

	</body>
</html>