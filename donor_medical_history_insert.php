<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the form
    $donor_id = $_POST['donor_id'];
    $medical_condition = $_POST['medical_condition'];
    $date_diagnosed = $_POST['date_diagnosed'];

    // Insert data into donor_medical_history table
    $sql = "INSERT INTO donor_medical_history (donor_id, medical_condition, date_diagnosed) 
            VALUES ('$donor_id', '$medical_condition', '$date_diagnosed')";

    if ($conn->query($sql) === TRUE) {
        echo "Medical history added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch available donors
$donor_sql = "SELECT donor_id, name FROM donors";
$donor_result = $conn->query($donor_sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Donor Medical History</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Donor Medical History</h1>
        <form method="POST" action="donor_medical_history_insert.php">
           
            <label for="donor_id">Select Donor:</label>
            <select name="donor_id" required>
                <option value="" disabled selected>Select a Donor</option>
                <?php
                if ($donor_result->num_rows > 0) {
                    while($row = $donor_result->fetch_assoc()) {
                        echo "<option value='" . $row['donor_id'] . "'>" . $row['name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No donors available</option>";
                }
                ?>
            </select><br><br>

            <textarea name="medical_condition" placeholder="Medical Condition" required></textarea><br><br>

            <input type="date" name="date_diagnosed" required><br><br>

            <button type="submit">Add Medical History</button>
        </form>
        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
