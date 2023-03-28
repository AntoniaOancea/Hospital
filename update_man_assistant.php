<?php

require 'functions.php';
include("header2.php");

check_login();
if($_SESSION['USER']!="admin") 
        header('Location:index.php');


$id = $_GET['edit'];

if(isset($_POST['update'])){

   $name = $_POST['name'];
   $mail = $_POST['mail'];
   $password = $_POST['password'];

   if(empty($name) || empty($mail) || empty($password))
      $message[] = 'please fill out all!';    
   else{

      $update_data = "UPDATE assistants SET name='$name', mail='$mail', password='$password'  WHERE id_assistant = '$id'";
      $upload = mysqli_query($conn, $update_data);
      header("location:man_assistant.php");
   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Admin Page</title>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<br><br>
<div class="container">

    
    <div class="admin-product-form-container centered">

    <?php
        
        $select = mysqli_query($conn, "SELECT * FROM assistants WHERE id_assistant = '$id'");
        while($row = mysqli_fetch_assoc($select)){

    ?>
    
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" class="box" name="name" value="<?php echo $row['name']; ?>" placeholder="name">
        <input type="email" class="box" name="mail" value="<?php echo $row['mail']; ?>" placeholder="mail">
        <input type="text" class="box" name="password" value="<?php echo $row['password']; ?>" placeholder="password">
        <input type="submit" value="update" name="update" class="btn">
    </form>
    


    <?php }; ?>

    

    </div>

</div>

</body>
</html>