<?php
// 連接資料庫
$link = @mysqli_connect("localhost", "root", "ki27165211", "course_evaluate") or die("無法開啟MySQL資料庫連接!<br/>");
mysqli_query($link, 'SET NAMES utf8');

// 檢查是否有 POST 表單資料送過來
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 取得使用者帳號和密碼
    $username = $_POST['username'];
    $password = $_POST['password'];
    // 使用 mysqli_real_escape_string 避免 SQL Injection
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);

    // 使用 sha256 雜湊密碼
    $hashed_password = substr(hash('sha256', $password), 0, 20);

    // 檢查帳號密碼是否正確
    $sql = "SELECT * FROM account WHERE a_mail='$username' AND a_password='$hashed_password'";
    $result = $link->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password_db = $row['a_password'];

        // 比對前 20 位
        if ($hashed_password_db === $hashed_password) {
            // 登入成功
            $username_parts = explode('@', $username);

            // 設定 Cookie
            setcookie('username', $username_parts[0], time() + (86400 * 30), "/"); // 30 天有效期
            setcookie('email', $username, time() + (86400 * 30), "/"); // 30 天有效期

            // 導向登入後的首頁或其他頁面
            header("location: index.php");
            exit();
        } else {
            // 登入失敗
            //echo "帳號或密碼錯誤";
            echo "<script>alert('帳號或密碼錯誤'); window.location.href='sign.php';</script>";
        }
    } else {
        // 登入失敗
        //echo "帳號或密碼錯誤";
        echo "<script>alert('帳號或密碼錯誤'); window.location.href='sign.php';</script>";
    }
}

// 關閉資料庫連接
mysqli_close($link);
?>
