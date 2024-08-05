<?php
// Include database connection file
include '../connection.php';

// Check if student ID is set in the URL
if(isset($_GET['id'])) {
    // Sanitize the student ID to prevent SQL injection
    $studentId = $_GET['id'];
    
    // Construct the DELETE query
    $sql = "DELETE FROM studenttb WHERE student_id = $studentId";
    
    // Execute the DELETE query
    $result = $conn->query($sql);
    
    // Check if deletion was successful
    if($result) {
        // Redirect to the display_students.php page after deletion
        header("Location: display_student.php");
        exit();
    } else {
        // Handle deletion error
        echo "Error deleting student: " . $conn->error;
    }
} else {
    // Redirect to an error page if student ID is not provided
    header("Location: error_page.php");
    exit();
}
?>
