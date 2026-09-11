<?php
session_start();
include('../connection/connection.php');
include('../meals/header.php');
include('../session.user.php');



if (isset($_POST['update_qty']) && isset($_POST['quantity'])) {
  $meal_id = $_POST['id'];
  $new_qty = max(1, intval($_POST['quantity']));
  foreach ($_SESSION['cart'] as &$item) {
    if ($item['id'] == $meal_id) {
      $item['quantity'] = $new_qty;
      $_SESSION['message'] = "Quantity updated successfully!";
      break;
    }
  }
  unset($item);
}



if (isset($_POST['remove_id'])) {
  $remove_id = $_POST['remove_id'];

  foreach ($_SESSION['cart'] as $key => $item) {
    if ($item['id'] == $remove_id) {
      unset($_SESSION['cart'][$key]);
      $_SESSION['cart'] = array_values($_SESSION['cart']);
      $_SESSION['message'] = "The product has been successfully removed from the cart";
      break;
    }
  }
}



$all_total = 0;
if (isset($_SESSION['cart'])) {
  foreach ($_SESSION['cart'] as $item) {
    $all_total += $item['price'] * $item['quantity'];
  }
}



if (isset($_POST['confirm_order'])) {
  if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    try {
      $total = 0;
      foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
      }

      if ($total <= 0) {
        $_SESSION['message'] = "Cart is empty, cannot place order!";
        header("Location: cart.php");
        exit;
      }

      $user_id = $_SESSION['id'] ;

      $stmt = $connect->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
      $stmt->execute([$user_id, $total]);

      $order_id = $connect->lastInsertId();

      $stmt_item = $connect->prepare("INSERT INTO order_items (order_id, meal_id, quantity, price) VALUES (?, ?, ?, ?)");
      foreach ($_SESSION['cart'] as $item) {
        $stmt_item->execute([$order_id, $item['id'], $item['quantity'], $item['price']]);
      }

      unset($_SESSION['cart']);
      $_SESSION['message'] = "Your order has been placed successfully!";
    } catch (Exception $e) {
      $_SESSION['message'] = "Error: " . $e->getMessage();
    }
  } else {
    $_SESSION['message'] = "Your cart is empty!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Shopping Cart - Restaurant</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <style>

    .table thead {
      background-color: #f8d7da;
    }

    .table th,
    .table td {
      text-align: center;
      vertical-align: middle;
    }

    .btn-confirm {
      background-color: #28a745;
      border-color: #28a745;
      color: #fff;
    }

    .btn-confirm:hover {
      background-color: #218838;
      border-color: #1e7e34;
      color: #fff;
    }
  </style>
</head>

<body>

  <div class="container my-5">

    <?php if (isset($_SESSION['message'])): ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message'];
        unset($_SESSION['message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <div class="card shadow">
      <div class="card-body">
        <h3 class="mb-4 text-danger">Your Cart</h3>
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
          <table class="table table-bordered align-middle text-center">
            <thead>
              <tr>
                <th>Meal</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($_SESSION['cart'] as $item): ?>
                <tr>
                  <td><?php echo $item['name']; ?></td>
                  <td><?php echo $item['price']; ?> EGP</td>
                  <td>
                    <form method="post" style="display:inline;">
                      <input type="hidden" name="id" value="<?= $item['id']; ?>">
                      <input type="number"
                        name="quantity"
                        value="<?= $item['quantity']; ?>"
                        min="1"
                        class="form-control"
                        style="width:80px; display:inline-block;"
                        onchange="this.form.submit()">
                      <input type="hidden" name="update_qty" value="1">
                    </form>
                  </td>
                  <td><?= $item['price'] * $item['quantity']; ?> EGP</td>
                  <td>
                    <form method="post" action="cart.php" style="display:inline;">
                      <input type="hidden" name="remove_id" value="<?php echo $item['id']; ?>">
                      <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <h4 class="text-center">Total: <span class="text-danger"><?php echo $all_total; ?> EGP</span></h4>

          <div class="text-center mt-3">
            <form method="post" action="">
              <button style="height:50px"ype="submit" name="confirm_order" class="request">Confirm Order</button>
            </form>
          </div>

        <?php else: ?>
          <h3 class="text-center text-muted">Your cart is empty.</h3>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script>
    function showMessage(message, type) {
      const alertPlaceholder = document.getElementById('alert-placeholder') || document.body;
      const wrapper = document.createElement('div');
      wrapper.innerHTML = `
        <div class="alert alert-${type} alert-dismissible fade show mt-3" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
      alertPlaceholder.prepend(wrapper);
    }
  </script>

</body>

</html>

<?php include("../layouts/footer.php"); ?>