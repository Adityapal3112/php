<?php
    session_start();
    
    if(!isset($_SESSION['login']) || $_SESSION['login'] !=true){
        echo "<script> location.href='http://localhost/loginsystem/login.php'; </script> ";
        // exit;
    }
?>
<?php
require 'partials/navbar.php';
require 'partials/dbconnect.php';

?>
<?php
    $showAlert = false;
    $showError = false;
    $name =  $_SESSION['service'];
    // echo $_SESSION['username']; s 
    // echo'<br>'; 
    $str = implode(" ",$name);
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $password = $_POST['password'];
      $hash = password_hash($password,PASSWORD_DEFAULT);

      $sql = "UPDATE `userinfo` SET `password` = '$hash' WHERE `userinfo`.`sno` = $str";
      $result = mysqli_query($conn,$sql);
      if($result){
        $showAlert = true;
        
      }
      else{
        $showError = true;
      }
    // session_destroy(); 
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

    <title>Your Pal!</title>
  </head>
  <body>
    
    <?php
    if($showAlert){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Your password has changed successfully
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    
    if($showError){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError .'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    
    ?>

    <form action="http://localhost/loginsystem/changepass.php" method="post">
        <div class="container">
            <label for="password" class="form-label">New Password</label>
            <input type="password" id="password" name="password" class="form-control" aria-describedby="passwordHelpBlock">
            <div id="passwordHelpBlock" class="form-text">
            Enter your new password
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

        </div>
    </form>
    
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