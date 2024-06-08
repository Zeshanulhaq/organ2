<?php
header('Content-Type: application/json');

// Database connection details
$servername = "localhost";
$username = "root"; // Change this to your MySQL username
$password_db = ""; // Change this to your MySQL password
$dbname = "lifeconnect"; // Change this to your database name

// Connect to the database
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Get user ID from DELETE request
parse_str(file_get_contents("php://input"), $delete_vars);
$user_id = isset($delete_vars['id']) ? $delete_vars['id'] : '';

if (!empty($user_id)) {
    // Prepare and execute the SQL statement to delete the user
    $stmt = $conn->prepare("DELETE FROM users WHERE userid = ?");
    $stmt->bind_param("s", $user_id);
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Failed to delete user"]);
    }
    $stmt->close();
} else {
    echo json_encode(["success" => false, "error" => "Invalid user ID"]);
}

$conn->close();
?>
