<?php
require 'functions.php';
include("header2.php");

check_login();
if($_SESSION['USER']!="admin") 
    header('Location:index.php');

$select = "SELECT id, name, mail FROM assistants";

if(isset($_POST['add_assistant'])){

   $name = $_POST['name'];
   $mail = $_POST['mail'];
   $password = $_POST['password'];

   if(empty($name) || empty($mail) || empty($password)){
      $message[] = 'Please fill out all!';//daca nu sunt completate toate campurile
   }else{
      $insert = "INSERT INTO assistants(name, mail , password) VALUES('$name', '$mail', '$password')";//inserarea in baza de date
      if(!mysqli_query($conn,$insert))
        $message[]='Error!';
   }
};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   database_run("DELETE FROM assistants WHERE id_assistant = $id");
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

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Add new assistants</h3>
         <input type="text" placeholder="name" name="name" class="box">
         <input type="text" placeholder="mail" name="mail" class="box">
         <input type="text" placeholder="password" name="password" class="box">
         <input type="submit" class="btn btn-primary" name="add_assistant" value="Add Assistant">
      </form>

   </div>

<?php
   $select = mysqli_query($conn, "SELECT * FROM assistants");   
?>
   <table id="editableTable" class="table table-bordered">
      <thead>
      <tr>
        <th style="width:10%">ID</th>
        <th style="width:20%">Name</th>
        <th style="width:30%">Mail</th>
        <th style="width:20%">Password</th>
        <th style="width:20%">Action</th>
      </tr>
      </thead>
		<?php while( $doctor = mysqli_fetch_assoc($select) ) { ?>
		   <tr id="<?php echo $doctor ['id_assistant']; ?>">
           <td><?php echo $doctor ['id_assistant']; ?></td>
		   <td><?php echo $doctor ['name']; ?></td>
		   <td><?php echo $doctor ['mail']; ?></td>
           <td><?php echo $doctor ['password']; ?></td>		
           <td>
            <a href="update_man_assistant.php?edit=<?php echo $doctor['id_assistant']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
            <a href="man_assistant.php?delete=<?php echo $doctor['id_assistant']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>   				   				  
		   </tr>
		<?php } ?>
	</tbody>
   </table>

</div>


</body>
</html>