<?php
include("functions.php");
// id受け取り
$id = $_GET['id'];

// DB接続
$pdo = connect_to_db();

// SQL実行
$sql = 'SELECT * FROM manual WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>マニュアル編集</title>
	<link rel="stylesheet" media="all" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script src="js/script.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({ selector:'textarea' });</script>     
</head>

<body id="top">
	<?php include('header.html'); ?>

    <div id="manual_create">
        <div id="manual_create_header">
            マニュアル編集
        </div>
        <form>
            <div id="form_url">
                <p>youtube URL</p> 
                <input type="text" name="youtube_thumbnail" style="width: 1200px;" value="<?= $record['youtube_thumbnail'] ?>">
            </div>
            <div id="form_contents">
                <p>内容</p> 
<!--                
                <input type="text" name="contents" style="width: 1200px; height: 300px;" value="<?= $record['contents'] ?>">
-->
                <textarea name="contents" style="width: 1210px; height: 500px;"><?= $record['contents'] ?></textarea>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="padding: 20px 0px 20px 30px;">
                    <input type="submit" value="このページを削除する" formaction="delete.php" formmethod="GET"/>
                </div>            
                <div style="padding: 20px 80px 20px 0px;">
                    <input type="submit" value="保存" formaction="update.php" formmethod="POST"/>  
                </div>
                    
                                  
            </div>
            <div>
                <input type="hidden" name="id" value="<?= $record['id'] ?>">
            </div>            
        </form>
      
    </div>

	<?php include('footer.html'); ?>
</body>
</html>