<!doctype html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>ログイン</title>
	<link rel="stylesheet" media="all" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script src="js/script.js"></script>
</head>

<body id="top">
	<?php include('header.php'); ?>

    <div id="login">
        <div id="login_header">
            ログイン
        </div>
        <form action="login.php" method="POST" autocomplete="off">
            <div id="form_url">
                <p>名前</p> 
                <input type="text" name="login_name" style="width: 300px;">
            </div>
            <div id="form_url">
                <p>パスワード</p> 
                <input type="password" name="login_pass" style="width: 300px;">
            </div>            
            <div style="text-align: left; padding: 20px 0px 20px 20px;">
                <button>ログイン</button>
            </div>
        </form>
    </div>

	<?php include('footer.html'); ?>
</body>
</html>