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
        <script src="js/scripts.js"></script>
        
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
        <header class="masthead" style="background-image: url('assets/img/about-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="page-heading">
                            <h1>課程列表</h1>
                            <span class="subheading">Course Schedule</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- 選擇查詢學年科系的form -->
        <main class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <form action="course.php" method="post" class="my-4">
                            <div class="form-group row mb-3">
                                <label for="year" class="col-sm-3 col-form-label">學年度 :</label>
                                <div class="col-sm-9">
                                    <select name="year" id="year" class="form-control">
                                        <option value="110">110</option>
                                        <option value="111">111</option>
                                        <option value="112" selected>112</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="semester" class="col-sm-3 col-form-label">學期 :</label>
                                <div class="col-sm-9">
                                    <select name="semester" id="semester" class="form-control">
                                        <option value="1">第一學期</option>
                                        <option value="2" selected>第二學期</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="college" class="col-sm-3 col-form-label">學院 :</label>
                                <div class="col-sm-9">
                                    <select name="college" id="college" class="form-control">
                                        <option value="農學院">農學院</option>
                                        <option value="理工學院" selected>理工學院</option>
                                        <option value="生命科學院">生命科學院</option>
                                        <option value="師範學院">師範學院</option>
                                        <option value="人文藝術學院">人文藝術學院</option>
                                        <option value="管理學院">管理學院</option>
                                        <option value="獸醫學院">獸醫學院</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="department" class="col-sm-3 col-form-label">科系 :</label>
                                <div class="col-sm-9">
                                    <select name="department" id="department" class="form-control">
                                        <option value="資工系" selected>資訊工程學系</option>
                                        <option value="應數系">應用數學系</option>
                                        <option value="電物系">電子物理系</option>
                                        <option value="應化系">應用化學系</option>
                                        <option value="生機系">生物機電工程學系</option>
                                        <option value="土木系">土木與水資源工程學系</option>
                                        <option value="電機系">電機工程學系</option>
                                        <option value="機械系">機械與能源工程學系</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" name="Insert" class="btn btn-primary custom-search-btn">查詢</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <!-- 接收表單、連結資料庫查詢、顯示課程列表 -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <?php
                        // 是否收到表單送回資料
                        if (isset($_POST["Insert"])) {
                            // 開啟MySQL的資料庫連接
                            $link = mysqli_connect("localhost", "root", "ki27165211", "course_evaluate")
                                    or die("無法開啟MySQL資料庫連接!<br/>");

                            mysqli_set_charset($link, 'utf8');

                            $year = mysqli_real_escape_string($link, $_POST["year"]);
                            $semester = mysqli_real_escape_string($link, $_POST["semester"]);
                            $college = mysqli_real_escape_string($link, $_POST["college"]);
                            $department = mysqli_real_escape_string($link, $_POST["department"]);

                            $sql = "SELECT c.*, e.e_test, e.e_report_HW, e.e_gain, e.e_pro, e.e_exprience, AVG(e.e_score) AS avg_score
                                    FROM course c
                                    LEFT JOIN evaluate e ON c.c_id = e.e_course
                                    WHERE c.c_year = '$year' AND c.c_semester = '$semester' 
                                    AND c.c_college = '$college' AND c.c_department = '$department'
                                    GROUP BY c.c_id";

                            $result = mysqli_query($link, $sql);

                            if ($result && mysqli_num_rows($result) > 0) {
                                echo "<div class='reviews-section'>";
                            
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<div class='review-card my-3 p-4 bg-white rounded shadow-sm'>";
                                    echo "<div class='review-top d-flex justify-content-between align-items-center'>";
                                    echo "<div class='review-meta'>";
                                    $avg_score = round($row['avg_score']);
                                    for ($i = 0; $i < 5; ++$i) {
                                        echo $i < $avg_score ? "<i class='fas fa-star text-warning'></i>" : "<i class='far fa-star'></i>";
                                    }
                                    echo "<span class='text-muted'> ・ " . htmlspecialchars($row['c_year']) . "學年 第" . htmlspecialchars($row['c_semester']) . "學期</span>";
                                    echo "</div>";
                                    echo "</div>"; // end review-top
                                    echo "<div class='review-details'>"; // 包裹詳細信息的新 div
                                    echo "<div class='review-body'>";
                                    echo "<h5><a href='show_eva.php?c_id=" . htmlspecialchars($row['c_id']) . "'>" . htmlspecialchars($row['c_name']) . "</a></h5>";
                                    echo "<div class='hidden-details'>";
                                    echo "<p>" . htmlspecialchars($row['e_test']) . "</p>";
                                    echo "<p>" . htmlspecialchars($row['e_report_HW']) . "</p>";
                                    echo "<p>" . htmlspecialchars($row['e_gain']) . "</p>";
                                    echo "<p>" . htmlspecialchars($row['e_pro']) . "</p>";
                                    echo "<p>" . htmlspecialchars($row['e_exprience']) . "</p>";
                                    echo "</div>";

                                    echo "</div>"; // end review-body
                                    echo "</div>"; // end review-details
                                    echo "</div>"; // end review-card
                                }
                            
                                echo "</div>"; // end reviews-section
                            } else {
                                echo "沒有符合條件的課程。";
                            }
                            mysqli_close($link);
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
        
    </body>
</html>
