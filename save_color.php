<?php
// echo 'START';
// データベースに接続
$url = parse_url(getenv('DATABASE_URL'));
$dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
$pdo = new PDO($dsn, $url['user'], $url['pass']);


if($_POST['color01'] && $_POST['color02'] && $_POST['color03']){ // POST値がある時

	$stmt = $pdo->prepare('INSERT INTO color_tb (color01, color02, color03) VALUES(:color01, :color02, :color03)');
	$stmt->bindParam(':color01', $_POST['color01'], PDO::PARAM_STR);
	$stmt->bindParam(':color02', $_POST['color02'], PDO::PARAM_STR);
	$stmt->bindParam(':color03', $_POST['color03'], PDO::PARAM_STR);
	$stmt->execute();

}

?>
