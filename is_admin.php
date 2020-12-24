<?php
// 有seesion的話就啟動
if(!isset($_SESSION)){
    session_start();
}
// 啟動後判斷有沒有登入，沒有的話就轉向
if(!isset($_SESSION['admin'])){
    header('Location:login.php');
    exit;
}
