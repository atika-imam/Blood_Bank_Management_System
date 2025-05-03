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

  <!-- Session-related operations -->
  <li><a href="add_patient.php">Add Patient</a></li> <!-- Add a new patient record -->
  <li><a href="add_doctor.php">Add Doctor</a></li> <!-- Add a new doctor record -->
  <li><a href="nurse_insert.php">Add Nurse</a></li> <!-- Add a new nurse record -->
  <li><a href="add_donor.php">Add Donor</a></li> <!-- Add a new donor record -->
  <li><a href="donor_medical_history_insert.php">Add Donor Medical History</a></li> <!-- Add donor medical history -->

  <!-- Blood management operations -->
  <li><a href="add_blood_stock.php">Update Blood Stock</a></li> <!-- Update blood stock details -->
  <li><a href="add_available_blood_stock.php">Available Blood Stock</a></li> <!-- View available blood stock -->
  <li><a href="blood_test_insert.php">Add Blood Test</a></li> <!-- Add a new blood test record -->
  <li><a href="test_report_insert.php">Add Test Report</a></li> <!-- Add a test report -->
  <li><a href="blood_request_insert.php">Add Blood Request</a></li> <!-- Add a new blood request -->
  <li><a href="search.php">Search by Blood</a></li> <!-- Search for blood by type or availability -->
  <li><a href="expiry_record_insert.php">Add Expiry Record</a></li> <!-- Add blood expiry records -->

  <!-- Storage and transportation operations -->
  <li><a href="storage_location_insert.php">Add Storage Location</a></li> <!-- Add new storage location -->
  <li><a href="transportation_insert.php">Add Transportation</a></li> <!-- Add transportation details for blood -->
  <li><a href="temperature_log_insert.php">Add Temperature Log</a></li> <!-- Log temperature records for blood storage -->

  <!-- Camp and hospital-related operations -->
  <li><a href="camp_location_insert.php">Camp Location</a></li> <!-- Add new camp location -->
  <li><a href="hospital_insert.php">Add Hospital</a></li> <!-- Add a new hospital -->
  <li><a href="supplier_insert.php">Add Supplier</a></li> <!-- Add supplier details -->
  <li><a href="inventory_insert.php">Add Inventory</a></li> <!-- Manage inventory of blood-related supplies -->

  <!-- Volunteer and schedule operations -->
  <li><a href="volunteer_insert.php">Add Volunteer</a></li> <!-- Add a new volunteer -->
  <li><a href="shift_schedule_insert.php">Add Shift Schedule</a></li> <!-- Add shift schedules for staff -->
  <li><a href="appointment_schedule_insert.php">Add Appointment Schedule</a></li> <!-- Schedule appointments -->

  <!-- Emergency and compliance operations -->
  <li><a href="ambulance_request_insert.php">Add Ambulance Request</a></li> <!-- Add ambulance request -->
  <li><a href="compliance_record_insert.php">Add Compliance Record</a></li> <!-- Log compliance records for blood donations -->
  <li><a href="billing_record_insert.php">Add Billing Record</a></li> <!-- Add billing details for services -->
  <li><a href="feedback_insert.php">Add Feedback</a></li> <!-- Add user or donor feedback -->

  <!-- Logout operation -->
  <li><a href="logout.php">Logout</a></li> <!-- Logout from the system -->

  </ul>
  </div>
</body>
</html>