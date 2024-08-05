<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryId = $_POST['categoryId'];
    $categoryName = $_POST['categoryName'];
    $description = $_POST['description'];

    // Update only if a new image is uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $img_loc = $_FILES['image']['tmp_name'];
        $img_name = $_FILES['image']['name'];
        $img_des = "../category_uploads/".$img_name;
        move_uploaded_file($img_loc,'../category_uploads/'.$img_name);

        // Update category data with new image
        $sql = "UPDATE categorytb SET c_name='$categoryName', description='$description', image='$img_des' WHERE category_id=$categoryId";
    } else {
        // Update category data without changing the image
        $sql = "UPDATE categorytb SET c_name='$categoryName', description='$description' WHERE category_id=$categoryId";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: display_category.php");
        exit;
    } else {
        echo "Error updating category: " . mysqli_error($conn);
    }
}
?>
