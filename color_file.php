<?php
// データベースに接続
$url = parse_url(getenv('DATABASE_URL'));
$dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
$pdo = new PDO($dsn, $url['user'], $url['pass']);

// データ取得

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

		<center>
			<div class=header>
				<a href="index.php"><h1>COLOR SELECTION</h1></a>
			</div>

			<?php
			$stmt = $pdo->prepare('SELECT * FROM color_tb');
			$stmt->execute();

			// データをcolor変数に格納
			$i = 0;
			while ($colors = $stmt -> fetch(PDO::FETCH_ASSOC)) {
				echo '<div>';
				echo '<div class="color_file_box" style="background-color:'.$colors['color01'].'"></div>';
				echo '<div class="color_file_box" style="background-color:'.$colors['color02'].'"></div>';
				echo '<div class="color_file_box" style="background-color:'.$colors['color03'].'"></div>';
				echo '</div>';
				echo '<div style="margin-top:-5px; margin-bottom:20px;">';
				echo '<div class="color_name">'.$colors['color01'].'</div>';
				echo '<div class="color_name">'.$colors['color02'].'</div>';
				echo '<div class="color_name">'.$colors['color03'].'</div>';
				echo '</div>';
			}
			?>

			<!-- フッター -->
      <div style="font-size: 70%; margin-top:30px; margin-bottom:80px;">
        <p>©️2019 小貫智弥 | Tomoya Onuki</p>
      </div>
      <!-- ここまで -->
		</center>
	</body>
</html>
