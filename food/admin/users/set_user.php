<?php
session_start();
include('../connection/connection.php');
if($_SERVER["REQUEST_METHOD"]=="GET"){

    $get_id=$_GET["id"];
    

    
    // $emp_inf=$result->fetchAll(PDO::FETCH_ASSOC);
    if($_SESSION['id']==$get_id){
        header("location:show.php?msg=You can't Set Yourself as a User");
    }
    else{
        $result=$connect->query("UPDATE `users` set is_admin='0' where id=$get_id");
        header("location:show.php");
    }
    
    
// var_dump($emp_inf);
}
?>