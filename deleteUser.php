<?php  
  
require_once 'db.php';

require_once 'User.php';

if(isset($_GET["id"])){
    $user_id = $_GET["id"];

    $user = new User($pdo);

    $user->deleteUser($user_id);
    header("location:index.php");

    
}

?>


