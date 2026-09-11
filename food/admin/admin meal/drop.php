<?php
include('../connection/connection.php');
include('../session.admin.php');

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../login.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"]=="GET"){

    $get_id=$_GET["id"];
    
    $result=$connect->query("UPDATE `meals` set is_dropped='1' where id=$get_id");
    // $emp_inf=$result->fetchAll(PDO::FETCH_ASSOC);
    header("location:show.php");
    
// var_dump($emp_inf);
}
?>