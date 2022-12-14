<?php
class Func{
    //CSRF トークン作成
function csrfToken(){
    $bytes = openssl_random_pseudo_bytes(16);
    return bin2hex($bytes);
}

function redirectTo($dir){
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: {$dir}");
}

//サニタイズ
function sanitize($before){
    foreach ($before as $key => $value) {
      $after[$key] = htmlspecialchars($value,ENT_QUOTES,'UTF-8');
    }
    return $after;
}

//エスケープ処理
function escape($str) {
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}
}