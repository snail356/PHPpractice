<?php
require __DIR__ . '/db_connect.php';
$pageName = 'ab-list';


$perPage = 5;
$t_sql = "SELECT COUNT(1) FROM snail_class";
                //  拿到stmt 物件，拿索引是陣列NUM，只有一筆所以拿索引0
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
// $totalRows = $pdo->query($t_sql)->fetch()['COUNT(1)'];
// 總共頁數
$totalPages = ceil($totalRows/$perPage);


$stmt = $pdo->query("SELECT * FROM snail_class ORDER BY sid DESC");

$row = $stmt->fetchAll();



// print_r($row);
// echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>



<?php require __DIR__ . '/parts/html-head.php'; ?>
<?php require __DIR__ . '/parts/navbar.php'; ?>


<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">
                            <i class="fas fa-caret-square-left"></i></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">
                            <i class="fas fa-caret-left"></i></a>
                    </li>

                    <!-- 計算頁數的迴圈 -->
                    <?php for($i = 1 ; $i < $totalPages; $i++ ):?>
                    <li class="page-item"><a class="page-link" href="#">
                        <?= $i ?></a>
                    </li>
                     <?php endfor ?>


                    <li class="page-item"><a class="page-link" href="#">
                            <i class="fas fa-caret-right"></i></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">
                            <i class="fas fa-caret-square-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
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

                <?php foreach ($row as $r) : ?>
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