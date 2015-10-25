<?php
    header("Content-Type:text/html; charset=utf-8");
    session_start();
    session_destroy();
    /*require_once 'config.php';
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysql_query("set names utf8");
    $sqlstr = "INSERT INTO member(StudentName, StudentID, Password, Department, Email, Phone) VALUES ('Wade', 'F74010000', 'xx830311', 'CSIE105', 'xxhomey830311@yahoo.com.tw', '0910818277')";
    if(mysqli_query($conn, $sqlstr)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sqlstr . "<br>" . mysqli_error($conn);
    }*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>預約印表機平台</title>

    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/index.css" rel="stylesheet" />
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap-table.css" />
    <style>
        
    </style>
    <script type="text/javascript">
        function initial() {
            $.ajax({ //先call一次排行
                method: "POST",
                url: "storeRank.php"
            }).done(function (data) {
                $("#rankContent").html(data);
            })

            setInterval(function () { //每3分鐘call排行
                $.ajax({
                    method: "POST",
                    url: "storeRank.php"
                }).done(function (data) {
                    $("#rankContent").html(data);
                })
            }, 18000);
        }
    </script>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" onload="initial()">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <span class="light">Book My </span>Printer
                </a>
            </div>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav" style="font-family:'Microsoft JhengHei';">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">關於平台</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#storeRank">關於店家</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#map">店家位置</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#reserve">關於預約</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">關於我們</a>
                    </li>
                    <li>
                        <a style="cursor: pointer;" data-toggle="modal" data-target="#storeLogin">影印店登入</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 影印店登入畫面 -->
    <div class="modal fade" id="storeLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog text-center" style="width: 30%;">
            <div class="modal-content">
                <br>
                <h2 style="color:black;">影印店登入</h2>
                <form method="post" action="storeLogin.php" style="color:black;">
                    <b>帳號</b>：
                    <input name="storeAccount" type="text" required="required" style="width:50%; max-width:50%;" />
                    <br /><br />
                    <b>密碼</b>：
                    <input name="storePassword" type="password" required="required" style="width:50%; max-width:50%;" />
                    <br /><br />
                    <div style="text-align:center;">
                        <input type="submit" class="btn btn-success" value="登入" />
                    </div>
                </form>
                <br />
            </div>
        </div>
    </div>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">預約印表機平台</h1>
                        <p class="intro-text">
                            快速預約印表機，讓你不必在為影印困擾
                            <br />
                            預約前記得先登入會員~
                        </p>
                        <p id="memberZone">
                            <a data-toggle="modal" data-target="#regist" class="btn btn-primary btn-lg"><span>加入會員</span></a>
                            <a data-toggle="modal" data-target="#login" class="btn btn-success btn-lg"><span>登入會員</span></a>
                            <a data-toggle="modal" data-target="#verify" class="btn btn-danger btn-lg"><span>驗證碼輸入</span></a>
                        </p>
                    </div>
                </div>

                <!-- 登入畫面 -->
                <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width: 30%;">
                        <div class="modal-content">
                            <h2 style="color:black;">登入會員</h2>
                            <form method="post" action="login.php" style="color:black;">
                                <b>學號</b>：
                                <input name="studentID" type="text" required="required" style="width:50%; max-width:50%;" />
                                <br /><br />
                                <b>密碼</b>：
                                <input name="password" type="password" required="required" style="width:50%; max-width:50%;" />
                                <br /><br />
                                <div style="text-align:center;">
                                    <input type="submit" class="btn btn-success" value="登入" />
                                </div>
                            </form>
                            <br />
                        </div>
                    </div>
                </div>

                <!-- 註冊畫面 -->
                <div class="modal fade" id="regist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width: 30%;">
                        <div class="modal-content">
                            <h2 style="color:black;">加入會員</h2>
                            <form method="post" style="color:black;" action="register.php">
                                <b>會員姓名</b>：
                                <input name="name" id="name" type="text" required="required" style="width:50%; max-width:50%;" />
                                <br /><br />
                                <b>會員學號</b>：
                                <input name="studentID" id="stdID" type="text" required="required" style="width:50%; max-width:50%;" />
                                <br /><br />
                                <b>會員密碼</b>：
                                <input name="password1" id="pwd1" type="password" required="required" style="width:50%; max-width:50%;" />
                                <br /><br />
                                <b>確認密碼</b>：
                                <input name="password2" id="pwd2" onchange="checkpwd()" type="password" required="required" style="width:50%; max-width:50%;" />
                                <br /><br />
                                <b>就讀系級</b>：
                                <input name="department" id="department" type="text" required="required" style="width:50%; max-width:50%;" />
                                <br /><br />
                                <b>電子信箱</b>：
                                <input name="email" id="email" type="text" required="required" style="width:50%; max-width:50%;" />
                                <br /><br />
                                <b>手機號碼</b>：
                                <input name="phone" id="phone" type="text" required="required" style="width:50%; max-width:50%;" />
                                <br /><br />

                                <div style="text-align:center;">
                                    <input type="submit" name="registerBtn" value="註冊" class="btn btn-primary" />
                                </div>
                            </form>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 驗證碼輸入畫面 -->
        <div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 30%;">
                <div class="modal-content">
                    <h2 style="color:black;">驗證碼輸入</h2>
                    <form method="post" action="verify.php" style="color:black;">
                        <b>帳號</b>：
                        <input name="studentID" type="text" required="required" style="width:50%; max-width:50%;" />
                        <br /><br />
                        <b>驗證碼</b>：
                        <input name="verifycode" type="text" required="required" style="width:50%; max-width:50%;" />
                        <br /><br />
                        <div style="text-align:center;">
                            <input type="submit" class="btn btn-success" value="確認" />
                        </div>
                    </form>
                    <br />
                </div>
            </div>
        </div>
    </header>

    <!-- 關於平台 -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <h2>關於平台</h2>
            <h4>我們提供線上預約影印服務</h4>
            <hr>
            <div class="col-md-4">
                <h3>在家線上下單</h3>
                <img src="img/text.png" />
            </div>
            <div class="col-md-4">
                <h3>商店通知取件</h3>
                <img src="img/mail.png" />
            </div>
            <div class="col-md-4">
                <h3>現場取件付款</h3>
                <img src="img/shop.png" />
            </div>
        </div>
    </section>

    <!--關於店家-->
    <section id="storeRank" class="content-section text-center">
        <div class="container">
            <h2>關於店家</h2>
            <hr>
            <div class="row">
                <!--左-->
                <div class="col-md-6 ">
                    <h3>店家排行榜</h3>
                    <table id="events-id2" data-toggle="table">
                        <thead>
                            <tr>
                                <th>排行</th>
                                <th>店家名稱</th>
                                <th>累積得分</th>
                                <th>平均得分</th>
                            </tr>
                        </thead>
                        <tbody id="rankContent"></tbody>
                    </table>
                </div>
                <!--右-->
                <div class="col-md-6" style="text-align: center;">
                    <h3>目前合作影印店</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <div style="width:100%;" id="map"></div>

    <!--預約影印-->
    <section id="reserve" class="container content-section ">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2" style="text-align: center;">
                <h2>預約影印</h2>
                <hr>
                <br>
                <h3>要先登入才能預約影印喔~</h3>
                <p>
                    <a data-toggle="modal" data-target="#regist" class="btn btn-primary btn-lg"><span>加入會員</span></a>
                    <a data-toggle="modal" data-target="#login" class="btn btn-success btn-lg"><span>登入會員</span></a>
                </p>
            </div>
        </div>
    </section>

    <!--關於我們-->
    <section id="contact" class="content-section text-center">
        <div class="container">
            <div class="row" >
                <h2>關於我們</h2>
                <hr>
                <div class="col-md-3">
                    <div class="photo" id="p1"></div><br />
                    <h3>陳自泓</h3>
                    <h4>資訊系大四</h4>
                </div>
                <div class="col-md-3">
                    <div class="photo" id="p2"></div><br />
                    <h3>陳恩平</h3>
                    <h4>工資管大四</h4>
                </div>
                <div class="col-md-3">
                    <div class="photo" id="p3"></div><br />
                    <h3>韓承勳</h3>
                    <h4>資訊系大四</h4>
                </div>
                <div class="col-md-3">
                    <div class="photo" id="p4"></div><br />
                    <h3>劉皓平</h3>
                    <h4>電機系大四</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; BookMyPrinter 2015</p>
        </div>
    </footer>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqrMwTfxxHPl6Qcf7QgcGWiE_3C76oviY&sensor=false"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/grayscale.js"></script>
    <script src="js/bootstrap-table.js"></script>
</body>

</html>