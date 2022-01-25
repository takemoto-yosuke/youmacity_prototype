<?php

include('functions.php');
check_login_admin();
$pdo = connect_to_db();

$sql = 'SELECT * FROM groups';

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
  $output .= "<option value='{$record["id"]}'>{$record["group_name"]}</option>";
}  
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
            ■所属設定
            <form action="group_create.php" method="POST" autocomplete="off">
                <div id="form_url">
                    <p>【所属追加】</p> 
                    <p><input type="text" name="group_name" style="width: 300px;"></p>
                </div>
                <div style="text-align: left; padding: 0px 0px 20px 20px;">
                    <button>追加</button>
                </div>            
            </form>    

            <form action="group_edit.php" method="POST" autocomplete="off">
                <div id="form_url">
                    <p>【所属名変更】</p> 
                    <p>変更前：
                        <select name="group_id" id="editer">
                            <option>--- 所属 ---</option>
                            <?= $output ?>
                        </select>                     
                    </p>
                    <p>変更後：<input type="text" name="group_name" style="width: 300px;"></p>
                </div>
                <div style="text-align: left; padding: 0px 0px 20px 20px;">
                    <button>変更</button>
                </div>            
            </form>   
            
            <form action="group_delete.php" method="POST" autocomplete="off">
                <div id="form_url">
                    <p>【所属削除】</p> 
                    <p>
                        <select name="group_id" id="editer">
                            <option>--- 所属 ---</option>
                            <?= $output ?>
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