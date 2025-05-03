<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $blood_group = $_POST['blood_group'];
    $quantity = $_POST['quantity'];
    $storage_location_id = $_POST['storage_location_id'];
    $expiry_date = $_POST['expiry_date'];

    $sql = "INSERT INTO inventory (blood_group, quantity, storage_location_id, expiry_date)
            VALUES ('$blood_group', '$quantity', '$storage_location_id', '$expiry_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Inventory record added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inventory</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Inventory Record</h1>
        <form method="POST" action="inventory_insert.php">
            <label for="blood_group">Blood Group:</label>
            <select id="blood_group" name="blood_group" required>
                <option value="" disabled selected>Select a blood group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>

            <label for="storage_location_id">Storage Location ID:</label>
            <input type="text" id="storage_location_id" name="storage_location_id" required>

            <label for="expiry_date">Expiry Date:</label>
            <input type="date" id="expiry_date" name="expiry_date" required>

            <button type="submit">Add Inventory</button>
        </form>
        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
