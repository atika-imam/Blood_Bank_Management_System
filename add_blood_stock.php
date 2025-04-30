<?php
session_start();
if (! isset($_SESSION['username'])) {
  header('Location: loginpage.php');
  exit;
}
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $blood_group = $_POST['blood_group'];
    $quantity    = (int)$_POST['quantity'];

    $sql = "INSERT INTO blood_stock (blood_group, quantity) 
            VALUES ('$blood_group', $quantity)
            ON DUPLICATE KEY UPDATE quantity = GREATEST (0, quantity + $quantity)";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>Blood stock updated successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head><title>Update Blood Stock</title><link rel="stylesheet" href="style.css"></head>
<body>
  <h1>Update Blood Stock</h1>
  <form method="post" action="">
    <label>Blood Group</label><br>
    <input type="text" name="blood_group" required><br><br>
    <label>Units to Add (use negative to subtract)</label><br>
    <input type="number" name="quantity" required><br><br>
    <button type="submit">Update Stock</button>
  </form>
  <p><a href="index.php" class="back-link">← Back to Home</a></p>
</body>
</html>
