<?php
    session_start();
    // 遍歷所有的 Cookie 並將它們的過期時間設定為過去的時間
    if(isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time() - 3600);
            setcookie($name, '', time() - 3600, '/');
        }
    }

    // 清除 Session
    
    session_unset();
    session_destroy();

    // 重定向到首頁
    header("Location: index.php");
?>
