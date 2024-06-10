<?php
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
$sql_create_table = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    userid VARCHAR(50) NOT NULL UNIQUE,
    fullname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    user_type VARCHAR(50) NOT NULL
)";

if ($conn->query($sql_create_table) !== TRUE) {
    echo "Error creating table: " . $conn->error;
}

// Function to generate unique user ID
function generateUniqueId($prefix = 'USR_') {
    return $prefix . uniqid();
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];
    $userid = generateUniqueId();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to insert user data into the database
    $stmt = $conn->prepare("INSERT INTO users (userid, fullname, email, password, user_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $userid, $fullname, $email, $hashed_password, $user_type);

    // Execute SQL statement
    if ($stmt->execute()) {
        header("Location: userlogin.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
