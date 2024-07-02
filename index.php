<?php session_start(); ?>
<?php
// 建立MySQL的資料庫連接
$link = mysqli_connect("localhost", "root", "ki27165211", "course_evaluate") or die("無法開啟MySQL資料庫連接!<br/>");

// 檢查連接
if (!$link) {
    die("連接失敗: " . mysqli_connect_error());
}

// 查詢總課程數
$total_courses_query = "SELECT COUNT(*) AS total FROM course"; // 確保這裡的 'course' 是您的課程表名
$total_courses_result = mysqli_query($link, $total_courses_query);
$total_courses_row = mysqli_fetch_assoc($total_courses_result);
$total_courses = $total_courses_row['total'];

// 查詢總評價數
$total_evaluations_query = "SELECT COUNT(*) AS total FROM evaluate"; // 確保這裡的 'evaluate' 是您的評價表名
$total_evaluations_result = mysqli_query($link, $total_evaluations_query);
$total_evaluations_row = mysqli_fetch_assoc($total_evaluations_result);
$total_evaluations = $total_evaluations_row['total'];

// 查詢總科系數，這裡假設 'course' 表中有一個 'department' 列
$total_departments_query = "SELECT COUNT(DISTINCT c_department) AS total FROM course"; // 替換 'department' 為您表中的相應列名
$total_departments_result = mysqli_query($link, $total_departments_query);
$total_departments_row = mysqli_fetch_assoc($total_departments_result);
$total_departments = $total_departments_row['total'];

// 關閉數據庫連接
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>嘉義大學課程評價系統</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.png" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/index.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <img src="assets/favicon.png" alt="Image" style="width: 60px; height: 50px;">
                <a class="navbar-brand" href="https://www.ncyu.edu.tw/">國立嘉義大學</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php">首頁</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="course.php">課程列表</a></li>
                        <!-- <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="evaluate.php">評價</a></li> -->
                        <!-- <?php
                        
                            if (isset($_COOKIE['username'])) {
                                echo "<li class='nav-item'><a class='nav-link px-lg-3 py-3 py-lg-4' href='evaluate.php'>評價</a></li>";
                            } else {
                                echo "<li class='nav-item'><a class='nav-link px-lg-3 py-3 py-lg-4' href='sign.php'>評價</a></li>";
                            }
                        ?> -->
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
                        
                        <!-- <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="sign.php">登入</a></li> -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading ">
                            <h1 >嘉大課程評價系統</h1>
                            <span class="subheading">快來評價!</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        

        <!-- Main Content   課程只放111學年度的排行  -->
        <div class="statistics-container">
            <div class="statistic">
                <h3><?php echo htmlspecialchars($total_courses); ?></h3>
                <p>總課程數</p>
            </div>
            <div class="statistic">
                <h3><?php echo htmlspecialchars($total_evaluations); ?></h3>
                <p>總評價數</p>
            </div>
            <div class="statistic">
                <h3><?php echo htmlspecialchars($total_departments); ?></h3>
                <p>總科系數</p>
            </div>
        </div>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- 暫放  下面是排行榜表格style -->
                    <style>
                        table {
                            border-collapse: collapse;
                            width: 100%;
                        }

                        th, td {
                            border: 1px solid black;
                            padding: 8px;
                            text-align: center;
                        }
                    </style>
                    <div class="post-preview">

                    <!-- Workspace -->
                    



                    <?php
                    
                    
                        // 建立MySQL的資料庫連接，放自己的database設定
                        $link = mysqli_connect("localhost", "root", "ki27165211", "course_evaluate") or die("無法開啟MySQL資料庫連接!<br/>");

                        // 用JOIN結合evaluate和course資料表
                        $sql = "SELECT ROUND(AVG(e.e_score),1) AS avg_score, c.c_name, c.c_department, c.c_pro, e.e_course
                                FROM evaluate e 
                                INNER JOIN course c ON e.e_course = c.c_id AND c.c_year = 111
                                GROUP BY e.e_course
                                ORDER BY avg_score DESC";

                       
                        echo "<span style='font-size: 35px;'>111學年度好課評價</span>";
                        // 印出最多前十名，包含排名、評分、學系、課程名字
                        $i = 1;
                        if ($result = mysqli_query($link, $sql)) {
                            echo "<table border='2'>";
                            echo "<tr><th>排名</th><th>總評分</th><th>學系</th><th>教授</th><th>課程名稱</th></tr>";
                            while (($row = mysqli_fetch_assoc($result)) && ($i <= 10)) {
                                echo "<tr>";
                                echo "<td>" . $i . "</td>";
                                echo "<td>" . $row["avg_score"] . "</td>";
                                echo "<td>" . $row["c_department"] . "</td>";
                                echo "<td>" . $row["c_pro"] . "</td>";
                                echo "<td>"; 
                                //記得之後將a:hover修改 目前指到不會有改變
                                echo "<a href='show_eva.php?c_id={$row['e_course']}' style='color: #007bff; font-weight: bold;text-decoration: none;'>{$row['c_name']}</a>";
                                echo "</td>";
                                echo "</tr>";
                                $i++;
                            }
                            echo "</table>";
                            mysqli_free_result($result);
                        }

                    ?>
                    
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                    <!-- Post preview-->
                    <div class="post-preview">

                        <?php
                            $sql = "SELECT ROUND(AVG(e.e_easy),1) AS avg_score, c.c_name, c.c_department, c.c_pro, e.e_course
                            FROM evaluate e 
                            INNER JOIN course c ON e.e_course = c.c_id AND c.c_year = 111
                            GROUP BY e.e_course
                            ORDER BY avg_score DESC";

                            echo "<span style='font-size: 35px;'>111學年度課程涼度評分</span>";
                            // 印出最多前十名，包含排名、輕鬆程度、學系、課程名字
                            $i = 1;
                            if ($result = mysqli_query($link, $sql)) {
                                echo "<table border='2'>";
                                echo "<tr><th>排名</th><th>輕鬆程度</th><th>學系</th><th>教授</th><th>課程名稱</th></tr>";
                                while (($row = mysqli_fetch_assoc($result)) && ($i <= 10)) {
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . $row["avg_score"] . "</td>";
                                    echo "<td>" . $row["c_department"] . "</td>";
                                    echo "<td>" . $row["c_pro"] . "</td>";
                                    echo "<td>"; 
                                    //記得之後將a:hover修改 目前指到不會有改變
                                    echo "<a href='show_eva.php?c_id={$row['e_course']}' style='color: #007bff; font-weight: bold;text-decoration: none;'>{$row['c_name']}</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                    $i++;
                                }
                                echo "</table>";
                                mysqli_free_result($result);
                            }
                        ?>
                    </div>

                    <!-- Divider-->
                    <hr class="my-4" />
                    <!-- Pager   到評價畫面的按鈕 -->

                    
                    <?php
                        
                        if (isset($_COOKIE['username'])) {
                            // 如果有登入，前往評價
                            echo "<div class=\"d-flex justify-content-end mb-4\"><a class=\"btn btn-primary text-uppercase\" href=\"course.php\">前往評價 →</a></div>";
                        } else {
                            // 如果沒有登入，顯示登入連結
                            echo "<div class=\"d-flex justify-content-end mb-4\"><a class=\"btn btn-primary text-uppercase\" href=\"sign.php\">前往評價 →</a></div>";
                        }
                    ?>

                    
                </div>
            </div>
        </div>

        



        
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
