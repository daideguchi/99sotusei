<?php
class Connect extends PDO
{
    public function __construct()
    {
        parent::__construct("mysql:host=localhost;dbname=gsacf_d10_05", 'root','',
        // parent::__construct("mysql:dbname=heroku_216b601f26418e8;charset=utf8mb4;port=3306;host=us-cdbr-east-05.cleardb.net", 'b5184191d44d54','cd70a3e5',
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    
    }


}



function connect_to_db()
{
  //localhost
  $dbn = 'mysql:dbname=gsacf_d10_05;charset=utf8mb4;port=3306;host=localhost';
  $user = 'root';
  $pwd = '';

  //lolipop
  // $dbn = 'mysql:dbname=LAA1351624-3m2sih;charset=utf8mb4;port=3306;host=mysql153.phy.lolipop.lan';
  // $user = 'LAA1351624';
  // $pwd = 'kdJayFzX';

//   heroku
//   $dbn = 'mysql:dbname=heroku_216b601f26418e8;charset=utf8mb4;port=3306;host=us-cdbr-east-05.cleardb.net';
//   $user = 'b5184191d44d54';
//   $pwd = 'cd70a3e5';
  	$options = array(
		// SQL実行失敗時にはエラーコードのみ設定
		PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
		// デフォルトフェッチモードを連想配列形式に設定
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		// バッファードクエリを使う(一度に結果セットをすべて取得し、サーバー負荷を軽減)
		// SELECTで得た結果に対してもrowCountメソッドを使えるようにする
		PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
	);
	// PDOオブジェクト生成（DBへ接続）
	$dbh = new PDO($dbn, $user, $pwd, $options);
	return $dbh;

  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }
}



?>
