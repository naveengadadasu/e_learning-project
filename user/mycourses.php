<?php
// Start the session
session_start();

// Include the connection file
include 'connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve the student's ID from the session
$student_id = $_SESSION['user_id'];

// Retrieve enrolled courses for the student including their titles, descriptions, and images
$sql = "SELECT coursetb.title, coursetb.description, coursetb.image FROM enrollmenttb 
        INNER JOIN coursetb ON enrollmenttb.course_id = coursetb.course_id 
        WHERE enrollmenttb.student_id = $student_id";
$result = mysqli_query($conn, $sql);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - E-Learning</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Adjust card size */
        .card {
            max-width: 18rem; /* Set the maximum width for medium-sized cards */
        }
        .footer {
            background-color: #99ccff;
            padding: 50px 0;
            text-align: center;
        }
        .social-icons a {
            margin: 0 10px;
            color: #007bff; /* Change color as needed */
        }
        .testimonial {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 style="text-align:center;">My Courses</h1>
                <?php if (mysqli_num_rows($result) > 0) : ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <div class="card mx-auto mb-3"> <!-- Added 'mx-auto' to center align the cards -->
                            <img src="../admin/course_uploads/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['title']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <a href="#" class="btn btn-primary">Watch Now</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>No courses enrolled yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php  include 'testimonial.php'; ?>
    <?php include 'footer.php';?>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
