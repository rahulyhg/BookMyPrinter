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

    $result = mysql_query("SELECT * FROM ratestorelist ORDER BY `AvgScore` DESC LIMIT 5" , $conn);
    $rank = 1;
    while($row = mysql_fetch_assoc($result)) {
        $returnStr .= "<tr>";
        $returnStr .= "<td>" . $rank . "</td>";
        $returnStr .= "<td>" . $row["StoreName"] . "</td>";
        $returnStr .= "<td>" . $row["TotalScore"] . "</td>";
        $returnStr .= "<td>" . $row["AvgScore"] . "</td>";
        $returnStr .= "</tr>";
        $rank += 1;
    }
    
    echo $returnStr;
?>