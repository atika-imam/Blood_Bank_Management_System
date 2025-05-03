<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $availability = $_POST['availability'];
    $joining_date = $_POST['joining_date'];

    $sql = "INSERT INTO volunteer (name, contact_number, email, assigned_location, availability, joining_date) 
            VALUES ('$name', '$contact', '$email', '$location', '$availability', '$joining_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Volunteer added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Volunteer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Add Volunteer</h1>
    <form method="POST" action="volunteer_insert.php">
        <label for="name">Volunteer Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="contact">Contact Number:</label>
        <input type="text" id="contact" name="contact" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="location">Assigned Location:</label>
        <select name="location" id="location" required>
            <option value="">-- Select Location --</option>
            <?php
            $result = $conn->query("SELECT location_id, name FROM camp_location");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['location_id'] . "'>" . $row['name'] . " (ID: " . $row['location_id'] . ")</option>";
                }
            } else {
                echo "<option value=''>No locations available</option>";
            }
            ?>
        </select>

        <label for="availability">Availability:</label>
        <input type="text" id="availability" name="availability" placeholder="Availability (e.g., Weekends)">

        <label for="joining_date">Joining Date:</label>
        <input type="date" id="joining_date" name="joining_date" placeholder="Joining Date">

        <button type="submit">Add Volunteer</button>
    </form>
    <p><a href="index.php" class="back-link">← Back to Home</a></p>
</div>
</body>
</html>

<?php
$conn->close();
?>
