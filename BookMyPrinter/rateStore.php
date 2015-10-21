<?php
    session_start();
    $StudentName = $_SESSION['StudentName'];
    $rateStoreName = $_POST[rateStoreName];
    $rateScore = $_POST[rateScore];

    require_once 'config.php';
    
    $conn = mysql_connect($db_host, $db_user, $db_pass);
    if (!$conn) {
        die("無法連結資料庫!");
    }

    mysql_select_db("bookmyprinter", $conn);
    mysql_query("set names utf8");
    $result = mysql_query("SELECT * FROM ratelist", $conn);
    $num_rows = mysql_num_rows($result) + 1;
    $sqlstr = "INSERT INTO `ratelist`(`ID`, `StudentName`, `StoreName`, `Score`) VALUES ('$num_rows', '$StudentName', '$rateStoreName', '$rateScore')";
    
    if(mysql_query($sqlstr, $conn)){
        echo $num_rows;
    }
    else {
        echo "Error: " . mysql_error();
    }
    fclose($conn);
?>