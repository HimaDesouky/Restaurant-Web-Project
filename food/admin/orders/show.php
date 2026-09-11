<?php
include('../connection/connection.php');
include('../session.admin.php');

$employee=$connect->query('SELECT * FROM orders');
$data=$employee->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
include ('../employees/header.php');
?>
 
      <button class="request"><a style="color:white;text-decoration:none;" href="../home/home.php">home</a></button>
<!-- <button class="request"><a style="color:white;text-decoration:none;" href="show.php">all orders</a></button> -->
<!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../home/home.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Orders</li>
        </ol>
      </nav> -->
      <!-- Data Table -->
      <!-- <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Users</h1>
        <a href="create.php" class="btn btn-primary">
          <i class="fas fa-plus me-2"></i> Add User
        </a>
      </div> -->
<center>
        <div class="card" style="margin-top:10px;width:90%">
        <div class="card-header">
          <h5 class="card-title mb-0">Order Records</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="studentTable">
              <thead>
                <tr>
                  
                  <th>Order Id</th>
                  <th>User Id</th>
                  <th>Order Price</th>
                  
                  <th>Request Status</th>
                  
                  
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php
            foreach($data as $inf){
                ?>
                <tr>
                    <td><?php echo $inf["id"]?></td>
                    <td><?php echo $inf["user_id"]?></td>
                    <td><?php echo $inf["total_price"]?></td>
                    <td><?php echo $inf["request_status"]?></td>
                    
                    
                    
                    
                  <td style="display: flex;">
                    <form action="show_user.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $inf['user_id']?>">
                    <button type="submit" class="btn btn-sm btn-outline-primary me-1">
                      <i class="fas fa-eye"></i> Show User Information
                    </button></form>
                    <form action="show_items.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $inf['id']?>">
                      <button type="submit" class="btn btn-sm btn-outline-success me-1">
                      <i class="fas fa-eye"></i> Show Items of Order 
                    </button>
                    </form>
                    
                    </td>
                </tr>
                <?php
            }
            ?>
                
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