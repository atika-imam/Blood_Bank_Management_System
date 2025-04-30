<?php
$servername = "localhost";
$username = "root"; // default username in XAMPP
$password = "";     // default password blank hota hai
$dbname = "blood_bank";   // database ka naam

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Connection check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
