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
    $blood_unit_id = $_POST['blood_unit_id'];
    $test_date = $_POST['test_date'];
    $result = $_POST['result'];

    // Prepared statement to insert data securely
    $sql = "INSERT INTO test_report (blood_unit_id, test_date, result) 
            VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters ('i' for integer, 's' for string)
        $stmt->bind_param("iss", $blood_unit_id, $test_date, $result);

        if ($stmt->execute()) {
            echo "Test report added successfully!";
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

<!-- HTML Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Test Report</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Test Report</h1>
        <form method="POST" action="test_report_insert.php">
            <div class="form-group">
                <label for="blood_unit_id">Blood Unit ID:</label>
                <input type="number" name="blood_unit_id" id="blood_unit_id" required>
            </div>

            <div class="form-group">
                <label for="test_date">Test Date:</label>
                <input type="date" name="test_date" id="test_date" required>
            </div>

            <div class="form-group">
                <label for="result">Result:</label>
                <input type="text" name="result" id="result" required>
            </div>

            <button type="submit">Add Test Report</button>
        </form>
        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
