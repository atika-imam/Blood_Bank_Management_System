<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location_name = $_POST['location_name'];
    $capacity = $_POST['capacity'];

    if (empty($location_name) || empty($capacity)) {
        echo "Both fields are required!";
    } else {
        $sql = "INSERT INTO storage_location (location_name, capacity) VALUES (?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("si", $location_name, $capacity);
            if ($stmt->execute()) {
                echo "Storage location added successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Storage Location</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Storage Location</h1>
        <form method="POST" action="storage_location_insert.php">
            <div class="form-group">
                <label for="location_name">Location Name:</label>
                <input type="text" id="location_name" name="location_name" required>
            </div>

            <div class="form-group">
                <label for="capacity">Capacity:</label>
                <input type="number" id="capacity" name="capacity" value="1" min="1" max="100" step="1" required>
            </div>

            <button type="submit">Add Location</button>
        </form>
        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
