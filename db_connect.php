<?php 
$db_host = 'localhost';
$db_name = 'snail_project';
$db_user = 'snail';
$db_pass = '3345678';

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8";
$pdo_options = [
    PDO::ATTR_ERRMODE =>  //屬性錯誤模式
    PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,//拿出資料是關聯是陣列
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);

// 不能呼叫兩次，所以要先判斷
if (!isset($_SESSION)) {
    session_start();
}