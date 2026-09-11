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
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $name=validate_input($_POST["name"]);
        $price=validate_input($_POST["price"]);
        $description=validate_input($_POST["description"]);
        $is_dropped=validate_input($_POST["is_dropped"]);
        $image=$_FILES["image"];
        $img_name=$image["name"];
        $temp_name=$image["tmp_name"];
        $ext=pathinfo($img_name,PATHINFO_EXTENSION);
        
        $allowed_ext=["jpg","png","jpeg"];

        $result=$connect->query('SELECT name FROM meals');
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
        
        if(!in_array($ext,$allowed_ext)){
            $errors[]="Please enter a valid img (.jpg, .png , .jpeg) ...!";
        }
        // if(!isFloat($is_dropped)){
        //     $errors[]="invalid Meal's Type";
        // }
    
        if(empty($errors)){
            $new_filename='images/'.$name.'.'.$ext;
            $target_path = '../../' . $new_filename;
            move_uploaded_file($temp_name, $target_path);
           $query = $connect->query("INSERT INTO meals (name, price, image,description) VALUES ('$name', '$price', '$new_filename','$description')");
            $done='Added Successfully ...!';
        }
         
    
    // var_dump($data);
    }

?>
<?php
include ('../employees/header.php');
?>

<link rel="stylesheet" href="../layouts/form_style.css">
<!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../home/home.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page"><a href="show.php">Meals</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Meal</li>
        </ol>
      </nav> -->
      <button class="request"><a style="color:white;text-decoration:none;" href="../home/home.php">home</a></button>
<button class="request"><a style="color:white;text-decoration:none;" href="show.php">all meals</a></button>
<div class="emp-form-container">
        <h1 class="emp-form-title">Add Meal</h1>
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
        <form method="post" enctype="multipart/form-data" action="#" id="employeeForm">

            <div class="emp-form-group">
                <label for="empName" class="emp-form-label emp-required">Meal's Name</label>
                <input type="text" name="name" id="empName" class="emp-form-input" placeholder="Enter Meal's name" required>
            </div>

            <div class="emp-form-row">
                <div class="emp-form-group">
                    <label for="empPosition" class="emp-form-label emp-required">Price</label>
                    <input type="number" name="price" id="empPosition" class="emp-form-input" placeholder="0.00" required>
                </div>
</div>
            <div class="emp-form-row">
                <div class="emp-form-group">
                    <label for="empPosition" class="emp-form-label emp-required">Description</label>
                    <input type="text" name="description" id="empPosition" class="emp-form-input" placeholder="" required>
                </div>
</div>
            <div class="emp-form-row">
                <!-- <div class="emp-form-group">
                    <label for="empEmail" class="emp-form-label emp-required">Email</label>
                    <input type="email" id="empEmail" class="emp-form-input" placeholder="email@company.com" required>
                </div> -->
                <div class="emp-form-group">
                    <label for="empPhone" class="emp-form-label emp-required">Image</label>
                    <input type="file" name="image" id="empPhone" class="emp-form-input" placeholder="" required>
                </div>
            

            
                <!-- <div class="emp-form-group">
                    <label for="empDepartment" class="emp-form-label emp-required">Department</label>
                    <select id="empDepartment" class="emp-form-select" required>
                        <option value="">Select Department</option>
                        <option value="hr">HR</option>
                        <option value="it">IT</option>
                        <option value="finance">Finance</option>
                        <option value="marketing">Marketing</option>
                    </select>
                </div> -->
            </div>

            <div class="emp-form-group">
            <label for="empDepartment" class="emp-form-label emp-required">Meal's Type</label>
                    <select name="is_dropped" id="empDepartment" class="emp-form-select" required>
                        <option value="">Select Meal Type</option>
                        <option value="1">Dropped</option>
                        <option value="0">Undropped</option>
                        
                    </select>
                </div>

            <center><button type="submit" class="request" style="width:80%">Add Meal</button></center>
        </form>
    </div>

    <script>
        
    </script>

<?php
include ("../layouts/footer.php");
?>