<?php
require __DIR__ . '/db_connect.php';

$stmt = $pdo->query("SELECT * FROM snail_class");

$row = $stmt->fetchAll();

print_r($row);

echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
