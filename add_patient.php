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
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $disease = $_POST['disease'];
    $contact_no = $_POST['contact_no'];

    // Insert data into patients table
    $sql = "INSERT INTO patients (name, age, gender, blood_group, disease, contact_no) 
            VALUES ('$name', '$age', '$gender', '$blood_group', '$disease', '$contact_no')";

    if ($conn->query($sql) === TRUE) {
        echo "New patient added successfully!";
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
    <title>Add Patient</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Patient</h1>
        <form method="POST" action="add_patient.php">
            <input type="text" name="name" placeholder="Name" required><br><br>
            <input type="number" name="age" placeholder="Age" required><br><br>
            <input type="text" name="gender" placeholder="Gender" required><br><br>
            <input type="text" name="blood_group" placeholder="Blood Group" required><br><br>
            <input type="text" name="disease" placeholder="Disease" required><br><br>
            <input type="text" name="contact_no" placeholder="Contact No" required><br><br>
            <button type="submit">Add Patient</button>
        </form>
        <p><a href="index.php">← Back to Home</a></p>
    </div>
</body>
</html>
