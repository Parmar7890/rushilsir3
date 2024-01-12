<?php
session_start();
?>

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

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="./index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="" method="post" id="loginForm">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Email" name="email" id="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div id="emailErr" style="color:red;"></div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div id="passwordErr" style="color:red;"></div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>



        <p class="mb-1">
          <a href="forgot-password.php">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="./register.php" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
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
  <!-- AdminLTE App -->
  

  <script>
   $(document).ready(function(){
    var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    $("#loginForm").submit(function(e){
     // e.preventDefault();
      var email = $("#email").val();
      var password = $("#password").val();
      var isValid = true;

     $("#emailErr").text("");
     $("#passworderr").text("");

     if(email == ""){
      $("#emailErr").text("email is reuired!");
      isValid = false;
     }
     else if (!emailRegex.test(email)) {
      $("#emailErr").text("invaild email!!");
      isValid = false;
     }

     if(password == ""){
      $("#passwordErr").text("password is required!");
      isValid = false;
     }
     return isValid;
    })
   })
  </script>
</body>

</html>
<?php
//session_start();

require_once 'db.php';

require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
  
  $response = [];
    $email = $_POST['email'];
    $password = $_POST["password"];
    
      $_SESSION['email'] = $_POST['email'];
    if(empty($email)){
      echo "EMAIL IS REQURED";
    }
    $user = new User($pdo);
    $result=json_decode($user->login($email),true);
    $lastLodinQuery = $pdo->prepare('UPDATE register SET last_login = now() WHERE email = email');
            $lastLodinQuery->execute();
   // print_r($result);die;
   $message = $result["message"];
   if ($result['status'] == 200) {
       echo "<script type='text/javascript'>
           // Display a success toast
           Toastify({
               text: '$message',
               backgroundColor: 'green',
           }).showToast();
           setTimeout(function() {
               window.location.href = 'index.php';
              
           }, 2000);
       </script>";
   
   
      //echo "<script>alert('login')</script>";
    } else {
      //  echo $resonse["status"] =  "Login failed. Invalid username or password.";
       echo " <script type='text/javascript'>
       // Display a success toast
       Toastify({
         text: '$message',
         backgroundColor: 'green',
       }).showToast();
       
      
     </script>";
    }


   
}
 ?>
// $filecheck = basename($_FILES['imagefile']['name']);
// $ext = strtolower(substr($filecheck, strrpos($filecheck, '.') + 1));

// if (!(($ext == "jpg" || $ext == "gif" || $ext == "png") && ($_FILES["imagefile"]["type"] == "image/jpeg" || $_FILES["imagefile"]["type"] == "image/gif" || $_FILES["imagefile"]["type"] == "image/png") && 
//     ($_FILES["imagefile"]["size"] < 2120000))){
//     echo "F2";
//     die();
// }
// admin@gmail.com 