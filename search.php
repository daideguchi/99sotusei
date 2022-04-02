<?php
session_start();
include("functions.php");
check_session_id();
$userdata = userinfo();
$allpostData = getAllpost();

// var_dump($allpostData);
// exit();

    //  foreach($allpostData as $post):

    // endforeach 


?>

<html>
  <head>
    <title>記事を探す</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/css/main.css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura-earthly.css" type="text/css"> -->

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['都道府県'],
	
          ['北海道'	],
	
          ['青森'	],
	
          ['秋田'	],
	
          ['岩手'	],
	
          ['宮城'	],
	
          ['山形'	],
	
          ['福島'	],
	
          ['栃木'	],
	
          ['群馬'	],
	
          ['茨城'	],
	
          ['東京'	],
	
          ['埼玉'	],
	
          ['千葉'	],
	
          ['神奈川'	],
	
          ['静岡'	],
	
          ['愛知'	],
	
          ['岐阜'	],
	
          ['三重'	],
	
          ['滋賀'	],
	
          ['京都'	],
	
          ['大阪'	],
	
          ['奈良'	],
	
          ['和歌山'	],
	
          ['兵庫'	],
	
          ['徳島'	],
	
          ['香川'	],
	
          ['愛媛'	],
	
          ['高知'	],
	
          ['福岡'	],
	
          ['佐賀'	],
	
          ['長崎'	],
	
          ['大分'	],
	
          ['熊本'	],
	
          ['宮崎'	],
	
          ['鹿児島'	],
	
          ['沖縄'	],
	
          ['岡山'	],
	
          ['広島'	],
	
          ['山口'	],
	
          ['鳥取'	],
	
          ['島根'	],
	
          ['石川'	],
	
          ['福井'	],
	
          ['富山'	],
	
          ['山梨'	],
	
          ['長野'	],
	
          ['新潟'	],
        ]);

        var options = {

	    	region: 'JP',

		resolution: 'provinces'

	};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>
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
    <div id="regions_div" style="width: 900px; height: 500px; border: solid;"></div>
<br><br>
    	<div>
        <?php foreach($allpostData as $post): ?>
            <div style="display: flex;"><img src=./post/<?php echo "{$post["thumbnail"]}" ?> class="img-thumbnail" style="width: 200px;" alt=""> 
            <div>
            <div><p><b>
			<a href='article.php?id=<?php echo "{$post["post_id"]}" ?>'>
			<?php echo h("{$post["title"]}") ?></a>
			</b></p></div>
            <div><p><?php echo h("{$post["text"]}")?></p></div>
            </div>
            </div>
            <br>
        <?php endforeach ?>
	</div>
  </body>
</html>


