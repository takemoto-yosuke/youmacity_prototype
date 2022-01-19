<?php

include('functions.php');
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
	<title>マニュアル新規作成</title>
	<link rel="stylesheet" media="all" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script src="js/script.js"></script>
</head>

<body id="top">
	<?php include('header.php'); ?>

    <div id="signup">
        <div id="signup_header">
            新規登録
        </div>
        <form action="signup.php" method="POST" autocomplete="off">
            <div id="form_url">
                <p>名前</p> 
                <input type="text" name="signup_name" style="width: 300px;">
            </div>
            <div id="form_url">
                <p>パスワード</p> 
                <input type="password" name="signup_pass" style="width: 300px;">
            </div>   
            <div id="form_url">
                <p>所属</p> 
                <select name="group_id" id="editer" style="width: 300px;">
                <option>--- 所属 ---</option>
                <?= $output ?>
                </select>
            </div>                        
            <div style="text-align: left; padding: 20px 0px 20px 20px;">
                <button>登録</button>
            </div>
        </form>
    </div>

	<?php include('footer.html'); ?>
</body>
</html>