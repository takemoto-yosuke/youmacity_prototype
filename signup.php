<?php

if (
  !isset($_POST['signup_name']) || $_POST['signup_name'] == '' ||
  !isset($_POST['signup_pass']) || $_POST['signup_pass'] == '' 
) {
  exit('paramError');
}

$signup_name = $_POST['signup_name'];
$signup_pass = $_POST['signup_pass'];
//$created_at = $_POST['created_at'];

include('functions.php');
$pdo = connect_to_db();

$sql = 'INSERT INTO users(id, user_name, password, updated_at) VALUES(NULL, :signup_name, :signup_pass, now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':signup_name', $signup_name, PDO::PARAM_STR);
$stmt->bindValue(':signup_pass', $signup_pass, PDO::PARAM_STR);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:manual_view.php");
exit();
