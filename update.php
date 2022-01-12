<?php

if (
  !isset($_POST['youtube_thumbnail']) || $_POST['youtube_thumbnail'] == '' ||
  !isset($_POST['contents']) || $_POST['contents'] == '' 
) {
  exit('paramError');
}

$youtube_thumbnail = $_POST['youtube_thumbnail'];
$contents = $_POST['contents'];
$id = $_POST['id'];

include('functions.php');
$pdo = connect_to_db();


$sql = 'UPDATE manual SET youtube_thumbnail=:youtube_thumbnail, contents=:contents, updated_at=now() WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':youtube_thumbnail', $youtube_thumbnail, PDO::PARAM_STR);
$stmt->bindValue(':contents', $contents, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

//header("Location:manual_view.php");
header("Location:manual_detail.php?id=$id");

exit();
