<?php  
require('db.php');

require('User.php');

$obj = new items($pdo);

$result = $obj->showItem();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>item table</title>
    
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>
<body>
    <?php
    include('header.php');
     include('sidebar.php');
      ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <button type="button" class="btn btn-block btn-primary btn-sm">Add item</button> -->
              <div class="card-header d-flex justify-content-end">
              <a href="addItem.php" class="btn btn-primary">
                 Add items
                </a>
                <!-- <h3 class="card-title">DataTable with minimal features & hover style</h3> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
  
                  <tr>
                    <th>ITEM NAME</th>
                    <th>STATUS</th>
                    <th>PHOTO</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                  </tr>
      
                  </thead>
                  <tbody>
                  <?php 
if($result){
  foreach($result as $row){
// echo "<pre>";
// print_r($row);
// die;


?>
                  <tr>
                    <td><?php echo $row["item_name"]; ?></td>

                    <?php  
if($row["status"] == 1){
  echo '<td>in stock</td>';
  
}else{
  echo '<td>empty</td>';

}

?>
                    <td><?php echo $row["photo"]; ?></td>
                    <td><a href="editItem.php?id=<?php echo $row["id"]; ?>">edit<a></td>
                    <td><a href="deleteItem.php?id=<?php echo $row["id"]; ?>">delete<a></td>
                  </tr>
                  <?php  

}
}


?>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


      <?php include('footer.php'); ?>
</body>
</html>

