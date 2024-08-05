<div class="container">
        <h1>Testimonials</h1>
        <?php
// Include the connection file
include 'connection.php';

// Fetch testimonials with student names
$sql = "SELECT t.message, s.s_name 
        FROM testimonials t 
        INNER JOIN studenttb s ON t.student_id = s.student_id";
$result = mysqli_query($conn, $sql);

// Check if there was an error executing the query
if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit(); // Exit the script
}

// Check if any testimonials are found
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="testimonial">';
        echo "<p><strong>" . $row['s_name'] . ":</strong> " . $row['message'] . "</p>";
        echo '</div>';
    }
} else {
    echo "<p>No testimonials found.</p>";
}

// Close the database connection
mysqli_close($conn);
?>


        <hr>

        <h2>Add Your Testimonial</h2>
        <form method="post" action="submit_testimonial.php">
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Testimonial</button>
        </form>
    </div>