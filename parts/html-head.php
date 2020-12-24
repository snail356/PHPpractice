<?php
define('WEB_ROOT','/PHPpractice/')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title.'-' : '(登入中)' ?>課程管理</title>
    <link rel="stylesheet" href="<?= WEB_ROOT ?>bootstrap\css\bootstrap.css">
    <link rel="stylesheet" href="<?= WEB_ROOT ?>fontawesome\css\all.css">
</head>