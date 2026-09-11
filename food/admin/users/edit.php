<?php
include('../validate/validate.php');
include('../connection/connection.php');
include('../session.admin.php');

    $errors=[];
    $done='';
    if($_SERVER["REQUEST_METHOD"]=="GET"){

        $id=$_GET["id"];
        
        $result=$connect->query("SELECT * FROM `users` where id=$id");
        $emp_inf=$result->fetch(PDO::FETCH_ASSOC);
        
    // var_dump($emp_inf);
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $id=validate_input($_POST["id"]);
        $name=validate_input($_POST["name"]);
        $email=validate_input($_POST["email"]);
        $old_password=validate_input($_POST["old_password"]);
        $password=validate_input($_POST["password"]);
        $conf_password=validate_input($_POST["conf_password"]);
        $is_admin=validate_input($_POST["is_admin"]);


        $result=$connect->query("SELECT * FROM `users` where id=$id");
        $emp_inf=$result->fetch(PDO::FETCH_ASSOC);


        $result=$connect->query("SELECT email FROM users Where id != $id");
        $datas=$result->fetchAll(PDO::FETCH_ASSOC);
        
        $result=$connect->query("SELECT password FROM users Where id = $id");
        $pass=$result->fetch(PDO::FETCH_ASSOC);

        if(!validate_u_name($name)){
            $errors[]="invalid name";
        }
        
        foreach($datas as $data){
            foreach($data as $inf){
                if($inf==$email){
                    $errors[]="the email is allardy taken ...!";
                    break;
                }
            }
        }
        if($pass['password']!=md5($old_password)){
            $errors[]="the old password is incorrect ...!";
        }
        if(strlen($password)<6){
            $errors[]="password must be at least 6 character ...!";
        }
        if($password!=$conf_password){
            $errors[]="confirm Your Password Correctlly ...!";
        }
        if(!isFloat($is_admin)){
            $errors[]="invalid admin";
        }
    
    
        if(empty($errors)){
            $password=md5($password);
            $query = $connect->query("UPDATE users SET name='$name', email='$email', password='$password',is_admin='$is_admin' where id='$id'");
            $done='Edited Successfully ...!';
        }
         
        $result=$connect->query("SELECT * FROM `users` where id=$id");
        $emp_inf=$result->fetch(PDO::FETCH_ASSOC);


    // var_dump($data);
    }

?>
<?php
include ('../employees/header.php');
?>
<link rel="stylesheet" href="../layouts/form_style.css">

<button class="request"><a style="color:white;text-decoration:none;" href="../home/home.php">home</a></button>
<button class="request"><a style="color:white;text-decoration:none;" href="show.php">all users</a></button>
      
<div class="emp-form-container">
        <h1 class="emp-form-title">Edit User</h1>
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
                        <label for="empPhone" class="emp-form-label emp-required">email</label>
                        <input type="tel" value="<?php echo $emp_inf['email']; ?>" name="email" id="empPhone" class="emp-form-input" placeholder="+1234567890" required>
                    </div>
                </div>
    
                <div class="emp-form-row">
                    <div class="emp-form-group">
                        <label for="empPosition" class="emp-form-label emp-required">Old password</label>
                        <input type="password" value="" name="old_password" id="empPosition" class="emp-form-input" placeholder="Old Password" required>
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
                <div class="emp-form-row">
                    <div class="emp-form-group">
                        <label for="empPosition" class="emp-form-label emp-required">password</label>
                        <input type="password" value="" name="password" id="empPosition" class="emp-form-input" placeholder="New Password" required>
                    </div>
                    
                </div>
                <div class="emp-form-row">
                    <div class="emp-form-group">
                        <label for="empPosition" class="emp-form-label emp-required">Confirm password</label>
                        <input type="password" value="" name="conf_password" id="empPosition" class="emp-form-input" placeholder="Confirm Password" required>
                    </div>
                    
                </div>
    
                <div class="emp-form-group">
                <label for="empDepartment" class="emp-form-label emp-required">Acount Type</label>
                        <select name="is_admin" id="empDepartment" class="emp-form-select" required>
                            <option value="">Select Acount Type</option>
                            <?php
                            if($emp_inf['is_admin']==1){
                                ?>
                                <option selected value="1">Admin</option>
                                <option value="0">User</option>
                                <?php
                            }
                            
                            else{
                                ?>
                                <option value="1">Admin</option>
                                <option selected value="0">User</option>
                                <?php
                            }
                            ?>
                            
                            
                        </select>
                </div>
    
                <center><button type="submit" class="request" style="width:90%">Edit user</button></center>
            </form>
    </div>

    <script>
        
    </script>

<?php
include ("../layouts/footer.php");
?>