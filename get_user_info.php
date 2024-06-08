<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['userid'])) {
    echo json_encode([
        "userid" => $_SESSION['userid'],
        "fullname" => $_SESSION['fullname'],
        "email" => $_SESSION['email'],
        "user_type" => $_SESSION['user_type']
    ]);
} else {
    echo json_encode(["error" => "User not logged in"]);
}
?>
