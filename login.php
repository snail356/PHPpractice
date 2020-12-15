<?php
$title = '登入'


if(isset($_POST['account']) and $_POST['Password'])){
    if($_POST['account']==='test' and $_POST['Password']==='123'){
        //可以登入
    }else{
        $errorMsg = '帳號或密碼輸入錯誤'
    }
}
?>

<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/navbar.php' ?>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card-body">
                <h5 class="card-title">登入</h5>
                <!-- 表單刷新送出 -->
                <form method="post">
                    <div class="form-group">
                        <label for="account">account</label>
                                                         <!-- 一定要加name才有效可以送資料 -->
                        <input type="text" class="form-control" id="account" name="account"
                        value="<?= htmlentities($_POST['account'] ?? '' )?>">
                        
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" id="Password" name="Password" 
                        value="<?= htmlentities($_POST['account'] ?? '' )?>">
                    </div>
                    <div class="form-group form-check">
                    <!-- checkbox預設送出on也可自己設定value checked可以讓勾選停留不會送出就消失-->
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="exampleCheck1"
                        value="123" checked
                        echo isset($_POST['exampleCheck1']) ? 'checked' : '' >
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>


<?php include __DIR__ . '/parts/scripts.php' ?>
<?php include __DIR__ . '/parts/html-foot.php' ?>