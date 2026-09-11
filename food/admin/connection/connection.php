<?php
try{
    $connect=new PDO("mysql:host=localhost;dbname=food;","root","");
    // $connect=new mysqli("localhost","root","","company");
    
}
catch(Exception $e){
    echo $e->getMessage();
}
?>