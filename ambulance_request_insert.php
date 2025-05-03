<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

$patients_sql = "SELECT patient_id, name FROM patients";
$patients_result = $conn->query($patients_sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $pickup_location = $_POST['pickup_location'];
    $drop_location = $_POST['drop_location'];
    $emergency_level = $_POST['emergency_level'];

    $sql = "INSERT INTO ambulance_request (patient_id, request_date, pickup_location, drop_location, emergency_level) 
            VALUES ('$patient_id', NOW(), '$pickup_location', '$drop_location', '$emergency_level')";

    if ($conn->query($sql) === TRUE) {
        echo "Ambulance request created successfully!";
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
    <title>Request Ambulance</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Request Ambulance</h1>
        <form method="POST" action="ambulance_request_insert.php">
            <label for="patient_id">Select Patient:</label>
            <select name="patient_id" required>
                <option value="">-- Select Patient --</option>
                <?php while ($patient = $patients_result->fetch_assoc()) { ?>
                    <option value="<?php echo $patient['patient_id']; ?>"><?php echo $patient['name']; ?></option>
                <?php } ?>
            </select>

            <label for="pickup_location">Pickup Location:</label>
            <input type="text" name="pickup_location" placeholder="Enter Pickup Location" required>

            <label for="drop_location">Drop Location:</label>
            <input type="text" name="drop_location" placeholder="Enter Drop Location" required>

            <label for="emergency_level">Emergency Level:</label>
            <select name="emergency_level" required>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>

            <button type="submit">Request Ambulance</button>
        </form>

        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
