<?php 
session_start();
include ('../meals/header.php');
include('../connection/connection.php');

// لو المستخدم ضغط على Add to cart
if(isset($_POST['add_to_cart'])){
    $meal_id = $_POST['meal_id'];
    $meal_name = $_POST['meal_name'];
    $meal_price = $_POST['meal_price'];
    $quantity = 1;

    // لو الكارت مش فاضي
    if(isset($_SESSION['cart'])){
        $item_ids = array_column($_SESSION['cart'], 'id');
        if(in_array($meal_id, $item_ids)){
            // لو المنتج موجود نزود الكمية
            foreach($_SESSION['cart'] as &$item){
                if($item['id'] == $meal_id){
                    $item['quantity'] += 1;
                }
            }
        } else {
            // لو مش موجود نضيفه جديد
            $_SESSION['cart'][] = [
                'id' => $meal_id,
                'name' => $meal_name,
                'price' => $meal_price,
                'quantity' => $quantity
            ];
        }
    } else {
        // أول مرة نضيف cart
        $_SESSION['cart'][] = [
            'id' => $meal_id,
            'name' => $meal_name,
            'price' => $meal_price,
            'quantity' => $quantity
        ];
    }
}

// نجيب كل الوجبات
$result = $connect->query("SELECT * FROM meals WHERE is_dropped=0");
$data = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meals</title>
  <style>
    .btns {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 12px; 
      padding: 10px;
    }
    .btns a {
      display: flex;
      padding: 6px 12px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      color: #fff;
      font-size: 14px;
      transition: 0.3s;
    }
    .btns .edit_btn {
      background-color: #f1c40f;
      color: #333;
    }
    .btns .delete_btn {
      background-color: #e74c3c;
    }
    .btns a:hover {
      opacity: 0.85;
      transform: scale(1.05);
    }
    
    
    .card {
      border-radius: 15px;
      padding: 15px;
      text-align: center;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
      transition: transform 0.2s ease;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 12px;
    }
  </style>
</head>
<body>
<div class="container mt-4">
  <div class="row">
    <?php if($connect){ ?>
      <?php foreach($data as $meal){ ?>
        <div class="col-md-3 mb-4">
          <div class="card">
            <!-- الصورة -->
            <img src="<?php echo "../../". $meal['image']; ?>" alt="meal"
                onerror="this.onerror=null;this.src='https://via.placeholder.com/200x180?text=No+Image';">

            <h3 style="margin-top:10px;"><?php echo $meal["name"]; ?></h3>
            <p><?php echo $meal["description"]; ?></p>
            <div id="price"><b style="color:black;"><?php echo $meal["price"]; ?> EGP</b></div>

            <!-- لو عايز ازرار Add to Cart -->
            <form method="POST">
              <input type="hidden" name="meal_id" value="<?php echo $meal['id']; ?>">
              <input type="hidden" name="meal_name" value="<?php echo $meal['name']; ?>">
              <input type="hidden" name="meal_price" value="<?php echo $meal['price']; ?>">
              
              <button type="submit" name="add_to_cart" class="request">Add to cart</button>
            </form>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
  </div>
</div>
</body>
</html>

<?php include ("../layouts/footer.php"); ?>
