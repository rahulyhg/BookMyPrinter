
<?php
    header("Content-Type:text/html; charset=utf-8");
    $StudentID = $_POST['studentID'];
    $Verifycode = $_POST['verifycode'];
    require_once 'config.php';

    $conn = mysql_connect($db_host, $db_user, $db_pass);
    if (!$conn) {
        die("無法連結資料庫!");
    }
    mysql_select_db("bookmyprinter", $conn);
    mysql_query("set names utf8");
    $result = mysql_query("SELECT * FROM member WHERE StudentID = '$StudentID' " , $conn);
    $row = mysql_fetch_assoc($result);
    if($row["verifycode"] ==$Verifycode)
    {
        echo '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">';
        echo '<script type="text/javascript">alert("驗證成功!");';
        $sql_update = "UPDATE `member` Set `verifycode` = '0' WHERE StudentID = '$StudentID'";
        mysql_query($sql_update, $conn);
        session_start();
        $StudentName = $row["StudentName"];
        $_SESSION['StudentName'] = $StudentName;
        $_SESSION['StudentID'] = $StudentID;
        echo 'window.location.href=\'index_login.php\'';
        echo '</script>';   
    }
    else {
        echo '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">';
        echo '<script type="text/javascript">alert("驗證碼錯誤！");';
        echo 'history.back()';
        echo '</script>';
    }
    fclose($conn);
?>
