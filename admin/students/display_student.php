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
  <a href="display_student.php">Student</a> <!-- Updated link for Student -->
  <a href="../testimonials/display_testiomonial.php">Testimonials</a>
  <a href="../payment.php">Payments</a>
</div>

<!-- Content area -->
<div class="content">
<h1 style="text-align:center">Admin Dashboard</h1>
  <h2>Student List</h2>
  <!-- Button to add student -->
  <button type="button" class="btn btn-primary mb-3" onclick="location.href='add_student.php'">Add Student</button>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Student ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Contact Number</th>
          <th>Country</th>
          <th>City</th>
          <th>Action</th> <!-- New column for edit and delete buttons -->
        </tr>
      </thead>
      <tbody>
        <!-- PHP code to fetch and display student data -->
        <?php
        include '../connection.php';

        $sql = "SELECT * FROM studenttb";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["student_id"] . "</td>";
            echo "<td>" . $row["s_name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["contactno"] . "</td>";
            echo "<td>" . $row["country"] . "</td>";
            echo "<td>" . $row["city"] . "</td>";
            echo "<td>";
            echo "<a href='edit_student.php?id=" . $row["student_id"] . "' class='btn btn-warning btn-sm'>Edit</a>&nbsp;";
            echo "<a href='delete_student.php?id=" . $row["student_id"] . "' class='btn btn-danger btn-sm'>Delete</a>";
            echo "</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='7'>No students found</td></tr>";
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
