
<?php  

try{
    require('db.php');

    require('order.php');
 

  $fetch_data = "SELECT * FROM tbl_order";
  $query_execute = $pdo->prepare($fetch_data);
  $query_execute->execute();
 $result = $query_execute->fetchAll(PDO::FETCH_ASSOC);
 $order_result = explode(',',$result[0]['orders']);
 
 }catch(PDOException $e){
     $response["status"] = 404;
     $response["message"] = "cant show data!";
 }

 $fetch_item = "SELECT 
 it.item_name,
 it.amount
 FROM tbl_order ot inner join items it on ot.id=it.id
 ";
 $query_execute2 = $pdo->prepare($fetch_item);
 $query_execute2->execute();
 $result_item = $query_execute2->fetchAll(PDO::FETCH_ASSOC);


//  echo "<pre>";
//   print_r($result_item);
//   die;
//  $item_price = explode(',',$result_item[0]['amount']);
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-ezFs1OGpRaD2ZZlCA6dxRlN3LC9F/cfUDRP18AAI5zPoJSKt7bG6S1zPGAd7s2BY4tJjlTLRDe+LlME5JkGYLg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
    // include('header.php');
    // include('sidebar.php');
      ?>
<div class="wrapper">


  <section class="content">
    <div class="card mx-auto"> 
      <div class="row">
        <div class="col-12 col-sm-12">
          <div class="form-group">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ORDER ID</th>
                      <th>CUSTOMER NAME</th>
                      <th>CUSTOMER TYPE</th>
                      <?php  
if($result_item){
  $item_name=array();
    foreach($result_item as $id=>$values){
      $item_name = explode(',',$values['item_name']); 
    }
    foreach($item_name as $id=>$values)
    {
      ?>
      <th><?php echo $values; ?></th>
      <?php
    }
}
        ?>
</tr>
             <td>
              <?php  

              if($result_item){
                $item_prices = array();
                foreach($result_item as $id=>$values){
                  $item_prices = explode(',',$values['amount']);
                }
                foreach($item_prices as $id=>$values){
                  ?>
                  <th><?php echo $values; ?></th>
                  <?php
                }
              }
?>
             </td>

                    </tr>
                  </thead>
                  <tbody class="proudctDiv">
                    <?php
                    if ($result) {
                      foreach ($result as $row) {
                       
                        ?>
                        <tr>
                          <td><?php echo $row["order_id"]; ?></td>
                          <td><?php echo $row["customer_name"]; ?></td>
                          <td><?php echo $row["customer_type"]; ?></td>
                            <!-- #region -->                         
                          <!-- <td></td> -->

                          
                        </tr>
                    <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
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
  
  <!-- /.content-wrapper -->
</div>


      <script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="./plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="./plugins/jszip/jszip.min.js"></script>
<script src="./plugins/pdfmake/pdfmake.min.js"></script>
<script src="./plugins/pdfmake/vfs_fonts.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dist/js/demo.js"></script>
<!-- Page specific script -->
</body>
</html>


<?php   


// $obj = new orders($pdo);

// $result = $obj->showOrders();



?>



