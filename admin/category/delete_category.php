<?php
// Include database connection file
include '../connection.php';

// Check if category ID is set in the URL
if(isset($_GET['id'])) {
    // Sanitize the category ID to prevent SQL injection
    $categoryId = $_GET['id'];
    
    // Construct the DELETE query
    $sql = "DELETE FROM categorytb WHERE category_id = $categoryId";
    
    // Execute the DELETE query
    $result = $conn->query($sql);
    
    // Check if deletion was successful
    if($result) {
        // Redirect to the display_category.php page after deletion
        header("Location: display_category.php");
        exit();
    } else {
        // Handle deletion error
        echo "Error deleting category: " . $conn->error;
    }
} else {
    // Redirect to an error page if category ID is not provided
    header("Location: error_page.php");
    exit();
}
?>
