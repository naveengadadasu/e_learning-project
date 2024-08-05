<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST['studentId'];
    $studentName = $_POST['s_name'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactno'];
    $password = $_POST['password'];
    $country = $_POST['country'];
    $city = $_POST['city'];

    $sql = "UPDATE studenttb SET s_name='$studentName', email='$email', contactno='$contactNo', password='$password', country='$country', city='$city' WHERE student_id=$studentId";

    if (mysqli_query($conn, $sql)) {
        header("Location: display_student.php");
        exit;
    } else {
        echo "Error updating student: " . mysqli_error($conn);
    }
}
?>
