<?php

include('../connection/connection.php');
include('../session.admin.php');

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../login.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"]=="GET"){
    
    $get_id=$_GET["id"];
    $result=$connect->query("SELECT * FROM `meals` where id=$get_id");
    $meal_inf=$result->fetch(PDO::FETCH_ASSOC);
    $image_path = $original_path='../../' . $meal_inf['image'];

    if (file_exists($image_path)) {
    unlink($image_path);
    }

    $result=$connect->query("DELETE FROM `meals` where id=$get_id");
    // $emp_inf=$result->fetchAll(PDO::FETCH_ASSOC);
    header("location:show.php");
    
// var_dump($emp_inf);
}
?>