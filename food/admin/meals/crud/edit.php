<?php
include('../../validate/validate.php');
include('../../connection/connection.php');

$errors = [];
$done   = '';
$meal   = null;

// جلب بيانات الوجبة عند الفتح (GET)
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = (int) $_GET["id"];
    $result = $connect->query("SELECT * FROM meals WHERE id=$id");
    $meal = $result->fetch(PDO::FETCH_ASSOC);
}

// تحديث بيانات الوجبة (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id    = $_POST["id"];
    $name  = $_POST["name"];
    $price = $_POST["price"];
    $desc  = $_POST["desc"];
    $image=$_POST["image"];

    // صورة جديدة؟
    if (!empty($_FILES["image"]["name"])) {
        $imageName  = time() . "_" . basename($_FILES["image"]["name"]);
        $targetPath = "../../admin/images/" . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath);

        $query = $connect->prepare("UPDATE meals SET name=?, price=?, `desc`=?, image=? WHERE id=?");
        $query->execute([$name, $price, $desc, $imageName, $id]);
    } else {
        $query = $connect->prepare("UPDATE meals SET name=?, price=?, `desc`=? WHERE id=?");
        $query->execute([$name, $price, $desc, $id]);
    }

    $done = "Meal updated successfully!";

    // جلب البيانات بعد التحديث
    $result = $connect->query("SELECT * FROM meals WHERE id=$id");
    $meal = $result->fetch(PDO::FETCH_ASSOC);
}
?>

<?php include ('../layouts/header.php'); ?>
<link rel="stylesheet" href="../layouts/form_style.css">

<div class="emp-form-container">
    <h1 class="emp-form-title">Edit Meal</h1>

    <?php if(!empty($errors)){ ?>
        <div class="alert alert-danger"><ul>
        <?php foreach($errors as $error){ echo "<li>$error</li>"; } ?>
        </ul></div>
    <?php } elseif(!empty($done)){ ?>
        <div class="alert alert-success"><ul><li><?php echo $done; ?></li></ul></div>
    <?php } ?>

<form method="post" action="../admin.php" id="employeeForm" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $meal['id']; ?>">

    <div class="emp-form-group">
        <label for="empName" class="emp-form-label emp-required">Meal Name</label>
        <input type="text" value="<?php echo htmlspecialchars($meal['name']); ?>" 
               name="name" id="empName" class="emp-form-input" 
               placeholder="Enter meal name" required>
    </div>

    <div class="emp-form-group">
        <label for="empPrice" class="emp-form-label emp-required">Price</label>
        <input type="number" value="<?php echo htmlspecialchars($meal['price']); ?>" 
               name="price" id="empPrice" class="emp-form-input" 
               placeholder="0.00" step="0.01" required>
    </div>

    <div class="emp-form-group">
        <label for="empDesc" class="emp-form-label">Description</label>
        <textarea name="desc" id="empDesc" class="emp-form-input" 
                  placeholder="Meal description"><?php echo htmlspecialchars($meal['desc']); ?></textarea>
    </div>

    <!-- الصورة الحالية -->
    <div class="emp-form-group">
        <label>Current Image:</label><br>
        <?php if(!empty($meal['image'])){ ?>
            <img src="../images/<?php echo $meal['image']; ?>" alt="meal" width="150" style="border-radius:8px; margin-top:5px;">
        <?php } else { ?>
            <p>No image available</p>
        <?php } ?>
    </div>

    <!-- رفع صورة جديدة + معاينة -->
    <div class="emp-form-group">
        <label for="mealImage" class="emp-form-label">Upload New Image</label>
        <input type="file" name="image" id="mealImage" class="emp-form-input" accept="image/*" onchange="previewImage(event)">
        <div style="margin-top:10px;">
        <img src="images/<?php echo $meal['image']; ?>" alt="meal" width="150" style="border-radius:8px; margin-top:5px;">
        </div>
    </div>

    <button type="submit" class="emp-form-btn">Edit Meal</button>
</form>
</div>

<script>
function previewImage(event){
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('newImagePreview');
        output.src = reader.result;
        output.style.display = "block";
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

<?php include ("../layouts/footer.php"); ?>
