<?php
include('../connection/connection.php');
if($_SERVER["REQUEST_METHOD"]=="GET"){

    $get_id=$_GET["id"];
    
    $result=$connect->query("UPDATE `users` set is_admin='1' where id=$get_id");
    // $emp_inf=$result->fetchAll(PDO::FETCH_ASSOC);
    header("location:show.php");
    
// var_dump($emp_inf);
}
?>