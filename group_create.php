<?php

if (
  !isset($_POST['group_name']) || $_POST['group_name'] == '' 
) {
  exit('paramError');
}
session_start();

$group_name = $_POST['group_name'];

include('functions.php');
$pdo = connect_to_db();

$sql = 'INSERT INTO groups(id, group_name) VALUES(NULL, :group_name)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':group_name', $group_name, PDO::PARAM_STR);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:manual_tool.php");
exit();
