<?php
    header('content-Type: text/html; charset=utf-8');
    session_start();
    $studentName = $_SESSION['StudentName'];
    $rateStoreName = $_POST['rateStoreName'];
    $rateScore = $_POST['rateScore'];
    require_once 'config.php';
    
    $conn = mysql_connect($db_host, $db_user, $db_pass);
    if (!$conn) {
        die("無法連結資料庫!");
    }

    mysql_select_db("bookmyprinter", $conn);
    mysql_query("set names utf8");

    if($rateScore) { //有人按了評分
        
        $result = mysql_query("SELECT * FROM ratestorelist WHERE StoreName = '$rateStoreName' " , $conn);
        $row = mysql_fetch_assoc($result);
        $RateCount = $row["RateCount"] + 1;
        $TotalScore = $row["TotalScore"] + $rateScore;
        $AvgScore = $TotalScore / $RateCount;
        $sqlstr = "UPDATE `ratestorelist` SET `RateCount` = '$RateCount', `TotalScore` = '$TotalScore', `AvgScore` = '$AvgScore' WHERE StoreName = '$rateStoreName'";
        if(mysql_query($sqlstr, $conn)){ //insert成功
            $file = file_get_contents("rateFile.txt");
            $content = $studentName . "  同學給了  " . $rateStoreName . "  " .  $rateScore . " 顆星！<br>" . $file;
            file_put_contents("rateFile.txt", $content);

            echo file_get_contents("rateFile.txt");;
        }
        else {
            echo "Error: " . mysql_error();
        }
        fclose($conn);
    }
    else { //定時call
        //$txt = '';
        //file_put_contents("rateFile.txt", $txt);
        echo file_get_contents("rateFile.txt");
    }

?>