<?php

if (
  !isset($_POST['group_name']) || $_POST['group_name'] == '' 
) {
  exit('paramError');
}
session_start();

$group_name = $_POST['group_name'];
$group_id = $_POST['group_id'];

include('functions.php');
$pdo = connect_to_db();

$sql = 'UPDATE groups SET group_name=:group_name WHERE id=:group_id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':group_name', $group_name, PDO::PARAM_STR);
$stmt->bindValue(':group_id', $group_id, PDO::PARAM_STR);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:manual_tool.php");
exit();
