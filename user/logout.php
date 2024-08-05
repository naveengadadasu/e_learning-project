<?php
session_start(); // Start the session

// Check if the user is logged in (optional)
if($_SESSION['user_id'] && $_SESSION['user_name']) {
    // Unset all session variables
    $_SESSION = array();
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);

    // Destroy the session
    session_destroy();

    // Redirect to a login page or any other page
    header("Location: index.php");
    exit;
} else {
    // If the user is not logged in, redirect to a login page or any other page
    header("Location: login.php");
    exit;
}
?>
