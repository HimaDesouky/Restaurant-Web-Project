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
  <link rel="stylesheet" href="../meals/admin_style.css">
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
<nav class="navbar navbar-expand-lg navbar-custom px-3" style="background:#1D2B53;">
    <!-- Logo -->
      <i class="fa-solid fa-utensils" style="color:black ;font-size:40px; margin-left:20px; background:aqua;padding:8px;border-radius:30px;"></i>

    <!-- Toggle for mobile -->
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item" style="padding-right:10px;">
          <a style="color:white;" class="nav-link" href="../meals/meals.php"><i class="fa-solid fa-cart-shopping me-2"></i>meals</a>
        </li>
        <li class="nav-item" style="padding-right:10px;">
          <a style="color:white;" class="nav-link" href="../meals/profile.php"><i class="fas fa-user me-2"></i>Profile</a>
        </li>
        <li class="nav-item" style="padding-right:10px;">
          <a style="color:white;" class="nav-link" href="../cart/cart.php"><i class="fa-solid fa-cart-shopping me-2"></i>Cart</a>
        </li>
        <li class="nav-item" style="padding-right:10px;">
          <a style="color:white;" class="nav-link" href="../cart/myorders.php"><i class="fa-solid fa-cart-shopping me-2"></i>my orders</a>
        </li>
        <li class="nav-item" style="padding-right:10px;">
          <a style="color:white;" class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
 