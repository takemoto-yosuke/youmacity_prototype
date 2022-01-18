<?php
include("functions.php");
check_login();
// id受け取り
$id = $_GET['id'];

// DB接続
$pdo = connect_to_db();

// SQL実行
//$sql = 'SELECT * FROM manual WHERE id=:id';

//manualテーブルとusersテーブルを結合
$sql = 
'SELECT 
*
FROM
  manual
  LEFT OUTER JOIN(SELECT id AS user_id, user_name FROM users)
  AS join_users
  ON  manual.user_name_id = join_users.user_id
  WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);

$thumbnail_url = $record["youtube_thumbnail"];
$embedded_url = str_replace("watch?v=", "embed/", $thumbnail_url);

//日付
$updated_day = substr($record["updated_at"], 0, 10);

/// oEmebdからメタ情報取得して表示（タイトル取得）
$oembed_url = "https://www.youtube.com/oembed?url={$thumbnail_url}&format=json";
$ch = curl_init( $oembed_url );
curl_setopt_array( $ch, [
  CURLOPT_RETURNTRANSFER => 1
] );
$resp = curl_exec( $ch );
 
$metas = json_decode( $resp, true );
//youtube非公開設定だとタイトルがNULLとなる
if(!isset($metas["title"])){
    $metas["title"] = "非公開";
}
?>

<!doctype html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>マニュアル詳細</title>
	<link rel="stylesheet" media="all" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script src="js/script.js"></script>

</head>

<body id="top">
	<?php include('header.php'); ?>

   
	<div id="mainManual">
		<div id="contents"> 
            <div id='detail_title'>
                <p>タイトル：<?= $metas["title"] ?></p>
            </div>
            <div id='detail_updated'>
                <p>更新日：<?= $updated_day ?></p>
            </div>  
            <div id='detail_user'>
                <p>編集者：<?= $record["user_name"] ?></p>
            </div> 
        </div>        
		<div id="detail_contents">            
            <div id='embedded_thumbnail'>
                <iframe width="1280" height="720" src="<?= $embedded_url ?>?rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div> 
            <div style="width: 1280px; text-align: right; padding-bottom: 10px; padding-top: 10px;">
                <button onclick="location.href='manual_edit.php?id=<?= $record["id"] ?>'">編集</button>
            </div>             
            <div id='detail_manual'>
                <?= $record["contents"] ?>
            </div>
        </div>


    </div>
	<?php include('footer.html'); ?>
</body>
</html>
