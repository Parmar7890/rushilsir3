
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
// session_start();firstnameInvalid fileds
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM register WHERE email = :email");
        $stmt->bindParam(':email', $email);
        // $stmt->bindParam(':password', $password);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        $response = [];
        
        if($user && $user["role"] == 1) {
            $response["status"] = 200;
            $response["message"]="admin login successfully";
            //header("location:index.php");
        }elseif($user && $user["role"] == 2) {
            $response["status"] = 200;
            $response["message"] = "employee login successfully";
        }else{
            $response["status"] = 200;
            $response["message"] = "service provider login succesfully";
        }
        if ($stmt->rowCount() > 0) {
            $response["status"] = 200;
           
        } else {
            $response["status"] = 404;
            $response["message"] = "Invalid login details"; 
        }
        return json_encode($response);
    }

    public function register($postData) {
        $response = array();

$stmt2 = $this->pdo->prepare("SELECT * FROM register WHERE email =:email");

$stmt2->bindParam(':email',$postData["email"]);
$stmt2->execute();

if($stmt2->rowCount() > 0){
    $response["status"] = "404";
    $response["message"] = 'cant save email';

    return json_encode($response);
}else{
    $stmt = $this->pdo->prepare("INSERT INTO register (first_name, last_name, email, password, phone, username,role) VALUES (:first_name, :last_name, :email, :password, :phone, :username,:role)");
       
    $stmt->bindParam(':first_name', $postData["firstname"]);
    $stmt->bindParam(':last_name', $postData["last_name"]);
    $stmt->bindParam(':email', $postData["email"]);
    $stmt->bindParam(':password', $postData["password"]);
    $stmt->bindParam(':phone', $postData["phone"]);
    $stmt->bindParam(':username', $postData["username"]);
    $stmt->bindParam(':role', $postData["role"]);
    $stmt->execute();

    $response["status"] = "200";
     $response["message"] = "User created successfully";
    return json_encode($response);
    
}

       
    }

    public function otp_insert($postData){
        $otp = $postData["otp"];
        $email =$postData["email"];
        $response = [];

        $insert_otp = "INSERT INTO tbl_otp (otp,email) VALUES (:otp,:email);";
         $sql=$this->pdo->prepare($insert_otp);
         $sql->bindParam(":otp",$otp);
         $sql->bindParam(":email",$email);
         $_SESSION["email"]=$email;
         $result=$sql->execute();
         
         if($result){
            
            return "otp send";
            //header("location:resetPassword.php");
         }
    }

    public function sendOtp($postData)
    {
        $otp = $postData["otp"];
        $email =$postData["email"];
      $mail = new PHPMailer(true);
    
      $mail->isSMTP();                                           
      $mail->Host = 'smtp.gmail.com';                  
      $mail->SMTPAuth = true;                               
      $mail->Username = 'pratikparmar.dds@gmail.com';                   
      $mail->Password = 'gbkw kait yhsc ighr';                                
      $mail->SMTPSecure = 'ssl';            
      $mail->Port = 465;                                    
      //$mail->setFrom('pratikparmar.dds@gmail.com');
      $mail->addAddress($email);  
    
    
      $mail->isHTML(true);                                  
      $mail->Subject = 'Email verification from wokkie';
    
        
    
      $mail->Body = "Thanks for registertion!
      Click the link below for verify the email address
      <h1>$otp</h1>";
    
      $result=$mail->send();
      if($result){
        return 1;
      }
   
     
    }

    public function getOtp($email){
       
        $cheack_otp = $this->pdo->prepare("SELECT * FROM tbl_otp WHERE email=:email and status=0");
        $cheack_otp->bindParam(':email', $email);
        $cheack_otp->execute();
        
        return $cheack_otp->fetchColumn(1);
        
    }

    public function deactivateOtp($email){
       
        $cheack_otp = $this->pdo->prepare("update  tbl_otp set status=1 WHERE email=:email");
        $cheack_otp->bindParam(':email', $email);
        $result=$cheack_otp->execute();
        
        if($result){
            return 1;
        }
        
    }

    public function confirmPassword($postData){
   
    $confirmPassword= $postData["confirmPassword"];
    $email=$postData["email"];
    $query = $this->pdo->prepare("UPDATE register SET password=:confirmPassword where email=:email");
        $query->bindParam(":confirmPassword",$confirmPassword);
        $query->bindParam(":email",$email);
        $result=$query->execute();
        
        if($result){
            return 1;
        }
    }


public function showUser(){
    $show_data = $this->pdo->prepare("SELECT * FROM register");
    $show_data->execute();
    
    $result = $show_data->fetchAll(PDO::FETCH_ASSOC);

    if(count($result) > 0){
        return $result;
    } else {
        return false;
    }
}


