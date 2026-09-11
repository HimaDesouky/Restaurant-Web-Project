<?php 
session_start();
include "validate/validate.php" ;
include "connection/connection.php" ;
  $errors=[];
  

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

  $email = validate_input($_POST["email"]) ;
  $v_email =validateemail($_POST["email"]) ;
  $password =md5($_POST['password']) ;

    if ($v_email) {
    $stm = $connect->prepare("SELECT * FROM users WHERE email = :email  ");
    $stm->execute([':email' => $email]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        if ($password === $user['password']) {
            if ($user['is_admin'] == 1) {
                $_SESSION['name']=$user['name'];
                $_SESSION['id']=$user['id'];
                $_SESSION['email']=$user['email'];
                $_SESSION['is_admin']=1;
                header("location:home/home.php");
                // echo "admin done"; كنت عاملها علشان اجرب الكود 
                exit();
            } else {
              $_SESSION['email']=$user['email'];
              $_SESSION['id']=$user['id'];
                $_SESSION['name'] = $user['name'];
                header("location:meals/profile.php");
                // echo "user done"; كنت عاملها علشان اجرب الكود
                exit();
            }
        } else {
            $errors[] = "Your password is wrong...!"; 
        }
    } else {
        $errors[] = "Your email is wrong...!";
    }
}
if(!validateemail($email) || empty($email)) {
        $errors[] = " Please enter a valid email...! " ;
    } 
    
 if(empty($password)){
            $errors[] = " Please enter a valid password...! " ;
 }
if (!empty($password) && strlen($password) < 5) {
    $errors[] = " Password must be at least 6 characters ...! " ;
}
// if (!empty($password) && !preg_match('/(?=.*\d)(?=.*[!@#$%^&*()\-_=+{}\[\];:\'",.<>\/?\\|`~])/', $password)) {
//     $errors[] = "Password must contain at least one number and one special character...!";
// }

        } 
?>

<!doctype html><html lang="en" dir="ltr"><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Log In</title>
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
    }
    .request:hover {
      background: #1D2B53;
      border: 1px solid #1D2B53;
    }
</style>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="style.css" rel="stylesheet"> -->
<!-- <nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand brand-food" href="shop.php">
      <span class="emoji">🍕</span> Foodly
    </a>
  <div class="ms-auto">
      <a class="btn btn-outline-light me-2" href="orders_my.php">My Orders</a>
      <a class="btn btn-light text-tomato me-2" href="cart.php">Cart</a>
    </div>
  </div>
</nav> -->

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
  <link rel="stylesheet" href="admin_style.css">
  </head>
<body style="background-color: #F7F7F7;">

  <!-- Main Content -->

    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom px-3" style="background:#1D2B53;">
    <!-- Logo -->
      <i class="fa-solid fa-utensils" style="color:black ;font-size:40px; margin-left:20px; background:aqua;padding:8px;border-radius:30px;"></i>

    <!-- Toggle for mobile -->
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    
  </nav>

<br>
<div style="width:500px;" class="container auth-box">
  <div class="card card-auth">
   <div class="card-header text-start">
  <h1 class="h4 m-0">Log In</h1>
</div>

    <div class="card-body">
      <form method="post" action="login.php" class="text-start" novalidate>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required placeholder="Please enter your email">
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required placeholder="Please enter your password">
        </div>

        <?php if (!empty($errors)): ?>
          <div class="alert alert-danger">
              <?php foreach($errors as $e): ?>
                <p class="mb-0"><?= $e ?></p>
              <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <div class="d-grid">
          <button class="request" >LOGIN</button>
        </div>
      </form>

      <hr>
      <p class="text-center small mb-0">Don't have an account? <a href="register.php">Register Now</a></p>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
