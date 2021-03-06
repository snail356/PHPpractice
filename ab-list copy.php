  <?php
    require __DIR__ . '/db_connect.php';
    // require __DIR__ . '/is_admin.php';


    // 沒有登入顯示頁面設定
    if (!isset($_SESSION['admin'])) {
        include __DIR__ . '/ab-list-noadmin.php';
        exit;
    }
    // 沒有登入顯示頁面設定












    $pageName = 'ab-list';
    // 由使用者給數值 如果有的話轉為整數，沒的話給1
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;



    // 搜尋                                         如果沒有就給空字串
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // 如果有search就丟入
    $params = [];



    // 定義where變數，用SQL語法給1當作這個子句的開頭
    $where = 'WHERE 1';
    if (!empty($search)) {
        $where .= sprintf(" AND `classname` LIKE %s", $pdo->quote('%' . $search . '%'));
        $params['search'] = $search;
    }








    $perPage = 2;
    $t_sql = "SELECT COUNT(1) FROM snail_class $where";
    //  拿到stmt 物件，拿索引是陣列NUM，只有一筆所以拿索引0
    // $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
    $totalRows = $pdo->query($t_sql)->fetch()['COUNT(1)'];
    // 總共頁數
    $totalPages = ceil($totalRows / $perPage);


    // 限定page的範圍
    // if ($page < 1) $page = 1; 放到下面避免
    if ($page > $totalPages) $page = $totalPages;
    if ($page < 1) $page = 1;

    // SELECT * FROM `snail_class` LIMIT 4,3  LIMIT(索引值,筆數)
    $p_sql = sprintf(
        "SELECT * FROM snail_class %s
        ORDER BY sid DESC LIMIT %s, %s",
        $where,
        ($page - 1) * $perPage,
        $perPage
    );

    $stmt = $pdo->query($p_sql);
    // $stmt = $pdo->query("SELECT * FROM snail_class ORDER BY sid DESC");

    $rows = $stmt->fetchAll();



    // print_r($rows);
    // echo json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    ?>



  <?php require __DIR__ . '/parts/html-head.php'; ?>
  <?php require __DIR__ . '/parts/navbar.php'; ?>
  <style>
      .card-head {
          margin-left: 10px;
          /* height: 100%;
          width: 100%; */
          /* background-color: black; */
          background-image: url(img/89fc747bf7c7cd1c076808059930a1e570de519b.jpg);
      }

      .card {
          margin-top: 15px;
          margin-bottom: -8px;
      }

      .card-body {
          padding: 15px;

      }

      .remove-icon a i {
          color: gray;
      }

      .card-title {
          font-size: 15px;
          font-weight: 900;
          color: #819ca5;
          font-variant: small-caps;
      }

      .card-text {
          font-size: 10px;
          color: gray;
          font-variant: small-caps;
          line-height: 12px;
          ;
      }

      small {
          font-size: 30x;
          background-color: black;
      }

      /* .btn{
          border-radius: 0%;
          height: 20px;
          font-size: 5px;
      } */
      .btn {
          background-color: #fff;
          border-color: #c47b00;
          border-radius: 0%;
          height: 20px;
          font-size: 5px;
          line-height: 50%;

      }

      .btn:hover {
          background-color: #c47b00;
          border-color: #c47b00;
      }

      .btn a {
          font-size: 5px;
          color: #c47b00;
      }

      .btn a:hover {
          text-decoration: none;
          color: white;
      }

      .text-muted {
          font-size: 5px;
          margin-bottom: 1px;
      }

      nav.pageline {
          border: none;
          background-color: #fff;
      }

      /* page列變色 */
      .page-item>a {
          color: grey;
      }

      /* #e2e678 */
      .page-item.active .page-link {
          background-color: #819ca5;
      }
  </style>

  <div class="container">
      <div class="col">
          <div class=" d-flex flex-row-reverse my-2">
              <form class="form-inline my-2 my-lg-0">
                  <!-- 記得要加name 搜尋用G -->
                  <input class="form-control mr-sm-2" type="search" name="search" value="<?= htmlentities($search) ?>" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
          </div>
      </div>

      <div class="row">

          <?php foreach ($rows as $r) : ?>
              <!-- 課程卡片 -->
              <div class="container d-flex justify-content-center">
                  <div class="card mb-3 d-flex align-items-center" style="width: 50%;height:200px ">
                      <div class="row no-gutters">
                          <div class="col-4 d-flex align-items-center" style="height: 100%;">
                              <div class="card-head">
                                  <!-- <img src="img\89fc747bf7c7cd1c076808059930a1e570de519b.jpg" class="card-img" alt="..."> -->
                              </div>
                          </div>
                          <div class="col-8 ">
                              <div class="card-body ">
                                  <!-- 刪除ICON -->
                                  <div class="remove-icon d-flex justify-content-end">
                                      <a href="javascript:del_it(<?= $r['sid']  ?>)">
                                          <i class="fas fa-times"></i>
                                      </a></div>
                                  <h5 class="card-title">[ <?= htmlentities($r['category']) ?> ] <?= strip_tags($r['classname']) ?></h5>
                                  <!-- 內容DIV -->
                                  <div class="card-t ml-2">
                                      <p class="card-text">課程日期：<?= $r['date'] ?></p>
                                      <p class="card-text">數量：<?= $r['amount'] ?></p>
                                      <p class="text-muted font-weight-light ">利用創作力創作出的陶土器皿因為其溫潤的特質而顯得獨一無二。
                                      </p>
                                  </div>

                                  <div class="button d-flex justify-content-end "><button type="submit" class="btn btn-primary btn-outline-success"><a href="ab-edit.php?sid=<?= $r['sid'] ?>">編輯課程</a></button></div>

                              </div>

                          </div>
                      </div>
                  </div>
              </div>


          <?php endforeach ?>

      </div>

      <!--  頁數 -->
      <div class="container d-flex justify-content-center">
          <div class="row">
              <div class="col">
                  <nav class="pageline" aria-label="Page navigation example">
                      <ul class="pagination">
                          <!-- <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>"><a class="page-link" href="?page=1 "> -->
                          <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                              <a class="page-link" href="?
                              <?php $params['page'] = 1;
                                echo http_build_query($params); ?>">
                                  <!-- 把page放入params陣列後，呼叫變為query格式的字串 -->
                                  <i class="fas fa-angle-double-left"></i></a>
                          </li>
                          <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>"><a class="page-link" href="?
                          <?php $params['page'] = $page - 1;
                            echo http_build_query($params); ?> ">
                                  <i class="fas fa-angle-left"></i></a>
                          </li>

                          <!-- 計算頁數的迴圈 -->
                          <?php for ($i = $page - 2; $i <= $page + 2; $i++) :
                                if ($i >= 1 and $i <= $totalPages) :
                            ?>


                                  <!-- ?是在同一頁面有不同的值 -->
                                  <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                      <a class="page-link" href="?<?php $params['page'] = $i;
                                echo http_build_query($params); ?>">
                                          <?= $i ?></a>
                                  </li>
                          <?php endif;
                            endfor ?>


                          <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>"><a class="page-link" href="?<?php $params['page'] = $page + 1;
                                echo http_build_query($params); ?>">
                                  <i class="fas fa-angle-right"></i></a>
                          </li>
                          <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>"><a class="page-link" href="?<?php $params['page'] = $totalPages;
                                echo http_build_query($params); ?>">
                                  <i class="fas fa-angle-double-right"></i></i></a>
                          </li>
                      </ul>
                  </nav>
              </div>
          </div>
      </div>
  </div>
<!-- <?php print_r($params); ?> -->

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