<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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

        <form action="" method="post" id="otp_form">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="otp" name="otp" id="otp">
            <div class="input-group-append">
              <div class="input-group-text">
                <!-- <span class="fas fa-envelope"></span> -->
              </div>
            </div>
          </div>
          <div id="otpErr" style="color:red;"></div>
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



     
       
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
    


  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- daterangepicker -->
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>


<script>
   $(document).ready(function(){
var otpCheck =  /^[0-9]+$/;

     $("#otp_form").submit(function(e){
      var isValid = true;
     
      var otp = $("#otp").val();
     $("#otpErr").text("");

     if(otp == ""){
      $("#otpErr").text("otp is reuired!");
      isValid = false;
     }   else if (!otpCheck.test(otp)) {
      $("#otpErr").text("invaild otp!!");
      isValid = false;
     }
    
     return isValid;
    })
   })
  </script>
</body>
</html>

<?php  
session_start();
require_once 'db.php';

require_once 'User.php';


$obj = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_otp = $_POST["otp"];
    $email=$_SESSION["email"];
    $db_otp=$obj->getOtp($email);

    if($user_otp == $db_otp){
        $check_status=$obj->deactivateOtp($email);
        if($check_status == 1){
          echo " <script type='text/javascript'>
          // Display a success toast
          Toastify({
            text: 'otp is valid..',
            backgroundColor: 'green',
          }).showToast();
          setTimeout(function() {
           window.location.href = './cofirmPassword.php';
         }, 3000); 
        </script>";
           // header("Location: ./cofirmPassword.php");
        }
        else{
          echo " <script type='text/javascript'>
          // Display a success toast
          Toastify({
            text: 'otp is deactivated..',
            backgroundColor: 'green',
          }).showToast();
          setTimeout(function() {
           window.location.href = './resetPassword.php';
         }, 3000); 
        </script>";
        }
        
        
    }
    else{
      echo " <script type='text/javascript'>
      // Display a success toast
      Toastify({
        text: 'Invalid Otp',
        backgroundColor: 'green',
      }).showToast();
      setTimeout(function() {
       window.location.href = './resetPassword.php';
     }, 3000); 
    </script>";
    }

    

}



?>
