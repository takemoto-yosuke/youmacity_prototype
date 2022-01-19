<?php

session_start();

$group_id = $_POST['group_id'];

include('functions.php');
$pdo = connect_to_db();

$sql = 'DELETE FROM groups WHERE id=:group_id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':group_id', $group_id, PDO::PARAM_STR);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:manual_tool.php");
exit();
