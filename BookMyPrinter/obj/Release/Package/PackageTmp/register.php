
<?php
    header("Content-Type:text/html; charset=utf-8");
    $Name = $_POST[name];
    $StudentID = $_POST[studentID];
    $pwd1 = $_POST[password1];
    $pwd2 = $_POST[password2];
    $Dept = $_POST[department];
    $Email = $_POST[email];
    $Phone = $_POST[phone];
    
    if(strcmp($pwd1, $pwd2)) {
        echo '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">';
        echo '<script type="text/javascript">alert("請再次確認密碼!");';
        echo 'history.back()';
        echo '</script>';
    }
    else {
        require_once 'config.php';

        $conn = mysql_connect($db_host, $db_user, $db_pass);
        if (!$conn) {
            die("無法連結資料庫!");
        }

        mysql_select_db("bookmyprinter", $conn);
        mysql_query("set names utf8");
        $result = mysql_query("SELECT * FROM member", $conn);
        $num_rows = mysql_num_rows($result) + 1;
        $query = mysql_query("SELECT StudentID FROM member WHERE StudentID='$StudentID'"  , $conn);
        if(mysql_num_rows($query) == 0) {
            $sqlstr = "INSERT INTO `member`(`ID`, `StudentName`, `StudentID`, `Password`, `Department`, `Email`, `Phone`) VALUES ('$num_rows', '$Name', '$StudentID', '$pwd1', '$Dept', '$Email', '$Phone')";
            if(mysql_query($sqlstr, $conn)) {
                echo '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">';
                echo '<script type="text/javascript">alert("成功加入會員!");';
                echo 'history.back()';
                echo '</script>';
            } else {
                echo "Error: " . $sqlstr;
            }
        }
        else {
            echo '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">';
            echo '<script type="text/javascript">alert("此學號已申請過會員!");';
            echo 'history.back()';
            echo '</script>';
        }
        
    }
    fclose($conn);
?>
