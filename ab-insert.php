<?php

$pageName = 'ab-insert';


?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>
<style>
    .form-text {
        color: red;
    }

    .PIC {
        /* height: 100%;
        width: 500px; */
        background-color: black;
    }

    h5 {
        color: #c47b00;
    }

    .card {
        border: none;
    }

    .form-control {
        border: 1px dashed pink;
        border-top: none;
        border-left: none;
        border-right: none;
        border-radius: 0%;
    }

    .btn {
        background-color: #c47b00;
        border-color: #c47b00;
        border-radius: 0%;
    }

    label {
        color: #c47b00;
    }
</style>

<div class="alert alert-danger" role="alert" id="info" style="display: none;">
    錯誤
</div>
<div class="container d-flex justify-content-center">
    <div class="container2 ">
        <div class="row d-flex justify-content-center" style="border-bottom:1px solid #fcaa3e">
            <div class="title my-3">
                <h5>陶藝課程體驗</h5>
            </div>

        </div>
        <div class="row d-flex align-items-center">
            <!-- 圖片及介紹 -->
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="img/89fc747bf7c7cd1c076808059930a1e570de519b.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <!-- 新增表單 -->
            <div class="col">

                <!-- <div class="alert alert-danger" role="alert" id="info" style="display: none;">
                    錯誤
                </div> -->

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <form name="form1" novalidate onsubmit="checkForm();return false;">
                            <div class="form-group">
                                <label for="category">課程分類</label>
                                <input type="text" class="form-control" id="category" name="category">
                                <small class="form-text error-msg" style="display: none">請選擇課程分類</small>
                            </div>
                            <div class="form-group">
                                <label for="classname">課程名稱</label>
                                <input type="text" class="form-control" id="classname" name="classname">
                            </div>
                            <div class="form-group">
                                <label for="date">上課日期</label>
                                <input type="datetime-local" class="form-control" id="date" name="date">
                            </div>
                            <div class="form-group">
                                <label for="amount">數量</label>
                                <input type="number" class="form-control" id="amount" name="amount">
                            </div>
                            <button type="submit" class="btn btn-primary col">新增</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

            fetch('ab-insert-api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        //新增成功
                        info.classList.remove('alert-danger');
                        info.classList.add('alert-success');
                        info.innerHTML = '新增成功';
                    } else {
                        info.classList.remove('alert-success');
                        info.classList.add('alert-danger');
                        info.innerHTML = '新增失敗';
                    }
                    info.style.display = 'block';
                });



        }
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>