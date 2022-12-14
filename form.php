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

//セッションに登録されたポストデータを変数に代入してデータを削除
if (isset($_SESSION['oldPost'])) {
    $oldPost = $_SESSION['oldPost'];
    unset($_SESSION['oldPost']);
}
//セッションに登録されたエラーデータを変数に代入してデータを削除
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
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
        
        <h2>日報送信フォーム</h2>
        <div class="form-contents">
	        <p>振り返りの内容は、詳細にお書きください。</p>
	        <p class="caution">Googleアカウントを同時に複数ログインさせると、正常にフォームが送信されませんのでご注意ください。</p>
	        <?php if (isset($error)): ?>
	            <p class="error">入力内容に誤りがあります。赤文字のエラーをご確認ください。</p>
	        <?php endif; ?>
	        <form action="./formCheck.php" method="post">
	            <dl>
	                <dt>名前(スペースは入れず、旧漢字は常用漢字にしてフルネームで入力ください)</dt>
	                <dd>
	                    <?php if (isset($error['name'])) { echo "<span>" . $error['name'] . "</span>";} ?>
	                    <input type="text" name="name" value="<?php if (isset($oldPost['name'])) { echo $oldPost['name'];}?>" required>
	                </dd>
	                <!-- <dt>メールアドレス</dt>
	                <dd>
	                    <?php if (isset($error['email'])) { echo "<span>" . $error['email'] . "</span>";} ?>
	                    <input type="email" name="email" value="<?php if (isset($oldPost['email'])) { echo $oldPost['email'];}?>" required>
	                </dd> -->
	                <dt>本日の体温(在宅の場合も必ず検温をお願いします)</dt>
	                <dd>
	                    <select name="temp">
	                        <?php for ($i=35.0; $i < 38.1; $i= $i + 0.1):?>
	                            <?php if (isset($oldPost['temp']) && number_format($i,1) == $oldPost['temp']):?>
	                                <option value='<?php echo number_format($i,1); ?>' selected><?php echo number_format($i,1); ?></option>
	                            <?php elseif (number_format($i,1) == 36.0):?>
	                                <option value='<?php echo number_format($i,1); ?>' selected><?php echo number_format($i,1); ?></option>
	                            <?php else:?>
	                                <option value='<?php echo number_format($i,1); ?>'><?php echo number_format($i,1); ?></option>
	                            <?php endif ?>
	                        <?php endfor; ?>
	                    </select>
	                    ℃
	                </dd>
	                <dt>本日の作業場所</dt>
	                <dd>
	                    <select name="place">
	                        <option value="office"<?php if (isset($oldPost['place']) && $oldPost['place'] == "office"):?> selected<?php endif ;?>>事業所内(千葉)</option>
	                        <option value="officekashiwa"<?php if (isset($oldPost['place']) && $oldPost['place'] == "officekashiwa"):?> selected<?php endif ;?>>事業所内(柏)</option>
	                        <option value="home"<?php if (isset($oldPost['place']) && $oldPost['place'] == "home"):?> selected<?php endif ;?>>千葉・在宅(自宅などの通所以外)</option>
	                        <option value="homekashiwa"<?php if (isset($oldPost['place']) && $oldPost['place'] == "homekashiwa"):?> selected<?php endif ;?>>柏・在宅(自宅などの通所以外)</option>
	                        <option value="company"<?php if (isset($oldPost['place']) && $oldPost['place'] == "company"):?> selected<?php endif ;?>>企業実習(事業所内で実習の場合もこちら)</option>
	                    </select>
	                </dd>
	                <dt>本日の開始時間</dt>
	                <dd>
	                    <?php if (isset($error['start_time'])) { echo "<span>" . $error['start_time'] . "</span>";} ?>
	                    <select name="start_hour" id="start_hour">
	                        <?php
	                        foreach (["10","11","12","13","14","15","16"] as $startHour) {
	                            if ($startHour == $oldPost['start_hour']) {
	                                echo "<option value='{$startHour}' selected>{$startHour}</option>";
	                            }else{
	                                echo "<option value='{$startHour}'>{$startHour}</option>";
	                            }
	                        }
	                        ?>
	                    </select>
	                    :
	                    <select name="start_min" id="start_min">
	                        <?php
	                        foreach (["00","15","30","45"] as $startMin) {
	                            if ($startMin == $oldPost['start_min']) {
	                                echo "<option value='{$startMin}' selected>{$startMin}</option>";
	                            }else{
	                                echo "<option value='{$startMin}'>{$startMin}</option>";
	                            }
	                        }
	                        ?>
	                    </select>
	                </dd>
	                <dt>本日の終了時間</dt>
	                <dd>
	                    <?php if (isset($error['end_time'])) { echo "<span>" . $error['end_time'] . "</span>";} ?>
	                    <select name="end_hour" id="end_hour">
	                        <?php
	                        foreach (["10","11","12","13","14","15","16"] as $endHour) {
	                            if ($endHour == $oldPost['end_hour']) {
	                                echo "<option value='{$endHour}' selected>{$endHour}</option>";
	                            }else{
	                                echo "<option value='{$endHour}'>{$endHour}</option>";
	                            }
	                        }
	                        ?>
	                    </select>
	                    :
	                    <select name="end_min" id="end_min">
	                        <?php
	                        foreach (["00","15","30","45"] as $endMin) {
	                            if ($endMin == $oldPost['end_min']) {
	                                echo "<option value='{$endMin}' selected>{$endMin}</option>";
	                            }else{
	                                echo "<option value='{$endMin}'>{$endMin}</option>";
	                            }
	                        }
	                        ?>
	                    </select>
	                </dd>
	                <dt>マイタイピングのスコア</dt>
	                <dd>
	                    <?php if (isset($error['mytyping'])) { echo "<span>" . $error['mytyping'] . "</span>";} ?>
	                    <input type="number" name="mytyping" min="0" max="20000" value="<?php echo $oldPost['mytyping']?>">
	                    <label for="mytyping_skip">
	                        <input type="checkbox" name="mytyping_skip" id="mytyping_skip" value="skip"<?php if (isset($oldPost['mytyping_skip']) && $oldPost['mytyping_skip'] == "skip"):?> checked<?php endif ;?>>
	                        スキップ
	                    </label>
	                </dd>
	                <dt>寿司打のコース名とスコア</dt>
	                <dd>
	                    <?php if (isset($error['sushida'])) { echo "<span>" . $error['sushida'] . "</span>";} ?>
	                    <select name="sushida_course">
	                        
	                        <option value=""></option>
	                        <option value="3000"<?php if (isset($oldPost['sushida_course']) && $oldPost['sushida_course'] == "3000"):?> selected<?php endif ;?>>3000円コース</option>
	                        <option value="5000"<?php if (isset($oldPost['sushida_course']) && $oldPost['sushida_course'] == "5000"):?> selected<?php endif ;?>>5000円コース</option>
	                        <option value="10000"<?php if (isset($oldPost['sushida_course']) && $oldPost['sushida_course'] == "10000"):?> selected<?php endif ;?>>10000円コース</option>
	                    </select>
	                    <input type="number" name="sushida_point" min="0" max="100000" value="<?php echo $oldPost['sushida_point']?>">円分
	                    <select name="sushida_plus_minus">
	                        <option value="plus"<?php if (isset($oldPost['sushida_plus_minus']) && $oldPost['sushida_plus_minus'] == "plus"):?> selected<?php endif ;?>>得</option>
	                        <option value="minus"<?php if (isset($oldPost['sushida_plus_minus']) && $oldPost['sushida_plus_minus'] == "minus"):?> selected<?php endif ;?>>損</option>
	                    </select>
	                    <label for="sushida_skip">
	                        <input type="checkbox" name="sushida_skip" id="sushida_skip" value="skip"<?php if (isset($oldPost['sushida_skip']) && $oldPost['sushida_skip'] == "skip"):?> checked<?php endif ;?>>
	                        スキップ
	                    </label>
	                </dd>
	                <dt>本日の主な学習内容(または、実習先企業名)</dt>
	                <dd>
	                    <?php if (isset($error['todays_content'])) { echo "<span>" . $error['todays_content'] . "</span>";} ?>
	                    <input type="text" name="todays_content" value="<?php if (isset($oldPost['todays_content'])) { echo $oldPost['todays_content'];}?>" required>
	                </dd>
	                <dt>本日の午前中の作業内容</dt>
	                <dd>
	                    <?php if (isset($error['am_content'])) { echo "<span>" . $error['am_content'] . "</span>";} ?>
	                    <input type="text" name="am_content" value="<?php if (isset($oldPost['am_content'])) { echo $oldPost['am_content'];}?>">
	                </dd>
	                <dt>本日の午後の作業内容</dt>
	                <dd>
	                    <?php if (isset($error['pm_content'])) { echo "<span>" . $error['pm_content'] . "</span>";} ?>
	                    <input type="text" name="pm_content" value="<?php if (isset($oldPost['pm_content'])) { echo $oldPost['pm_content'];}?>">
	                </dd>
	                <dt>本日行った作業で大変だったことはどのような内容でしたか。</dt>
	                <dd>
	                    <?php if (isset($error['todays_terribly'])) { echo "<span>" . $error['todays_terribly'] . "</span>";} ?>
	                    <textarea name="todays_terribly" required><?php if (isset($oldPost['todays_terribly'])) { echo $oldPost['todays_terribly'];}?></textarea>
	                </dd>
	                <dt>本日楽しいと感じた事や、気が付いた事</dt>
	                <dd>
	                    <?php if (isset($error['todays_felt'])) { echo "<span>" . $error['todays_felt'] . "</span>";} ?>
	                    <textarea name="todays_felt" required><?php if (isset($oldPost['todays_felt'])) { echo $oldPost['todays_felt'];}?></textarea>
	                </dd>
	                <dt>スタッフや事業所への要望</dt>
	                <dd>
	                    <?php if (isset($error['opinion'])) { echo "<span>" . $error['opinion'] . "</span>";} ?>
	                    <input type="text" name="opinion" value="<?php if (isset($oldPost['opinion'])) { echo $oldPost['opinion'];}?>">
	                    <label for="opinion_skip" id="opinion_skip">
	                        <input type="checkbox" name="opinion_skip" id="opinion_skip" value="skip" <?php if (isset($oldPost['opinion_skip']) && $oldPost['opinion_skip'] == "skip"):?> checked<?php endif ;?>>
	                        スキップ
	                    </label>
	                </dd>
	            </dl>
	            <p class="submit"><input type="submit" value="確認"></p>
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
