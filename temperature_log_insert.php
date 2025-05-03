<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

$location_ids = [];
$fetch_sql = "SELECT location_id FROM storage_location";
$fetch_result = $conn->query($fetch_sql);
if ($fetch_result->num_rows > 0) {
    while ($row = $fetch_result->fetch_assoc()) {
        $location_ids[] = $row['location_id'];
    }
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $storage_location_id = $_POST['storage_location_id'];
    $temperature = $_POST['temperature'];
    $log_date = $_POST['log_date'];
    $unit = $_POST['unit'];

    // Convert Fahrenheit to Celsius if needed
    if ($unit == 'F') {
        $temperature = ($temperature - 32) * 5 / 9;
    }

    // Check if storage location ID exists
    $check_sql = "SELECT location_id FROM storage_location WHERE location_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $storage_location_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows == 0) {
        $message = "<p style='color:red;'>Error: Invalid Storage Location ID.</p>";
        $check_stmt->close();
    } else {
        $check_stmt->close();

        // Insert log into temperature_log
        $sql = "INSERT INTO temperature_log (storage_location_id, temp_value, log_time) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $storage_location_id, $temperature, $log_date);

        if ($stmt->execute()) {
            echo "Temperature Log added successfully!";
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
    <title>Add Temperature Log</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Temperature Log</h1>

        <!-- Display message -->
        <?php if (!empty($message)) echo $message; ?>

        <form method="POST" action="temperature_log_insert.php">
            <label for="storage_location_id">Storage Location ID:</label>
            <select name="storage_location_id" id="storage_location_id" required>
                <option value="">-- Select Location ID --</option>
                <?php foreach ($location_ids as $id): ?>
                    <option value="<?php echo htmlspecialchars($id); ?>"><?php echo htmlspecialchars($id); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="temperature">Temperature:</label>
            <input type="text" name="temperature" id="temperature" required>

            <label>Unit:</label>
            <label for="unit_celsius">Celsius</label>
            <input type="radio" id="unit_celsius" name="unit" value="C" checked>
            <label for="unit_fahrenheit">Fahrenheit</label>
            <input type="radio" id="unit_fahrenheit" name="unit" value="F">

            <label for="log_date">Log Date and Time:</label>
            <input type="datetime-local" name="log_date" id="log_date" required>

            <button type="submit">Add Temperature Log</button>
        </form>

        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
