

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Code4Learning</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    /* Custom CSS for the navbar */
    .navbar-brand {
      font-size: 1.5rem;
      font-weight: bold;
    }

    /* Separate links for Login and Sign Up on hover */
    .nav-item .nav-link {
      display: inline-block;
      position: relative;
    }

    .nav-item .nav-link::after {
      content: "";
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background-color: #fff;
      transition: width 0.3s;
    }

    .nav-item .nav-link:hover::after {
      width: 100%;
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
<?php

include "navbar.php";
?>

<?php
// Start the session
if (!isset($_SESSION)) {
    session_start();
}


// Check if the user is logged in
// if (isset($_SESSION['user_id'])) {
//     // User is logged in, display "Enroll Now" button
//     $enrollButton = '<a href="show_course.php" class="btn btn-primary">Enroll Now</a>';
// } 
// else{
//     $enrollButton = '<a href="login.php" class="btn btn-primary">Enroll Now</a>';
// }

// Include the connection file
include 'connection.php';




$sql = "SELECT category_id, c_name, description, image FROM categorytb";
$courseresult = mysqli_query($conn, $sql);
// Close the database connection
mysqli_close($conn);
?>


<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php
// Include show_categories.php if a category is clicked

?>
<div class="container">        
    <div class="row">
        <h1 style="text-align:center;">Course Categories</h1>
        <?php while ($row = mysqli_fetch_assoc($courseresult)) : ?>
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
</body>
</html>
