<?php
// require __DIR__. '/is_admin.php';
require __DIR__. '/db_connect.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '參數不足',
];

if(! isset($_POST['sid']) or !isset($_POST['category']) or ! isset($_POST['date'])){
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// TODO: 檢查欄位格式

// $email_re = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';
// if(! preg_match($email_re, $_POST['email'])){
//     $output['code'] = 400;
//     $output['error'] = 'Email 格式錯誤';

//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }



$sql = "UPDATE `snail_class` SET `category`=?,`classname`=?,`date`=?,`amount`=? WHERE `sid`=?";


$stmt = $pdo->prepare($sql);

$stmt->execute([
        $_POST['category'],
        $_POST['classname'],
        $_POST['date'],
        // empty($_POST['birthday']) ? NULL : $_POST['birthday'],
        $_POST['amount'],
        $_POST['sid'],
]);

$output['rowCount'] = $stmt->rowCount();
if($stmt->rowCount()){
    $output['success'] = true;
    unset($output['error']);
}else{
    $output['error'] = '資料沒有修改';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);







 