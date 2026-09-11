<?php
include('../connection/connection.php');
include('../session.admin.php');

$get_id=$_POST['id'];
$employee=$connect->query("SELECT * FROM users WHERE id=$get_id");
$data=$employee->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
include ('../employees/header.php');
?>
      <button class="request"><a style="color:white;text-decoration:none;" href="../home/home.php">home</a></button>
      <button class="request"><a style="color:white;text-decoration:none;" href="show.php">All Orders</a></button>
      <!-- Data Table -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Users</h1>
        
      </div>
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">User Records</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="studentTable">
              <thead>
                <tr>
                  
                  <th>Id</th>
                  <th>Name</th>
                  
                  <th>Email</th>
                  <th>Acount Type</th>
                  
                  
                </tr>
              </thead>
              <tbody>
              <?php
            foreach($data as $inf){
                ?>
                <tr>
                    <td><?php echo $inf["id"]?></td>
                    <td><?php echo $inf["name"]?></td>
                    <td><?php echo $inf["email"]?></td>
                    <?php
                    if($inf["is_admin"]==1){
                        ?>
                        <td>Admin</td>
                        <?php
                    }
                    else{
                        ?>
                        <td>User</td>
                        <?php
                    }
                    ?>
                    
                    
                    
                  
                </tr>
                <?php
            }
            ?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
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