<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courseId = $_POST['courseId'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $categoryId = $_POST['categoryId'];

    // Update only if a new image is uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $img_loc = $_FILES['image']['tmp_name'];
        $img_name = $_FILES['image']['name'];
        $img_des = "../course_uploads/".$img_name;
        move_uploaded_file($img_loc,'../course_uploads/'.$img_name);

        // Update course data with new image
        $sql = "UPDATE coursetb SET title='$title', description='$description', price='$price', category_id='$categoryId', image='$img_des' WHERE course_id=$courseId";
    } else {
        // Update course data without changing the image
        $sql = "UPDATE coursetb SET title='$title', description='$description', price='$price', category_id='$categoryId' WHERE course_id=$courseId";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: display_course.php");
        exit;
    } else {
        echo "Error updating course: " . mysqli_error($conn);
    }
}
?>
