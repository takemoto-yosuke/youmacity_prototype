<?php

// データ受け取り
$id = $_GET['id'];

// DB接続
include('functions.php');
$pdo = connect_to_db();

// is_array関数で配列かどうか判定する（複数同時削除）
if(is_array($id)) {
  foreach($id as $id){
    // SQL実行
    $sql = 'DELETE FROM manual WHERE id=:id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);

    try {
      $status = $stmt->execute();
    } catch (PDOException $e) {
      echo json_encode(["sql error" => "{$e->getMessage()}"]);
      exit();
    }
  }
}

//単体削除
else {
    // SQL実行
    $sql = 'DELETE FROM manual WHERE id=:id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);

    try {
      $status = $stmt->execute();
    } catch (PDOException $e) {
      echo json_encode(["sql error" => "{$e->getMessage()}"]);
      exit();
    }  
}
header("Location:manual_view.php");
exit();