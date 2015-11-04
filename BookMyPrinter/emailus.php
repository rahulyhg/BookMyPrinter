<?php
    include_once("mailer.php"); 
    header("Content-Type:text/html; charset=utf-8");
    $userEmail = $_POST['userEmail'];
    $EmailContent = $_POST['EmailContent'];
    $EmailContent = '使用者:' . $userEmail . '  內容:' . $EmailContent;
    if(sendmail('bookmyprinterncku@gmail.com',$EmailContent)){
        echo '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">';
        echo '<script type="text/javascript">alert("感謝您寶貴的意見，我們將在1~3天後回覆您!");';
        echo 'history.back()';
        echo '</script>';
    }else {
        echo "Error: sendmail()";
    }
?>