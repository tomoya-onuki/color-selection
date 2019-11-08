<?php
echo 'START';
// データベースに接続
$url = parse_url(getenv('DATABASE_URL'));
$dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
$pdo = new PDO($dsn, $url['user'], $url['pass']);

// function h($str) {
//     return htmlspecialchars($str, ENT_QUOTES, 'UTF=8');
// }


// データ取得
$stmt = $pdo->prepare('SELECT * FROM color_tb');
$stmt->execute();

// データをcolor変数に格納
$i = 0;
while ($colors = $stmt -> fetch(PDO::FETCH_ASSOC)) {
	// $color[$i][0] = $colors['color01'];
	// $color[$i][1] = $colors['color02'];
	// $color[$i][2] = $colors['color03'];
	// $i+=1;
	echo $colors['color01'];
	echo $colors['color02'];
	echo $colors['color03'];
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



		<div id="container"></div> <!-- canvasを設置するためのdivタグ -->
		<script type="text/javascript">
		var cvs = document.createElement("canvas"); // canvasタグの動的生成
		var width = 800;  // サイズ
		var height = 400; // サイズ
		cvs.width = width;
		cvs.height = height; // サイズの設定
		document.getElementById("container").appendChild(cvs); // l2のdivに配置する
		var ctx = cvs.getContext("2d"); // canvasに描画するためのオブジェクト



		var w = 100, h = 100;

		for (var i = 0; i < array.length; i++) {
			array[i]
		}
		ctx.fillStyle = "<?php echo $colors['color01']; ?>";
		ctx.fillRect(0, 10, w, h);
		ctx.fillStyle = "<?php echo $colors['color02']; ?>";
		ctx.fillRect(w+2, 10, w, h);
		ctx.fillStyle = "<?php echo $colors['color03']; ?>";
		ctx.fillRect(w+w+4, 10, w, h);
		</script>


		<center>
			<!-- フッター -->
      <div style="font-size: 70%; margin-top:30px; margin-bottom:80px;">
        <p>©️2019 小貫智弥 | Tomoya Onuki</p>
      </div>
      <!-- ここまで -->
		</center>
	</body>
</html>
