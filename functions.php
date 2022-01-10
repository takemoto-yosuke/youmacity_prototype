<?php

function connect_to_db()
{
$dbn ='mysql:dbname=youmacity_prototype;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = 'root';

try {
  return new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}
}

function check_login()
{
  session_start();
  if (!isset($_SESSION["user_name"])) {
    header('Location:login_page.php');
    exit();
  } 
}