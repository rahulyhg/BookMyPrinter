
<?php
    header("Content-Type:text/html; charset=utf-8");
    $ID = $_POST[ID];
    $accept = $_POST[accept];
    require_once 'config.php';

    $conn = mysql_connect($db_host, $db_user, $db_pass);
    if (!$conn) {
        die("無法連結資料庫!");
    }

    if($accept == 1){
        $str = "已接受";
    }
    else if($accept == 0) {
        $str = "已拒絕";
    }
    
    mysql_select_db("bookmyprinter", $conn);
    mysql_query("set names utf8");
    $result = mysql_query("SELECT * FROM reservationlist WHERE ID = '$ID' " , $conn);
    if($row = mysql_fetch_assoc($result)) {
        $update = mysql_query("UPDATE `reservationlist` SET `situation`='$str' WHERE `ID` = '$ID'", $conn);
        echo $str;
    }
    else{
        echo "Error";
    }
    fclose($conn);
?>
