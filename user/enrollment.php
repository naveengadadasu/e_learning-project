<?php
// Start the session
session_start();

// Include the connection file
include 'connection.php';

// Check if the course ID is provided in the URL
if (isset($_GET['course_id'])) {
    // Retrieve the course details from the database
    $course_id = $_GET['course_id'];
    $sql = "SELECT * FROM coursetb WHERE course_id = $course_id"; // Modify 'id' to your actual primary key column name
    $result = mysqli_query($conn, $sql);
    
    // Check if the query executed successfully
    if ($result) {
        // Check if any rows are returned
        if (mysqli_num_rows($result) > 0) {
            $course = mysqli_fetch_assoc($result);
        } else {
            // Redirect if the course is not found
            header("Location: courses.php");
            exit();
        }
    } else {
        // Handle SQL query error
        echo "Error: " . mysqli_error($conn);
        exit();
    }
} else {
    // Redirect if no course ID is provided
    header("Location: enrollment.php");
    exit();
}

// Process the payment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pay_now'])) {
    // Check if the student is already enrolled in the course
    $student_id = $_SESSION['user_id']; // Assuming user_id is the student's ID from the session
    $check_enrollment_sql = "SELECT * FROM enrollmenttb WHERE student_id = $student_id AND course_id = $course_id";
    $check_enrollment_result = mysqli_query($conn, $check_enrollment_sql);
    
    if ($check_enrollment_result && mysqli_num_rows($check_enrollment_result) > 0) {
        // If the student is already enrolled, display a dialogue box
        echo "<script>alert('You are already enrolled in this course.');</script>";
    } else {
        // If the student is not enrolled, proceed with the payment
        // Dummy payment processing
        // Here you can simulate the payment process, update the database, etc.
        
        // For demonstration purposes, let's assume the payment is successful
        
        // Insert enrollment data into enrollmenttb
        $price = $course['price']; // Price of the course
        $date = date('Y-m-d H:i:s'); // Current date and time
        
        $insert_sql = "INSERT INTO enrollmenttb (student_id, course_id, price, date) VALUES ('$student_id', '$course_id', '$price', '$date')";
        
        if (mysqli_query($conn, $insert_sql)) {
            // Enrollment data inserted successfully
            
            // Redirect to a success page
            header("Location: mycourses.php");
            exit();
        } else {
            // Handle SQL query error
            echo "Error: " . mysqli_error($conn);
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - E-Learning</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Add your custom styles here */
        .card {
            text-align: center;
            background-color: #f8f9fa; /* Add your desired background color */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add a subtle shadow for depth */
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $course['title']; ?></h5>
                        <p class="card-text"><?php echo $course['description']; ?></p>
                        <p class="card-text">Price: $<?php echo $course['price']; ?></p>
                        <form method="post" id="paymentForm">
                            <!-- Add your payment form fields here -->
                            <button type="button" id="confirmPayment" class="btn btn-primary">Confirm Payment</button>
                            <button type="submit" name="pay_now" id="payNowBtn" class="btn btn-primary" style="display: none;">Pay Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        document.getElementById('confirmPayment').addEventListener('click', function() {
            var confirmPayment = confirm('Confirm Payment?');
            if (confirmPayment) {
                document.getElementById('payNowBtn').click(); // Trigger form submission
            } else {
                // Redirect to enrollment.php
                window.location.href = 'enrollment.php';
            }
        });
    </script>
</body>
</html>
