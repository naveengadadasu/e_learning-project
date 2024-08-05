<?php
include '../connection.php';
// Check if category ID is provided in the URL
if(isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    
    // Fetch category data from database based on ID
    $sql = "SELECT * FROM categorytb WHERE category_id = $categoryId";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $categoryName = $row['c_name'];
        $description = $row['description'];
        // Image path is not directly editable, so no need to pre-fill image field
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Head content here -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
  <h2>Edit Category</h2>
  <div class="row">
    <div class="col-md-6">
      <form action="update_category.php" method="post" enctype="multipart/form-data">
        <!-- Hidden field to store category ID for update operation -->
        <input type="hidden" name="categoryId" value="<?php echo $categoryId; ?>">

        <!-- Pre-filled Category Name field -->
        <div class="mb-3">
          <label for="categoryName" class="form-label">Category Name</label>
          <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?php echo $categoryName; ?>" required>
        </div>

        <!-- Pre-filled Description field -->
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" name="description" rows="3"><?php echo $description; ?></textarea>
        </div>

        <!-- Image Upload field (not pre-filled) -->
        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <input type="file" class="form-control" id="image" name="image">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
</div>



<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
