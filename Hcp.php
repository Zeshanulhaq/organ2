<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "lifeconnect";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add a new healthcare professional
function addHealthcareProfessional($data) {
    global $conn;
    
    $full_name = $conn->real_escape_string($data['full_name']);
    $email = $conn->real_escape_string($data['email']);
    $password = password_hash($conn->real_escape_string($data['password']), PASSWORD_DEFAULT);
    // Add other fields as needed
    
    $sql = "INSERT INTO healthcare_professional (full_name, email, password) VALUES ('$full_name', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        return "New healthcare professional added successfully";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to retrieve all healthcare professionals
function getAllHealthcareProfessionals() {
    global $conn;
    
    $sql = "SELECT * FROM healthcare_professional";
    $result = $conn->query($sql);
    
    $hcpArray = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $hcpArray[] = $row;
        }
    }
    
    return $hcpArray;
}

// Function to update a healthcare professional
function updateHealthcareProfessional($id, $data) {
    global $conn;
    
    $full_name = $conn->real_escape_string($data['full_name']);
    $email = $conn->real_escape_string($data['email']);
    $password = password_hash($conn->real_escape_string($data['password']), PASSWORD_DEFAULT);
    // Add other fields as needed
    
    $sql = "UPDATE healthcare_professional SET full_name='$full_name', email='$email', password='$password' WHERE healthcare_professional_id=$id";
    
    if ($conn->query($sql) === TRUE) {
        return "Healthcare professional updated successfully";
    } else {
        return "Error updating healthcare professional: " . $conn->error;
    }
}

// Function to delete a healthcare professional
function deleteHealthcareProfessional($id) {
    global $conn;
    
    $sql = "DELETE FROM healthcare_professional WHERE healthcare_professional_id=$id";
    
    if ($conn->query($sql) === TRUE) {
        return "Healthcare professional deleted successfully";
    } else {
        return "Error deleting healthcare professional: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>