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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>体験振り返り送信フォーム・送信完了 | 就労移行支援事業所・ルーツ千葉</title>
</head>
<body>
    <header>
		<h1>
			<img src="./images/roots_logo.jpg">
			<span>就労移行支援事業所・ルーツ千葉</span>
		</h1>
	</header>
    <nav>
		<ul>
			<li><a href="./index.html">ホーム</a></li>
			<li><a href="./user.html">利用者用ページ</a></li>
			<li><a href="./trial.html">体験・見学者用</a></li>
		</ul>
	</nav>
    <div id="done">
        <h2>
            <?php
            if (isset($name)) {
            echo $name . "さん、"; }
            ?>
            本日はお疲れ様でした！
        </h2>
        <p>
            またのお越しをお待ちしております！
        </p>
        <p><a href="./index.html">ホーム画面に戻る</a></p>
    </div>
    <footer>
		<p>住所：〒260-0015　千葉県千葉市中央区富士見1-12-7 CI-20ビル5階</p>
		<small>&copy;株式会社ステッピング・ハウプ</small>
	</footer>
</body>
</html>