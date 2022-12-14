<?php
class Verify{
    //名前の入力があるか、リストにある名前なのか確認
    public function name($name)
    {
        //名前の配列は、入所・退所があったら修正してください
        $nameList = [
            // del 2022/11/18 "金子伸明",
            "水田勝己",
            "伊藤まゆ",
            "高梨麗",
            "伊東祐樹",
            // del 2022/11/18 "井川礼香",
            // del 2022/11/18 "後関弘依",
            "大塚実咲",
            // del 2022/11/18 "小杉彩",
            "新田晃啓",
            // del 2022/11/18 "大木航平",
            // del 2022/11/18 "関根由美",
            // del 2022/11/18 "谷口薫",
            "長谷川魁",
            "三上かな子",
            "今井瑠捺",
            "長岡昇吾",
            // del 2022/11/18 "森聡子",
            // del 2022/11/18 "木原健",
            // del 2022/11/18 "小倉美加",
            "福間貴幸",
            // del 2022/11/18 "茂木信也",
            "青木立夏子",
            "小松麻子",
            "出口康介",
            // del 2022/11/18 "神戸麻美",
            "本澤則子",
            "津端秀和",
            "岡田真理子",
            "麻野貴大",
            "村木玲奈",
            "山岸拓",
            "日野愛菜",
            "山内その美",
            "秋葉大樹",
            "並木健一",
            "吉岡一星",
            "下山葉菜",
            "佐々木智美",
            "大貫裕太郎",
            "釜佑也",
            "四元祐希",
            "酒井宝",
            "西村祐希",
            "釜侑也"
        ];
        //名前の配列は、入所・退所があったら修正してください
        
        if ($name == '') {
            return $_SESSION['error']['name'] = '名前が入力されていません。';
        }elseif (!in_array($name, $nameList)) {
            return $_SESSION['error']['name'] = '名前の登録がありません。';
        }
    }

    //アドレスの入力があるか、メールアドレス形式か確認
    public function email($email)
    {
        if ($email == '') {
            return $_SESSION['error']['email'] = 'メールアドレスが入力されていません。';
        }elseif (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            return $_SESSION['error']['email'] = '正しいメールアドレスを入力してください。';
        }
    }

    //開始・終了時間確認
    public function time($start_hour, $start_min, $end_hour, $end_min)
    {
        if ($start_hour . $start_min == $end_hour . $end_min) {
            return $_SESSION['error']['start_time'] = '開始時刻と終了時刻が同じ時間になっています。';
        }elseif ($start_hour . $start_min > $end_hour . $end_min) {
            return $_SESSION['error']['start_time'] = '開始時刻が終了時刻より遅い時間になっています。';
        }elseif ($end_hour == "16" && $end_min > 0) {
            return $_SESSION['error']['end_time'] = '16時以降の時間になっています。';
        }
    }

    //マイタイピングのスコア入力あるか、もしくはスキップか確認
    public function myTyping($mytyping, $mytyping_skip)
    {
        if ($mytyping == "" && $mytyping_skip == "") {
            return $_SESSION['error']['mytyping'] = '点数を入力するか、スキップにチェックを入れてください';
        }elseif ($mytyping > 0 && $mytyping_skip == "skip") {
            return $_SESSION['error']['mytyping'] = '点数を入力するかスキップにするか、どちらかをお選びください';
        }
    }

    //寿司打ののスコア入力あるか、もしくはスキップか確認
    public function sushida($sushida_course, $sushida_point, $sushida_skip)
    {
        if ($sushida_course == "" && $sushida_point == "" && $sushida_skip == "") {
            return $_SESSION['error']['sushida'] = '点数を入力するか、スキップにチェックを入れてください';
        }elseif ($sushida_course == "" && $sushida_point > 0) {
            return $_SESSION['error']['sushida'] = 'コースを選択してください';
        }elseif ($sushida_course != "" && $sushida_point == "") {
            return $_SESSION['error']['sushida'] = '点数を入力してください';
        }elseif ($sushida_course > 0 && $sushida_point > 0 && $sushida_skip == "skip") {
            return $_SESSION['error']['sushida'] = '点数を入力するかスキップにするか、どちらかをお選びください';
        }
    }

    //入力があるか・本日の主な学習内容
    public function todaysContent($todays_content)
    {
        if ($todays_content == '') {
            return $_SESSION['error']['todays_content'] = '入力されていません。';
        }
    }

    //午前・午後がどちらも入力されてなかったらエラー
    public function ampmContent($am_content,$pm_content)
    {
        if ($am_content == '' && $pm_content == '') {
            return $_SESSION['error']['am_content'] = '午前・午後の作業内容の少なくともどちらか一方を入力してください';
		}
    }


    //午前のみ空白の場合「午後のみ」を入れる
    public function amContent($am_content){
        if ($am_content == '') {
            return '午後のみ';
        } else {
        	return $am_content;
        }
    }

    //午後のみ空白の場合「午前のみ」を入れる
    public function pmContent($pm_content){
        if ($pm_content == '') {
            return '午前のみ';
        } else {
        	return $pm_content;
        }
    }

    //入力があるか:作業で大変だったこと
    public function todaysTerribly($todays_terribly)
    {
        if ($todays_terribly == '') {
            return $_SESSION['error']['todays_terribly'] = '入力されていません。';
        }
    }

    //入力があるか:楽しいと感じた事や、気が付いた事
    public function todaysFelt($todays_felt)
    {
        if ($todays_felt == '') {
            return $_SESSION['error']['todays_felt'] = '入力されていません。';
        }
    }

    //入力があるか:スタッフや事業所への要望
    public function opinion($opinion, $opinion_skip)
    {
        if ($opinion == "" && $opinion_skip == "") {
            return $_SESSION['error']['opinion'] = '要望を入力するか、スキップにチェックを入れてください';
        }
    }
}		