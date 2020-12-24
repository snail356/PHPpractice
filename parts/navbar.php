<?php
if (!isset($pageName)) $pageName = '';

?>


<style>
  nav {
    background-color: #819ca5;
  }

  a {
    color: #546e76;
  }

  a:hover {
    color: pink;
  }

  /* .active a{
        color: #fff;
    } */
  .navbar .nav-item.active a {
    color: white;
    border-radius: 10px;

  }
</style>


<nav class="navbar navbar-expand-lg  ">
  <a class="navbar-brand" href="<?php WEB_ROOT ?>index01.php">Index</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- 連結列表 -->
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item  <?= $pageName == 'ab-list copy' ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php WEB_ROOT ?>ab-list copy.php">課程列表 </a>
      </li>
      <li class="nav-item  <?= $pageName == 'ab-insert' ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php WEB_ROOT ?>ab-insert.php">新增課程 </a>
      </li>
    </ul>
    <!-- 登入登出 -->
    <ul class="navbar-nav">
      <?php if(isset($_SESSION['admin'])) : ?>
        <li class="nav-item ">
          <a class="nav-link" ><?= $_SESSION['admin']['account'] ?></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="<?php WEB_ROOT ?>logout.php">登出</a>
        </li>
      <?php else : ?>
        <li class="nav-item  <?= $pageName == 'login' ? 'active' : ''; ?>">
          <a class="nav-link" href="<?php WEB_ROOT ?>login.php">登入</a>
        </li>
      <?php endif ?>



    
  </div>
</nav>