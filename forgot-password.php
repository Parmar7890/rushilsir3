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
    
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Please Enter Your valid Email</p>

        <form action="" method="post" id="forgot_form">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Email" name="email" id="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div id="emailErr" style="color:red;"></div>
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
            <div id="bootstrap-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
    <div class="toast-body">
        <!-- Toast message will be inserted here -->
    </div>
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

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<script>
     
    $(document).ready(function(){
      var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
     
        $("#forgot_form").submit(function(e){
         
           var isValid = true;
       
        var email = $("#email").val();
       // alert(email);
       
          
            $("#emailErr").text("");
           
            if(email == ""){
                $("emailErr").text("email name is required");
                isValid = false;
            }
            else if (!emailRegex.test(email)) {
      $("#emailErr").text("invaild email!!");
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


    $response = [];
$email = $_POST['email'];
    $verify_email = $pdo->prepare("SELECT * FROM register WHERE email =:email");
    $verify_email->bindParam(':email',$email);
    $verify_email->execute();
$response = [];

    if($verify_email->rowCount() > 0) {

        $otp = rand(100000,999999);
        $postData = array(
            'email' => $email,
            'otp' => $otp
        );
        $mail_status = $obj->sendOtp($postData);
       if($mail_status == 1){
        
        $result= $obj->otp_insert($postData);


       echo " <script type='text/javascript'>
       // Display a success toast
       Toastify({
         text: 'otp sent successfully!',
         backgroundColor: 'green',
       }).showToast();
       setTimeout(function() {
        window.location.href = './resetPassword.php';
      }, 3000); 
     </script>";

    // header("Location : ./resetPassword.php");

       }
       else{


        echo " <script type='text/javascript'>
        // Display a success toast
        Toastify({
          text: 'mail not send',
          backgroundColor: 'green',
        }).showToast();
      </script>";
       }
      
    }
    else{
      echo " <script type='text/javascript'>
      // Display a success toast
      Toastify({
        text: 'Invalid Email...',
        backgroundColor: 'green',
      }).showToast();
    </script>";
    }



}



?>