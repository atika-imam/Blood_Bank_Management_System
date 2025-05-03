<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nurse_id = $_POST['nurse_id'];
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $contact_no = $_POST['contact_no'];

    $sql = "INSERT INTO nurse (nurse_id, name, specialization, contact_no)
            VALUES ('$nurse_id', '$name', '$specialization', '$contact_no')";

    if ($conn->query($sql) === TRUE) {
        echo "Nurse added successfully!";
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
    <title>Add Nurse</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Add Nurse</h1>

    <?php
    if (!empty($message)) echo $message;
    ?>

    <form method="POST" action="nurse_insert.php">
        <label>Nurse ID:</label>
        <input type="text" name="nurse_id" required>

        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Specialization:</label>
        <input type="text" name="specialization" required>

        <label>Contact No:</label>
        <input type="text" name="contact_no" required>

        <button type="submit">Add Nurse</button>
    </form>

    <p><a href="index.php" class="back-link">← Back to Home</a></p>
</div>

</body>
</html>
