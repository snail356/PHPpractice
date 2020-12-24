<?php
require __DIR__ . '/db_connect.php';
$pageName = 'ab-insert';
// require __DIR__ . '/is_admin.php';


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

            <!-- 新增表單 -->
            <div class="col">

                <!-- <div class="alert alert-danger" role="alert" id="info" style="display: none;">
                    錯誤
                </div> -->
                <img src="" alt="" id="preview" onclick="file_field.click()" style="width: 300px; height: 300px; background-color: #ccc;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <form name="form1" novalidate onsubmit="checkForm();return false;">
                            <input type="file" id="avatar" name="avatar" accept="image/*" onchange="fileChange()" style="display: none">
                            <div class="form-group">
                                <label for="account">account</label>
                                <input type="text" class="form-control" value="<?= $_SESSION['admin']['account']?>" id="account" name="account">
                                <!-- <small class="form-text error-msg" style="display: none">請選擇課程分類</small> -->
                            </div>
                            <div class="form-group">
                                <label for="nickname">nickname</label>
                                <input type="text" class="form-control" value="<?= $_SESSION['admin']['nickname']?>" id="nickname" name="nickname">
                            </div>  
                            <div class="form-group">
                                <label for="password">**原密碼</label>
                                <input type="password" class="form-control" id="password" name="password" require>
                            </div>
                            <div class="form-group">
                                <label for="new_password">新密碼(留白表示不變更)</label>
                                <input type="text" class="form-control" id="new_password" name="new_password">
                            </div>

                            <button type="submit" class="btn btn-primary col">確認</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




<?php include __DIR__ . '/parts/scripts.php'; ?>

<script>
    const file_field = document.querySelector('#file_field');
    const preview = document.querySelector('#preview');
    const reader = new FileReader();

    reader.addEventListener('load', function(event) {
        preview.src = reader.result;
        preview.style.height = 'auto';
    });

    function fileChange() {
        reader.readAsDataURL(file_field.files[0]);

        console.log(file_field.files.length);
        console.log(file_field.files[0]);
    }






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