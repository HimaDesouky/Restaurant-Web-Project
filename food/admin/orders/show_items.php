<?php
include('../connection/connection.php');
include('../session.admin.php');

$id=$_POST['id'];
$employee=$connect->query("SELECT m.id,m.name,m.image,m.price,o.quantity,o.price as total_price FROM order_items as o JOIN meals as m on o.meal_id=m.id WHERE o.order_id=$id");
$data=$employee->fetchAll(PDO::FETCH_ASSOC);
$employee=$connect->query("SELECT total_price FROM orders WHERE id=$id");
$total_price=$employee->fetch(PDO::FETCH_ASSOC);
?>
<?php
include ('../employees/header.php');
?>

<!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../home/home.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page"><a href="show.php">Orders</a></li>
          <li class="breadcrumb-item active" aria-current="page">Show items</li>
        </ol>
      </nav> -->
      <!-- Data Table -->
    
      <button class="request"><a style="color:white;text-decoration:none;" href="../home/home.php">home</a></button>
      <button class="request"><a style="color:white;text-decoration:none;" href="show.php">All Orders</a></button>
      
<!-- <button class="request"><a style="color:white;text-decoration:none;" href="show.php">all meals</a></button> -->
      <!-- <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Meals</h1>
        
      </div> -->
      <br>
<center>
        <div class="card" style="margin-top:10px;width:90%;">
        <div class="card-header">
          <h5 class="card-title mb-0">Meal Records</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="">
              <thead>
                <tr>
                  <th>Meal Id</th>
                  <th>Meal Name</th>     
                  <th>Meal price</th>
                  <th>Meal Image</th>
                  <th>Quntity</th>
                  <th>Total Price</th>
                </tr>
              </thead>
              <tbody>
              <?php
            foreach($data as $inf){
                ?>
                <tr>
                    <td><?php echo $inf["id"]?></td>
                    <td><?php echo $inf["name"]?></td>
                    <td><?php echo $inf["price"]?></td>
                    <td><img height="50px" src="<?php echo '../../' . $inf["image"] ?>" alt=""></td>
                    <td><?php echo $inf["quantity"]?></td>
                    <td><?php echo $inf["total_price"]?></td>  </tr>
                <?php
            }
            ?>
            <tr>
                <td colspan="4"></td>
                <td colspan="">Total Price</td>
                <td colspan=""><?php echo $total_price['total_price'] ?></td>
            </tr>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
</center>
      <script>
                const detecte= document.querySelectorAll(".delete");
                for(i=0;i<detecte.length;i++){
                    detecte[i].onclick = (e)=>{
                        var conf=confirm("are you sure ...?");
                        if(!conf){
                            e.preventDefault();
                        }
                    }
                }
            </script>
<?php
include ("../layouts/footer.php");
?>