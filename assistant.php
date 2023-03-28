<?php
    require "functions.php";
    check_login();
    if(isset($_GET['edit'])) 
        $id = $_GET['edit'];
    else
         header("Location: index.php");

    $nume = mysqli_query($conn,"SELECT name FROM assistants WHERE id_assistant = '".$id."'");
    if (!$nume || mysqli_num_rows($nume) == 0) {
        header("Location: index.php");
        die;
    }
    $nume = mysqli_fetch_assoc($nume);
    
    $select = mysqli_query($conn,"SELECT * FROM treatments WHERE id_assistant = '".$id."' GROUP BY id_patient");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include("header.php"); ?>
    
    <h1 class="jumbotron text-center" style="color:#2596be; text-align:left;">Asst. <?php echo strtoupper($nume['name']) ?></h1>
    
    <table id="editableTable" class="table table-bordered">
      <thead>
      <tr>
        <th style="width:20%">Patient</th>
        <th style="width:20%">Doctor</th>
        <th style="width:20%">Assistant</th>
        <th style="width:20%">Details</th>
      </tr>
      </thead>
		<?php while( $doctor = mysqli_fetch_assoc($select) ) { ?>
		   <tr id="<?php echo $doctor ['id_treatment']; ?>">
           <td><?php 
                $patient = mysqli_fetch_assoc(mysqli_query($conn,"SELECT name FROM patients WHERE id_patient = '".$doctor['id_patient']."'"));
                echo $patient['name']; ?>
            </td>
            <td><?php 
                $doc = mysqli_fetch_assoc(mysqli_query($conn,"SELECT name FROM doctors WHERE id_doctor = '".$doctor['id_doctor']."'"));
                echo $doc['name']; ?>
            </td>
            <td><?php 
                $assistant = mysqli_fetch_assoc(mysqli_query($conn,"SELECT name FROM assistants WHERE id_assistant = '".$doctor['id_assistant']."'"));
                echo $assistant['name']; ?>
            </td>  				   			
            <td><?php echo $doctor['details']; ?></td>
		<?php } ?>
	</tbody>
   </table>
</body>
