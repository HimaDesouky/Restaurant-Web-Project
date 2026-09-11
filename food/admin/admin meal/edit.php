<?php
include('../validate/validate.php');
include('../connection/connection.php');
include('../session.admin.php');

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../login.php");
    exit();
}

    $errors=[];
    $done='';
    if($_SERVER["REQUEST_METHOD"]=="GET"){

        $id=$_GET["id"];
        
        $result=$connect->query("SELECT * FROM `meals` where id=$id");
        $emp_inf=$result->fetch(PDO::FETCH_ASSOC);
        
    // var_dump($emp_inf);
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $id=validate_input($_POST["id"]);
        $name=validate_input($_POST["name"]);
        $image=validate_input($_POST["image"]);
        $price=validate_input($_POST["price"]);
        $description=validate_input($_POST["description"]);
        $is_dropped=validate_input($_POST["is_dropped"]);

        $result=$connect->query("SELECT name FROM meals Where id != $id");
        $datas=$result->fetchAll(PDO::FETCH_ASSOC);
                
        if(!validate_u_name($name)){
            $errors[]="invalid name";
        }
        
        foreach($datas as $data){
            foreach($data as $inf){
                if($inf==$name){
                    $errors[]="the name is allardy taken ...!";
                    break;
                }
            }
        }
        if($price<=0){
            $errors[]='price must be greater than 0 ..!';
        }
        // if(!isFloat($is_dropped)){
        //     $errors[]="invalid Meal type";
        // }
    
    
        if(empty($errors)){
            $original_path='../../' . $image;
            $parts = explode('.', $image);
            $ext = end($parts);
            $new_filename='images/'.$name.'.'.$ext;
            $new_path = '../../' . $new_filename;
            rename($original_path, $new_path);
            $query = $connect->query("UPDATE meals SET name='$name', price='$price', image='$new_filename', description='$description' where id='$id'");
            $done='Edited Successfully ...!';
        }
         
        $result=$connect->query("SELECT * FROM `meals` where id=$id");
        $emp_inf=$result->fetch(PDO::FETCH_ASSOC);

    // var_dump($data);
    }

?>

<!-- include ('../layouts/header.php'); -->

 <head>

</head>
<?php
include ('../employees/header.php');
?>
<link rel="stylesheet" href="../layouts/form_style.css">
<!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../home/home.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page"><a href="show.php">Meals</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Meal</li>
        </ol>
      </nav> -->
<button class="request"><a style="color:white;text-decoration:none;" href="../home/home.php">home</a></button>
<button class="request"><a style="color:white;text-decoration:none;" href="show.php">all meals</a></button>
<div class="emp-form-container">
        <h1 class="emp-form-title">Edit Meal</h1>
        <?php
        if(!empty($errors)){?>
        <div class="alert alert-danger">
        <ul>
        <?php
        
            foreach($errors as $error){?>
            <li><?php echo $error ;?></li>
           <?php
            }
            ?>
        </ul></div>
        <?php    
        }
        else{
            if(!empty($done)){
            ?>
            <div class="alert alert-success">
                <ul>
                    <li><?php echo $done; ?></li>
                </ul>
                </div>
       <?php
        }}
        ?>
        <form method="post" action="#" id="employeeForm">
            
        <input type="hidden" name="id" value="<?php echo $id?>">
        <input type="hidden" name="image" value="<?php echo $emp_inf["image"]?>">
       
            <div class="emp-form-group">
                <label for="empName" class="emp-form-label emp-required">Meal's Name</label>
                <input type="text" value="<?php echo $emp_inf['name']; ?>" name="name" id="empName" class="emp-form-input" placeholder="Enter full name" required>
            </div>

            <div class="emp-form-row">
                
                <div class="emp-form-group">
                    <label for="empPhone" class="emp-form-label emp-required">Price</label>
                    <input type="number" value="<?php echo $emp_inf['price']; ?>" name="price" id="empPhone" class="emp-form-input" placeholder="+1234567890" required>
                </div>
            </div>
            <div class="emp-form-row">
                <div class="emp-form-group">
                    <label for="empPosition" class="emp-form-label emp-required">Description</label>
                    <input type="text" name="description" id="empPosition" value="<?php echo $emp_inf['description']; ?>" class="emp-form-input" placeholder="" required>
                </div>
</div>


            <!-- </div> -->

            <div class="emp-form-group">
            <label for="empDepartment" class="emp-form-label emp-required">Meal Type</label>
                    <select name="is_dropped" id="empDepartment" class="emp-form-select" required>
                        <option value="">Select Meal Type</option>
                        <?php
                        if($emp_inf['is_dropped']==1){
                            ?>
                            <option selected value="1">Dropped</option>
                            <option value="0">Undropped</option>
                            <?php
                        }
                        
                        else{
                            ?>
                            <option value="1">Dropped</option>
                            <option selected value="0">Undropped</option>
                            <?php
                        }
                        ?>
                        
                        
                    </select>
            </div>

            <center><button type="submit" class="request" style="width:90%">edit meal</button></center>
        </form>
    </div>

    <script>
        
    </script>

<?php
include ("../layouts/footer.php");
?>