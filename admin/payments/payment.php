
<?php
include '../connection.php';

// Fetching data from the database
$query = "SELECT enrollmenttb.enrollment_id, studenttb.s_name AS student_name, coursetb.title AS course_title, enrollmenttb.price, enrollmenttb.date
          FROM enrollmenttb
          INNER JOIN studenttb ON enrollmenttb.student_id = studenttb.student_id
          INNER JOIN coursetb ON enrollmenttb.course_id = coursetb.course_id";
$result = mysqli_query($conn, $query);

// Checking for errors in query execution
if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit();
}
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

    /* Custom CSS for the content area */
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
  <a href="../index.php">Home</a>
  <a href="../course/display_course.php">Course</a>
  <a href="category/display_category.php">Category</a>
  <a href="../students/display_student.php">Student</a>
  <a href="../testimonials/display_testiomonial.php">Testimonials</a>
  <a href="../payments/payment.php">Payments</a>
</div>

<!-- Content area -->
<div class="content">
<h2 style="text-align:center">Payment Data</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Enrollment ID</th>
            <th>Student Name</th>
            <th>Course Title</th>
            <th>Enrolled Price</th>
            <th>Date</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['enrollment_id'] . "</td>";
            echo "<td>" . $row['student_name'] . "</td>";
            echo "<td>" . $row['course_title'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td><button class='btn btn-danger'>Delete</button></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
  </div>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
