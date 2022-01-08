<?php

include('functions.php');
$pdo = connect_to_db();

$sql = 'SELECT * FROM manual ORDER BY updated_at DESC';

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {

//対象の文字列
$thumbnail_url = $record["youtube_thumbnail"];

//文字列の長さ
$url_length = strlen($thumbnail_url);
 
//区切り文字（開始）
$start = "?v=";
 
//開始位置
$start_position = strpos($thumbnail_url, $start) + strlen($start);
 
//切り出す部分の長さ
$length = $url_length - $start_position;
 
//切り出し
$thumbnail = substr($thumbnail_url, $start_position, $length);

//日付
$updated_day = substr($record["updated_at"], 0, 10);

$thumbnail_url = $record["youtube_thumbnail"];
$embedded_url = str_replace("watch?v=", "embed/", $thumbnail_url);

  $output .= "
  <div id='all'>
        <div id='check'>
            <input type='checkbox' name='id[]' value='{$record["id"]}'>            
        </div>
		<div id='contents'>         
            <a href='manual_detail.php?id={$record["id"]}'></a>      
            <!--  
            <div id='thumbnail'>
                <img src='https://img.youtube.com/vi/{$thumbnail}/hqdefault.jpg' alt=''>
            </div>
            --> 
            <div id='embedded_thumbnail_view'>
                <iframe width='480' height='270' src='{$embedded_url}' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
            </div>            
            <div id='title'>
                <p>aaaaaaa</p>
            </div>
            <div id='updated'>
                <p>{$updated_day}</p>

            </div>  
            <div id='user'>
                <p>タナカナカナ</p>
            </div> 
        </div>
    </div>
  ";
}
?>


<!doctype html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>マニュアル一覧</title>
	<link rel="stylesheet" media="all" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script src="js/script.js"></script>
</head>

<body id="top">
	<?php include('header.html'); ?>

   
	<div id="mainManual">
		<div id="heading">
            <div id="thumbnail">
            </div> 
            <div id="title">
                <p>タイトル</p>
            </div>
            <div id="updated">
                <p>更新日</p>
            </div>  
            <div id="user">
                <p>編集者</p>
            </div> 
        </div>    

        <form action='delete.php' method='GET'>
        <?= $output ?>
        <div style="background: #EEEEEE;">
        <button>一括削除</button>
</div>
        </form>
<!-- サムネ画像          
		<div id="contents">
            <a href="https://yahoo.co.jp">            
            </a>            
            <div id="thumbnail">
                <img src="https://img.youtube.com/vi/8trJLq3ERI4/maxresdefault.jpg" alt="">
            </div> 
            <div id="title">
                <p>aaaaaaa</p>
            </div>
            <div id="updated">
                <p>2021/2/21</p>
            </div>  
            <div id="user">
                <p>タナカナカナ</p>
            </div> 
        </div>
-->
    </div>
	<?php include('footer.html'); ?>

</body>

</html>