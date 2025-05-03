<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input values
    $location_id = $_POST['location_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $volunteer_id = $_POST['volunteer_id'];

    // Prepared statement for inserting data into camp_location
    $stmt = $conn->prepare("INSERT INTO camp_location (location_id, name, address, volunteer_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $location_id, $name, $address, $volunteer_id); 

    if ($stmt->execute()) {
        echo "Camp location added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Camp Location</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add New Camp Location</h1>

        <!-- Display message if any -->
        <?php if (!empty($message)) echo $message; ?>

        <form method="POST" action="">
            <label for="location_id">Location ID:</label>
            <input type="text" id="location_id" name="location_id" required>

            <label for="name">Camp Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="volunteer_id">Volunteer ID:</label>
            <input type="number" id="volunteer_id" name="volunteer_id" required>

            <button type="submit">Add Camp Location</button>
        </form>

        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
