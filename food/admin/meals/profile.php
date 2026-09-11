<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require "../connection/connection.php";
if(!isset($_SESSION['email']) &&  $_SESSION['is_admin'] == 0) { // ده بتاعت ان ال user ميتحرك ب ال url و تتحط في كل الصفح تقريبا 
  header("location:login.php") ;
          exit() ;
} 
if(isset($_SESSION["id"])){
$id=$_SESSION["id"];
$data = $connect->query("SELECT * FROM users where id=$id");
$result = $data->fetch(PDO::FETCH_ASSOC);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $newName = $_POST['name'];
  if (!empty($newName)) {
      $st = $connect->prepare("UPDATE users SET name = :n WHERE id = :id");
      $st->execute([
          ':n' => $newName,
          ':id' => $id   // الـid بتاع المستخدم اللي عامل لوجين
      ]);
  }
  $newPass = $_POST['new_password'];
if (!empty($newPass)) {
    $st = $c->prepare("UPDATE users SET password = :np WHERE id = :id");
    $st->execute([
        ':np' => $newPass,
        ':id' => $id,
    ]);
}
}
// 1) هات الطلبات للمستخدم الحالي
$st = $connect->prepare("SELECT id, request_status, total_price, created_at FROM orders
  WHERE user_id = :id ");

$st->execute([':id' => $id]);
$orders=$st->fetchAll(PDO::FETCH_ASSOC);

// 2) هات تفاصيل كل طلب (items + meal name)
$itemStmt = $connect->prepare("SELECT 
  quantity, price, meals.name
  FROM order_items
  JOIN meals ON meals.id= order_items.meal_id
  WHERE order_items.order_id = :oid
");

// foreach ($orders as $order) {
//     $itemStmt->execute([':oid' => $order['id']]);
//     $order_items[$order['id']] = $itemStmt->fetchAll(PDO::FETCH_ASSOC);
// }



?>
<?php
include ('../meals/header.php');
?>


  

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">

</nav>
<div>
</div>
<!-- Profile Content -->
<div class="container profile-box">
  <div class="card card-auth mb-4">
    <div class="card-header">
      <h1 class="h4 m-0">Profile</h1>
    </div>
    <div class="card-body">
      <p><strong>Name:</strong> <?php echo $result['name'] ?> </p>
      <p><strong>Email:</strong> <?php echo $result['email']?> </p>
    </div>
  </div>
  <!-- Edit Profile Form -->
  <!-- <div class="card card-auth">
    <div class="card-header">
      <h2 class="h5 m-0">Edit Profile</h2>
    </div>
    <div class="card-body">
      <form method="post" action="user.php" style="margin-bottom:10px;">
          <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" value="">
        </div>
        <div class="mb-3">
          <label class="form-label">Change Password (Optional)</label>
          <input type="password" name="new_password" class="form-control" placeholder="••••••">
          <div class="form-hint">Leave it blank if you don't want to change it</div>
        </div>
        </div>
        <div class="d-grid">
          <center><button class="request" style="width:90%">Save Changes</button></center>
        </div>
      </form>
        <br>

    </div>
  </div> -->
</div>
<br>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>