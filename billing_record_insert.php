<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $service_type = $_POST['service_type'];
    $service_description = $_POST['service_description'];
    $cost = $_POST['cost'];
    $date_of_service = $_POST['date_of_service'];

    $sql = "INSERT INTO billing_record (patient_id, service_type, service_description, cost, date_of_service) 
            VALUES ('$patient_id', '$service_type', '$service_description', '$cost', '$date_of_service')";

    if ($conn->query($sql) === TRUE) {
        echo "Billing record added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$patient_sql = "SELECT patient_id, name FROM patients";
$patient_result = $conn->query($patient_sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Billing Record</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Billing Record</h1>
        <form method="POST" action="billing_record_insert.php">
            <label for="patient_id">Select Patient:</label>
            <select name="patient_id" required>
                <option value="" disabled selected>-----Select a Patient-----</option>
                <?php
                if ($patient_result->num_rows > 0) {
                    while($row = $patient_result->fetch_assoc()) {
                        echo "<option value='" . $row['patient_id'] . "'>" . $row['name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No patients available</option>";
                }
                ?>
            </select>

            <label for="service_type">Service Type:</label>
            <select name="service_type" required>
                <option value="" disabled selected>-----Select Service Type-----</option>
                <option value="test">Test</option>
                <option value="treatment">Treatment</option>
                <option value="inventory">Inventory</option>
            </select>

            <label for="service_description">Service Description:</label>
            <input type="text" name="service_description" required>

            <label for="cost">Cost in Rs.:</label>
            <input type="text" name="cost" required>

            <label for="date_of_service">Date of Service:</label>
            <input type="datetime-local" name="date_of_service" required>

            <button type="submit">Add Billing Record</button>
        </form>
        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
