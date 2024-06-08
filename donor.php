<?php
// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone_number = $_POST['number'];
    $city = $_POST['city'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['bloodgroup'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root"; // Change this to your MySQL username
    $password_db = ""; // Change this to your MySQL password
    $dbname = "lifeconnect"; // Change this to your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // Prepare and execute SQL statement for inserting data
        $stmt = $conn->prepare("INSERT INTO donor (full_name, email, password, phone_number, city, age, gender, blood_group) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt == false) {
         die("Error preparing statement:". $conn->error);
        }

        $stmt->bind_param("ssssssss", $full_name, $email, $password, $phone_number, $city, $age, $gender, $blood_group); // 's' for string, 'i' for integer

        if (!$stmt->execute()) {
            die("Error executing query: " . $stmt->error);
        }

        echo "Registration Successful...";
        $stmt->close();
        $conn->close();
    }
}
?>
