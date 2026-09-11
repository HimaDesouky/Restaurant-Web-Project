<?php
session_start();
unset($_SESSION["name"]);
session_unset();
session_destroy();
// setcookie("email","",time()-36000);
// setcookie("admin","",time()-36000);
header("location:login.php");
exit();
?>

