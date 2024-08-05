<?php
include '../connection.php';

if(isset($_GET['id'])) {
    $studentId = $_GET['id'];
    
    $sql = "SELECT * FROM studenttb WHERE student_id = $studentId";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $studentName = $row['s_name'];
        $email = $row['email'];
        $contactNo = $row['contactno'];
        $password = $row['password'];
        $country = $row['country'];
        $city = $row['city'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
  <h2>Edit Student</h2>
  <div class="row">
    <div class="col-md-6">
      <form action="update_student.php" method="post">
        <input type="hidden" name="studentId" value="<?php echo $studentId; ?>">
        
        <div class="mb-3">
          <label for="s_name" class="form-label">Student Name</label>
          <input type="text" class="form-control" id="s_name" name="s_name" value="<?php echo $studentName; ?>" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>

        <div class="mb-3">
          <label for="contactno" class="form-label">Contact Number</label>
          <input type="text" class="form-control" id="contactno" name="contactno" value="<?php echo $contactNo; ?>" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" required>
        </div>

        <div class="mb-3">
          <label for="country" class="form-label">Country</label>
          <select class="form-select" id="country" name="country" required>
            <option value="" disabled>Select Country</option>
            <option value="USA">USA</option>
            <option value="Canada">Canada</option>
            <!-- Add more country options here -->
          </select>
        </div>

        <div class="mb-3">
          <label for="city" class="form-label">City</label>
          <select class="form-select" id="city" name="city" required>
            <option value="" disabled>Select City</option>
            <!-- City options will be populated dynamically using JavaScript -->
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Sample list of countries and their cities (You can replace this with your own data)
  const countries = {
    "USA": ["New York", "Los Angeles", "Chicago"],
    "Canada": ["Toronto", "Vancouver", "Montreal"],
    "UK": ["London", "Manchester", "Birmingham"],
    "India": ["Mumbai", "Delhi", "Bangalore"]
    // Add more countries and their cities here
  };

  // Function to populate the city dropdown based on the selected country
  function populateCities() {
    const country = document.getElementById("country").value;
    const cityDropdown = document.getElementById("city");
    // Clear existing options
    cityDropdown.innerHTML = "<option value='' disabled>Select City</option>";
    // Populate with cities of the selected country
    countries[country].forEach(city => {
      const option = document.createElement("option");
      option.value = city;
      option.textContent = city;
      cityDropdown.appendChild(option);
    });
  }

  // Populate cities when the page loads
  populateCities();
</script>

</body>
</html>
