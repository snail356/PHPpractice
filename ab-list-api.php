<?php
require __DIR__ . '/db_connect.php';
$pageName = 'ab-list';
// 由使用者給數值 如果有的話轉為整數，沒的話給1
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$perPage = 5;
$t_sql = "SELECT COUNT(1) FROM snail_class";
//  拿到stmt 物件，拿索引是陣列NUM，只有一筆所以拿索引0
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
// $totalRows = $pdo->query($t_sql)->fetch()['COUNT(1)'];
// 總共頁數
$totalPages = ceil($totalRows / $perPage);


// 限定page的範圍
if ($page < 1) $page = 1;
if ($page > $totalPages) $page = $totalPages;

// SELECT * FROM `snail_class` LIMIT 4,3  LIMIT(索引值,筆數)
$p_sql = sprintf(
    "SELECT * FROM snail_class LIMIT %s, %s",
    ($page - 1) * $perPage,
    $perPage
);

$stmt = $pdo->query($p_sql);
// $stmt = $pdo->query("SELECT * FROM snail_class ORDER BY sid DESC");

$rows = $stmt->fetchAll();


$output = [
    'page' => $page,
    'perPage' => $perPage,
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
    'rows' => $rows,
];
echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);