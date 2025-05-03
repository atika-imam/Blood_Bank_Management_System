<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}
include('db_config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Available Blood Stock</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Available Blood Stock</h1>
    <table>
      <tr>
        <th>Blood Group</th>
        <th>Units Available</th>
      </tr>
      <?php
        $sql = "SELECT blood_group, quantity FROM blood_stock";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['blood_group']}</td><td>{$row['quantity']}</td></tr>";
          }
        } else {
          echo "<tr><td colspan='2'>No data available</td></tr>";
        }

        $conn->close();
      ?>
    </table>
    <p><a href="index.php" class="back-link">← Back to Home</a></p>
  </div>
</body>
</html>
