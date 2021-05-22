<?php 
require 'partials/navbar.php';
?>

<?php
include 'partials/dbconnect.php';
?>

<?php
$showError = false;
$showAlert = false;

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  
  $existSql = "SELECT * FROM `userinfo` WHERE username = '$username' ";
  $result = mysqli_query($conn,$existSql);
  $numSql = mysqli_num_rows($result);
  // echo $numSql;
  if($numSql >0)
  {
    $showError = "Username already exist";
  }
  else{
    if($password == $cpassword) {
      $hash = password_hash($password,PASSWORD_DEFAULT);
      $sql = "INSERT INTO `userinfo` (`username`, `password`,`date`) VALUES ('$username', '$hash',current_timestamp())";
      $result = mysqli_query($conn,$sql);
      
      if($result){
        $showAlert = true;
      }
    }
    else{
      $showError = "Passwords do not match";
    }
  }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Your PAL !</title>
  </head>
  <body>
    <?php

    if($showError){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> ' . $showError .'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if($showAlert){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your account has been created successfully
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <!-- creating the form -->
    <div class="container">
    <br>
    <h1 class="text-center"> Sign Up to our website</h1>
    </div>
    <div  class="container my-4 col-md-6">
        <form action="/loginsystem/signup.php" method="POST">
        
            <div class="mb-3">
                <label for="username" class="form-label" name="username">Username</label>
                <input type="username" class="form-control" id="username" name= "username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label" name="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label" name="cpassword">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>