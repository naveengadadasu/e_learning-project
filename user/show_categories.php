<?php
// Start the session
if (!isset($_SESSION)) {
    session_start();
}

// Include the connection file
include 'connection.php';

// Fetch categories from the database
$sql = "SELECT category_id, c_name, description, image FROM categorytb";
$result = mysqli_query($conn, $sql);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - E-Learning</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .card {
            margin-bottom: 20px;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
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
        <h1 style="text-align:center;">All Categories</h1>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="../admin/category_uploads/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="<?php echo $row['c_name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['c_name']; ?></h5>
                        <p class="card-text"><?php echo $row['description']; ?></p>
                        <a href="show_course.php?category_id=<?php echo $row['category_id']; ?>" class="btn btn-primary">Enroll Now</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php  include 'testimonial.php'; ?>
<?php include 'footer.php';?>
<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
