
<?php

include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $categoryName = $_POST['categoryName'];
    $description = $_POST['description'];
    $image = $_FILES['image'];
    print_r($_FILES['image']);
    $img_loc = $_FILES['image']['tmp_name'];
    $img_name = $_FILES['image']['name'];
    $img_des = "../category_uploads/".$img_name;
    move_uploaded_file($img_loc,'../category_uploads/'.$img_name);

    $res= mysqli_query($conn,"INSERT INTO `categorytb`( `c_name`, `description`, `image`) VALUES ('$categoryName','$description','$img_des')");
    if ($res) {
                header("Location: display_category.php");
                exit;
            } else {
                echo "Error: " . $stmt->errorInfo()[2];
            }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Bootstrap Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
  <h2>Category Form</h2>
  <form action="" method="post" enctype="multipart/form-data">


    <!-- Category Name -->
    <div class="mb-3">
      <label for="categoryName" class="form-label">Category Name</label>
      <input type="text" class="form-control" id="categoryName" name="categoryName" required>
    </div>

    <!-- Description -->
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>

    <!-- Image Upload -->
    <div class="mb-3">
      <label for="image" class="form-label">Image</label>
      <input type="file" class="form-control" id="image" name="image">
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
