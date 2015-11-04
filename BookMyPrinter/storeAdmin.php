<?php
    header("Content-Type:text/html; charset=utf-8");
    session_start();
    $StoreName = $_SESSION['StoreName'];
    if(empty($StoreName)) {
        echo '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">';
        echo '<script type="text/javascript">alert("請先登入帳戶!");';
        echo 'window.location.href=\'index.php\'';
        echo '</script>';
    }
    require_once 'config.php';

    $conn = mysql_connect($db_host, $db_user, $db_pass);
    if (!$conn) {
        die("無法連結資料庫!");
    }
    mysql_select_db("bookmyprinter", $conn);
    mysql_query("set names utf8");
    $result = mysql_query("SELECT * FROM reservationlist WHERE storeName = '$StoreName' " , $conn);
    while($row = mysql_fetch_assoc($result))
    {
        $str .= '<tr><td></td>';
        $str .= '<td id="reservationID">'. $row["ID"] .'</td>';
        $str .= '<td>'. $row["studentName"] .'</td>';
        $str .= '<td>'. $row["studentID"] .'</td>';
        $str .= '<td>'. $row["takeoffTime"] .'</td>';
        $str .= '<td><a data-toggle="modal" data-target="#printInfo" style="height:100%; cursor: pointer;" id="checkInfoBtn'. $row["ID"] .'">
                    詳細列印資訊</a></td>';
        $str .= '<td id="situation">'. $row["situation"] .'</td>';
        $str .= '</tr>';
        $js .= '$(\'#checkInfoBtn'. $row["ID"]. '\').click(function (){
                    checkInfo('. $row["ID"] .');
                    selectID = " '. $row["ID"] .' ";
                });';
    }
    fclose($conn);
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
    <script type="text/javascript">
        var selectID;
        var tmp;
        function initial() {
            $('#logout').click(function (){
                alert("登出成功");
                window.location.href='index.php';
            });

            <?php echo $js;  ?>

            $('#acceptBtn').click(function (){ //接受訂單
                $.ajax({
                    url: 'acceptReservation.php',
                    cache: false,
                    dataType: 'html',
                    type:'POST',
                    data: { ID: selectID, accept: 1},
                    error: function(xhr) {
                        alert('Ajax request 發生錯誤');
                    },
                    success: function(response) {
                        alert("已接受訂單");
                        $('#situation').empty().append(response);
                    }
                });
            });

            $('#rejectBtn').click(function (){ //拒絕訂單
                $.ajax({
                    url: 'acceptReservation.php',
                    dataType: 'html',
                    type:'POST',
                    data: { ID: selectID, accept: 0},
                    error: function(xhr) {
                        alert('Ajax request 發生錯誤');
                    },
                    success: function(response) {
                        alert("已拒絕訂單");
                        $('#situation').empty().append(response);
                    }
                });
            });

            $('#printInfo').on('hidden.bs.modal', function () {
                $('#checkCol0').empty().append("資料處理中...");
                $('#checkCol1').empty().append("資料處理中...");
                $('#checkCol2').empty().append("資料處理中...");
                $('#checkCol3').empty().append("資料處理中...");
                $('#checkCol4').empty().append("資料處理中...");
                $('#checkCol5').empty().append("資料處理中...");
                $('#checkCol6').empty().append("資料處理中...");
                $('#checkCol7').empty().append("資料處理中...");
                $('#checkCol8').empty().append("資料處理中...");
            })
        }

        function checkInfo(id){
            $.ajax({
                url: 'reservationInfo.php',
                cache: false,
                dataType: 'json',
                type:'POST',
                data: { ID: id},
                error: function(xhr) {
                    alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    $('#checkCol0').empty().append(response["fileURL"]);
                    $('#checkCol1').empty().append(response["pageNumber"]);
                    $('#checkCol2').empty().append(response["printColor"]);
                    $('#checkCol3').empty().append(response["printSide"]);
                    $('#checkCol4').empty().append(response["printDirection"]);
                    $('#checkCol5').empty().append(response["paperSize"]);
                    $('#checkCol6').empty().append(response["printType"]);
                    $('#checkCol7').empty().append(response["printNumber"]);
                    $('#checkCol8').empty().append(response["printPs"]);
                }
            });
        }

        function operateFormatter(value, row, index) {
            return [
                '<a class="edit ml10" href="javascript:void(0)" title="修改">',
                    '<i class="glyphicon glyphicon-edit"></i>',
                '</a>',
                '<a class="remove ml10" href="javascript:void(0)" title="移除">',
                    '<i class="glyphicon glyphicon-remove"></i>',
                '</a>'
            ].join('');
        }

        window.operateEvents = {
            'click .edit': function (e, value, row, index) {
                alert('You click edit icon');
            },
            'click .remove': function (e, value, row, index) {
                alert('You click remove icon');
            }
        };
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
                    <span class="light">Book My </span>
                    Printer
                </a>
            </div>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav" style="font-family:'Microsoft JhengHei';">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#list">查看預約</a>
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
                        <h1 class="brand-heading">
                            預約印表機平台
                            <br />
                            影印店管理
                        </h1>
                        <p class="intro-text">
                            您將能在這裡看到您的所有訂單
                            <br />
                        </p>
                        <p>
                            <?php echo $StoreName; ?>
                            你好 !
                        </p>
                        <p>查看預約單</p>
                        <a href="#list" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- 關於平台 -->
    <section id="list" class="container content-section text-center">
        <div class="row">
            <h2>訂單管理</h2>
            <div class="col-lg-8 col-lg-offset-2">
                <table id="events-id2" data-toggle="table"  data-show-refresh="true" data-search="true" data-select-item-name="toolbar1">
                    <thead>
                        <tr>
                            <th data-checkbox="true"></th>
                            <th data-sortable="true">訂單編號</th>
                            <th data-sortable="true">姓名</th>
                            <th data-sortable="true">學號</th>
                            <th data-sortable="true">取件時間</th>
                            <th data-sortable="true">詳細列印資訊</th>
                            <th data-sortable="true">狀態</th>
                            <th data-formatter="operateFormatter" data-events="operateEvents">操作選項</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $str; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; BookMyPrinter</p>
        </div>
    </footer>

    <!-- 確認畫面 -->
    <div class="modal fade" id="printInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="color: black; ">
                <br>
                <h3 style="text-align:center;">詳細影印資訊</h3>
                <div style="padding-left:15%;">
                    檔案連結：<br><span id="checkCol0">資料處理中...</span><br>
                    影印頁數：<span id="checkCol1">資料處理中...</span><br>
                    影印色彩：<span id="checkCol2">資料處理中...</span><br>
                    影印面數：<span id="checkCol3">資料處理中...</span><br>
                    影印方向：<span id="checkCol4">資料處理中...</span><br>                
                    紙張尺寸：<span id="checkCol5">資料處理中...</span><br>
                    每頁張數：<span id="checkCol6">資料處理中...</span><br>
                    影印份數：<span id="checkCol7">資料處理中...</span> 份<br>
                    其他備註：<span id="checkCol8">資料處理中...</span><br>
                </div>
                <div class="text-center">
                    <br>
                    <a id="acceptBtn" class="btn btn-success btn-lg " data-dismiss="modal">接受訂單</a>
                    <a id="rejectBtn" class="btn btn-danger btn-lg " data-dismiss="modal" >拒絕訂單</a>
                </div><br>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/grayscale.js"></script>
    <script src="js/bootstrap-table.js"></script>
</body>

</html>
