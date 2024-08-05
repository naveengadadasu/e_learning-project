<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Your remaining PHP code goes here

// Start session to access session data

// Check if the user is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    // User is logged in, retrieve user's email
    $user_email = $_SESSION['user_name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Code4Learning</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <!-- Brand -->
    <a class="navbar-brand" href="#">Code4Learning</a>

    <!-- Navbar toggle button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="show_allcourses.php">Course</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="show_categories.php">Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#footer">Contact Us</a>
        </li>
        <!-- Conditional display based on login status -->
        <?php if(isset($user_email)) : ?>
            <!-- My Courses link -->
          <li class="nav-item">
            <a class="nav-link" href="mycourses.php">My Courses</a>
          </li>
          <!-- Display welcome message with user's email -->
          <li class="nav-item">
            <span class="nav-link">Welcome, <?php echo $user_email; ?></span>
          </li>
          <!-- Logout link -->
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        <?php else : ?>
          <!-- Display login link -->
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <!-- Display signup link -->
          <li class="nav-item">
            <a class="nav-link" href="signup.php">Sign Up</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
