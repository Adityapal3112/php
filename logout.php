<?php
session_start();

session_unset();
session_destroy();
header("location:http://localhost/loginsystem/login.php");
// echo "<script> location.href='http://localhost/loginsys/login.php'; </script> error";
exit;
?>