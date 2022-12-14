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

//ファイルの読み込み
require_once(dirname(__FILE__) . '/function/function.php');
require_once(dirname(__FILE__) . '/function/Verify.php');

//入力方法確認クラス読み込み
$function = new Func;
$varify = new Verify;

//postデータ受け取りと初期設定
$post = $function->sanitize($_POST);

$name = $post['name'];
//$email = $post['email'];
$temp = $post['temp'];
$place = $post['place'];
$start_hour = $post['start_hour'];
$start_min = $post['start_min'];
$end_hour = $post['end_hour'];
$end_min = $post['end_min'];
$mytyping = $post['mytyping'];
if (isset($post['mytyping_skip'])) {
    $mytyping_skip = $post['mytyping_skip'];
}else {
    $mytyping_skip = "";
}
$sushida_course = $post['sushida_course'];
$sushida_point = $post['sushida_point'];
$sushida_plus_minus = $post['sushida_plus_minus'];
if (isset($post['sushida_skip'])) {
    $sushida_skip = $post['sushida_skip'];
}else {
    $sushida_skip = "";
}
$todays_content = $post['todays_content'];
$am_content = $post['am_content'];
$pm_content = $post['pm_content'];
$todays_terribly = $post['todays_terribly'];
$todays_felt = $post['todays_felt'];
$opinion = $post['opinion'];
if (isset($post['opinion_skip'])) {
    $opinion_skip = $post['opinion_skip'];
}else {
    $opinion_skip = "";
}

//入力データを保存
$_SESSION['oldPost']['name'] = $name;
// del 2022/12/01 $_SESSION['oldPost']['email'] = $email;
$_SESSION['oldPost']['temp'] = $temp;
$_SESSION['oldPost']['place'] = $place;
$_SESSION['oldPost']['start_hour'] = $start_hour;
$_SESSION['oldPost']['start_min'] = $start_min;
$_SESSION['oldPost']['end_hour'] = $end_hour;
$_SESSION['oldPost']['end_min'] = $end_min;
$_SESSION['oldPost']['mytyping'] = $mytyping;
$_SESSION['oldPost']['mytyping_skip'] = $mytyping_skip;
$_SESSION['oldPost']['sushida_course'] = $sushida_course;
$_SESSION['oldPost']['sushida_point'] = $sushida_point;
$_SESSION['oldPost']['sushida_plus_minus'] = $sushida_plus_minus;
$_SESSION['oldPost']['sushida_skip'] = $sushida_skip;
$_SESSION['oldPost']['todays_content'] = $todays_content;
$_SESSION['oldPost']['am_content'] = $am_content;
$_SESSION['oldPost']['pm_content'] = $pm_content;
$_SESSION['oldPost']['todays_terribly'] = $todays_terribly;
$_SESSION['oldPost']['todays_felt'] = $todays_felt;
$_SESSION['oldPost']['opinion'] = $opinion;
$_SESSION['oldPost']['opinion_skip'] = $opinion_skip;

