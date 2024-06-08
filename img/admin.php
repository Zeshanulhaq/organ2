<?php
// Connect to your database (replace with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lifeconnect";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data
$sql = "SELECT  firstname, email , password , number , city , age , gender FROM doners";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo 
        " - firstname: " . $row["firstname"]. 
        " - email: " . $row["email"]. 
        " - password: " . $row["password"]. 
        " - number: " . $row["number"]. 
        " - city: " . $row["city"]. 
        " - age: " . $row["age"]. 
        " - gender: " . $row["gender"]. 
        "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();



?>