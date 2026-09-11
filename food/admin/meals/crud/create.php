<?php
include('../../validate/validate.php');
include('../../connection/connection.php');

$errors=[];
$done='';

if (isset($_POST['upload']) || $_SERVER["REQUEST_METHOD"]=="POST") {
    $name  = validate_input($_POST["name"]);
    $desc  = validate_input($_POST["desc"]);
    $price = validate_input($_POST["price"]);

    $targetDir = "../images/";
    $fileName = basename($_FILES["image"]["name"]);
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // اسم الصورة الجديد (نربطه بالـ name عشان يكون مميز)
    $newFileName = $name . "." . $fileType;
    $targetFilePath = $targetDir . $newFileName;

    $allowedTypes = ['jpg','jpeg','png','gif','webp'];

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            echo "✅ تم رفع الصورة بنجاح!<br>";
            echo "<img src='$targetFilePath' width='300'>";
            $image = $newFileName; // نحفظ الاسم الجديد فقط
        } else {
            echo "❌ حدث خطأ أثناء رفع الملف.";
        }
    }

    if(empty($errors)){
        $query = $connect->query("INSERT INTO meals (name, `desc`, price, image) 
                                  VALUES ('$name', '$desc', '$price','$image')");
        $done='Added Successfully ...!';
    }
}
?>
<?php
include ('../layouts/header.php');
?>
<div class="emp-form-container">
        <h1 class="emp-form-title">Add Employee</h1>
        <?php
        if(!empty($errors)){?>
        <div class="alert alert-danger">
        <ul>
        <?php foreach($errors as $error){ ?>
            <li><?php echo $error ;?></li>
        <?php } ?>
        </ul></div>
        <?php    
        } else {
            if(!empty($done)){ ?>
            <div class="alert alert-success">
                <ul>
                    <li><?php echo $done; ?></li>
                </ul>
            </div>
        <?php }} ?>

        <form method="post" action="" enctype="multipart/form-data">
            <div class="emp-form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="emp-form-group">
                <label>Description</label>
                <input type="text" name="desc" required>
            </div>

            <div class="emp-form-group">
                <label>Price</label>
                <input type="text" name="price" required>
            </div>

            <div class="emp-form-group">
                <label>Image</label>
                <input type="file" name="image" required>
            </div>

            <button type="submit" name="upload">Add meal</button>
        </form>
</div>

<?php
include ("../layouts/footer.php");
?>