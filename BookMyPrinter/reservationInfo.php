
<?php
    header("Content-Type:text/html; charset=utf-8");
    $ID = $_POST[ID];
    require_once 'config.php';

    $conn = mysql_connect($db_host, $db_user, $db_pass);
    if (!$conn) {
        die("無法連結資料庫!");
    }

    mysql_select_db("bookmyprinter", $conn);
    mysql_query("set names utf8");
    $result = mysql_query("SELECT * FROM reservationlist WHERE ID = '$ID' " , $conn);
    if($row = mysql_fetch_assoc($result)) {
        $response = [
            "fileURL" => $row["fileURL"],
            "pageNumber" => $row["pageNumber"],
            "printColor" => $row["printColor"],
            "printSide" => $row["printSide"],
            "printDirection" => $row["printDirection"],
            "paperSize" => $row["paperSize"],
            "printType" => $row["printType"],
            "printNumber" => $row["printNumber"],
            "printPs" => $row["printPs"],
        ];
        echo json_encode($response); 
    }
    else{
        echo "Error";
    }
    fclose($conn);
?>
