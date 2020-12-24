<?php
require __DIR__ . '/db_connect.php';

$title = '登入';
$pageName = 'login';

if(isset($_POST['account']) and isset($_POST['password']) ){

    $sql = "SELECT * FROM snail_admins WHERE account=? AND password=SHA1(?) ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['account'],
        $_POST['password'],
    ]);

    $row = $stmt->fetch();
    if(empty($row)){
        $errorMsg = '帳號或密碼錯誤';
    } else {
        $_SESSION['admin'] = $row;
    }
}
    
    
    
    /*
    if($_POST['account']==='test' and $_POST['password']==='123'){
        // 可以登入
        $_SESSION['admin'] = 'test';
    } else {
        $errorMsg = '帳號或密碼錯誤';
    }
    */

?>
<?php include __DIR__. '/parts/html-head.php'; ?>
<?php include __DIR__. '/parts/navbar.php'; ?>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
            <?php if(isset($errorMsg)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $errorMsg ?>
            </div>
            <?php endif ?>
            <?php if(isset($_SESSION['admin'])): ?>
            <div>
                <h3>Hello <?= $_SESSION['admin']['account'] ?></h3>
                <p><a href="logout.php">登出</a></p>
            </div>
            
            <?php else: ?>
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title">登入</h5>

                    <form method="post">
                        <div class="form-group">
                            <label for="account">Account</label>
                            <input type="text" class="form-control" id="account" name="account"
                                    value="<?= htmlentities($_POST['account']  ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   value="<?= htmlentities($_POST['password'] ?? '')  ?>">
                        </div>
                        <!--
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" value="1"
                                   id="exampleCheck1" name="exampleCheck1"
                                   <?php // echo isset($_POST['exampleCheck1']) ? 'checked' : '' ?> >
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>


                </div>
            </div>
            <?php endif ?>
        </div>
    </div>



</div>
<?php include __DIR__. '/parts/scripts.php'; ?>
<?php include __DIR__. '/parts/html-foot.php'; ?>
