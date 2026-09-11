<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords" content="admin dashboard, bootstrap 5 admin, responsive dashboard" />
  <meta name="description" content="Modern Admin Dashboard" />
  <title>My orders</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="admin_style.css">
  </head>
<body>
  <!-- Sidebar
  <div id="sidebar">
    <div class="sidebar-header">
      <h3><i class="fas fa-tachometer-alt"></i> Admin Panel</h3>
      <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-chevron-left"></i>
      </button>
    </div>
    <div class="sidebar-menu">
      <ul>
        <li>
          <a href="../home/home.php" class="active">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#" data-bs-toggle="collapse" data-bs-target="#employees-menu" aria-expanded="false" class="has-arrow">
            <i class="fas fa-users"></i>
            <span>Employees</span>
          </a>
          <ul id="employees-menu" class="collapse sidebar-dropdown">
            <li><a href="../employees/admin.php"><i class="fas fa-list"></i><span>All Employees</span></a></li>
            <li><a href="../employees/create.php"><i class="fas fa-plus-circle"></i><span>Add Employee</span></a></li>
          </ul>
        </li>
        <li>
          <a href="#" data-bs-toggle="collapse" data-bs-target="#Users-menu" aria-expanded="false" class="has-arrow">
            <i class="fas fa-users"></i>
            <span>Users</span>
          </a>
          <ul id="Users-menu" class="collapse sidebar-dropdown">
            <li><a href="../users/show.php"><i class="fas fa-list"></i><span>All Users</span></a></li>
            <li><a href="../users/create.php"><i class="fas fa-plus-circle"></i><span>Add User</span></a></li>
          </ul>
        </li>
        <li>
          <a href="#" data-bs-toggle="collapse" data-bs-target="#departments-menu" aria-expanded="false" class="has-arrow">
            <i class="fas fa-sitemap"></i>
            <span>Meals</span>
          </a>
          <ul id="departments-menu" class="collapse sidebar-dropdown">
            <li><a href="#"><i class="fas fa-list"></i><span>All Meals</span></a></li>
            <li><a href="#"><i class="fas fa-plus-circle"></i><span>Add Meal</span></a></li>
          </ul>
        </li>
        <li>
          <a href="#">
            <i class="fas fa-chart-bar"></i>
            <span>Reports</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
          </a>
        </li>
      </ul>
    </div>
  </div> -->

  <!-- Main Content -->
  <div id="content">
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom px-3" style="background:rgba(102, 21, 21, 1);" >
    <!-- Logo -->
      <i class="fa-solid fa-utensils" style="color:black ;font-size:40px; margin-left:20px; background:rgba(235, 206, 206, 1);padding:8px;border-radius:30px;"></i>

    <!-- Toggle for mobile -->
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item" style="padding-right:10px;">
          <a style="color:white;" class="nav-link" href="#"><i class="fas fa-user me-2"></i>Profile</a>
        </li>
        <li class="nav-item" style="padding-right:10px;">
          <a style="color:white;" class="nav-link" href="../meals/meals.php"><i class="fa-solid fa-cart-shopping me-2"></i>Main page</a>
        </li>
        <li class="nav-item" style="padding-right:10px;">
            <a style="color:white;" class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping me-2"></i>Cart</a>
        </li>
        <li class="nav-item" style="padding-right:10px;">
          <a style="color:white;" class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>