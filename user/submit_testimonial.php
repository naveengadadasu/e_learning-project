<?php
// Start the session
session_start();

// Include the connection file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // Retrieve the student ID from the session
        $student_id = $_SESSION['user_id'];
        
        // Sanitize and validate the input
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        // Insert the testimonial into the database
        $sql = "INSERT INTO testimonials (student_id, message) VALUES ('$student_id', '$message')";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Please log in to submit a testimonial.";
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
