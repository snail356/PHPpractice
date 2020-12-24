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
        "SELECT * FROM snail_class ORDER BY sid DESC LIMIT %s, %s",
        ($page - 1) * $perPage,
        $perPage
    );
    echo '<-- ';
    echo $p_sql ;
    echo ' -->';

    $stmt = $pdo->query($p_sql);
    // $stmt = $pdo->query("SELECT * FROM snail_class ORDER BY sid DESC");

    $rows = $stmt->fetchAll();



    // print_r($rows);
    // echo json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    ?>



  <?php require __DIR__ . '/parts/html-head.php'; ?>
  <?php require __DIR__ . '/parts/navbar.php'; ?>
  <style>
      .remove-icon a i {
          color: red;
      }
      
  </style>

  <div class="container">
      <div class="row">
          <!-- 列表 -->
          <div class="col">
              <nav aria-label="Page navigation example">
                  <ul class="pagination">
                      <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>"><a class="page-link" href="?page=1 ">
                              <i class="fas fa-caret-square-left"></i></a>
                      </li>
                      <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page - 1 ?> ">
                              <i class="fas fa-caret-left"></i></a>
                      </li>

                      <!-- 計算頁數的迴圈 -->
                      <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                            if ($i >= 1 and $i <= $totalPages) :
                        ?>


                              <!-- ?是在同一頁面有不同的值 -->
                              <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                  <a class="page-link" href="?page=<?= $i ?>">
                                      <?= $i ?></a>
                              </li>
                      <?php endif;
                        endfor ?>


                      <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $page + 1 ?> ">
                              <i class="fas fa-caret-right"></i></a>
                      </li>
                      <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= $totalPages ?> ">
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
                      <th scope="col"><i class="fas fa-trash-alt"></i></th>
                      <th scope="col">sid</th>
                      <th scope="col">課程分類</th>
                      <th scope="col">課程名稱</th>
                      <th scope="col">上課日期</th>
                      <th scope="col">數量</th>
                      <th scope="col"><i class="fas fa-pen-square"></i></th>
                  </tr>
              </thead>
              <tbody>

                  <?php foreach ($rows as $r) : ?>
                      <tr>
                          <!--刪除1 啥都不做 javascript:   按下後執行removeitemfunction(實際參數) -->
                          <!-- <td class="remove-icon"><a href="javascript:" onclick="removeItem(event)"> -->

                          <!-- 刪除2 -->
                          <!-- <td class="remove-icon"><a href="ab-delete.php?sid=<?= $r['sid']  ?>" onclick="del_it(event,<?= $r['sid']  ?>)"> -->

                          <td class="remove-icon">
                              <a href="javascript:del_it(<?= $r['sid']  ?>)">
                                  <i class="fas fa-trash-alt"></i>
                              </a>
                          </td>
                          <td><?= $r['sid'] ?></td>
                          <td><?= htmlentities($r['category']) ?></td>
                          <td><?= strip_tags($r['classname']) ?></td>
                          <td><?= $r['date'] ?></td>
                          <td><?= $r['amount'] ?></td>
                          <td class="">
                              <a href="ab-edit.php?sid=<?= $r['sid'] ?>">
                                  <i class="fas fa-pen-square"></i>
                              </a>
                          </td>
                      </tr>

                  <?php endforeach ?>


              </tbody>
          </table>
      </div>
  </div>


  <?php require __DIR__ . '/parts/scripts.php'; ?>
  <script>
      //   刪除1
      //   function removeItem(event) {
      //       // console.log(event.target);
      //       // console.log(event.currentTarget);
      //       const t = event.target;
      //     //   上一層是tr remove()是將他從DOM移除
      //       t.closest('tr').remove();
      //   }
      // 刪除2
      //   function del_it(event, sid) {
      //       if (!confirm(`是否要刪除編號為 ${sid} 的資料?`)) {
      //           event.preventDefault();
      //       }
      //   }

      function del_it(sid) {
          if (confirm(`是否要刪除編號為 ${sid} 的資料?`)) {
              location.href = 'ab-delete.php?sid=' + sid;
          }
      }
  </script>
  <?php require __DIR__ . '/parts/html-foot.php'; ?>