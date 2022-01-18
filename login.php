<?php
session_start();
include('functions.php');

$login_name = $_POST['login_name'];
$login_pass = $_POST['login_pass'];

$pdo = connect_to_db();

$sql = 'SELECT * FROM users WHERE user_name=:login_name AND password=:login_pass';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':login_name', $login_name, PDO::PARAM_STR);
$stmt->bindValue(':login_pass', $login_pass, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$val = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$val) {
  echo "<p>ログイン情報に誤りがあります</p>";
  echo "<a href=login_page.php>ログイン</a>";
  exit();
} else {
  $_SESSION = array();
//  $_SESSION['session_id'] = session_id();
  $_SESSION['user_name'] = $val['user_name'];
  $_SESSION['id'] = $val['id'];  
  header("Location:manual_view.php");
  exit();
}

