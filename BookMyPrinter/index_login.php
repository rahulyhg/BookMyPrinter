<?php
    header("Content-Type:text/html; charset=utf-8");
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>預約印表機平台</title>

    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/grayscale.css" rel="stylesheet" />
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js"></script>
    <script src="js/jquery.raty.js"></script>
    <script type="text/javascript">
        var rateScore;
        $(function () {
            $("#stars").raty({
                number: 5,
                path: 'img',
                starOn : 'star-on.png',  
                starOff: 'star-off.png',
                starHalf : 'star-half.png',
                target: '#title', 
                hints: ['很差', '一般', '還不錯', '很好', '滿意'],
                click: function (score, evt) {
                    rateScore = score;
                }
            });
        });

        function fun1() {
            if (document.getElementById('printAll').value == "自訂列印頁數") {
                document.getElementById("pageNumber").value = "請輸入頁數";
                document.getElementById("pageNumber").disabled = false;
            }
            else {
                document.getElementById("pageNumber").disabled = true;
            }
        }

        function uploadFile() {
            window.open('https://script.google.com/macros/s/AKfycbzzfCpKIzJcWD90R7JtAzUZpUJOqeAi6GVuNAhGXYFEdISLvRU/exec', '上傳檔案系統', config='height=300,width=300');
        }

        function rateStore() {
            $.ajax({
                url: 'rateStore.php',
                cache: false,
                dataType: 'html',
                type: 'POST',
                data: {
                    rateStoreName: $('#rateStoreName').val(),
                    rateScore: rateScore
                },
                error: function (xhr) {
                    alert('評分失敗');
                },
                success: function () {
                    alert('評分成功');
                }
            });
            
        }

        function initial() {
            $('#checkBtn').click(function (){
                $('#checkCol0').html($('#fileURL').val());
                $('#checkCol1').html($('#pageNumber').val());
                $('#checkCol2').html($('#printColor').val());
                $('#checkCol3').html($('#printSide').val());
                $('#checkCol4').html($('#printDirection').val());
                $('#checkCol5').html($('#paperSize').val());
                $('#checkCol6').html($('#printType').val());
                $('#checkCol7').html($('#printNumber').val());
                $('#checkCol8').html($('#printPs').val());
                $('#checkCol9').html($('#storeName').val());
                $('#checkCol10').html($('#takeoffTime').val());
            });

            $('#logout').click(function (){
                alert("登出成功");
                window.location.href='index.php';
            });

            $('#confirmBtn').click(function (){
                $.ajax({
                    url: 'checkReservation.php',
                    cache: false,
                    dataType: 'html',
                    type:'POST',
                    data: { fileURL: $('#fileURL').val(), pageNumber: $('#pageNumber').val(), printColor: $('#printColor').val(),
                            printSide: $('#printSide').val(), printDirection: $('#printDirection').val(),
                            paperSize: $('#paperSize').val(), printType: $('#printType').val(), printNumber: $('#printNumber').val(),
                            printPs: $('#printPs').val(), storeName: $('#storeName').val(), takeoffTime: $('#takeoffTime').val()},
                    error: function(xhr) {
                        alert('Ajax request 發生錯誤');
                    },
                    success: function() {
                        alert('預約完成！');
                        parent.location.reload();
                    }
                });
            });
        }
    </script>
    <style>
        span {
            font-family: Microsoft JhengHei;
        }
        option, select, textarea, input{
            color: black;
            font-family: Microsoft JhengHei;
        }
        ::selection{
	        background: black;
	        color: white;
        }
    </style>
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
                        <a class="page-scroll" href="#about">預約說明</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#storeRank">店家排行</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#reserve">立刻預約</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">聯絡我們</a>
                    </li>
                    <li>
                        <a style="cursor: pointer;" id="logout">登出</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
                        </p>
                        <p>
                            <?php
                                $StudentName = $_SESSION['StudentName'];
                                if(empty($StudentName)) {
                                    echo '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">';
                                    echo '<script type="text/javascript">alert("請登入會員!");' ;
                                    echo 'window.location.href=\'index.php\'';
                                    echo '</script>';
                                }
                                echo $StudentName;
                            ?>
                            你好 !
                        </p>
                        <h3>開始使用</h3>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- 關於平台 -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <h2>預約說明</h2>
            <div class="col-md-4">
                <h3>Step 1</h3>
                <p>上傳檔案</p>
            </div>
            <div class="col-md-4">
                <h3>Step 2</h3>
                <p>2222</p>
            </div>
            <div class="col-md-4">
                <h3>Step 3</h3>
                <p>33333</p>
            </div>
        </div>
    </section>

    <!--店家排行-->
    <section id="storeRank" class="content-section text-center">
        <div class="container">
            <div class="row">
                <!--左-->
                <div class="col-md-6 ">
                    <h2>店家排行榜</h2>
                    <input name="printNumber" id="printNumber" value="1(預設)" type="text" style="width:150px; max-width:150px;" />
                </div>
                <!--右-->
                <div class="col-md-6">
                    <h2>動態評分</h2>
                    
                    <h2>我要評分</h2>
                    <select name="rateStoreName" id="rateStoreName"  style="width:250px; max-width:250px;">
                        <option value="影印店1" selected="selected">影印店1</option>
                        <option value="影印店2">影印店2</option>
                        <option value="影印店3">影印店3</option>
                        <option value="影印店4">影印店4</option>
                        <option value="影印店5">影印店5</option>
                        <option value="影印店6">影印店6</option>
                        <option value="影印店7">影印店7</option>
                        <option value="影印店8">影印店8</option>
                        <option value="影印店9">影印店9</option>
                        <option value="影印店10">影印店10</option>
                    </select><br><br>
                    <div id="stars"></div><span id="title"></span><br><br>
                    <a id="rateBtn" class="btn btn-danger btn-lg" onclick="rateStore()" >送出評分</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 預約影印 -->
    <section id="reserve" class="content-section container text-center">
        <h2 style="text-align: center;">預約影印</h2>
        <form>
            <p><b>上傳檔案</b><p>
            <a class="btn btn-success btn-lg" onclick="uploadFile()"><span style="font-family: Microsoft JhengHei;">點我開啟上傳檔案系統</span></a><br><br>
            <p><b>檔案連結</b></p>
            <input name="fileURL" id="fileURL" type="text" value="檔案連結請複製至此"  style="width:350px; max-width:350px; height:50px;" /><br><br><br>

            <h3><b>列印設定</b></h3>
            <select name="printAll" id="printAll" onchange="fun1()" style="width:350px; max-width:350px;  height:50px;">
                <option value="列印整份文件" selected="selected">列印整份文件</option>
                <option value="自訂列印頁數">自訂列印頁數</option>
            </select><br><br>
            <b>自訂影印頁數：</b>
            <input name="pageNumber" value="列印整份文件(預設)" id="pageNumber" type="text" disabled="disabled"  style="width:150px; max-width:150px;" /> (Ex. 1~20)<br><br>

            <select name="printColor" id="printColor" style="width:350px; max-width:350px; height:50px;">
                <option value="黑白列印" selected="selected">黑白列印</option>
                <option value="彩色列印">彩色列印</option>
            </select><br><br>

            <select name="printSide" id="printSide" style="width:350px; max-width:350px; height:50px;">
                <option value="單面列印" selected="selected">單面列印</option>
                <option value="雙面列印">雙面列印</option>
            </select><br><br>

            <select name="printDirection" id="printDirection" style="width:350px; max-width:350px;  height:50px;">
                <option value="直向列印" selected="selected">直向列印</option>
                <option value="橫向列印">橫向列印</option>
            </select><br><br>
            
            <select name="paperSize" id="paperSize"  style="width:350px; max-width:350px;  height:50px;">
                <option value="A3">A3（29.7公分 x 42公分</option>
                <option value="A4" selected="selected">A4（21公分 x 29.7公分）</option>
                <option value="A5">A5（14.8公分 x 21公分）</option>
                <option value="B3">B3（25.7公分 x 36.4公分）</option>
                <option value="B4">B4（18.2公分 x 25.7公分）</option>
            </select><br><br>

            <select name="printType" id="printType"  style="width:350px; max-width:350px;  height:50px;">
                <option value="每張1頁" selected="selected">每張1頁</option>
                <option value="每張2頁">每張2頁</option>
                <option value="每張4頁">每張4頁</option>
                <option value="每張6頁">每張6頁</option>
                <option value="每張8頁">每張8頁</option>
                <option value="每張16頁">每張16頁</option>
            </select><br><br>
            
            <p><b>影印份數</b></p>
            <input name="printNumber" id="printNumber" value="1(預設)" type="text" style="width:150px; max-width:150px;" />  份<br><br>

            <p><b>其他備註</b></p>
            <textarea name="printPs" id="printPs" cols="45" rows="5"  style="width:350px; max-width:350px;">無備註(預設)</textarea><br><br>

            <p><b>選擇影印店</b></p>
            <select name="storeName" id="storeName"  style="width:350px; max-width:350px;">
                <option value="影印店1" selected="selected">影印店1</option>
                <option value="影印店2">影印店2</option>
                <option value="影印店3">影印店3</option>
                <option value="影印店4">影印店4</option>
                <option value="影印店5">影印店5</option>
                <option value="影印店6">影印店6</option>
                <option value="影印店7">影印店7</option>
                <option value="影印店8">影印店8</option>
                <option value="影印店9">影印店9</option>
                <option value="影印店10">影印店10</option>
            </select><br><br>
            
            <p><b>取件時間</b><p>
            <input name="takeoffTime" type="datetime-local" id="takeoffTime"  style="color:black; width:350px; max-width:350px;" value = "2015-09-01T00:00:00" /><br>
            <br><br>
            <a data-toggle="modal" data-target="#doubleCheck"  id="checkBtn" class="btn btn-danger btn-lg">送出</a>
        </form>      
    </section>

    <!--聯絡我們-->
    <section id="contact" class="content-section text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>聯絡我們</h2>
                    <a data-toggle="modal" data-target="#contactEmail" class="btn btn-default btn-lg">
                        <i class="fa fa-google fa-fw"></i><span class="network-name">Gmail</span>
                    </a><br><br>
                    <a href="https://www.facebook.com/tzu.h.chen.1" class="btn btn-default btn-lg">
                        <i class="fa fa-facebook fa-fw"></i><span class="network-name">Facebook</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Email -->
    <div class="modal fade" id="contactEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 30%;">
            <div class="modal-content" style="color: black; padding-left:15%;">
                <br><h3>E-mail連結</h3>
                <p>xxhomey19@mail.com</p>
                <p>來信請備註"影印機預約平台" :)</p>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div style="width:100%;" id="map"></div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; BookMyPrinter</p>
        </div>
    </footer>

    <!-- 確認畫面 -->
    <div class="modal fade" id="doubleCheck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="color: black; ">
                <br>
                <h3 style="text-align:center;">確認預約</h3>
                <div style="padding-left:15%;">
                    檔案連結：<br><span id="checkCol0"></span><br>
                    影印頁數：<span id="checkCol1"></span><br>
                    影印色彩：<span id="checkCol2"></span><br>
                    影印面數：<span id="checkCol3"></span><br>
                    影印方向：<span id="checkCol4"></span><br>                
                    紙張尺寸：<span id="checkCol5"></span><br>
                    每頁張數：<span id="checkCol6"></span><br>
                    影印份數：<span id="checkCol7"></span> 份<br>
                    其他備註：<span id="checkCol8"></span><br>
                    選擇影印店：<span id="checkCol9"></span><br>
                    取件時間：<span id="checkCol10"></span><br>  
                </div>
                <div class="text-center">
                    <br>
                    <a id="confirmBtn" class="btn btn-danger btn-lg" >確認送出</a>
                </div><br>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqrMwTfxxHPl6Qcf7QgcGWiE_3C76oviY&sensor=false"></script>
    
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/grayscale.js"></script>
    



</body>

</html>