<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vehicle_name = $_POST['vehicle_name'];
    $driver_name = $_POST['driver_name'];
    $transportation_date = $_POST['transportation_date'];

    $sql = "INSERT INTO transportation (vehicle_name, driver_name, date_time) 
            VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $vehicle_name, $driver_name, $transportation_date);

        if ($stmt->execute()) {
            echo "Transportation added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Transportation Record</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Transportation Record</h1>

        <?php if (!empty($message)) echo $message; ?>

        <form method="POST" action="transportation_insert.php">

            <label for="vehicle_name">Vehicle Name:</label> 
            <input type="text" name="vehicle_name" id="vehicle_name" required> 

            <label for="driver_name">Driver Name:</label>
            <input type="text" name="driver_name" id="driver_name" required>

            <label for="transportation_date">Transportation Date & Time:</label>
            <input type="datetime-local" name="transportation_date" id="transportation_date" required>

            <button type="submit">Add Transportation Record</button>
        </form>

        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
