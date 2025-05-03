<?php
session_start();
if (! isset($_SESSION['username'])) {
  header('Location: loginpage.php');
  exit;
}
include 'db_config.php';
$result = $conn->query("SELECT * FROM donors");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Donor List</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Donor List</h1>
  <table border="1">
    <tr>
      <th>ID</th><th>Name</th><th>Age</th><th>Gender</th><th>Blood Group</th><th>Contact</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['donor_id']     ?></td>
        <td><?= $row['name']         ?></td>
        <td><?= $row['age']          ?></td>
        <td><?= $row['gender']       ?></td>
        <td><?= $row['blood_group']  ?></td>
        <td><?= $row['contact_no']   ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
  <p><a href="index.php" class="back-link">← Back to Home</a></p>
</body>
</html>