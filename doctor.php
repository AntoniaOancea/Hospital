<?php
    require "functions.php";
    check_login();

    if(isset($_GET['edit'])) 
        $id = $_GET['edit'];
    else
        header("Location: index.php");
    $nume = mysqli_query($conn,"SELECT name FROM doctors WHERE id_doctor = '".$id."'");
    if (!$nume || mysqli_num_rows($nume) == 0) {
        header("Location: index.php");
    die;
    }
    $nume = mysqli_fetch_assoc($nume);

    $select = mysqli_query($conn,"SELECT * FROM treatments WHERE id_doctor = '".$id."' GROUP BY id_patient");

    if(isset($_POST['add_treatment'])){

        $patient = $_POST['patient'];
        $assistant = $_POST['assistant'];
        $details = $_POST['details'];
     
        if(empty($patient)||empty($assistant)||empty($details)){
           echo("<div class='alert alert-danger' role='alert'><h3>Please fill out all!</h3></div>");
        }else{
            $id_patient = mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(id_patient) as max_id FROM patients WHERE name='".$patient."'"));
            $id_patient = $id_patient['max_id'];
            if(!$id_patient)
                mysqli_query($conn,"INSERT INTO patients(name) VALUES ('".$patient."')");
            $id_assistant =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT MAX(id_assistant) as max_id FROM assistants WHERE name='".$assistant."'"));
            $id_assistant = $id_assistant['max_id'];

            if(!$id_assistant)
                echo("<div class='alert alert-danger' role='alert'><h3>Assistant doesn't exist!</h3></div>");
            else{
                $insert = "INSERT INTO treatments(id_patient, id_doctor, id_assistant, details) VALUES('$id_patient','$id','$id_assistant','$details')";//inserarea in baza de date
                if(!mysqli_query($conn,$insert))
                    echo("<div class='alert alert-danger' role='alert'><h3>Error!</h3></div>");
                else
                header("Location: doctor.php?edit=$id");
            }
        }
     
     };
     
     if(isset($_GET['delete'])){
        $id2 = $_GET['delete'];
        database_run("DELETE FROM treatments WHERE id_treatment = $id2");
        header("Location: doctor.php?edit=$id");
     };
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
    
    <h1 class="jumbotron text-center" style="color:#2596be; text-align:left;">Dr. <?php echo strtoupper($nume['name']) ?></h1>
    
    <div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Add new treatments</h3>
         <input type="text" placeholder="Name patient" name="patient" class="box">
         <input type="text" placeholder="Name assistant" name="assistant" class="box">
         <input type="text" placeholder="Details" name="details" class="box">
         <input type="submit" class="btn btn-primary" name="add_treatment" value="Add treatment">
      </form>

   </div>

    <table id="editableTable" class="table table-bordered">
      <thead>
      <tr>
        <th style="width:20%">Patient</th>
        <th style="width:20%">Doctor</th>
        <th style="width:20%">Assistant</th>
        <th style="width:20%">Details</th>
        <th style="width:20%">Action</th>
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
            <td>
            <a href="update_treatment.php?edit=<?php echo $id?>&update=<?php echo $doctor['id_treatment'];?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
            <a href="doctor.php?edit=<?php echo $id;?>&delete=<?php echo $doctor['id_treatment']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
		<?php } ?>
	</tbody>
   </table>
</body>
