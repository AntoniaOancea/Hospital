<?php
require 'functions.php';
include("header2.php");

check_login();
if($_SESSION['USER']!="admin") 
    header('Location:index.php');

$select = "SELECT id, name FROM patients";

if(isset($_POST['add_patient'])){

   $name = $_POST['name'];

   if(empty($name)){
      $message[] = 'Please fill out all!';//daca nu sunt completate toate campurile
   }else{
      $insert = "INSERT INTO patients(name) VALUES('$name')";//inserarea in baza de date
      if(!mysqli_query($conn,$insert))
        $message[]='Error!';
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   database_run("DELETE FROM patients WHERE id_patient = $id");
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <title>Admin Page</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="style.css">

</head>
<body>
<h1 class="jumbotron text-center">Admin</h1>

<?php

if(isset($message)){
   foreach($message as $message){
      echo "<div class='alert alert-danger' role='alert'><h3>".$message."</h3></div>";
   }
}

?>
 
<div class="container">
   <div class="search-container">
      <form action="man_patient.php">
         <input type="text" placeholder="Search.." name="search">
         <button type="submit"><i class="fa fa-search"></i></button>
      </form>
   </div>

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Add new patients</h3>
         <input type="text" placeholder="name" name="name" class="box">
         <input type="submit" class="btn btn-primary" name="add_patient" value="Add Patient">
      </form>

   </div>

<?php
   $select = mysqli_query($conn, "SELECT * FROM patients");
?>
   <table id="editableTable" class="table table-bordered">
      <thead>
      <tr>
        <th style="width:10%">ID</th>
        <th style="width:70%">Name</th>
        <th style="width:20%">Action</th>
      </tr>
      </thead>
		<?php while( $doctor = mysqli_fetch_assoc($select) ) { ?>
		   <tr id="<?php echo $doctor ['id_patient']; ?>">
           <td><?php echo $doctor ['id_patient']; ?></td>
		   <td><?php echo $doctor ['name']; ?></td>	
           <td>
            <a href="update_man_patient.php?edit=<?php echo $doctor['id_patient']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
            <a href="man_patient.php?delete=<?php echo $doctor['id_patient']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>   				   				  
		   </tr>
		<?php } ?>
	</tbody>
   </table>

</div>


</body>
</html>