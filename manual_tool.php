<?php

include('functions.php');
check_login();

?>

<!doctype html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>設定</title>
	<link rel="stylesheet" media="all" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script src="js/script.js"></script>
</head>

<body id="top">
	<?php include('header.php'); ?>

    <div id="login">
        <div id="login_header">
            設定
        </div>
        <div style="padding: 10px 0px 10px 20px;">
            ■グループ設定
            <form action="group_create.php" method="POST" autocomplete="off">
                <div id="form_url">
                    <p>【グループ追加】</p> 
                    <p>グループ名：<input type="text" name="group_name" style="width: 300px;"></p>
                </div>
                <div style="text-align: left; padding: 0px 0px 20px 20px;">
                    <button>追加</button>
                </div>            
            </form>    

            <form action=".php" method="POST" autocomplete="off">
                <div id="form_url">
                    <p>【グループ名変更】</p> 
                    <p>変更前グループ名：
                        <select name="editer" id="editer">
                            <option value="1">--- 編集者 ---</option>
                        </select>                     
                    </p>
                    <p>変更後グループ名：<input type="text" name="login_name" style="width: 300px;"></p>
                </div>
                <div style="text-align: left; padding: 0px 0px 20px 20px;">
                    <button>変更</button>
                </div>            
            </form>   
            
            <form action=".php" method="POST" autocomplete="off">
                <div id="form_url">
                    <p>【グループ削除】</p> 
                    <p>グループ名：
                        <select name="editer" id="editer">
                            <option value="1">--- 編集者 ---</option>
                        </select>                     
                    </p>
                </div>
                <div style="text-align: left; padding: 0px 0px 20px 20px;">
                    <button>削除</button>
                </div>            
            </form> 
        </div>        
    </div>

	<?php include('footer.html'); ?>
</body>
</html>