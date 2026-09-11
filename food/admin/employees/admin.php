<?php
include('../connection/connection.php');
include('../session.admin.php');

$employee=$connect->query('SELECT * FROM employees');
$data=$employee->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
include ('header.php');
?>
<head>
  
</head>
<button class="request"><a style="color:white;text-decoration:none;" href="../home/home.php">home</a></button>


<nav aria-label="breadcrumb">

      </nav>
      <!-- Data Table -->
<center>
      <center><div class="d-flex justify-content-between align-items-center mb-4" style="width:80%;margin-top:10px;">
        <h1 class="h3 mb-0">Employee</h1>
<button class="request"><a style="color:white;text-decoration:none;" href="create.php">add Employee</a></button>
        
      </div></center>
      <div class="card" style="width:80%;text-align:center;">
        <div class="card-header">
          <h5 class="card-title mb-0">Empolyee Records</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="studentTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  
                  <th>Phone</th>
                  <th>Salary</th>
                  <th>Position</th>
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
                    <td><?php echo $inf["phone"]?></td>
                    <td><?php echo $inf["salary"]?></td>
                    <td><?php echo $inf["position"]?></td>
                    
                  <td style="display: flex;">
                    
                    <form action="edit.php">
                    <input type="hidden" name="id" value="<?php echo $inf['id']?>">
                      <button type="submit" class="btn btn-sm btn-outline-success me-1">
                      <i class="fas fa-edit"></i> Edit
                    </button>
                    </form>
                    <form action="delete.php">
                    <input type="hidden" name="id" value="<?php echo $inf['id']?>">
                    <button type="submit" class="btn btn-sm btn-outline-danger delete">
                      <i class="fas fa-trash"></i> Delete
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