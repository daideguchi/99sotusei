<?php
session_start();
include("functions.php");
check_session_id();

$question_all = question_all();
// $comment_count = comment_count();
// $count = $comment_count->fetchColumn();

// var_dump($question_all);
// exit;



// var_dump($allpostData);
// exit();
// var_dump($comment_count);
// exit();
$user_id = $_SESSION["id"];
$username = $_SESSION["username"];
$ques_id = $_GET["id"];

$pdo = connect_to_db();

//回答の件数を取得
$sql_answer = "SELECT COUNT(*) FROM answer_table WHERE ques_id = $ques_id";
$answer_count = $pdo->query($sql_answer);
$count = $answer_count->fetchColumn();


$sql = "SELECT * FROM `users_table` JOIN `question_table` 
ON users_table.id = question_table.user_id 
WHERE ques_id = $ques_id;";
$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

foreach($stmt as $article): 
    $ques_title = $article['ques_title'];
    $question = $article['question'];
    $quesuser = $article['username'];
    $quesuser_id = $article['id'];
    $quesuser_pref = $article['pref'];
    $quesuser_city = $article['city'];
    $quesuser_department = $article['department'];
    $ok = $article['ok'];
 endforeach;



//回答を表示するための準備
$sql_answer = "SELECT * FROM answer_table WHERE ques_id=$ques_id";
$stmt_answer = $pdo->prepare($sql_answer);

// var_dump($stmt_answer);
// exit();

try {
  $status_answer = $stmt_answer->execute();
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
 
    <title>質問記事</title>
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
                        <a class="navbar-brand" href="question.php">質問する</a>   


                        <!-- <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> -->
                        <!-- <a href="./background/todo_logout.php">ログアウト</a> -->
                        </nav>
                    </div>
                </div>

            <?php if ($ok != 0) {?>
                <p>解決ずみ</p>
                <?php
            } else {?>
                <p>未解決</p>
                <?php }?>

        <?php 
        if ($user_id === $_SESSION["id"]) {?>
            <?php if ($ok != 0) {?>
                <a href="./background/answer_act.php?id=<?php echo "{$ques_id}" ?>">未解決にする</a>

                <?php
            } else {?>
                <a href="./background/answer_act.php?id=<?php echo "{$ques_id}" ?>">解決済みにする</a>
            <?php }?>
        <?php }?>


            <br>
            <h1><u><?php echo h("{$ques_title}") ?></u></h1>
            <br><br>投稿者：<a href='userspage.php?id=<?php echo "{$quesuser_id}" ?>'>
            <?php echo h("{$quesuser}") ?></a> | <?php echo h("{$quesuser_pref}")?> | <?php echo h("{$quesuser_city}")?> | <?php echo h("{$quesuser_department}")?><br><br>

            <?php echo h("{$question}") ?>



            
<br><br><br>            
<hr>
<h3><u>回答(<?php echo "{$count}"?>)</u></h3>
<br>

	<div>
        <?php foreach($stmt_answer as $answer): ?>
            <div>
            <div><p>
			<a href='userspage.php?id=<?php echo "{$answer["user_id"]}" ?>'>
			<?php echo h("{$answer["username"]}") ?></a>
			</b></p></div>
            <div><p><?php echo h("{$answer["answer"]}")?></p></div>
            </div>
            </div>
            <br>
            <hr>
        <?php endforeach ?>
	</div>



<h3>回答する</h3>
<form action="./background/todo_answer.php" method="POST">
  <textarea name="answer" cols="80" rows="5"></textarea>
<br>
<input type="hidden" name="ques_id" value="<?php echo "{$ques_id}" ?>">
<input type="hidden" name="user_id" value="<?php echo "{$user_id}" ?>">
<input type="hidden" name="username" value="<?php echo "{$username}" ?>">

<button type="submit" class="btn btn-primary">送信</button> 
</form>

</body>
</html>

<style>
.btn-good{
    display: inline-block;
    padding: 0 8px;
    cursor: pointer;
}
.btn-good:hover{
    color: #f44336;
}
.active{
    color: #f44336;
}
.btn-good .active{
    color: #f44336;
}


</style>