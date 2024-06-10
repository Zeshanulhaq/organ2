<?php
// Start the session
session_start();

// Database connection details
$servername = "localhost";
$username = "root"; // Change this to your MySQL username
$password_db = ""; // Change this to your MySQL password
$dbname = "lifeconnect"; // Change this to your database name

// Connect to the database
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if it doesn't exist
$sql_create_table = "CREATE TABLE IF NOT EXISTS patients (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    number VARCHAR(15) NOT NULL,
    city VARCHAR(255) NOT NULL,
    dob DATE NOT NULL,
    gender CHAR(1) NOT NULL,
    test_report VARCHAR(255) NOT NULL,
    bloodgroup VARCHAR(3) NOT NULL,
    emergency_fullname VARCHAR(255) NOT NULL,
    emergency_email VARCHAR(255) NOT NULL,
    emergency_address VARCHAR(255) NOT NULL,
    emergency_relationship VARCHAR(255) NOT NULL,
    emergency_number VARCHAR(15) NOT NULL,
    emergency_city VARCHAR(255) NOT NULL
)";

if ($conn->query($sql_create_table) !== TRUE) {
    echo "Error creating table: " . $conn->error;
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $number = htmlspecialchars($_POST['number']);
    $city = htmlspecialchars($_POST['city']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $bloodgroup = htmlspecialchars($_POST['bloodgroup']);
    $emergency_fullname = htmlspecialchars($_POST['emergency_fullname']);
    $emergency_email = filter_var($_POST['emergency_email'], FILTER_VALIDATE_EMAIL);
    $emergency_address = htmlspecialchars($_POST['emergency_address']);
    $emergency_relationship = htmlspecialchars($_POST['emergency_relationship']);
    $emergency_number = htmlspecialchars($_POST['emergency_number']);
    $emergency_city = htmlspecialchars($_POST['emergency_city']);

    // Validate email
    if ($email === false || $emergency_email === false) {
        die("Invalid email format");
    }

    // Ensure uploads directory exists
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Handle file upload with validation
    $target_file = $target_dir . basename($_FILES["test_report"]["name"]);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file size (limit to 5MB)
    if ($_FILES["test_report"]["size"] > 5000000) {
        die("Sorry, your file is too large.");
    }

    // Allow certain file formats
    $allowed_types = array("jpg", "png", "jpeg", "pdf");
    if (!in_array($file_type, $allowed_types)) {
        die("Sorry, only JPG, JPEG, PNG & PDF files are allowed.");
    }

    // Move the uploaded file
    if (!move_uploaded_file($_FILES["test_report"]["tmp_name"], $target_file)) {
        die("Sorry, there was an error uploading your file.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to insert patient data into the database
    $stmt = $conn->prepare("INSERT INTO patients (fullname, email, password, number, city, dob, gender, test_report, bloodgroup, emergency_fullname, emergency_email, emergency_address, emergency_relationship, emergency_number, emergency_city) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssssss", $fullname, $email, $hashed_password, $number, $city, $dob, $gender, $target_file, $bloodgroup, $emergency_fullname, $emergency_email, $emergency_address, $emergency_relationship, $emergency_number, $emergency_city);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Patient registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
