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
        <nav class="navbar navbar-expand-lg navbar-light bg-light" id="mainNav">
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
                            <h1 class="masthead-title">課程評價</h1>
                            <h2 class="masthead-subtitle">Course Evaluation</h2>
                            
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
                        <!-- 評價表 -->
                        <form action="evaluate.php?c_id=<?php $c_id= isset($_GET['c_id']) ? $_GET['c_id'] : null; echo $c_id; ?>" method="post">
                            <table border="1" class="evaluate">
                            
                                <tr>
                                    <td>用戶</td>
                                    <td>
                                        <?php
                                            
                                            $ID = $_COOKIE['username'];
                                            echo "$ID";
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>課程名稱</td>
                                    <td>
                                        <?php
                                        $link = @mysqli_connect("localhost", "root", "ki27165211")
                                            or die("無法開啟MySQL資料庫連接!<br/>");
                                        mysqli_select_db($link, "course_evaluate");
                                        mysqli_query($link, 'SET NAMES utf8');

                                        $ID = $_GET['c_id'];
                                        $Query = "SELECT c_name FROM course WHERE c_id = '$ID'";
                                        $Result = $link->query($Query);

                                        if ($Result && $Result->num_rows > 0) {
                                            $Data = $Result->fetch_assoc();
                                            echo $Data["c_name"];
                                        }
                                        mysqli_close($link);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>課程評分</td>
                                    <td><select name="score" required>
                                            <option value="" selected>越高分表示對課程越滿意</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>涼度</td>
                                    <td><select name="easy" required>
                                            <option value="" selected>越高分表示越涼（輕鬆）</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>考試</td>
                                    <td><textarea name="test" rows="6" maxlength="200" placeholder="小考/期中考/期末考的方式與內容難易度..." required></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>報告作業</td>
                                    <td><textarea name="report_HW" rows="6" maxlength="200" placeholder="報告/作業的方式與內容難易度..."></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>收穫</td>
                                    <td><textarea name="gain" rows="6" maxlength="200" placeholder="上完這門課學到的酷東東"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>教授及上課方式</td>
                                    <td><textarea name="pro" rows="6" maxlength="200" placeholder="教授好催眠但不給我們睡覺/笑話很好笑之類的..."></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>心得</td>
                                    <td><textarea name="exprience" rows="6" maxlength="200" placeholder="推薦這堂課嗎/好有趣還是好無聊" required></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>到課頻率</td>
                                    <td><select name="fre" required>
                                            <option value="" selected>誠實選一個最接近的</option>
                                            <option value="1">每週都到，怎麼可能翹課</option>
                                            <option value="2">每兩週至少去一次，不可以翹的太明顯</option>
                                            <option value="3">一個月去個兩次，還是有點心吧</option>
                                            <option value="4">一個月去一次，探望同學與老師</option>
                                            <option value="5">期中期末週才會到</option>
                                            <option value="6">根本沒去上過課?!</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>是否通過</td>
                                    <td><input type="radio" name="pass" value="1" />是
                                        <input type="radio" name="pass" value="0" />否
                                    </td>
                                </tr>
                                
                                   
                                        <!-- <input type="submit" name="Insert" value="新增" /> -->
                            </table>
                            <br />
                            <div class="d-grid gap-1 d-md-flex justify-content-md-center text-center">
                                <button class="btn btn-primary" id="Insert" name="Insert" type="submit">新增</button>
                            </div>
                            <br />
                            <!-- <button class="btn btn-primary me-md-2" type="submit">Register</button> -->
                        </form>
                        <!-- 接收表單、連結資料庫查詢、顯示課程列表 -->
                        <?php
                            $c_id = $_GET['c_id'];

                            if (isset($_POST["Insert"])) {
                                // 開啟MySQL的資料庫連接
                                $link = @mysqli_connect("localhost", "root", "ki27165211", "course_evaluate") or die("無法開啟MySQL資料庫連接!<br/>");

                                // 取得傳入資料
                                $a_mail = isset($_COOKIE['username']) ? $_COOKIE['username'] : null;

                                // 選擇資料庫
                                mysqli_query($link, 'SET NAMES utf8'); // 送出UTF8編碼的MySQL指令

                                // 建立新增記錄的SQL指令字串
                                $sql = "INSERT INTO evaluate (e_account, e_course, e_score, e_easy, e_test, e_report_HW, e_gain, e_pro, e_exprience, e_fre, e_pass) 
                                        VALUES (
                                            (SELECT a_id FROM account WHERE a_mail = ?),
                                            ?,
                                            ?,?,?,?,?,?,?,?,?
                                        )";

                                if ($stmt = mysqli_prepare($link, $sql)) {
                                    // 連繫參數的變數
                                    $stmt->bind_param("sssssssssss", $a_mail, $c_id, $e_score, $e_easy, $e_test, $e_report_HW, $e_gain, $e_pro, $e_exprience, $e_fre, $e_pass);

                                    $a_mail = $_COOKIE["email"];
                                    $e_score = $_POST["score"];
                                    $e_easy = $_POST["easy"];
                                    $e_test = $_POST["test"];
                                    $e_report_HW = $_POST["report_HW"];
                                    $e_gain = $_POST["gain"];
                                    $e_pro = $_POST["pro"];
                                    $e_exprience = $_POST["exprience"];
                                    $e_fre = $_POST["fre"];
                                    $e_pass = $_POST["pass"];

                                    $stmt->execute();  // 執行SQL指令
                                    // echo "資料庫新增記錄成功, 影響記錄數: " . $stmt->affected_rows . "<br/>";
                                    echo "<div class='alert alert-success' role='alert'>評論成功！</div>";
                                    $stmt->close();    // 關閉Prepared Statement
                                } else {
                                    exit("評論失敗<br/>");
                                }

                                // 關閉資料庫連接
                                mysqli_close($link);
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
