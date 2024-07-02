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
        <link href="css/show_eva.css" rel="stylesheet" />
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
        <header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1>課程評價</h1>
                            <h2 class="subheading">Course Evaluation</h2>
                            
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <h2 class="section-heading">他人寫下的評價</h2>
                        <!-- 接收表單、連結資料庫查詢、顯示課程列表 -->
                        <?php
                            // 是否收到表單送回資料
                            if (isset($_GET['c_id'])) {
                                // 開啟MySQL的資料庫連接
                                $link = @mysqli_connect("localhost", "root", "ki27165211", "course_evaluate")
                                        or die("無法開啟MySQL資料庫連接!<br/>");

                                //送出UTF8編碼的MySQL指令
                                mysqli_query($link, 'SET NAMES utf8'); 

                                // 取得表單提交的值
                                $c_id = $_GET['c_id'];   

                                // 建立新增記錄的SQL指令字串
                                $sql = "SELECT * FROM evaluate WHERE e_course = '$c_id'";
                                // 執行查詢
                                $result = $link->query($sql);

                                if ($result->num_rows > 0) {
                                    // 顯示查詢結果
                                    echo "<table class='course'>
                                        <tr border='1'>
                                            <th>課程評分</th>
                                            <th>涼度</th>
                                            <th>考試</th>
                                            <th>報告作業</th>
                                            <th>收穫</th>
                                            <th>教授、上課風格評價</th>
                                            <th>心得</th>
                                            <th>到課頻率</th>
                                            <th>是否通過</th>
                                        </tr>";
                            
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                            <td>{$row['e_score']}</td>
                                            <td>{$row['e_easy']}</a></td>
                                            <td>{$row['e_test']}</td>
                                            <td>{$row['e_report_HW']}</td>
                                            <td>{$row['e_gain']}</td>
                                            <td>{$row['e_pro']}</td>
                                            <td>{$row['e_exprience']}</td>
                                            <td>{$row['e_fre']}</td>
                                            <td>{$row['e_pass']}</td>
                                        </tr>";
                                    }
                                    echo "</table>";
                                }
                                else {
                                    echo "沒有符合條件的評價。";
                                    
                                } 
                                if (isset($_COOKIE['username'])) {
                                    echo "<a href='evaluate.php?c_id={$c_id}&username={$_COOKIE['username']}'>點此前往評論該課程</a>";
                                } else {
                                    echo "<a href='sign.php'>點此前往登入</a>";
                                }

                                mysqli_close($link);      // 關閉資料庫連接
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
        </article>
                     

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
    </body>
</html>
