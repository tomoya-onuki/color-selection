<?php
// データベースに接続
$url = parse_url(getenv('DATABASE_URL'));
$dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
$pdo = new PDO($dsn, $url['user'], $url['pass']);

// データ取得
// echo $_GET['id'];

if ($_GET['id']) {
  $stmt = $pdo->prepare('DELETE FROM color_tb WHERE id = :id');
	$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_STR);
	$stmt->execute();
}

header('location: index.php');
?>
