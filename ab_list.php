<?php
require __DIR__ . '/db_connect.php';
$pageName = 'ab-list';
// 由使用者給數值 如果有的話轉為整數，沒的話給1
$page = isset($_GET['page']) ? intval($_GET['page']):1;

$perPage = 5;
$t_sql = "SELECT COUNT(1) FROM snail_class";
                //  拿到stmt 物件，拿索引是陣列NUM，只有一筆所以拿索引0
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
// $totalRows = $pdo->query($t_sql)->fetch()['COUNT(1)'];
// 總共頁數
$totalPages = ceil($totalRows/$perPage);
// 限定page的範圍
if($page<1) $page=1;
if($page>$totalPages) $page = $totalPages;

// SELECT * FROM `snail_class` LIMIT 4,3  LIMIT(索引值,筆數)
$p_sql = sprintf("SELECT * FROM snail_class LIMIT %s, %s" ,
($page-1)*$perPage, $perPage);

$stmt = $pdo ->query($p_sql);
// $stmt = $pdo->query("SELECT * FROM snail_class ORDER BY sid DESC");

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
                    <!-- ?是在同一頁面有不同的值 -->
                    <li class="page-item <?= $page == $i ? 'active' : '' ?>" >
                    <a class="page-link" href="?page=<?= $i ?>">
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