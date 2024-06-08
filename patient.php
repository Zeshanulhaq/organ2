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
    email VARCHAR(255) NOT NULL,
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
    // Retrieve form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['number'];
    $city = $_POST['city'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $bloodgroup = $_POST['bloodgroup'];
    $emergency_fullname = $_POST['emergency_fullname'];
    $emergency_email = $_POST['emergency_email'];
    $emergency_address = $_POST['emergency_address'];
    $emergency_relationship = $_POST['emergency_relationship'];
    $emergency_number = $_POST['emergency_number'];
    $emergency_city = $_POST['emergency_city'];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["test_report"]["name"]);
    move_uploaded_file($_FILES["test_report"]["tmp_name"], $target_file);

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
