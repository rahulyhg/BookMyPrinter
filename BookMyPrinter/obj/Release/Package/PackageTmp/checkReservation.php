
<?php
    session_start();
    $StudentName = $_SESSION['StudentName'];
    $StudentID = $_SESSION['StudentID'];
    header("Content-Type:text/html; charset=utf-8");
    $fileURL = $_POST[fileURL];
    $pageNumber = $_POST[pageNumber];
    $printColor = $_POST[printColor];
    $printSide = $_POST[printSide];
    $printDirection = $_POST[printDirection];
    $paperSize = $_POST[paperSize];
    $printType = $_POST[printType];
    $printNumber = $_POST[printNumber];
    $printPs = $_POST[printPs];
    $storeName = $_POST[storeName];
    $takeoffTime = $_POST[takeoffTime];
    
    require_once 'config.php';

    $conn = mysql_connect($db_host, $db_user, $db_pass);
    if (!$conn) {
        die("�L�k�s����Ʈw!");
    }

    mysql_select_db("bookmyprinter", $conn);
    mysql_query("set names utf8");
    $result = mysql_query("SELECT * FROM reservationlist", $conn);
    $num_rows = mysql_num_rows($result) + 1;
    $sqlstr = "INSERT INTO `reservationlist`(`ID`, `studentName`, `studentID`, `storeName`, `fileURL`, `pageNumber`, `printColor`, `printSide`, `printDirection`, `paperSize`, `printType`, `printNumber`, `printPs`, `takeoffTime`) VALUES ('$num_rows', '$StudentName', '$StudentID','$storeName', '$fileURL', '$pageNumber', '$printColor', '$printSide', '$printDirection', '$paperSize' , '$printType', '$printNumber', '$printPs', '$takeoffTime')";

    if(mysql_query($sqlstr, $conn)) {
        echo 'success';
    } else {
        echo "Error: " . $sqlstr;
    }
    fclose($conn);
?>
