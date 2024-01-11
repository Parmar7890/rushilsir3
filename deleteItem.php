<?php  

require('db.php');
require('User.php');


if(isset($_GET["id"])) {
    $userid = $_GET["id"];

    $obj = new items($pdo);

    $obj->deleteItem($userid);
    header("location:itemData.php");
}


?>