public function sendid($postData){


    $edit_user = $this->pdo->prepare('UPDATE register SET first_name=:first_name,last_name=:last_name,username=:username,email=:email,phone=:phone,role=:role WHERE id=:userid');



    $edit_user->bindParam(':userid', $postData["userid"]);
    $edit_user->bindParam(':first_name', $postData["fname"]);
    $edit_user->bindParam(':last_name', $postData["lname"]);
    $edit_user->bindParam(':email', $postData["email"]);
    $edit_user->bindParam(':phone', $postData["phone"]);
    $edit_user->bindParam(':username', $postData["username"]);
    $edit_user->bindParam(':role', $postData["role"]);
    $edit_user->execute();
    
    if ($edit_user->rowCount() > 0) {
        // Redirect after successful update
        header("Location: index.php");
        exit; // Ensure script stops after redirection
    } else {
        echo "Error";
    }
    
    if($edit_user->execute())
    {
        echo "Success";
    }
    else
    {
        echo "Error";
    }
    die;
}

function deleteUser($user_id){
    
    $delete_query = $this->pdo->prepare("DELETE FROM register WHERE id=:user_id");
    $delete_query->bindParam(':user_id',$user_id);
    $delete_query->execute();
    // header("location:index.php");
}

}

class items{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }



    public function addItem($postData) {
        // echo "<pre>";
        // print_r($postData);
        // die;
        $path = 'uploads';
    
        $fileNames = [];
    
        foreach ($_FILES['file']['name'] as $key => $val) {
            $targetFile = $path . basename($val);
    
            if (move_uploaded_file($_FILES['file']['tmp_name'][$key], 'uploads' . $val)) {
                $fileNames[] = $targetFile;
            } else {
                $response["status"] = "404";
                $response["message"] = "data not successfully";
            }
        }
    

       

        $photo = implode(',', $fileNames);
    
        echo  $targetFile = basename($photo,$_FILES['file']['name']);
        die;
         $ext = strtolower(substr($targetFile, strrpos($targetFile, '.') + 1));
         
         if (!(($ext == "jpg" || $ext == "gif" || $ext == "png") && ($_FILES["imagefile"]["type"] == "image/jpeg" || $_FILES["imagefile"]["type"] == "image/gif" || $_FILES["imagefile"]["type"] == "image/png") && 
             ($_FILES["imagefile"]["size"] < 2120000))){
             echo "F2";
             die();
         }

        $insertItem = $this->pdo->prepare("INSERT INTO items (item_name, status, photo) VALUES (:item_name, :status, :photo)");
    
        $insertItem->bindParam(':item_name', $postData["item_name"]);
        $insertItem->bindParam(':status', $postData["status"]);
        $insertItem->bindParam(':photo', $photo);
    
        if ($insertItem->execute()) {
            $response["status"] = "200";
            $response["message"] = "data successfully inserted";
        } else {
            $response["status"] = "404";
            $response["message"] = "data not successfully inserted";
        }
    }
    

    public function showItem(){
      
        $sql = "SELECT * FROM items";
   $statement = $this->pdo->prepare($sql);
   $statement->execute();
   $statement->setFetchMode(PDO::FETCH_ASSOC);
   
   $result = $statement->fetchAll(); 
   if($result){
    // echo "asdfhsdhfh";
    return $result;
   }else{
    return false;
   }
      
    }


    public function sendid($postData){
        // echo "<pre>";
        // print_r($postData);
        // die;
       $path = 'uploads';
       $fileNames = [];

       foreach($_FILES["file"]["name"] as $key=>$val) {
        $targetFile = $path . basename($val);
    //    echo $targetFile = basename($path,"jpg");
    //    die;


        if(move_uploaded_file($_FILES["file"]["tmp_name"][$key],'uploads'.$val)){
            $fileNames[] = $targetFile;
        }else {
            $response["status"] = "404";
            $response["message"] = "data not successfully";
        }
       }
       $image = implode(',', $fileNames);
    
       $edit_item = $this->pdo->prepare('UPDATE items SET item_name=:item_name,photo=:image WHERE id=:userid');
       
       $edit_item->bindParam(':user_id',$postData["userid"]);
       $edit_item->bindParam(':item_name', $postData["item_name"]);
       $edit_item->bindParam(':image', $image);

    //    if ($edit_item->execute()) {
    //     $response["status"] = "200";
    //     $response["message"] = "data successfully updated";
    // } else {
    //     $response["status"] = "404";
    //     $response["message"] = "data not updated";
    // }      

        // if ($edit_item->rowCount() > 0) {
       
        //     header("Location: itemData.php");
        //     exit; 
        // } else {
        //     echo "Error df";
        // }
    }

    public function deleteItem($userid){
        $delete_query = $this->pdo->prepare("DELETE FROM items WHERE id=:userid");
        $delete_query->bindParam(':userid',$userid);
        $delete_query->execute();
    }

    
}

?>


