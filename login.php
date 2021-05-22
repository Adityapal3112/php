<?php 
include 'partials/navbar.php';
?>
<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'partials/dbconnect.php';
  $username = $_POST["username"]; 
  $password = $_POST["password"]; 
    
     
  // $sql = "SELECT * FROM userinfo WHERE username='$username' AND password='$password'";
  $sql = "SELECT * FROM `userinfo` WHERE username='$username'";
  
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  
  // echo $num;
  if($num == 1){
    while($row=mysqli_fetch_assoc($result)){
      if (password_verify($password, $row['password'])){
        $login = true;
        session_start();
        $serial_number= "SELECT `sno` FROM `userinfo` WHERE `username`='$username'";
        $serial_number_result = mysqli_query($conn, $serial_number);
        $service = mysqli_fetch_assoc($serial_number_result);
        $_SESSION['username'] = $username;
        $_SESSION['login'] = true;
        $_SESSION['service'] = $service;

        header("location:http://localhost/loginsystem/welcome.php");
      }
      else{
        $showError = "Invalid Credntials hai" ;
      }
    }
  }    
  else{
    $showError ="Invalid Credentials";
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

    <title>Your PAL!</title>
  </head>
  <body>
    
          <?php
            if($showError)
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> ' . $showError . '</strong> You should check in on some of those fields below.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
          ?>
    
    <div class="container">
      <br>
      <h1 class="text-center"> Login to our website</h1>
      </div>
      <div  class="container my-4 col-md-6">
          <form action="/loginsystem/login.php" method="post">
            <div class="container my-4 col-md-6" >
                  <div class="mb-3">
                  <label for="username" class="form-label" name="username">Username</label>
                  <input type="text" class="form-control" id="username" name= "username">
              </div>
              <div class="mb-3">
                  <label for="password" class="form-label" name="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
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