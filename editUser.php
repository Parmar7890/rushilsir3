
<?php 
if(!isset($_GET["id"])){
  header("location:index.php"); 
}
require_once 'db.php';

require_once 'User.php';

$obj = new User($pdo);

$response = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_REQUEST["id"];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];


    $postData = array(
        'userid' =>$user_id,
        'fname' =>$fname,
        'lname' =>$lname,
        'username' =>$username,
        'email' =>$email,
        'phone' =>$phone,
        'role' =>$role
    );
$response = [];
    if($postData == null){
        $response["status"] = 404;
header("location:index.php");

    }else{
        $user = new User($pdo);
        $user->sendid($postData);
    }


}

try{

   $user_id = $_REQUEST["id"];

   $sql = "SELECT * FROM register WHERE id=:user_id";
   $statement = $pdo->prepare($sql);
   $statement->bindParam(':user_id', $user_id);
   $statement->execute();
   $statement->setFetchMode(PDO::FETCH_ASSOC);
   
   $result = $statement->fetch(); 
   

}catch(PDOException $e){
    $response["status"] = 404;
    $response["message"] = "cant show data!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editUser</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body>
<!-- <div class="container-fluid"> -->
    <?php  
if($result){

?>
    <form action="" method="post" id="emailForm">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User edit table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <!-- <th>Progress</th> -->
                      <!-- <th style="width: 40px">Label</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td><div class="form-group">
                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $result["first_name"]; ?>" placeholder="Enter first name">
                  </div></td>
                     
              
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td><div class="form-group">
                    <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $result["last_name"]; ?>" placeholder="Enter last name">
                  </div></td>
                    
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td><div class="form-group">
                    <input type="text" class="form-control" id="username" value="<?php echo $result["username"]; ?>"name="username" placeholder="Enter username">
                  </div>
                  <span style="color:red" id="usernameErr"></span>
                </td>
                     
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td><div class="form-group">
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $result["email"]; ?>" placeholder="Enter email">
                  </div>
                <span style="color:red" id="emailErr"></span>
                </td>
                    
                      
                    </tr>
                    </tr>
                    <tr>
                      <td>5.</td>
                      <td><div class="form-group">
                    <input type="phone" class="form-control" id="phone" name="phone" value="<?php echo $result["phone"]; ?>"placeholder="Enter phone">
                  </div>
                <span style="color:red" id="phoneErr"><span>
                </td>
                     
                
                    </tr>
                    <tr>
                      <td>6.</td>
                      <td><div class="form-group">
                    <input type="text" class="form-control" id="role" name="role" value="<?php echo $result["role"]; ?>"placeholder="Enter role">
                  </div></td>
                     
                  
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
            </div>
            <div class="card-header d-flex justify-content-end">
              <button type="submit" id="formValiation" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                 Add Category
                </button>
              </div>
              </form>
              <?php } ?>
            </div>





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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



  <script>
  $(document).ready(function() {
    $("#emailForm").submit(function(event) {
      var email = $("#email").val();
      var username = $("#username").val();

      var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
      var usernameRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;

      if (!emailRegex.test(email)) {
        $("#emailErr").text("Invalid email");
        event.preventDefault();
      }


     
      if (!usernameRegex.test(username)) {
        $("#usernameErr").text("username is invalide");
        event.preventDefault();
      }

     
    });
  });
</script>

</body>
</html>
