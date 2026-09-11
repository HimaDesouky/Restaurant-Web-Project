<?php if(!isset($_SESSION['email']) &&  $_SESSION['is_admin'] == 0) { // ده بتاعت ان ال user ميتحرك ب ال url و تتحط في كل الصفح تقريبا 
  header("location:login.php") ;
          exit() ;
} ?>