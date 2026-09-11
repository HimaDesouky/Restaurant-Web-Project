<?php
session_start();
include('../connection/connection.php');

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../login.php");
    exit();
}


$result=$connect->query('SELECT COUNT(*) as count FROM meals');
$meal=$result->fetch(PDO::FETCH_ASSOC);

$result=$connect->query('SELECT COUNT(*) as count,SUM(salary) as salary FROM employees');
$emp=$result->fetch(PDO::FETCH_ASSOC);

$result=$connect->query('SELECT COUNT(*) as count FROM users WHERE is_admin=0');
$user=$result->fetch(PDO::FETCH_ASSOC);

$result=$connect->query('SELECT COUNT(*) as count FROM users WHERE is_admin=1');
$admin=$result->fetch(PDO::FETCH_ASSOC);

$result = $connect->query("SELECT COUNT(*) as count FROM meals WHERE is_dropped=0");
$undrop=$result->fetch(PDO::FETCH_ASSOC);

$result = $connect->query("SELECT COUNT(*) as count FROM meals WHERE is_dropped=1");
$drop=$result->fetch(PDO::FETCH_ASSOC);

$result=$connect->query('SELECT COUNT(*) as count FROM meals');


$result=$connect->query('SELECT COUNT(*) as count FROM orders');
$order=$result->fetch(PDO::FETCH_ASSOC);

?>
<head>
  <style>
        .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      margin-bottom: 20px;
    }

    .card-header {
      background: white;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      padding: 15px 20px;
      border-radius: 10px 10px 0 0 !important;
    }

    .card-title {
      font-weight: 600;
      margin: 0;
      color: var(--secondary);
    }
    .stats-card {
      text-align: center;
      padding: 20px;
    }

    .stats-card i {
      font-size: 2rem;
      margin-bottom: 15px;
      color: var(--primary);
    }

    .stats-card h3 {
      font-size: 1.8rem;
      margin: 10px 0;
      color: var(--secondary);
    }

    .stats-card p {
      color: #6c757d;
      margin: 0;
    }

    .card i{
      color:#1D2B53;
    }
  </style>
</head>
<?php include ('../employees/header.php'); ?>

<button class="request">
  <a style="color:white;text-decoration:none;" href="#">home</a>
</button>

<center>
  <div class="row mb-4" style="margin-top:10px; width:80%;text-align:center;">
    <div class="col-md-3">
      <div class="card stats-card" style="padding-top:10px;margin-bottom:10px;">
        <i class="fas fa-users"></i>
        <h3><?php echo $emp['count'] ?></h3>
        <p>Total Employees</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card stats-card" style="padding-top:10px;margin-bottom:10px;">
        <i class="fas fa-users"></i>
        <h3><?php echo $admin['count'] ?></h3>
        <p>Total Admin</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card stats-card" style="padding-top:10px;margin-bottom:10px;">
        <i class="fas fa-users"></i>
        <h3><?php echo $user['count'] ?></h3>
        <p>Total Customers</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card stats-card" style="padding-top:10px;margin-bottom:10px;">
        <i class="fas fa-egg"></i>
        <h3><?php echo $meal['count'] ?></h3>
        <p>Total Meals</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card stats-card" style="padding-top:10px;margin-bottom:10px;">
        <i class="fas fa-egg"></i>
        <h3><?php echo $drop['count'] ?></h3>
        <p>Total Dropped Meals</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card stats-card" style="padding-top:10px;margin-bottom:10px;">
        <i class="fas fa-egg"></i>
        <h3><?php echo $undrop['count'] ?></h3>
        <p>Total Undropped Meals</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card stats-card" style="padding-top:10px;margin-bottom:10px;">
        <i class="fas fa-cart-shopping"></i>
        <h3><?php echo $order['count'] ?></h3>
        <p>Total Orders</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card stats-card" style="padding-top:10px;margin-bottom:10px;">
        <i class="fas fa-wallet"></i>
        <h3><?php echo number_format($emp['salary'],2) ?></h3>
        <p>Total Salary</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card stats-card" style="padding-top:10px;margin-bottom:10px;">
        <i class="fas fa-chart-line"></i>
        <h3><?php echo number_format($emp['salary'] / $emp['count'],2) ?></h3>
        <p>Average Salary</p>
      </div>
    </div>
  </div>
</center>

<?php include ("../layouts/footer.php"); ?>
