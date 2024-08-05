<?php
include '../connection.php';

// Check if course ID is provided in the URL
if(isset($_GET['id'])) {
    $courseId = $_GET['id'];
    
    // Fetch course data from database based on ID
    $sql = "SELECT * FROM coursetb WHERE course_id = $courseId";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $categoryId = $row['category_id'];
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
  <h2>Edit Course</h2>
  <div class="row">
    <div class="col-md-6">
      <form action="update_course.php" method="post" enctype="multipart/form-data">
        <!-- Hidden field to store course ID for update operation -->
        <input type="hidden" name="courseId" value="<?php echo $courseId; ?>">

        <!-- Pre-filled Title field -->
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
        </div>

        <!-- Pre-filled Description field -->
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" name="description" rows="3"><?php echo $description; ?></textarea>
        </div>

        <!-- Price -->
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>" required>
        </div>

        <!-- Category ID (Assuming you have a dropdown for category selection) -->
        <div class="mb-3">
          <label for="categoryId" class="form-label">Category</label>
          <select class="form-select" id="categoryId" name="categoryId" required>
            <!-- Populate options dynamically from database -->
            <?php
            $categoryQuery = mysqli_query($conn, "SELECT * FROM categorytb");
            while ($row = mysqli_fetch_assoc($categoryQuery)) {
                $selected = ($row['category_id'] == $categoryId) ? "selected" : "";
                echo "<option value='" . $row['category_id'] . "' $selected>" . $row['c_name'] . "</option>";
            }
            ?>
          </select>
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
