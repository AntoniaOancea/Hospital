<?php
require 'functions.php';
include("header2.php");

check_login();
if($_SESSION['USER']!="admin") 
    header('Location:index.php');

$select = mysqli_query($conn,"SELECT * FROM treatments");

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

   <table id="editableTable" class="table table-bordered">
      <thead>
      <tr>
        <th style="width:10%">ID</th>
        <th style="width:20%">Patient</th>
        <th style="width:20%">Doctor</th>
        <th style="width:20%">Assistant</th>
        <th style="width:30%">Details</th>
      </tr>
      </thead>
      <tbody>
		<?php while( $doctor = mysqli_fetch_assoc($select) ) { ?>
		   <tr id="<?php echo $doctor ['id_treatment']; ?>">
           <td><?php echo $doctor ['id_treatment'];?></td>
           <td><?php echo mysqli_query($conn,"SELECT name FROM patients WHERE id_patient = {$doctor ['id_patient']}")->fetch_assoc()['name']; ?></td>
		   <td><?php echo mysqli_query($conn,"SELECT name FROM doctors WHERE id_doctor = {$doctor ['id_doctor']}")->fetch_assoc()['name']; ?></td>
		   <td><?php echo mysqli_query($conn,"SELECT name FROM assistants WHERE id_assistant = {$doctor ['id_assistant']}")->fetch_assoc()['name']; ?></td>
           <td><?php echo $doctor ['details']; ?></td>   				   				  
		   </tr>
		<?php } ?>
	</tbody>
   </table>

</div>


</body>
</html>
