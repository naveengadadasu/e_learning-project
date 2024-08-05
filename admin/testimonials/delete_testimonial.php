<?php
// Include database connection file
include '../connection.php';

// Check if testimonial ID is set in the URL
if(isset($_GET['id'])) {
    // Sanitize the testimonial ID to prevent SQL injection
    $testimonialId = $_GET['id'];
    
    // Construct the DELETE query
    $sql = "DELETE FROM testimonials WHERE testimonial_id = $testimonialId";
    
    // Execute the DELETE query
    $result = $conn->query($sql);
    
    // Check if deletion was successful
    if($result) {
        // Redirect to the display_testimonial.php page after deletion
        header("Location: display_testiomonial.php");
        exit();
    } else {
        // Handle deletion error
        echo "Error deleting testimonial: " . $conn->error;
    }
} else {
    // Redirect to an error page if testimonial ID is not provided
    header("Location: error_page.php");
    exit();
}
?>
