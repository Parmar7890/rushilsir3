<?php
// session_start();
// require('db.php');
// require('User.php');

// $user = new user($pdo);

// if($user->logout()){
//     header("location:login.php");
// }else{
//   header("location:login.php");
// }


?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="daydreamsoft_logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">Day dream soft</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) --

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="index.php" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          

            <!-- <li class="nav-item">
              <a href="./itemData.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Item Data</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="./logout.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>logout</p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="./itemData.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>add items</p>
              </a>
            </li> 
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>