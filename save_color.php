<?php
// echo 'START';
// データベースに接続
$url = parse_url(getenv('DATABASE_URL'));
$dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
$pdo = new PDO($dsn, $url['user'], $url['pass']);

var_dump($_POST);

if($_POST['color_01'] && $_POST['color_02'] && $_POST['color_03']){ // POST値がある時

	$stmt = $pdo->prepare('INSERT INTO color_tb (color01, color02, color03) VALUES(:color01, :color02, :color03)');
	$stmt->bindParam(':color01', $_POST['color_01'], PDO::PARAM_STR);
	$stmt->bindParam(':color02', $_POST['color_02'], PDO::PARAM_STR);
	$stmt->bindParam(':color03', $_POST['color_03'], PDO::PARAM_STR);
	var_dump($stmt);
	$stmt->execute();

} else {
	echo "hoge";
}

?>
