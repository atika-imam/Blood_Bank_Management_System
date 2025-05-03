<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $blood_unit_id = $_POST['blood_unit_id'];
    $expiry_date = $_POST['expiry_date'];

    $sql = "INSERT INTO expiry_record (blood_unit_id, expiry_date)
            VALUES ('$blood_unit_id', '$expiry_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Expiry record added successfully!";
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
    <title>Add Expiry Record</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Expiry Record</h1>
        <form method="POST" action="expiry_record_insert.php">
            <div class="form-group">
                <label for="blood_unit_id">Blood Unit ID:</label>
                <input type="number" id="blood_unit_id" name="blood_unit_id" required>
            </div>

            <div class="form-group">
                <label for="expiry_date">Expiry Date:</label>
                <input type="date" id="expiry_date" name="expiry_date" required>
            </div>
            
            <button type="submit">Add Record</button>
        </form>
        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
