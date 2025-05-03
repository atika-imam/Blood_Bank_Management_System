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

      <a href="add_patient.php">View Patient</a>
      <a href="add_doctor.php">View Doctor</a>
      <a href="nurse_insert.php">View Nurse</a>
      <a href="add_donor.php">View Donor</a>
      <a href="donor_medical_history_insert.php">View Donor Medical History</a>

      <a href="add_blood_stock.php">Update Blood Stock</a>
      <a href="add_available_blood_stock.php">Available Blood Stock</a>
      <a href="blood_test_insert.php">Add Blood Test</a>
      <a href="test_report_insert.php">Add Test Report</a>
      <a href="blood_request_insert.php">Add Blood Request</a>
      <a href="expiry_record_insert.php">Add Expiry Record</a>

      <a href="storage_location_insert.php">Add Storage Location</a>
      <a href="transportation_insert.php">Add Transportation</a>
      <a href="temperature_log_insert.php">Add Temperature Log</a>

      <a href="camp_location_insert.php">Camp Location</a>
      <a href="hospital_insert.php">Add Hospital</a>
      <a href="supplier_insert.php">Add Supplier</a>
      <a href="inventory_insert.php">Add Inventory</a>

      <a href="volunteer_insert.php">Add Volunteer</a>
      <a href="shift_schedule_insert.php">Add Shift Schedule</a>
      <a href="appointment_schedule_insert.php">Add Appointment Schedule</a>

      <a href="ambulance_request_insert.php">Add Ambulance Request</a>
      <a href="compliance_record_insert.php">Add Compliance Record</a>
      <a href="billing_record_insert.php">Add Billing Record</a>
      <a href="feedback_insert.php">Add Feedback</a>

      <a href="logout.php">Logout</a>

</nav>
```

  </div>
</body>
</html>
