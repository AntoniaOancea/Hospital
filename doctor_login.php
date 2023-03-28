<?php  
include("header.php");
require "functions.php";

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $mail = $_POST['mail'];
    $pass_query = mysqli_query($conn, "SELECT password, id_doctor FROM doctors WHERE mail ='" . $mail . "'");
    if (!$pass_query) {
        echo("<div class='alert alert-danger' role='alert'><h3>Wrong password or email!</h3></div>");
    } else {
        if (mysqli_num_rows($pass_query) > 0) {
            $row = mysqli_fetch_assoc($pass_query);
            $pass = $row['password'];
            $id = $row['id_doctor'];
            if ($_POST['password'] == $pass) {
                $_SESSION['LOGGED_IN'] = true;
                $_SESSION['USER'] = $_POST['mail'];
                header("Location:doctor.php?edit=".$id);
                die;
            } else {
                echo("<div class='alert alert-danger' role='alert'><h3>Wrong password or email!</h3></div>");
            }
        } else {
            echo("<div class='alert alert-danger' role='alert'><h3>Wrong email!</h3></div>");
        }
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Hospital</title>
</head>

<body>
<h1 class="jumbotron text-center">DOCTOR</h1>

<br><br>

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-5 mt-md-4 pb-5">

                        
                            <form method="post" >
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="mail" placeholder="Mail" class="form-control form-control-lg">
                                    <input type="password" name="password" placeholder="Password" class="form-control form-control-lg">
                                    <label class="form-label" for="typePasswordX-2">Password</label>
                                </div>
                                <input type="submit" value="Login" class="btn btn-primary btn-block mb-4">
                            </form>


                        </div>
                    </div>
                  </div>
            </div>
         </div>
    </div>
</section>	
</body>
</html>