<?php
session_start();
include('../meals/header.php');
include('../connection/connection.php');
include('../session.user.php');


$user_id = $_SESSION['id'] ;

$stmt = $connect->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }
    h2 {
        color: rgba(102, 21, 21, 1);;
        text-align:left;
        margin-bottom: 30px;
    }
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    .card-header {
        background-color: red;
        color: white;
        font-weight: bold;
    }
    table {
        text-align: center;
    }
    th {
        background-color: #f5f5f5;
    }

    .card-header {
    background-color:#1D2B53; 
    color: white;
    font-weight: bold;
}

</style>
</head>
<body>

<div class="container my-4">
    <h1>My Orders</h1>

    <?php if($orders): ?>
    <?php foreach($orders as $order): ?>
        <div class="card mb-4 shadow-sm">
        <div class="card-header">Order #<?php echo $order['id']; ?>
            <span class="float-end">Total: <?php echo $order['total_price']; ?> EGP</span>
        </div>
        <div class="card-body">
            <h6 style="color:red;">Order Details:</h6>
            <table class="table table-bordered mt-3">
            <thead>
            <tr>
                <th>Meal</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
                <?php $stmt_items = $connect->prepare("
                SELECT oi.*, m.name FROM order_items oi JOIN meals m ON oi.meal_id = m.id WHERE oi.order_id = ?");
                $stmt_items->execute([$order['id']]);
                $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

            foreach($items as $item): ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['price']; ?> EGP</td>
                    <td><?php echo $item['quantity']; ?></td>
                  <td><?php echo $item['price'] * $item['quantity']; ?> EGP</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="alert alert-info text-center">You have no orders yet.</div>
<?php endif; ?>
</div>

</body>
</html>

