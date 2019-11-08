<?php
// echo 'START';
// データベースに接続
$url = parse_url(getenv('DATABASE_URL'));
$dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
$pdo = new PDO($dsn, $url['user'], $url['pass']);

if($_COOKIE['color0'] && $_COOKIE['color1'] && $_COOKIE['color2']){ // POST値がある時

	$stmt = $pdo->prepare('INSERT INTO color_tb (color01, color02, color03) VALUES(:color01, :color02, :color03)');
	$stmt->bindParam(':color01', $_COOKIE['color0'], PDO::PARAM_STR);
	$stmt->bindParam(':color02', $_COOKIE['color1'], PDO::PARAM_STR);
	$stmt->bindParam(':color03', $_COOKIE['color2'], PDO::PARAM_STR);
	$stmt->execute();

}

?>
