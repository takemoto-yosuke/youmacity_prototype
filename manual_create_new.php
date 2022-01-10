<?php
include('functions.php');
check_login();
?>
<!doctype html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>マニュアル新規作成</title>
	<link rel="stylesheet" media="all" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script src="js/script.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({ selector:'textarea' });</script>    
</head>

<body id="top">
	<?php include('header.php'); ?>

    <div id="manual_create">
        <div id="manual_create_header">
            マニュアル新規作成
        </div>
        <form action="create.php" method="POST">
            <div id="form_url">
                <p>youtube URL</p> 
                <input type="text" name="youtube_thumbnail" style="width: 1200px;">
            </div>
            <div id="form_contents">
                <p>本文</p> 
                <!--
                <input type="text" name="contents" style="width: 1200px; height: 300px;">
-->
                <textarea name="contents" style="width: 1210px; height: 500px;"></textarea>
            </div>
            <div style="text-align: center; padding: 20px 0px 20px 0px;">
                <button>投稿</button>
            </div>
        </form>
    </div>

	<?php include('footer.html'); ?>
</body>
</html>