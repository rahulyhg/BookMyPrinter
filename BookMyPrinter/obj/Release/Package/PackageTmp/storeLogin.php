
<?php
    header("Content-Type:text/html; charset=utf-8");
    $storeAccount = $_POST[storeAccount];
    $storePassword = $_POST[storePassword];
    require_once 'config.php';

    $conn = mysql_connect($db_host, $db_user, $db_pass);
    if (!$conn) {
        die("無法連結資料庫!");
    }
    mysql_select_db("bookmyprinter", $conn);
    mysql_query("set names utf8");
    $result = mysql_query("SELECT * FROM storelist WHERE StoreAccount = '$storeAccount' " , $conn);
    $row = mysql_fetch_assoc($result);
    if($row["StorePassword"] == $storePassword)
    {
        echo '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">';
        echo '<script type="text/javascript">alert("登入成功!");';
        session_start();
        $StoreName = $row["StoreName"];
        $_SESSION['StoreName'] = $StoreName;
        echo 'window.location.href=\'storeAdmin.php\'';
        echo '</script>';   
    }
    else {
        echo '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">';
        echo '<script type="text/javascript">alert("帳號或密碼錯誤！");';
        echo 'history.back()';
        echo '</script>';
    }
    fclose($conn);
?>
