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

// Get pagination parameters
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$offset = ($page - 1) * $limit;

// Fetch total number of users
$totalResult = $conn->query("SELECT COUNT(*) as count FROM users");
$totalCount = $totalResult->fetch_assoc()['count'];

// Fetch users with limit and offset
$sql = "SELECT userid, fullname, email, user_type FROM users LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

$users = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$conn->close();

echo json_encode([
    "total" => $totalCount,
    "users" => $users,
    "page" => $page,
    "limit" => $limit
]);
?>
