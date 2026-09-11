<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include "validate/validate.php";
include "connection/connection.php";

$errors=[];
    $done='';
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $name=validate_input($_POST["name"]);
        $email=validate_input($_POST["email"]);
        $password=validate_input($_POST["password"]);
        $conf_password=validate_input($_POST["conf_password"]);
        
        
        $result=$connect->query('SELECT email FROM users');
        $datas=$result->fetchAll(PDO::FETCH_ASSOC);
        
        
        if(!validate_u_name($name)){
            $errors[]="invalid name";
        }
        
        foreach($datas as $data){
            foreach($data as $inf){
                if($inf==$email){
                    $errors[]="the email is allardy taken ...!";
                    break;
                }
            }
        }
        if(strlen($password)<6){
            $errors[]="password must be at least 6 character";
        }
        if($password!=$conf_password){
            $errors[]="confirm Your Password Correctlly ...!";
        }
        
    
        if(empty($errors)){
            $password=md5($password);
            $query = $connect->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
             $done='Created Successfully ...!';
        }
         
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords" content="admin dashboard, bootstrap 5 admin, responsive dashboard" />
  <meta name="description" content="Modern Admin Dashboard" />
  <title>Admin Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="layouts/form_style.css">
  <style>
    .request {
      background: #1D2B53;
      color: white;
      margin-top: 10px;
      border: 1px solid #1D2B53;
      border-radius: 20px;
      padding: 6px 12px;
      cursor: pointer;
      transition: 0.3s;
      margin-left:10px;
    }
    .request:hover {
      background-color: rgb(0, 128, 255);
      border: 1px solid rgb(0, 128, 255);
      
    }
</style>
  </head>
<body style="background-color: #F7F7F7;">
 
  <!-- Main Content -->
  <div id="content">
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom px-3" style="background-color: #1D2B53;">
    <!-- Logo -->
      <i class="fa-solid fa-utensils" style="color:black ;font-size:40px; margin-left:20px; background:aqua;padding:8px;border-radius:30px;"></i>

    <!-- Toggle for mobile -->
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarContent">
      
 
    </div>
  </nav>
 

<br>
<!-- هنا هننقل أي أخطاء متولدة قبل الـHTML -->
<!-- <div id="alerts" class="container mt-3"></div> -->


    <div class="card-body">
    <div class="emp-form-container">
        <h1 class="emp-form-title">Create Account</h1>
        <?php
        if(!empty($errors)){?>
        <div class="alert alert-danger">
        <ul>
        <?php
        
            foreach($errors as $error){?>
            <li><?php echo $error ;?></li>
           <?php
            }
            ?>
        </ul></div>
        <?php    
        }
        else{
            if(!empty($done)){
            ?>
            <div class="alert alert-success">
                <ul>
                    <li><?php echo $done; ?></li>
                </ul>
                </div>
       <?php
        }}
        ?>
        <form method="post" action="#" id="employeeForm">

            <div class="emp-form-group">
                <label for="empName" class="emp-form-label emp-required">Full Name</label>
                <input type="text" name="name" id="empName" class="emp-form-input" placeholder="Enter full name" required>
            </div>

            <div class="emp-form-row">
                <!-- <div class="emp-form-group">
                    <label for="empEmail" class="emp-form-label emp-required">Email</label>
                    <input type="email" id="empEmail" class="emp-form-input" placeholder="email@company.com" required>
                </div> -->
                <div class="emp-form-group">
                    <label for="empPhone" class="emp-form-label emp-required">Email</label>
                    <input type="tel" name="email" id="empPhone" class="emp-form-input" placeholder="..gmail.com" required>
                </div>
            </div>

            <div class="emp-form-row">
                <div class="emp-form-group">
                    <label for="empPosition" class="emp-form-label emp-required">Password</label>
                    <input type="password" name="password" id="empPosition" class="emp-form-input" placeholder="Password" required>
                </div>
                <!-- <div class="emp-form-group">
                    <label for="empDepartment" class="emp-form-label emp-required">Department</label>
                    <select id="empDepartment" class="emp-form-select" required>
                        <option value="">Select Department</option>
                        <option value="hr">HR</option>
                        <option value="it">IT</option>
                        <option value="finance">Finance</option>
                        <option value="marketing">Marketing</option>
                    </select>
                </div> -->
            </div>
            <div class="emp-form-row">
                <div class="emp-form-group">
                    <label for="empPosition" class="emp-form-label emp-required">Confirm password</label>
                    <input type="password" value="" name="conf_password" id="empPosition" class="emp-form-input" placeholder="Confirm Password" required>
                </div>
                
            </div>
            

            <center><button type="submit" class="request" style="width:90%">Add user</button></center> 
            <hr>
      <p class="text-center small mb-0">
        Already have an account? <a href="login.php">Login</a>
      </p>
        </form>
    </div>

     
    </div>
  </div>
</div>

<!-- ننقل الـerror divs اللي اتطبعت قبل الـHTML ونحطها تحت الـnavbar -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const holder = document.getElementById('alerts');
  // أي div اتطبع قبل الـHTML بالستايل الأحمر هننقله هنا
  document.querySelectorAll('body > div[style*="#ffe6e6"]').forEach(function(el){
    holder.appendChild(el);
    el.classList.add('moved-alert');
  });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>