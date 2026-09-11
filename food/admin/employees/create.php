<?php
include('../validate/validate.php');
include('../connection/connection.php');
include('../session.admin.php');

    $errors=[];
    $done='';
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $name=validate_input($_POST["name"]);
        $phone=validate_input($_POST["phone"]);
        $position=validate_input($_POST["position"]);
        $salary=validate_input($_POST["salary"]);
        
        $result=$connect->query('SELECT phone FROM employees');
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
           $query = $connect->query("INSERT INTO employees (name, phone, position,salary) VALUES ('$name', '$phone', '$position','$salary')");
            $done='Added Successfully ...!';
        }
         
    
    // var_dump($data);
    }

?>
<?php
include ('header.php');
?>
<link rel="stylesheet" href="../layouts/form_style.css">
 <head>

</head>
<button class="request"><a style="color:white;text-decoration:none;" href="../home/home.php">home</a></button>
<button class="request"><a style="color:white;text-decoration:none;" href="admin.php">all employees</a></button>


<!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../home/home.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page"><a href="admin.php">Employees</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Employee</li>
        </ol>
      </nav> -->
<div class="emp-form-container">
        <h1 class="emp-form-title">Add Employee</h1>
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

            <div class="emp-form-group">
                <label for="empName" class="emp-form-label emp-required">Full Name</label>
                <input type="text" name="name" id="empName" class="emp-form-input" placeholder="Enter full name" required>
            </div>

            <div class="emp-form-row">
                <!-- <div class="emp-form-group">
                    <label for="empEmail" class="emp-form-label emp-required">Email</label>
                    <input type="email" id="empEmail" class="emp-form-input" placeholder="email@company.com" required>
                </div> -->
                <div class="emp-form-group">
                    <label for="empPhone" class="emp-form-label emp-required">Phone</label>
                    <input type="tel" name="phone" id="empPhone" class="emp-form-input" placeholder="+1234567890" required>
                </div>
            </div>

            <div class="emp-form-row">
                <div class="emp-form-group">
                    <label for="empPosition" class="emp-form-label emp-required">Position</label>
                    <input type="text" name="position" id="empPosition" class="emp-form-input" placeholder="Job position" required>
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
                <input type="number" name="salary" id="empSalary" class="emp-form-input" placeholder="0.00" step="0.01" required>
            </div>

            <center><button type="submit" class="request" style="width:80%">Add Employee</button></center>
        </form>
    </div>

    <script>
        
    </script>

<?php
include ("../layouts/footer.php");
?>