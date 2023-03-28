<?php

require 'functions.php';
include("header2.php");

check_login();
if(isset($_GET['edit']))
    $id = $_GET['edit'];
else
    header("location:index.php");
if(isset($_GET['update']))
    $id_treatment = $_GET['update'];
else
    header("location:index.php");

if(isset($_POST['update'])){

   $details = $_POST['details'];

   if(empty($details))
      $message[] = 'please fill out all!';    
   else{

      $update_data = "UPDATE treatments SET details='$details'  WHERE id_treatment = '$id_treatment'";
      $upload = mysqli_query($conn, $update_data);
      header("Location:doctor.php?edit=".$id);
   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Hospital</title>
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
        
        $select = mysqli_query($conn, "SELECT details FROM treatments WHERE id_treatment = '$id_treatment'");
        while($row = mysqli_fetch_assoc($select)){

    ?>
    
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" class="box" name="details" value="<?php echo $row['details']; ?>" placeholder="Details">
        <br>
        <input type="submit" value="update" name="update" class="btn">
    </form>
    


    <?php }; ?>

    

    </div>

</div>

</body>
</html>
