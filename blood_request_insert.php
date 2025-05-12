<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

$message = ""; // Initialize message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hospital_id = (int) $_POST['hospital_id'];
    $blood_group = trim($_POST['blood_group']);
    $quantity = (int) $_POST['quantity'];
    $request_date = $_POST['request_date'];
    $status = $_POST['status']; // Get from form

    // Use prepared statement correctly
    $stmt = $conn->prepare("INSERT INTO blood_request (hospital_id, blood_group, quantity, request_date, status) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isiss", $hospital_id, $blood_group, $quantity, $request_date, $status);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Blood request added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blood Request</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Add Blood Request</h1>

    <?php if (!empty($message)) echo $message; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="hospital_id">Hospital ID:</label>
            <input type="text" id="hospital_id" name="hospital_id" required>
        </div>

        <div class="form-group">
            <label for="blood_group">Blood Group:</label>
            <select id="blood_group" name="blood_group" required>
                <option value="" disabled selected>-- Select Blood Group --</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
        </div>

        <div class="form-group">
            <label for="request_date">Request Date:</label>
            <input type="date" id="request_date" name="request_date" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="" disabled selected>-- Select Status --</option>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
                <option value="Completed">Completed</option>
            </select>
        </div>

        <button type="submit">Add Request</button>
    </form>

    <p><a href="index.php" class="back-link">← Back to Home</a></p>
</div>

</body>
</html>
