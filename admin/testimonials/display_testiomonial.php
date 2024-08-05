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
  <a href="../category/display_category.php">Category</a>
  <a href="../students/display_student.php">Student</a>
  <a href="display_testimonial.php">Testimonials</a>
  <a href="../payments/payment.php">Payments</a>
</div>

<!-- Content area -->
<div class="content">
  <div class="container">
  <h1 style="text-align:center">Admin Dashboard</h1>
    <h2>Testimonials List</h2>
    <!-- Button to add testimonial -->
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Testimonial ID</th>
            <th>Message</th>
            <th>Student ID</th>
            <th>Action</th> <!-- New column for edit and delete buttons -->
          </tr>
        </thead>
        <tbody>
          <!-- PHP code to fetch and display testimonial data -->
          <?php
          include '../connection.php';

          $sql = "SELECT * FROM testimonials";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row["testimonial_id"] . "</td>";
              echo "<td>" . $row["message"] . "</td>";
              echo "<td>" . $row["student_id"] . "</td>";
              echo "<td>";
              echo "<a href='delete_testimonial.php?id=" . $row["testimonial_id"] . "' class='btn btn-danger btn-sm'>Delete</a>";
              echo "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='4'>No testimonials found</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
