<?php
// Start session to store admin login status
session_start();

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection details
    $servername = "localhost";
    $db_username = "root"; // Change this to your MySQL username
    $db_password = ""; // Change this to your MySQL password
    $dbname = "lifeconnect"; // Change this to your database name

    // Connect to the database
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to retrieve admin credentials
    $sql = "SELECT * FROM admins WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Admin found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables
            $_SESSION['admin_username'] = $username;
            // Redirect to admin dashboard
            header("Location: admin_dashboard.html");
            exit();
        } else {
            // Password is incorrect
            echo "Invalid username or password. Please try again.";
        }
    } else {
        // Admin not found
        echo "Invalid username or password. Please try again.";
    }

    // Close the database connection
    $conn->close();
} else {
    // If the form is not submitted via POST, redirect to login page
    header("Location: admin_login.html");
    exit();
}
?>
