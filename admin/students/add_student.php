<?php
include 'connection.php';

$error = ""; // Initialize error variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_name = $_POST['s_name'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $password = $_POST['password'];
    $country = $_POST['country'];
    $city = $_POST['city'];

    // Validate contact number (allow only numeric characters)
    if (!preg_match("/^[0-9]+$/", $contactno)) {
        $error = "Contact number must contain only numeric characters.";
    }

    // Validate password (must contain at least one uppercase letter, one special character, and one numeric character)
    if (!preg_match("/^(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/", $password)) {
        $error = "Password must contain at least one uppercase letter, one special character, and one numeric character.";
    }

    if (empty($error)) { // If no error, proceed with insertion
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $res = mysqli_query($conn, "INSERT INTO `studenttb`(`s_name`, `email`, `contactno`, `password`, `country`, `city`) VALUES ('$s_name','$email','$contactno','$hashed_password','$country','$city')");
        if ($res) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Error: " . $stmt->errorInfo()[2];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Bootstrap Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
  <h2>Student Form</h2>
  <?php if (!empty($error)) : ?>
  <div class="alert alert-danger" role="alert">
    <?php echo $error; ?>
  </div>
  <?php endif; ?>
  <form action="" method="post">
    <!-- Student Name -->
    <div class="mb-3">
      <label for="s_name" class="form-label">Student Name</label>
      <input type="text" class="form-control" id="s_name" name="s_name" required>
    </div>

    <!-- Email -->
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <!-- Contact Number -->
    <div class="mb-3">
      <label for="contactno" class="form-label">Contact Number</label>
      <input type="text" class="form-control" id="contactno" name="contactno" required>
    </div>

    <!-- Password -->
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <!-- Country Dropdown -->
    <div class="mb-3">
      <label for="country" class="form-label">Country</label>
      <select class="form-select" id="country" name="country" onchange="populateCities()" required>
        <option value="" selected disabled>Select Country</option>
        <!-- Country options will be populated dynamically using JavaScript -->
      </select>
    </div>

    <!-- City Dropdown -->
    <div class="mb-3">
      <label for="city" class="form-label">City</label>
      <select class="form-select" id="city" name="city" required>
        <option value="" selected disabled>Select City</option>
        <!-- City options will be populated dynamically using JavaScript -->
      </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript to populate country and city dropdowns -->
<script>
  // Sample list of countries and their cities (You can replace this with your own data)
  const countries = {
    "USA": ["New York", "Los Angeles", "Chicago"],
    "Canada": ["Toronto", "Vancouver", "Montreal"],
    "UK": ["London", "Manchester", "Birmingham"],
    "India": ["Mumbai", "Delhi", "Bangalore"]
  };

  // Function to populate the country dropdown
  function populateCountries() {
    const countryDropdown = document.getElementById("country");
    for (const country in countries) {
      const option = document.createElement("option");
      option.value = country;
      option.textContent = country;
      countryDropdown.appendChild(option);
    }
  }

  // Function to populate the city dropdown based on the selected country
  function populateCities() {
    const country = document.getElementById("country").value;
    const cityDropdown = document.getElementById("city");
    // Clear existing options
    cityDropdown.innerHTML = "<option value='' selected disabled>Select City</option>";
    // Populate with cities of the selected country
    countries[country].forEach(city => {
      const option = document.createElement("option");
      option.value = city;
      option.textContent = city;
      cityDropdown.appendChild(option);
    });
  }

  // Populate countries when the page loads
  populateCountries();
</script>

</body>
</html>
