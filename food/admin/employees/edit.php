<?php
include('../validate/validate.php');
include('../connection/connection.php');
include('../session.admin.php');

    $errors=[];
    $done='';
    if($_SERVER["REQUEST_METHOD"]=="GET"){

        $id=$_GET["id"];
        
        $result=$connect->query("SELECT * FROM `employees` where id=$id");
        $emp_inf=$result->fetch(PDO::FETCH_ASSOC);
        
    // var_dump($emp_inf);
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $id=validate_input($_POST["id"]);
        $name=validate_input($_POST["name"]);
        $phone=validate_input($_POST["phone"]);
        $position=validate_input($_POST["position"]);
        $salary=validate_input($_POST["salary"]);


        $result=$connect->query("SELECT * FROM `employees` where id=$id");
        $emp_inf=$result->fetch(PDO::FETCH_ASSOC);


        $result=$connect->query("SELECT phone FROM employees Where id != $id");
        $datas=$result->fetchAll(PDO::FETCH_ASSOC);
        
        
        if(!validate_u_name($name)){
            $errors[]="invalid name";
        }
        if(!validatephone($phone)){
            $errors[]="invalid phone";
        }
        foreach($datas as $data){
            foreach($data as $inf){
                if($inf==$phone){
                    $errors[]="the Phone is allardy taken ...!";
                    break;
                }
            }
        }
        // if(!isFloat($salary)){
        //     $errors[]="invalid salary";
        // }
    
        if(empty($errors)){
            $query = $connect->query("UPDATE employees SET name='$name', phone='$phone', position='$position',salary='$salary' where id='$id'");
            $done='Edited Successfully ...!';
        }
         
        $result=$connect->query("SELECT * FROM `employees` where id=$id");
        $emp_inf=$result->fetch(PDO::FETCH_ASSOC);

    // var_dump($data);
    }

?>
<?php
include ('header.php');
?>
<head>
  
</head>
<link rel="stylesheet" href="../layouts/form_style.css">
<button class="request"><a style="color:white;text-decoration:none;" href="../home/home.php">home</a></button>
<button class="request"><a style="color:white;text-decoration:none;" href="admin.php">all employees</a></button>
<!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../home/home.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page"><a href="admin.php">Employees</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Employee</li>
        </ol>
      </nav> -->
<div class="emp-form-container">
        <h1 class="emp-form-title">Edit Employee</h1>
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
       
            <div class="emp-form-group">
                <label for="empName" class="emp-form-label emp-required">Full Name</label>
                <input type="text" value="<?php echo $emp_inf['name']; ?>" name="name" id="empName" class="emp-form-input" placeholder="Enter full name" required>
            </div>

            <div class="emp-form-row">
                <!-- <div class="emp-form-group">
                    <label for="empEmail" class="emp-form-label emp-required">Email</label>
                    <input type="email" id="empEmail" class="emp-form-input" placeholder="email@company.com" required>
                </div> -->
                <div class="emp-form-group">
                    <label for="empPhone" class="emp-form-label emp-required">Phone</label>
                    <input type="tel" value="<?php echo $emp_inf['phone']; ?>" name="phone" id="empPhone" class="emp-form-input" placeholder="+1234567890" required>
                </div>
            </div>

            <div class="emp-form-row">
                <div class="emp-form-group">
                    <label for="empPosition" class="emp-form-label emp-required">Position</label>
                    <input type="text" value="<?php echo $emp_inf['position']; ?>" name="position" id="empPosition" class="emp-form-input" placeholder="Job position" required>
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
                <label for="empSalary" class="emp-form-label emp-required">Salary</label>
                <input type="number" value="<?php echo $emp_inf['salary']; ?>" name="salary" id="empSalary" class="emp-form-input" placeholder="0.00" step="0.01" required>
            </div>

            <center><button type="submit" class="request" style="width:80%">Edit Employee</button></center>

        </form>
    </div>

    <script>
        
    </script>

<?php
include ("../layouts/footer.php");
?>