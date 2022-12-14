<?php
//セッション
session_start();
session_regenerate_id(true);

//エンコーディング
header("Content-type: text/html; charset=utf-8");

//クリックジャッキング対策
header('X-FRAME-OPTIONS: DENY');

//タイムゾーン
date_default_timezone_set('Asia/Tokyo');

//名前を取得して、セッションを削除
if (isset($_SESSION['oldPost'])) {
    $name = $_SESSION['oldPost']['name'];
    unset($_SESSION['oldPost']); 
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>就労移行ITスクール</title>

    <link rel="icon" href="images/icon/favicon.ico" sizes="any">
    <link rel="icon" href="images/icon/apple-touch-icon.png">

    <!-- <link rel="stylesheet" href="css/destyle.min.css"> -->
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Round">

    <script src="https://kit.fontawesome.com/96a13211e2.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
    <div class="contents-wrapper">
        <header class="clearfix">
            <h1>
                <a href="index.html"><img src="images/logo_line.jpg" alt=""></a>
            </h1>
        </header>
        <div class="main-image"></div>
	    <div id="form">
	        <h2>
	            <?php
	            if (isset($name)) {
	            echo $name . "さん、"; }
	            ?>
	            本日はお疲れ様でした！
	        </h2>
	        <p>
	            訓練終了後は、ゆっくり休んで体調を整えましょう。
	        </p>
	        <p><a href="./index.html">ホーム画面に戻る</a></p>
	    </div>
        <footer class="clearfix">
            <small>
                Copyright <span class="copy">&copy;</span> 2022 就労移行ITスクール
            </small>
            <button class="page-top"></button>
        </footer>
	</div>
</body>
</html>