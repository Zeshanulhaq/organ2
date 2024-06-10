<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user data
    $stmt = $conn->prepare("SELECT userid, fullname, email, password, user_type FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($userid, $fullname, $email, $hashed_password, $user_type);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        // Set session variables
        $_SESSION['userid'] = $userid;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['email'] = $email;
        $_SESSION['user_type'] = $user_type;
        header("Location: userdashboard.html");
        // Redirect based on user type
        // switch ($user_type) {
        //     case 'patient':
        //         header("Location: Patient.html");
        //         break;
        //     case 'donor':
        //         header("Location: donor.html");
        //         break;
        //     case 'healthcare':
        //         header("Location: healthcare.html");
        //         break;
        //     default:
        //         header("Location: userdashboard.html");
        //         break;
        // }
        exit(); // Ensure the script stops executing after the redirect
    } else {
        echo "Invalid email or password";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
