<?php

include('functions.php');
check_login();
$pdo = connect_to_db();

//$sql = 'SELECT * FROM manual ORDER BY updated_at DESC';

//manualテーブルとusersテーブルを結合
/*
$sql = 
'SELECT 
*
FROM
  manual
  LEFT OUTER JOIN(SELECT id AS user_id, user_name FROM users)
  AS join_users
  ON  manual.user_name_id = join_users.user_id
  ORDER BY updated_at DESC';
*/
$sql = 
'
SELECT 
*
FROM
  manual
  LEFT OUTER JOIN(SELECT id AS user_id, user_name, group_id FROM users)
  AS join_users
  ON  manual.user_name_id = join_users.user_id
  LEFT OUTER JOIN (SELECT id AS groups_id, group_name FROM groups)
  AS join_groups
  ON  join_users.group_id = join_groups.groups_id
  ORDER BY updated_at DESC';

$sql2 = 
'
SELECT 
*
FROM
  manual
  LEFT OUTER JOIN(SELECT id AS user_id, user_name, group_id FROM users)
  AS join_users
  ON  manual.user_name_id = join_users.user_id
  LEFT OUTER JOIN (SELECT id AS groups_id, group_name FROM groups)
  AS join_groups
  ON  join_users.group_id = join_groups.groups_id
  GROUP BY user_id';

$sql3 = 
'
SELECT 
*
FROM
  manual
  LEFT OUTER JOIN(SELECT id AS user_id, user_name, group_id FROM users)
  AS join_users
  ON  manual.user_name_id = join_users.user_id
  LEFT OUTER JOIN (SELECT id AS groups_id, group_name FROM groups)
  AS join_groups
  ON  join_users.group_id = join_groups.groups_id
  GROUP BY group_id';
//$sql2 = 'SELECT * FROM users';
//$sql3 = 'SELECT * FROM groups';

$stmt = $pdo->prepare($sql);
$stmt2 = $pdo->prepare($sql2);
$stmt3 = $pdo->prepare($sql3);

try {
  $status = $stmt->execute();
  $status2 = $stmt2->execute();
  $status3 = $stmt3->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
$result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
$output = "";
$output2 = "";
$output3 = "";

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
//上記のyoutubeURLから埋め込みURLに変換
$embedded_url = str_replace("watch?v=", "embed/", $thumbnail_url);


/// oEmebdからメタ情報取得して表示（タイトル取得）
$oembed_url = "https://www.youtube.com/oembed?url={$thumbnail_url}&format=json";
$ch = curl_init( $oembed_url );
curl_setopt_array( $ch, [
  CURLOPT_RETURNTRANSFER => 1
] );
$resp = curl_exec( $ch );
 
$metas = json_decode( $resp, true );
  
  if (isset($_POST['editer']) && ($record["user_name"] != $_POST['editer'])){continue;} 
  if (isset($_POST['group']) && ($record["group_name"] != $_POST['group'])){continue;} 

  //youtube非公開設定だとタイトルがNULLとなる
  if(!isset($metas["title"])){
      $metas["title"] = "非公開";
  }

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
                <p>{$metas["title"]}</p>
            </div>
            <div id='updated'>
                <p>{$updated_day}</p>

            </div>  
            <div id='user'>
                <p>{$record["group_name"]}<br>
                {$record["user_name"]}</p>
            </div> 
        </div>
    </div>
  ";
}

foreach ($result2 as $record2) {
  $output2 .= "<option value='{$record2["user_name"]}'>{$record2["user_name"]}</option>";
}  

foreach ($result3 as $record3) {
  $output3 .= "<option value='{$record3["group_name"]}'>{$record3["group_name"]}</option>";
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
	<?php include('header.php'); ?>

    <!-- selectによる絞込 -->
    <div id="select_editer">
        <div class="select_tab">
        <form method='POST' action=''>
            <select name="group" id="editer" onchange="this.form.submit()">
                <option value="1">--- 所属 ---</option>
                <?= $output3 ?>
            </select> 
        </form>
        </div>
        <div class="select_tab"> 
        <form method='POST' action=''>
            <select name="editer" id="editer" onchange="this.form.submit()">
                <option value="1">--- 編集者 ---</option>
                <?= $output2 ?>
            </select> 
        </form>               
        </div>
    </div>   
   
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
                <p>所属/編集者</p>
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