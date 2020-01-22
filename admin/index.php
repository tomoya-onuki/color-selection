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
		<title>管理者画面 | COLOR SELECTION</title>
		<link rel="stylesheet" type="text/css" href="../my.css">
	</head>

	<body>

		<center>
			<div class=header>
				<a href="../index.php"><h1>COLOR SELECTION</h1></a>
			</div>
      <h2 style="margin-top:90px;">管理者用画面</h2>

			<!-- カラーファイルの編集 -->
			<div>
				<h3>カラーファイルの編集</h3>
				<table border="1">
					<tr>
						<th>ID</th>
						<th colspan="3">カラーコード</th>
						<th>削除</th>
					</tr>
				<?php
				$stmt = $pdo->prepare('SELECT * FROM color_tb');
				$stmt->execute();

				// データをcolor変数に格納
				$i = 0;
				while ($colors = $stmt -> fetch(PDO::FETCH_ASSOC)) {
					echo '<tr>'."\n";
					echo '<th>'.$colors['id'].'</th>'."\n";
					echo '<th bgcolor="'.$colors['color01'].'">'.$colors['color01'].'</th>'."\n";
					echo '<th bgcolor="'.$colors['color02'].'">'.$colors['color02'].'</th>'."\n";
					echo '<th bgcolor="'.$colors['color03'].'">'.$colors['color03'].'</th>'."\n";
					echo '<th><a href="delete.php?id='.$colors['id'].'">削除</a></th>'."\n";
					echo '</tr>';
				}

				?>
				</table>
			</div>
			<!-- ここまで -->

			<!-- フッター -->
      <div style="font-size: 70%; margin-top:30px; margin-bottom:80px;">
        <p>©️2019-2020 小貫智弥 | Tomoya Onuki</p>
      </div>
      <!-- ここまで -->
		</center>
	</body>
</html>
