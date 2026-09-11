<?php
include('../connection/connection.php');
include('../session.admin.php');

if($_SERVER["REQUEST_METHOD"]=="GET"){

    $get_id=$_GET["id"];
    
    $result=$connect->query("DELETE FROM `employees` where id=$get_id");
    // $emp_inf=$result->fetchAll(PDO::FETCH_ASSOC);
    header("location:admin.php");
    
// var_dump($emp_inf);
}
?>