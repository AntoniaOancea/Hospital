<?php

    require "functions.php";
    include("header.php");
    
    check_login();
    if($_SESSION['USER']!="admin") 
        header('Location:index.php');

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
    <h1 class="jumbotron text-center">Admin</h1>
    
    <div class="container">
        <br><br>
        <a onclick="location.href='man_doctor.php'" class="btn btn-primary btn-block">Doctors</a>
        <a onclick="location.href='man_assistant.php'" class="btn btn-primary btn-block">Assistents</a>
        <a onclick="location.href='man_patient.php'" class="btn btn-primary btn-block">Patients</a>
        <a onclick="location.href='man_treatments.php'" class="btn btn-primary btn-block">Treatments</a>
        <br><br>
    </div>

</body>
</html>