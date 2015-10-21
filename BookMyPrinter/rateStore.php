    <?php
    header('content-Type: text/html; charset=utf-8');
    session_start();
    $StudentName = $_SESSION['StudentName'];
    $rateStoreName = $_POST['rateStoreName'];
    $rateScore = $_POST['rateScore'];
    if($rateScore) { //有人按了評分
        /*require_once 'config.php';
    
        $conn = mysql_connect($db_host, $db_user, $db_pass);
        if (!$conn) {
        die("無法連結資料庫!");
        }

        mysql_select_db("bookmyprinter", $conn);
        mysql_query("set names utf8");
        $result = mysql_query("SELECT * FROM ratelist", $conn);
        $num_rows = mysql_num_rows($result) + 1;
        $sqlstr = "INSERT INTO `ratelist`(`ID`, `StudentName`, `StoreName`, `Score`) VALUES ('$num_rows', '$StudentName', '$rateStoreName', '$rateScore')";
    
        if(mysql_query($sqlstr, $conn)){ //insert成功*/
        $file = file_get_contents("rateFile.txt");
        $content = $StudentName . "  同學給了  " . $rateStoreName . "  " .  $rateScore . " 顆星！<br>" . $file;
        file_put_contents("rateFile.txt", $content);

        echo file_get_contents("rateFile.txt");
        /*}
        else {
        echo "Error: " . mysql_error();
        }
        fclose($conn);*/
    }
    else { //定時call
        //$txt = '';
        //file_put_contents("rateFile.txt", $txt);

        echo file_get_contents("rateFile.txt");
    }

?>