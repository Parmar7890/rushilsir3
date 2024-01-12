<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"><link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body>
<form action="" method="post" id="loginForm" enctype="multipart/form-data">
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">ADD ITEMS</h3>

                <div class="card-tools">
                        <a href="itemData.php"><i class="fas fa-times"></i></a>

                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center"> <!-- Center the content -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Add Item</label>
                            <input type="text" class="form-control" id="itemName" name="itemName" placeholder="Enter item name">
                        </div>
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file[]" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="1">
                                <label class="form-check-label">In Stock</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="status" value="0" type="radio" checked>
                                <label class="form-check-label">Empty</label>
                            </div>
                        </div>
                        <div class="card-header d-flex justify-content-end">
                
              <button type="submit" name="submit" class="btn btn-primary">
                 Add item
                </button>
              </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


  <!-- /.login-box -->

  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>




<?php 
require_once 'db.php';

require_once 'User.php';


if(isset($_POST["submit"])) {
  
  
$item_name = $_POST["itemName"];
$status = $_POST["status"];
  
$obj = new items($pdo);

$postData = array(
  'item_name' => $item_name,
  'status' => $status,
  'multiple_file' => $_FILES
);
// echo "<pre>";
// print_r($postData);
$obj->addItem($postData);


 }


?>



