<?php
// Start session to store user data
session_start();

include 'connection.php';

$error = ""; // Initialize error variable

// Function to generate random CAPTCHA code
function generateCaptcha($length = 6) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $captcha = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $captcha .= $characters[rand(0, $max)];
    }
    return $captcha;
}

// Verify CAPTCHA and process login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $captcha_input = $_POST['captcha_input'];
    $captcha_code = $_SESSION['captcha_code']; // Get the CAPTCHA code stored in session

    // Verify CAPTCHA
    if ($captcha_input == $captcha_code) {
        // CAPTCHA verification successful
        // Check if email and password are not empty
        if (!empty($email) && !empty($password)) {
            // Check if email and password match a record in the database
            $result = mysqli_query($conn, "SELECT * FROM studenttb WHERE email='$email'");
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row['password'])) {
                    // Store user data in session for future use
                    $_SESSION['user_id'] = $row['student_id'];
                    $_SESSION['user_name'] = $row['s_name'];

                    // Redirect to index.php
                    header("Location: index.php");
                    exit;
                } else {
                    $error = "Incorrect email or password.";
                }
            } else {
                $error = "Incorrect email or password.";
            }
        } else {
            $error = "Please fill in all fields.";
        }
    } else {
        $error = "Incorrect CAPTCHA code.";
    }
}

// Generate and store CAPTCHA code in session
$_SESSION['captcha_code'] = generateCaptcha();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Code4Learning</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body >

<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 400px;">
        <div class="card-body" style="background-color: lightblue;">
            <h2 class="card-title text-center mb-4">Login</h2>
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <!-- Custom CAPTCHA -->
                <div class="mb-3">
                    <label for="captcha_input" class="form-label">Enter CAPTCHA</label>
                    <input type="text" class="form-control" id="captcha_input" name="captcha_input" required>
                    <h2 class="form-text text-muted"><?php echo $_SESSION['captcha_code']; ?></h2>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <p class="mt-3">Don't have an account? <a href="signup.php">Signup here</a>.</p>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
