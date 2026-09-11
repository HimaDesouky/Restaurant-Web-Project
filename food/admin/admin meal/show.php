<?php
include('../connection/connection.php');
include('../session.admin.php');

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../login.php");
    exit();
}

$employee=$connect->query('SELECT * FROM meals');
$data=$employee->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
include ('../employees/header.php');
?>
<head>
  
</head>

<!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../home/home.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Meals</li>
        </ol>
      </nav> -->
<button class="request"><a style="color:white;text-decoration:none;" href="../home/home.php">home</a></button>
<button class="request"><a style="color:white;text-decoration:none;" href="show.php">all meals</a></button>
      <!-- Data Table -->
<center>      <div class="d-flex justify-content-between align-items-center mb-4" style="width:80%;">
        <h1 class="h3 mb-0">Meals</h1>
      <button class="request"><a style="color:white;text-decoration:none;" href="create.php">add meals</a></button>

        <!-- <a href="create.php" class="btn btn-primary">
          <i class="fas fa-plus me-2"></i> Add Meal
        </a> -->
      </div></center>
      <center><div class="card" style="width:90%;" >
        <div class="card-header">
          <h5 class="card-title mb-0">Meal Records</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="studentTable">
              <thead>
                <tr>
                  
                  <th>Id</th>
                  <th>Name</th>
                  
                  <th>price</th>
                  <th>Description</th>
                  <th>Image</th>
                  
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
                    <td><?php echo $inf["price"]?></td>
                    <td><?php echo $inf["description"]?></td>
                    <td><img height="50px" src="<?php echo '../../' . $inf["image"] ?>" alt=""></td>
                  <td style="display: flex;  ">

                    <div style="height: 50px;">       
                    </div>

                    <form action="undrop.php">
                        <?php
                        if($inf['is_dropped']==1){?>
                        <input type="hidden" name="id" value="<?php echo $inf['id']?>">
                    <button type="submit" class="btn btn-sm btn-outline-primary me-1">
                      <i class="fas fa-eye"></i> Undrop
                    </button>
                        <?php
                        }
                        ?>
                      </form>
                    <form action="drop.php">
                        <?php
                        if($inf['is_dropped']==0){?>
                        <input type="hidden" name="id" value="<?php echo $inf['id']?>">
                    <button type="submit" class="btn btn-sm btn-outline-danger me-1">
                      <i class="fas fa-eye"></i> drop
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
                    $result=$connect->query("SELECT COUNT(*) as count FROM order_items where meal_id={$inf['id']}");
                    $meal=$result->fetch(PDO::FETCH_ASSOC);
                    if($meal['count']==0){
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