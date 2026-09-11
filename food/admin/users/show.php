<?php
include('../connection/connection.php');
include('../session.admin.php');

$employee=$connect->query('SELECT * FROM users');
$data=$employee->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
include ('../employees/header.php');
?>
 <head>
 
</head>
<button class="request"><a style="color:white;text-decoration:none;" href="../home/home.php">home</a></button>

<!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../home/home.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
      </nav> -->
      <!-- Data Table -->
      <center><div class="d-flex justify-content-between align-items-center mb-4" style="width:80%;margin-top:10px;">
        <h1 class="h3 mb-0">Users</h1>
<button class="request"><a style="color:white;text-decoration:none;" href="create.php">add user</a></button>
        
      </div></center>
<center>      <div class="card" style="width:90%;">
        <div class="card-header">
          <h5 class="card-title mb-0">Student Records</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="studentTable">
            <?php
              if(isset($_GET['msg'])&&!empty($_GET['msg'])){
                ?>
                <div class="alert alert-danger">
                  <ul>
                    <li><?php echo $_GET['msg'] ?></li>
                  </ul>
                </div>

             <?php 
             $_GET['msg']='';
             }
             
              ?>
              <thead>
                <tr>
                  
                  <th>Id</th>
                  <th>Name</th>
                  
                  <th>Email</th>
                  <th>Acount Type</th>
                  
                  <th>Actions</th>
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
                    
                  <td style="display: flex;">
                  <form action="set_user.php">
                        <?php
                        if($inf['is_admin']==1){?>
                        <input type="hidden" name="id" value="<?php echo $inf['id']?>">
                    <button type="submit" class="btn btn-sm btn-outline-primary me-1">
                      <i class="fas "></i> Set as User
                    </button>
                        <?php
                        }
                        ?>
                      </form>
                    <form action="set_admin.php">
                        <?php
                        if($inf['is_admin']==0){?>
                        <input type="hidden" name="id" value="<?php echo $inf['id']?>">
                    <button type="submit" class="btn btn-sm btn-outline-danger me-1">
                      <i class="fas "></i> Set as Admin
                    </button>
                        <?php
                        }
                        ?>
                      </form>
                    <form action="edit.php">
                    <input type="hidden" name="id" value="<?php echo $inf['id']?>">
                      <button type="submit" class="btn btn-sm btn-outline-success me-1">
                      <i class="fas fa-edit"></i> Edit
                    </button>
                    </form>
                    <?php
                    $result=$connect->query("SELECT COUNT(*) as count FROM orders where user_id={$inf['id']}");
                    $meal=$result->fetch(PDO::FETCH_ASSOC);
                    if($meal['count']==0&&$_SESSION['id']!=$inf['id']){
                      ?>
                      
                      <form action="delete.php">
                    <input type="hidden" name="id" value="<?php echo $inf['id']?>">
                    <button type="submit" class="btn btn-sm btn-outline-danger delete">
                      <i class="fas fa-trash"></i> Delete
                    </button>
                    </form>
                      <?php
                    }
                    ?>
                    </td>
                </tr>
                <?php
            }
            ?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div></center>
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