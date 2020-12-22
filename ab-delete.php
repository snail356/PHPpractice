<?php
require __DIR__. '/db_connect.php';

if(isset($_GET['sid'])){
    $sid = intval($_GET['sid']);

    $pdo->query("DELETE FROM `snail_class` WHERE sid=$sid");
}

// 刪除完返回列表頁
// header('Location:ab-list.php');

// 預設回列表
$backto = 'ab-list.php';
// 若有設Referer就去
if(isset($_SERVER['HTTP_REFERER'])){
    $backto = $_SERVER['HTTP_REFERER'];
}
header('Location:'.$backto);