<?php  session_start();
    if(!isset($_SESSION['email']) &&  $_SESSION['is_admin'] == 1) { // ده بتاعت ان ال user ميتحرك ب ال url و تتحط في كل الصفح تقريبا 
        header("location:login.php") ;
                exit() ;
    } ?>