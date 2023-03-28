<?php

require 'functions.php';
include("header2.php");

check_login();
if($_SESSION['USER']!="admin") 
        header('Location:index.php');


$id = $_GET['edit'];

if(isset($_POST['update'])){

   $name = $_POST['name'];

   if(empty($name))
      $message[] = 'please fill out all!';    
   else{

      $update_data = "UPDATE patients SET name='$name'  WHERE id_patient = '$id'";
      $upload = mysqli_query($conn, $update_data);
      header("location:man_patient.php");
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
        
        $select = mysqli_query($conn, "SELECT * FROM patients WHERE id_patient = '$id'");
        while($row = mysqli_fetch_assoc($select)){

    ?>
    
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" class="box" name="name" value="<?php echo $row['name']; ?>" placeholder="name">
        <input type="submit" value="update" name="update" class="btn">
    </form>
    


    <?php }; ?>

    

    </div>

</div>

</body>
</html>