//エラーと入力内容を出力
if (isset($_SESSION['error'])) {
    $function->redirectTo('./form.php');
    exit();
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
<script type="text/javascript">
    let submitted = false;
</script>
<iframe
    name="hidden_iframe"
    id="hidden_iframe"
    style="display: none"
    onload="if(submitted){window.location='./formSend.php';}"
></iframe>
<body>
    <div class="contents-wrapper">
        <header class="clearfix">
            <h1>
                <a href="index.html"><img src="images/logo_line.jpg" alt=""></a>
            </h1>
        </header>
        <div class="main-image"></div>
    <div id="form">
        
        <h2>送信内容をご確認ください</h2>
<div class="form-contents">
        <p class="caution">Googleアカウントを同時に複数ログインさせると、正常にフォームが送信されませんのでご注意ください</p>
        <form action="https://docs.google.com/forms/u/1/d/e/1FAIpQLSd3oVO6zo_AKOjRhBpApzuYM9aiy8H4hS-oYrzjzM3krd6Cqg/formResponse" method="post" target="hidden_iframe" onsubmit="submitted=true;">
            <dl>
                <dt>名前(スペースは入れず、旧漢字は常用漢字にしてください)</dt>
                <dd>
                    <input type="hidden" name="entry.808081524" value="<?php echo $name; ?>">
                    <?php echo $name; ?>
                </dd>
                <!-- <dt>メールアドレス</dt>
                <dd>
                    <?php 
                    	// echo $email; 
                    ?>
                </dd>-->
                <dt>本日の体温(在宅の場合も必ず検温をお願いします)</dt>
                <dd>
                    <input type="hidden" name="entry.154246483" value="<?php echo $temp . "℃"; ?>">
                    <?php echo $temp; ?>℃
                </dd>
                <dt>本日の作業場所</dt>
                <dd>
                    <?php
                    switch ($place) {
                        case 'office':
                            echo "事業所内(千葉)";
                            echo '<input type="hidden" name="entry.879952163" value="事業所内(千葉)">';
                            break;
                        case 'officekashiwa':
                            echo "事業所内(柏)";
                            echo '<input type="hidden" name="entry.879952163" value="事業所内(柏)">';
                            break;
                        case 'home':
                            echo "千葉・在宅(自宅などの通所以外)";
                            echo '<input type="hidden" name="entry.879952163" value="千葉・在宅(自宅などの通所以外)">';
                            break;
                        case 'homekashiwa':
                            echo "柏・在宅(自宅などの通所以外)";
                            echo '<input type="hidden" name="entry.879952163" value="柏・在宅(自宅などの通所以外)">';
                            break;
                        case 'company':
                            echo "企業実習(事業所内で実習の場合もこちら)";
                            echo '<input type="hidden" name="entry.879952163" value="企業実習(事業所内で実習の場合もこちら)">';
                            break;
                        
                        default:
                            echo "Error";
                            break;
                    }
                    ?>
                </dd>
                <dt>本日の開始時間</dt>
                <dd>
                    <!--開始時間-->
                    <input type="hidden" name="entry.1049746821_hour" value="<?php echo $start_hour ?>">
                    <input type="hidden" name="entry.1049746821_minute" value="<?php echo $start_min ?>">
                    <!--開始時間-->
                    <?php echo $start_hour . ":" . $start_min; ?>
                </dd>
                <dt>本日の終了時間</dt>
                <dd>
                    <!--終了時間-->
                    <input type="hidden" name="entry.411639983_hour" value="<?php echo $end_hour ?>">
                    <input type="hidden" name="entry.411639983_minute" value="<?php echo $end_min ?>">
                    <!--終了時間-->
                    <?php echo $end_hour . ":" . $end_min; ?>
                </dd>
                <dt>マイタイピングのスコア</dt>
                <dd>
                    <?php
                    if ($mytyping_skip == "skip" ) {
                        echo "スキップ";
                        echo '<input type="hidden" name="entry.29952536" value="スキップ">';
                    }else {
                        echo $mytyping;
                        echo '<input type="hidden" name="entry.29952536" value="' . $mytyping . '">';
                    }
                    ?>
                </dd>
                <dt>寿司打のコース名とスコア</dt>
                <dd>
                    <?php
                    if ($sushida_skip == "skip" ) {
                        echo "スキップ";
                        echo '<input type="hidden" name="entry.1719545949" value="スキップ">';
                    }else {
                        if ($sushida_plus_minus == "plus") {
                            echo $sushida_course . "円コース：" . $sushida_point . "円分得";
                            echo '<input type="hidden" name="entry.1719545949" value="' . $sushida_course . "円コース：" . $sushida_point . "円分得" . '">';
                        }else {
                            echo $sushida_course . "円コース：" . $sushida_point . "円分損";
                            echo '<input type="hidden" name="entry.1719545949" value="' . $sushida_course . "円コース：" . $sushida_point . "円分損" . '">';
                        }
                    }
                    ?>
                </dd>
                <dt>本日の主な学習内容(または、実習先企業名)</dt>
                <dd>
                    <input type="hidden" name="entry.349124939" value="<?php echo $todays_content; ?>">
                    <?php echo $todays_content; ?>
                </dd>
                <dt>本日の午前中の作業内容</dt>
                <dd>
                    <input type="hidden" name="entry.462119290" value="<?php echo $am_content; ?>">
                    <?php echo $am_content; ?>
                </dd>
                <dt>本日の午後の作業内容</dt>
                <dd>
                    <input type="hidden" name="entry.439576666" value="<?php echo $pm_content; ?>">
                    <?php echo $pm_content; ?>
                </dd>
                <dt>本日行った作業で大変だったことはどのような内容でしたか。</dt>
                <dd>
                    <input type="hidden" name="entry.1253314143" value="<?php echo $todays_terribly; ?>">
                    <?php echo $todays_terribly; ?>
                </dd>
                <dt>本日楽しいと感じた事や、気が付いた事</dt>
                <dd>
                    <input type="hidden" name="entry.1965951507" value="<?php echo $todays_felt; ?>">
                    <?php echo $todays_felt; ?>
                </dd>
                <dt>スタッフや事業所への要望</dt>
                <dd>
                    <?php
                    if (isset($opinion_skip) && $opinion_skip == "skip" ) {
                        echo "スキップ";
                        echo '<input type="hidden" name="entry.342667032" value="スキップ">';
                    }else {
                        echo $opinion;
                        echo '<input type="hidden" name="entry.342667032" value="' . $opinion . '">';
                    }
                    ?>
                </dd>
                <!--本日の日付-->
                <input type="hidden" name="entry.233853725_year" value="<?php echo date("Y");?>">
                <input type="hidden" name="entry.233853725_month" value="<?php echo date("m");?>">
                <input type="hidden" name="entry.233853725_day" value="<?php echo date("d");?>">
                <!--本日の日付-->
                <!--その他設定-->
                <input type="hidden" name="emailReceipt" value="true">
                <input type="hidden" name="fvv" value="1">
                <input type="hidden" name="pageHistory" value="0">
                <!--その他設定-->
            </dl>
            <p class="submit">
                <input type="button" value="戻る" onclick="history.back()">
                <input type="submit" value="送信">
            </p>
        </form>
        </div>
    </div>
        <footer class="clearfix">
            <small>
                Copyright <span class="copy">&copy;</span> 2022 就労移行ITスクール
            </small>
            <button class="page-top"></button>
        </footer>
</div>
<script>	
$(function() {	
const page_top = $('.page-top');	
page_top.click(function() {	
console.log(page_top);	
$('body, html').animate({scrollTop: 0}, 600);	
return false;	
});	
});	
$(window).scroll(function() {	
let scroll = $(window).scrollTop();	
let screen_width = $(window).width();	
if(screen_width > 599 && scroll >= 1){	
$('header').addClass('scroll');	
} else {	
$('header').removeClass('scroll');	
}	
});	
</script>
</body>
</html>