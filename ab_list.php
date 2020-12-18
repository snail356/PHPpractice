<?php
require __DIR__ . '/db_connect.php';
$pageName = 'ab-list';

$stmt = $pdo->query("SELECT * FROM snail_class ORDER BY sid DESC");

$row = $stmt->fetchAll();

// print_r($row);
// echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>



<?php require __DIR__ . '/parts/html-head.php'; ?>
<?php require __DIR__ . '/parts/navbar.php'; ?>


<div class="container">
    <div class="row">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">sid</th>
                    <th scope="col">課程分類</th>
                    <th scope="col">課程名稱</th>
                    <th scope="col">上課日期</th>
                    <th scope="col">數量</th>
                </tr>
            </thead>
            <tbody>
             
                <?php foreach ($row as $r ) : ?>
                <tr>
                    <td><?= $r['sid'] ?></td>
                    <td><?= $r['category'] ?></td>
                    <td><?= $r['classname'] ?></td>
                    <td><?= $r['date'] ?></td>
                    <td><?= $r['amount'] ?></td>
                </tr>
          
                <?php endforeach ?>
                
               
            </tbody>
        </table>
    </div>
</div>


<?php require __DIR__ . '/parts/scripts.php'; ?>
<?php require __DIR__ . '/parts/html-foot.php'; ?>