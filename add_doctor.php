<?php
session_start();
if (! isset($_SESSION['username'])) {
  header('Location: loginpage.php');
  exit;
}
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the form
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $contact_no = $_POST['contact_no'];

    // Insert data into doctors table
    $sql = "INSERT INTO doctors (name, specialization, contact_no) 
            VALUES ('$name', '$specialization', '$contact_no')";

    if ($conn->query($sql) === TRUE) {
        echo "New doctor added successfully!";
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
    <title>Add Doctor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Doctor</h1>
        <form method="POST" action="add_doctor.php">
            <input type="text" name="name" placeholder="Doctor's Name" required><br><br>
            <input type="text" name="specialization" placeholder="Specialization" required><br><br>
            <input type="text" name="contact_no" placeholder="Contact No" required><br><br>
            <button type="submit">Add Doctor</button>
        </form>
        <p><a href="index.php">← Back to Home</a></p>
    </div>
</body>
</html>
