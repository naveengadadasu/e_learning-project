<?php

include 'connection.php';

function countRecords($conn, $tableName) {
    $sql = "SELECT COUNT(*) AS count FROM $tableName";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["count"];
    } else {
        return 0;
    }
}

// Function to calculate total amount received
function getTotalAmount($conn) {
    $sql = "SELECT SUM(price) AS total_amount FROM enrollmenttb";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["total_amount"];
    } else {
        return 0;
    }
}

$countCourses = countRecords($conn, "courseTB");
$countStudents = countRecords($conn, "studentTB");
$countCategories = countRecords($conn, "categoryTB");
$countTestimonials = countRecords($conn, "testimonials");
$countPayment = getTotalAmount($conn); // Get total amount received

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Side Navbar</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom CSS for the side navbar */
    .sidenav {
      height: 100%;
      width: 250px;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #333;
      padding-top: 20px;
    }

    .sidenav a {
      padding: 10px 15px;
      text-decoration: none;
      font-size: 18px;
      color: #fff;
      display: block;
    }

    .sidenav a:hover {
      background-color: #555;
    }

    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 16px;}
    }

    /* Custom CSS for the cards */
    .card {
      background-color: #f8f9fa; /* Light grey background */
      border-radius: 10px;
      box-sizing: border-box; /* Include padding and border in the total width and height */
      padding: 20px;
      margin-top: 20px;
    }

    .card-body {
      padding: 20px;
    }

    .card-title {
      font-size: 24px;
    }

    .card-text {
      font-size: 18px;
    }

    .content {
      margin-left: 250px; /* Adjust margin to provide space for the side navbar */
      padding: 20px;
    }
  </style>
</head>
<body>

<div class="sidenav">
  <!-- Title -->
  <h3 style="color: #fff; text-align: center;">code4learning</h3>

  <!-- Navigation Links -->
  <a href="index.php">Home</a>
  <a href="course/display_course.php">Course</a>
  <a href="category/display_category.php">Category</a>
  <a href="students/display_student.php">Student</a>
  <a href="testimonials/display_testimonial.php">Testimonials</a>
  <a href="payment.php">Payments</a>
</div>

<!-- Cards -->
<div class="container-fluid">
  <div class="content">
    <h1 style="text-align:center">Admin Dashboard</h1>
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Courses</h5>
            <p class="card-text">Total Count: <?php echo $countCourses; ?></p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Categories</h5>
            <p class="card-text">Total Count: <?php echo $countCategories; ?></p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Students</h5>
            <p class="card-text">Total Count: <?php echo $countStudents; ?></p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Testimonials</h5>
            <p class="card-text">Total Count: <?php echo $countTestimonials; ?></p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Total Amount Received</h5>
            <p class="card-text">Total Amount: <?php echo $countPayment; ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Closing the database connection
mysqli_close($conn);
?>
