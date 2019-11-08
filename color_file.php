<?php
echo 'START';
// データベースに接続
$url = parse_url(getenv('DATABASE_URL'));
$dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
$pdo = new PDO($dsn, $url['user'], $url['pass']);

// データ取得
$stmt = $pdo->prepare('SELECT * FROM color_tb');
$stmt->execute();

// データをcolor変数に格納
$i = 0;
while ($colors = $stmt -> fetch(PDO::FETCH_ASSOC)) {
	echo $colors['color01'];
	echo $colors['color02'];
	echo $colors['color03'];
	echo "<br>";
}
?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>COLOR FILE</title>
		<link rel="stylesheet" type="text/css" href="./my.css">
		<script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://riversun.github.io/jsframe/jsframe.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	</head>

	<body>


		<div class="color_file_box" style="<?php echo "#ff0000"; ?>"></div>
		<div class="color_file_box"></div>
		<div class="color_file_box"></div>


		<center>
			<!-- フッター -->
      <div style="font-size: 70%; margin-top:30px; margin-bottom:80px;">
        <p>©️2019 小貫智弥 | Tomoya Onuki</p>
      </div>
      <!-- ここまで -->
		</center>
	</body>
</html>
