<?php
// Include database connection file
include '../connection.php';

// Check if course ID is set in the URL
if(isset($_GET['id'])) {
    // Sanitize the course ID to prevent SQL injection
    $courseId = $_GET['id'];
    
    // Construct the DELETE query
    $sql = "DELETE FROM coursetb WHERE course_id = $courseId";
    
    // Execute the DELETE query
    $result = $conn->query($sql);
    
    // Check if deletion was successful
    if($result) {
        // Redirect to the display_course.php page after deletion
        header("Location: display_course.php");
        exit();
    } else {
        // Handle deletion error
        echo "Error deleting course: " . $conn->error;
    }
} else {
    // Redirect to an error page if course ID is not provided
    header("Location: error_page.php");
    exit();
}
?>
