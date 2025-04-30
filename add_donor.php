<?php
session_start();
if (! isset($_SESSION['username'])) {
  header('Location: loginpage.php');
  exit;
}
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $contact_no = $_POST['contact_no'];

    $sql = "INSERT INTO donors (name, age, gender, blood_group, contact_no) VALUES ('$name', '$age', '$gender', '$blood_group', '$contact_no')";

    if ($conn->query($sql) === TRUE) {
        $success = "Donor Added Successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Donor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Add Donor</h1>

    <?php
    if (isset($success)) {
        echo "<p style='color: green;'>$success</p>";
    }
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

    <form method="POST" action="">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Age:</label>
        <input type="number" name="age" required>

        <label>Gender:</label>
        <select name="gender" required>
            <option value="">-- Choose --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label>Blood Group:</label>
        <select name="blood_group" required>
            <option value="">-- Choose --</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </select>

        <label>Contact No:</label>
        <input type="text" name="contact_no" required>

        <button type="submit">Add Donor</button>
    </form>

    <p><a href="index.php" class="back-link">← Back to Home</a></p>
</div>

</body>
</html>
