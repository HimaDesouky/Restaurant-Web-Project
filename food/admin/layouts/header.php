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
  <link rel="stylesheet" href="../layouts/admin_style.css">
</head>
<body>
  <!-- Sidebar -->
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
  </div>

  <!-- Main Content -->
  <div id="content">
    <!-- Navbar -->
    <nav class="navbar navbar-custom">
      <div class="container-fluid">
        <button class="mobile-toggle" id="mobileToggle">
          <i class="fas fa-bars"></i>
        </button>
        <div class="ms-auto">
          <div class="dropdown">
            <a class="dropdown-toggle d-flex align-items-center text-decoration-none" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img height="45px" src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" alt="user" class="rounded-circle me-2">
              <span class="d-none d-md-inline">Admin</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
              <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container-fluid py-4">
      <!-- Breadcrumb -->
      

      <!-- Page Title -->
      

      <!-- Stats Cards -->
      <!-- <div class="row mb-4">
        <div class="col-md-3">
          <div class="card stats-card">
            <i class="fas fa-users"></i>
            <h3>156</h3>
            <p>Total Students</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card stats-card">
            <i class="fas fa-user-graduate"></i>
            <h3>124</h3>
            <p>Active Students</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card stats-card">
            <i class="fas fa-book"></i>
            <h3>12</h3>
            <p>Departments</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card stats-card">
            <i class="fas fa-chart-line"></i>
            <h3>94%</h3>
            <p>Success Rate</p>
          </div>
        </div>
      </div> -->
