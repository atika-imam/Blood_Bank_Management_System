<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

$message = ""; // Initialize message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $report_id = $conn->real_escape_string($_POST['report_id']);
    $test_name = $conn->real_escape_string($_POST['test_name']);
    $status = $conn->real_escape_string($_POST['status']);

    // Check if the selected report_id exists
    $check_sql = "SELECT report_id FROM test_report WHERE report_id = '$report_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows === 0) {
        $message = "<p style='color:red;'>Error: Report ID does not exist in test_report table.</p>";
    } else {
        $sql = "INSERT INTO blood_test (report_id, test_name, status)
                VALUES ('$report_id', '$test_name', '$status')";

        if ($conn->query($sql) === TRUE) {
            echo "Blood test added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Blood Test</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Add Blood Test</h1>

    <?php if (!empty($message)) echo $message; ?>

    <form method="POST" action="blood_test_insert.php">
        <div class="form-group">
            <label for="report_id">Select Report ID:</label>
            <select name="report_id" id="report_id" required>
                <option value="" disabled selected>-- Select Report ID --</option>
                <?php
                $result = $conn->query("SELECT report_id FROM test_report");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['report_id']) . "'>" . htmlspecialchars($row['report_id']) . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="test_name">Test Name:</label>
            <input type="text" id="test_name" name="test_name" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" id="status" name="status" placeholder="e.g., Passed / Failed" required>
        </div>

        <button type="submit">Add Blood Test</button>
    </form>

    <p><a href="index.php" class="back-link">← Back to Home</a></p>
</div>

</body>
</html>

<?php $conn->close(); ?>
