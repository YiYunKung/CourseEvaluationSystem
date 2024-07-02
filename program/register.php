<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>嘉義大學課程評價</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.png" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <img src="assets/favicon.png" alt="Image" style="width: 60px; height: 50px;">
            <a class="navbar-brand" href="https://www.ncyu.edu.tw/">國立嘉義大學</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                清單
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php">首頁</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="course.php">課程列表</a></li>
                    
                    <li class="nav-item">
                        <?php
                            if (isset($_COOKIE['username'])) {
                                // 如果有登入，顯示使用者名稱
                                echo '<a class="nav-link px-lg-3 py-3 py-lg-4">歡迎，' . $_COOKIE['username'] . '</a>';
                            } else {
                                // 如果沒有登入，顯示登入連結
                                echo '<a class="nav-link px-lg-3 py-3 py-lg-4" href="sign.php">登入</a>';
                            }
                        ?>
                    </li>
                    <li class="nav-item">
                        <?php
                            if (isset($_COOKIE['username'])) {
                                // 如果有登入，顯示使用者名稱
                                echo "<a class='nav-link px-lg-3 py-3 py-lg-4' href='logout.php'>登出</a>";
                            }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('assets/img/contact-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>註冊</h1>
                        <span class="subheading">您經擁有帳號了嗎?還沒的話趕緊註冊吧!</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
        <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">

                    <div class="my-5">
                        <form method="post" action="register.php" onsubmit="return validateForm();">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="a_mail" type="text" placeholder="Enter your email..." required />
                                <label for="a_mail">Email address (xxx@g.ncyu.edu.tw)</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="a_password" type="password" placeholder="Enter your password..." required />
                                <label for="a_password">Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="a_department" type="text" placeholder="Enter your department..." required />
                                <label for="a_department">Department (中文)</label>
                            </div>
                            <br />
                            <button class="btn btn-primary text-uppercase" type="submit">Register</button>
                        </form>
                    </div>

                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $a_mail = $_POST["a_mail"];
                        $a_password = $_POST["a_password"];
                        $a_department = $_POST["a_department"];

                        $link = mysqli_connect("localhost", "root", "ki27165211", "course_evaluate");

                        if (!$link) {
                            die("連接失敗: " . mysqli_connect_error());
                        }

                        if (!filter_var($a_mail, FILTER_VALIDATE_EMAIL) || !preg_match('/@g.ncyu.edu.tw$/', $a_mail)) {
                            echo "<div class='alert alert-danger' role='alert'>帳號格式不符合要求，請重新輸入。</div>";
                            exit;
                        }

                        if (!preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', $a_department)) {
                            echo "<div class='alert alert-danger' role='alert'>系所應為中文字符，請重新輸入。</div>";
                            exit;
                        }

                        $check_duplicate_sql = "SELECT COUNT(*) FROM account WHERE a_mail = ?";
                        $check_duplicate_stmt = mysqli_prepare($link, $check_duplicate_sql);

                        if ($check_duplicate_stmt) {
                            mysqli_stmt_bind_param($check_duplicate_stmt, "s", $a_mail);
                            mysqli_stmt_execute($check_duplicate_stmt);

                            mysqli_stmt_store_result($check_duplicate_stmt);

                            mysqli_stmt_bind_result($check_duplicate_stmt, $count);
                            mysqli_stmt_fetch($check_duplicate_stmt);

                            if ($count > 0) {
                                echo "<div class='alert alert-danger' role='alert'>該帳號已被使用。</div>";
                            } else {
                                // 使用 prepared statements 插入用戶信息到資料庫
                                // $hashed_password = password_hash($a_password, PASSWORD_DEFAULT);
                                $hashed_password = hash('sha256', $a_password);
                                $sql = "INSERT INTO account (a_mail, a_password, a_department) VALUES (?, ?, ?)";
                                $stmt = mysqli_prepare($link, $sql);

                                if ($stmt) {
                                    mysqli_stmt_bind_param($stmt, "sss", $a_mail, $hashed_password, $a_department);

                                    if (mysqli_stmt_execute($stmt)) {
                                        // header("Location: sign.php");
                                        // exit(); // Ensure that no other content is sent
                                        echo "<script>window.location = 'sign.php';</script>";
                                        exit(); // 確保沒有其他內容被送出
                                        // echo "<div class='alert alert-success' role='alert'>註冊成功！</div>";
                                    } else {
                                        echo "<div class='alert alert-danger' role='alert'>註冊失敗：" . mysqli_stmt_error($stmt) . "</div>";
                                    }

                                    mysqli_stmt_close($stmt);
                                } else {
                                    echo "<div class='alert alert-danger' role='alert'>Error preparing statement: " . mysqli_error($link) . "</div>";
                                }
                            }

                            mysqli_stmt_free_result($check_duplicate_stmt);
                            mysqli_stmt_close($check_duplicate_stmt);
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>Error preparing statement: " . mysqli_error($link) . "</div>";
                        }

                        mysqli_close($link);
                    }
                ?>
            </div>
        </div>
    </div>
    </main>


        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2023</div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
