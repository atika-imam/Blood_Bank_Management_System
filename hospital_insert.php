<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hospital_name = $_POST['hospital_name'];
    $hospital_address = $_POST['hospital_address'];

    // Sanitize and validate contact number (ensure it's an integer)
    $contact_number = filter_var($_POST['contact_no'], FILTER_VALIDATE_INT);
    
    if ($contact_number === false) {
        echo "Error: Invalid contact number. Please enter a valid integer.";
        exit;
    }

    // Prepared statement to prevent SQL injection
    $sql = "INSERT INTO hospital (name, address, contact_no) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $hospital_name, $hospital_address, $contact_number);

    if ($stmt->execute()) {
        echo "Hospital added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hospital</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Hospital</h1>
        <form method="POST" action="hospital_insert.php">
            <label for="hospital_name">Hospital Name:</label>
            <input type="text" id="hospital_name" name="hospital_name" required>
            
            <label for="hospital_address">Hospital Address:</label>
            <input type="text" id="hospital_address" name="hospital_address" required>
            
            <label for="contact_no">Contact Number:</label>
            <input type="text" id="contact_no" name="contact_no" required>
            
            <button type="submit">Add Hospital</button>
        </form>
        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
