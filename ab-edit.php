<?php

$pageName = 'ab-insert';
require __DIR__ . '/db_connect.php';

if (!isset($_GET['sid'])) {
    header('Location:ab-list.php');
    exit;
}

$sid = intval($_GET['sid']);

// $stmt= $pdo->query("SELECT * FROM snail_class WHERE sid=$sid ");
// 拿到資料row
$row = $pdo
    ->query("SELECT * FROM snail_class WHERE sid=$sid ")
    ->fetch();
// 若啥都沒拿到就轉向
if (empty($row)) {
    header('Location:ab-list.php');
    exit;
}




?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>
<style>
    .form-text {
        color: red;
    }

    .edit-title {
        border-bottom: 1px solid black;
        margin: 15px 0;

    }

    .btn {
        background-color: #fff;
        border-color: #c47b00;
        border-radius: 0%;
        color: #c47b00;
        /* height: 20px; */
        /* font-size: 5px; */
        line-height: 50%;

    }

    .btn:hover {
        background-color: #c47b00;
        border-color: #c47b00;
    }



    .btn a:hover {
        text-decoration: none;
        color: white;
    }

    label {
        color: #c47b00;
    }

    .form-control {
        border: 1px dashed pink;
        border-top: none;
        border-left: none;
        border-right: none;
        border-radius: 0%;
    }

    h5 {
        color: #c47b00;
    }
</style>
<div class="alert alert-danger" role="alert" id="info" style="display: none;">
    錯誤
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="edit-title d-flex justify-content-center" style="border-bottom:1px solid #fcaa3e">
                <h5 class="card-title">編輯課程</h5>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-6 ">
            <!-- <div class="alert alert-danger" role="alert" id="info" style="display: block;">
                錯誤
            </div> -->
            <div class="card">
                <div class="card-body">
                    <form name="form1" novalidate onsubmit="checkForm();return false;">
                        <!-- <form name="form1" method="post"> -->
                        <input type="hidden" name="sid" value="<?= $sid ?>">
                        <div class="form-group">
                            <label for="category">課程分類</label>
                            <input type="text" class="form-control" id="category" name="category" value=" <?= htmlentities($row['category']) ?>">
                            <small class="form-text error-msg" style="display: none">請選擇課程分類</small>
                        </div>
                        <div class="form-group">
                            <label for="classname">課程名稱</label>
                            <input type="text" class="form-control" id="classname" name="classname" value=" <?= htmlentities($row['classname']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="date">上課日期</label>
                            <input type="datetime-local" class="form-control" id="date" name="date">
                        </div>
                        <div class="form-group">
                            <label for="amount">數量</label>
                            <input type="number" class="form-control" id="amount" name="amount">
                        </div>
                        <div class="button d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary ">修改</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- 編輯課程 -->




</div>
<?php include __DIR__ . '/parts/scripts.php'; ?>

<script>
    const info = document.querySelector('#info');
    // document.querySelector('#category').style.bordercolor = 'red'
    const category = document.querySelector('#category');

    function checkForm() {
        info.style.display = 'none';
        // 設定此變數判斷是否通過檢查
        let isPass = true;


        if (category.value.length < 2) {
            isPass = false;
            category.style.borderColor = 'red';
            let small = category.closest('.form-group').querySelector('small');
            small.innerText = "請輸入正確的課程名稱";
            small.style.display = 'block';
        }

        if (isPass) {
            // 建立一個formdata的物件 拿這個頁面的第一個表單
            const fd = new FormData(document.form1);

            fetch('ab-edit-api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        //修改成功
                        info.classList.remove('alert-danger');
                        info.classList.add('alert-success');
                        info.innerHTML = '修改成功';
                    } else {
                        info.classList.remove('alert-success');
                        info.classList.add('alert-danger');
                        info.innerHTML = '修改失敗';

                    }
                    info.style.display = 'block';
                });



        }
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>