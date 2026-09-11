<?php 
include ('header.php');
include('../connection/connection.php');
$result = $connect->query("SELECT * FROM meals");
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

    .btns .show_btn {
        background-color: #3498db;
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
    .request {
      background: rgba(102, 21, 21, 1);
      color: white;
      margin-top: 10px;
      border: 1px solid rgba(102, 21, 21, 1);
      border-radius: 20px;
      padding: 6px 12px;
      cursor: pointer;
      transition: 0.3s;
    }
    .request:hover {
      background: green;
      border: 1px solid green;
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
  <div style="display: flex;
  justify-content: flex-end; /* يخليها ناحية اليمين */
  gap: 12px;"><button style="margin-top:10px;margin-right:10px; color:white; background:rgba(102, 21, 21, 1);font-family:'Poppins', sans-serif;border:0px ;padding:5px 10px;border-radius:4px;">Add new meal</button></div>
<div class="container mt-4">
  <div class="row">
    <?php if($connect){ ?>
      <?php foreach($data as $meal){ ?>
        <div class="col-md-3 mb-4">
          <div class="card">
            <img src="images/<?php echo $meal['image']; ?>" alt="meal">
            <h3 style="margin-top:10px;"><?php echo $meal["name"]; ?></h3>
            <p><?php echo $meal["desc"]; ?></p>
            <div id="price"><b style="color:black;"><?php echo $meal["price"]; ?> EGP</b></div>
            <div class="btns">
                <a class="edit_btn" href="crud/edit.php?id=<?php echo $meal ["id"] ?>">Edit</a>
                <a class="delete_btn" href="crud/delete.php?id=<?php echo $meal ["id"] ?>">Delete</a>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
  </div>
</div>
<script>
  document.querySelectorAll('.delete_btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
      if (!confirm("Are you sure you want to delete this meal?")) {
        e.preventDefault(); // يمنع تنفيذ الحذف
      }
    });
  });
</script>
</body>
</html>

      <?php
include ("../layouts/footer.php");
?>