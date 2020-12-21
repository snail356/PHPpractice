<?php
if (!isset($_SESSION)) {
    session_start();
}
$pageName = 'ab-insert';


?>
<?php include __DIR__ . '/parts/html-head.php'; ?>

<style>
    .form-text {
        color: red;
    }
</style>

<?php include __DIR__ . '/parts/navbar.php'; ?>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
            <?php if (isset($errorMsg)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $errorMsg ?>
                </div>
            <?php endif ?>


            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增課程</h5>

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
                        <button type="submit" class="btn btn-primary">新增</button>
                    </form>


                </div>
            </div>

        </div>
    </div>



</div>
<?php include __DIR__ . '/parts/scripts.php'; ?>

<script>
    // document.querySelector('#category').style.bordercolor = 'red'
    const category = document.querySelector('#category');

    function checkForm() {
        // 設定此變數判斷是否通過檢查
        let isPass = true;


        if (category.value.length < 2) {
            isPass = false;
            category.style.borderColor = 'red';
            let small = category.closest('.form-group').querySelector('small');
            small.innerText = "請輸入正確的名字";
            small.style.display = 'block';
        }

        if (isPass) {
            // 建立一個formdata的物件 拿這個頁面的第一個表單
            const fd = new FormData(document.form1);

            fetch('ab-insert-api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.text())
                .then(obj => {
                    console.log(obj);
                });
                console.log(fd)

        }
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>