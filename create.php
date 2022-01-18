<?php

if (
  !isset($_POST['youtube_thumbnail']) || $_POST['youtube_thumbnail'] == '' ||
  !isset($_POST['contents']) || $_POST['contents'] == '' 
) {
  exit('paramError');
}
session_start();

$youtube_thumbnail = $_POST['youtube_thumbnail'];
$contents = $_POST['contents'];
//$created_at = $_POST['created_at'];

include('functions.php');
$pdo = connect_to_db();

//$sql = 'INSERT INTO manual(id, user_name, contents, youtube_thumbnail, updated_at) VALUES(NULL, :login_name, :contents, :youtube_thumbnail, now())';
$sql = 'INSERT INTO manual(id, user_name_id, contents, youtube_thumbnail, updated_at) VALUES(NULL, :login_name, :contents, :youtube_thumbnail, now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':youtube_thumbnail', $youtube_thumbnail, PDO::PARAM_STR);
$stmt->bindValue(':contents', $contents, PDO::PARAM_STR);
//$stmt->bindValue(':login_name', $_SESSION["user_name"], PDO::PARAM_STR);
$stmt->bindValue(':login_name', $_SESSION["id"], PDO::PARAM_STR);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:manual_view.php");
exit();
