
<?php 

require('db.php');
require('User.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
 

  $pcNumber = $_SERVER["HTTP_USER_AGENT"];
  
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $phone = $_POST['phone'];
    $role = $_POST["role"];

    $postData = array(
      'firstname' =>$first_name,
      'last_name' =>$last_name,
      'username' =>$username,
      'email' =>$email,
      'password' =>$password,
      'phone' =>$phone,
      'role' => $role,
      'pcNumber' => $pcNumber
    );
  //echo "all filed are require!";
  
    if($postData == null){
      echo "<script>alert('All filed required')</script>";
    }
    $user = new User($pdo);
    $result = $user->register($postData);
    $result = json_decode($result, true);
    
     if($result['status'] == "200" ) {

      echo "<script>alert('success')</script>";
         header("location:login.php");
     }else{
         echo "<h1>".$result['message']."</h1>";
        
     }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <link rel="stylesheet" href="./plugins/toastr/toastr.min.css">
</head>
<body>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="./index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="" method="post" id="registerForm">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="first name" name="fname" id="fname">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div id="fnameErr" style="color:red;"></div>


          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="last name" name="lname" id="lname">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div id="lnameErr" style="color:red;"></div>


          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="username" name="username" id="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div id="usernameErr" style="color:red;"></div>


          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="email" name="email" id="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div id="emailErr" style="color:red;"></div>


          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="password" name="password" id="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div id="passwordErr" style="color:red;"></div>


          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="phone" name="phone" id="phone">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div id="phoneErr" style="color:red;"></div>

                <div class="form-group">
                  <!-- <label>Role</label> -->
                  <select class="form-control select2 select2-danger" name="role" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    
                    <option value="2">Employee</option>
                    <option value="3">Service Provider</option>
                  </select>
                </div>

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
            <button type="button" class="btn btn-default toastsDefaultDefault">
                  Launch Default Toast
                </button>
            <!-- /.col -->
          </div>
        </form>

          


        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="./register.php" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>


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




  <script src="./plugins/toastr/toastr.min.js"></script>
  <script>
     
    $(document).ready(function(){
        $("#registerForm").submit(function(e){
    //       $('.toastsDefaultDefault').click(function() {
    //   $(document).Toasts('create', {
    //     title: 'Toast Title',
    //     body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
    //   })
    // });
           var isValid = true;
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var username = $("#username").val();
        var email = $("#email").val();
       // alert(email);
        var password = $("#password").val();
        var phone = $("#phone").val();
 
            $("#fnameErr").text("");
            $("#lnameErr").text("");
            $("#usernameErr").text("");
            $("#emailErr").text("");
            $("#passwordErr").text("");
            $("#phoneErr").text("");

            if(fname == ""){
                $("#fnameErr").text("first name is required");
                isValid = false;
            }
            if(lname == ""){
                $("#lnameErr").text("last name is required");
                isValid = false;
            }
            if(username == ""){
                $("#usernameErr").text("username name is required");
                isValid = false;
            }
            if(email == ""){
                $("emailErr").text("email name is required");
                isValid = false;
            }
            if(password == ""){
                $("#passwordErr").text("password name is required");
                isValid = false;
            }
            if(phone == ""){
                $("#phoneErr").text("phone is required");
                isValid = false;
            }
            return isValid;

        })
    })
  </script>

</body>
</html>