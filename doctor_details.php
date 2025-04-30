<?php
session_start();
if (! isset($_SESSION['username'])) {
  header('Location: loginpage.php');
  exit;
}
include 'db_config.php';
$result = $conn->query("SELECT * FROM doctors");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Doctor List</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Doctor List</h1>
  <table border="1">
    <tr>
      <th>ID</th><th>Name</th><th>Specialization</th><th>Contact</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['doctor_id']       ?></td>
        <td><?= $row['name']            ?></td>
        <td><?= $row['specialization']  ?></td>
        <td><?= $row['contact_no']      ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
  <p><a href="index.php">← Back to Home</a></p>
</body>
</html>
