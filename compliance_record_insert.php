<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $document_name = $_POST['document_name'];
    $issue_date = $_POST['issue_date'];

    $stmt = $conn->prepare("INSERT INTO compliance_record (document_name, issue_date) VALUES (?, ?)");
    $stmt->bind_param("ss", $document_name, $issue_date);

    if ($stmt->execute()) {
        echo "Compliance record added successfully!";
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
    <title>Add Compliance Record</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Compliance Record</h1>
        <form method="POST" action="compliance_record_insert.php">
            <label for="document_name">Document Name:</label>
            <input type="text" name="document_name" required>

            <label for="issue_date">Issue Date:</label>
            <input type="date" name="issue_date" placeholder="Issue Date" required>

            <button type="submit">Add Record</button>
        </form>
        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
