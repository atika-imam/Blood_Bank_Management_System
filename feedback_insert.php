<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $feedback_text = $_POST['feedback_text'];
    $feedback_date = $_POST['feedback_date'];

    $sql = "INSERT INTO feedback (name, feedback_text, date_submitted)
            VALUES ('$name', '$feedback_text', '$feedback_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Feedback added successfully!";
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
    <title>Add Feedback</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Feedback</h1>
        <form method="POST" action="feedback_insert.php">
            <label for="name">Your Name:</label>
            <input type="text" name="name" required>

            <label for="feedback_text">Feedback:</label>
            <textarea name="feedback_text" required></textarea>

            <label for="feedback_date">Date Submitted:</label>
            <input type="date" name="feedback_date" required>

            <button type="submit">Submit Feedback</button>
        </form>
        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
