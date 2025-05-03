<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get values from the form
    $supplier_name = $_POST['supplier_name'];
    $supplier_bottles_supplied = $_POST['bottles_supplied'];
    $supplier_contact = $_POST['supplier_contact'];

    // Prepared statement to insert data securely
    $sql = "INSERT INTO supplier (name, bottles_supplied, contact) VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sis", $supplier_name, $supplier_bottles_supplied, $supplier_contact); // 's' for string, 'i' for integer
        if ($stmt->execute()) {
            echo "Supplier added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Supplier</h1>
        <form method="POST" action="supplier_insert.php">
            <label for="supplier_name">Supplier Name:</label>
            <input type="text" id="supplier_name" name="supplier_name" required>

            <label for="bottles_supplied">Bottles Supplied:</label>
            <input type="number" id="bottles_supplied" name="bottles_supplied" required>

            <label for="supplier_contact">Supplier Contact:</label>
            <input type="text" id="supplier_contact" name="supplier_contact" required>

            <button type="submit">Add Supplier</button>
        </form>
        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
