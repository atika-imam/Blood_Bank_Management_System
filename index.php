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
  <title>Blood Bank Management</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      padding: 40px;
    }

    h1 {
      color: #c82333;
      text-align: center;
      margin-bottom: 40px;
    }

    h2 {
      color: #343a40;
      margin-top: 30px;
      margin-bottom: 10px;
    }

    ul {
      list-style: none;
      padding: 0;
      margin-bottom: 30px;
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    li {
      display: inline-block;
    }

    a {
      display: inline-block;
      padding: 10px 20px;
      background-color: #dc3545;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-size: 14px;
      transition: background-color 0.3s ease;
    }

    a:hover {
      background-color: #c82333;
    }

    /* Optional: Section borders */
    h2 + ul {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 15px;
      background-color: #ffffff;
    }
  </style>
</head>

<body>
<div class="container">
<h1>Welcome to Blood Bank Management System</h1>

<h2>🔍 View Records</h2>
<ul>
  <li><a href="donor_details.php">View Donors</a></li>
  <li><a href="patient_details.php">View Patients</a></li>
  <li><a href="doctor_details.php">View Doctors</a></li>
  <li><a href="stock.php">View Stock</a></li>
  <li><a href="search.php">Search by Blood</a></li>
</ul>

<h2>➕ Add/View Individuals</h2>
<ul>
  <li><a href="add_donor.php">Add Donor</a></li>
  <li><a href="add_patient.php">Add Patient</a></li>
  <li><a href="add_doctor.php">Add Doctor</a></li>
  <li><a href="nurse_insert.php">Add Nurse</a></li>
  <li><a href="donor_medical_history_insert.php">Add Donor Medical History</a></li>
</ul>

<h2>🩸 Blood & Test Records</h2>
<ul>
  <li><a href="add_blood_stock.php">Update Blood Stock</a></li>
  <li><a href="add_available_blood_stock.php">Available Blood Stock</a></li>
  <li><a href="blood_test_insert.php">Add Blood Test</a></li>
  <li><a href="test_report_insert.php">Add Test Report</a></li>
  <li><a href="blood_request_insert.php">Add Blood Request</a></li>
  <li><a href="expiry_record_insert.php">Add Expiry Record</a></li>
</ul>

<h2>🚚 Logistics</h2>
<ul>
  <li><a href="storage_location_insert.php">Add Storage Location</a></li>
  <li><a href="transportation_insert.php">Add Transportation</a></li>
  <li><a href="temperature_log_insert.php">Add Temperature Log</a></li>
</ul>

<h2>🏥 Facility Management</h2>
<ul>
  <li><a href="camp_location_insert.php">Add Camp Location</a></li>
  <li><a href="hospital_insert.php">Add Hospital</a></li>
  <li><a href="supplier_insert.php">Add Supplier</a></li>
  <li><a href="inventory_insert.php">Add Inventory</a></li>
</ul>

<h2>👨‍⚕️ Staff & Scheduling</h2>
<ul>
  <li><a href="volunteer_insert.php">Add Volunteer</a></li>
  <li><a href="shift_schedule_insert.php">Add Shift Schedule</a></li>
  <li><a href="appointment_schedule_insert.php">Add Appointment Schedule</a></li>
</ul>

<h2>💬 Support & Feedback</h2>
<ul>
  <li><a href="ambulance_request_insert.php">Add Ambulance Request</a></li>
  <li><a href="compliance_record_insert.php">Add Compliance Record</a></li>
  <li><a href="billing_record_insert.php">Add Billing Record</a></li>
  <li><a href="feedback_insert.php">Add Feedback</a></li>
</ul>

<h2>🚪 Logout</h2>
<ul>
  <li><a href="logout.php">Logout</a></li>
</ul>

  </div>
</body>
</html>
