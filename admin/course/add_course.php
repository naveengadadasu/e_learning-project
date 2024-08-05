<?php

include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image'];
    $price = $_POST['price'];
    $categoryId = $_POST['categoryId']; // Assuming you have a dropdown for category selection
    $img_loc = $_FILES['image']['tmp_name'];
    $img_name = $_FILES['image']['name'];
    $img_des = "../course_uploads/".$img_name;
    move_uploaded_file($img_loc,'../course_uploads/'.$img_name);

    $res= mysqli_query($conn,"INSERT INTO `coursetb`(`title`, `description`, `image`, `price`, `category_id`) VALUES ('$title','$description','$img_des','$price','$categoryId')");
    if ($res) {
        header("Location: display_course.php");
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
  <h2>Course Form</h2>
  <form action="" method="post" enctype="multipart/form-data">

    <!-- Title -->
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title" required>
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

    <!-- Price -->
    <div class="mb-3">
      <label for="price" class="form-label">Price</label>
      <input type="text" class="form-control" id="price" name="price" required>
    </div>

    <!-- Category ID (Assuming you have a dropdown for category selection) -->
    <div class="mb-3">
      <label for="categoryId" class="form-label">Category</label>
      <select class="form-select" id="categoryId" name="categoryId" required>
        <!-- Populate options dynamically from database -->
        <?php
        $categoryQuery = mysqli_query($conn, "SELECT * FROM categorytb");
        while ($row = mysqli_fetch_assoc($categoryQuery)) {
            echo "<option value='" . $row['category_id'] . "'>" . $row['c_name'] . "</option>";
        }
        ?>
      </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
