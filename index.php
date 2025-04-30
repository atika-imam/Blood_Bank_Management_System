<?php
session_start();
if (! isset($_SESSION['username'])) {
  header('Location: loginpage.php');
  exit;
}
include 'db_config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Blood Bank Management System</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Welcome to Blood Bank Management System</h1>
    <nav>
      <a href="add_donor.php">Add Donor</a>
      <a href="add_patient.php">Add Patient</a>
      <a href="add_doctor.php">Add Doctor</a>
      <a href="add_blood_stock.php">Update Blood Stock</a>
      <a href="search.php">Search by Blood</a>
      <a href="logout.php">Logout</a>

    </nav>

    <h2>Available Blood Stock</h2>
    <table>
      <tr><th>Blood Group</th><th>Units Available</th></tr>
      <?php
      $sql    = "SELECT blood_group, quantity FROM blood_stock";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>{$row['blood_group']}</td><td>{$row['quantity']}</td></tr>";
        }
      } else {
        echo "<tr><td colspan='2'>No data available</td></tr>";
      }
      ?>
    </table>
  </div>
</body>
</html>
