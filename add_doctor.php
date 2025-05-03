<?php
session_start();
if (! isset($_SESSION['username'])) {
  header('Location: loginpage.php');
  exit;
}
include('db_config.php');

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $contact_no = $_POST['contact_no'];

    $sql = "INSERT INTO doctors (name, specialization, contact_no) 
            VALUES ('$name', '$specialization', '$contact_no')";

    if ($conn->query($sql) === TRUE) {
        echo "Doctor added successfully!";
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
    <title>Add Doctor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Add Doctor</h1>

    <?php
    if (!empty($message)) echo $message;
    ?>

    <form method="POST" action="add_doctor.php">
        <label>Doctor's Name:</label>
        <input type="text" name="name" required>

        <label>Specialization:</label>
        <input type="text" name="specialization" required>

        <label>Contact No:</label>
        <input type="text" name="contact_no" required>

        <button type="submit">Add Doctor</button>
    </form>

    <p><a href="index.php" class="back-link">← Back to Home</a></p>
</div>

</body>
</html>
