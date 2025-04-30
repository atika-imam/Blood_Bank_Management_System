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
  <h1>
    Welcome<br> Blood Bank Management System
  </h1>
  <div class="big-box">
  <ul class="main-menu">
    <li><a href="add_patient.php">Add Patient</a></li>
    <li><a href="add_doctor.php">Add Doctor</a></li>
    <li><a href="add_donor.php">Add Donor</a></li>
    <li><a href="add_blood_stock.php">Update Blood Stock</a></li>
    <li><a href="add_available_blood_stock.php">Available Blood Stock</a></li>
    <li><a href="search.php">Search by Blood</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
  </div>
</body>
</html>
