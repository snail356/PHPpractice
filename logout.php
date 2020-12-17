<?php
session_start();
//  清除SESSION
unset( $_SESSION['admin']);
// 跳轉頁面
header('Location:login.php')

?>