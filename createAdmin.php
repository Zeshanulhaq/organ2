<?php
// Admin credentials
$admin_username = "admin2";
$admin_password = "123"; // You should hash this password before storing it in the database

// Database connection details
$servername = "localhost";
$username = "root"; // Change this to your MySQL username
$password_db = ""; // Change this to your MySQL password
$dbname = "lifeconnect"; // Change this to your database name

// Connect to the database
$conn = new mysqli($servername, $username, $password_db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully or already exists";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db($dbname);

// Create table if it doesn't exist
$sql_create_table = "CREATE TABLE IF NOT EXISTS admins (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql_create_table) === TRUE) {
    echo "Table admins created successfully or already exists";
} else {
    echo "Error creating table: " . $conn->error;
}

// Hash the admin password
$hashed_admin_password = password_hash($admin_password, PASSWORD_DEFAULT);

// Prepare SQL statement to insert admin credentials into the database
$sql_insert_admin = "INSERT INTO admins (username, password) VALUES ('$admin_username', '$hashed_admin_password')";

// Execute SQL statement
if ($conn->query($sql_insert_admin) === TRUE) {
    echo "Admin credentials added successfully";
} else {
    echo "Error adding admin credentials: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
