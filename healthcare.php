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
    // Get form data
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $city = $_POST['city'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $specialization = $_POST['specialization'];
    $year_of_experience = $_POST['year_of_experience'];
    $hospital_name = $_POST['hospital_name'];
    $medical_license_ID = $_POST['medical_license_ID'];
    
    // Assume user ID is stored in session
    $userid = $_SESSION['userid'];
    
    // Prepare SQL statement to update user data
    $stmt = $conn->prepare("UPDATE users SET fullname = ?, phone_number = ?, city = ?, age = ?, gender = ?, specialization = ?, year_of_experience = ?, hospital_name = ?, medical_license_ID = ? WHERE userid = ?");
    $stmt->bind_param("ssssssisii", $full_name, $phone_number, $city, $age, $gender, $specialization, $year_of_experience, $hospital_name, $medical_license_ID, $userid);

    // Execute the statement
    if ($stmt->execute()) {
        echo "User data updated successfully";
        // Redirect to a success page or user profile
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating user data: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
