<?php
session_start();
if (! isset($_SESSION['username'])) {
  header('Location: loginpage.php');
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <nav>
      <a href="donor_details.php">View Donors</a>
      <a href="patient_details.php">View Patients</a>
      <a href="doctor_details.php">View Doctors</a>
      <a href="stock.php">View Stock</a>
      <a href="search.php">Search by Blood</a>
      <a href="logout.php">Logout</a>
    </nav>
  </div>
</body>
</html>
