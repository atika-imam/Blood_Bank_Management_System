<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

// Get doctors list for the select input
$doctors_sql = "SELECT doctor_id, name FROM doctors";
$doctors_result = $conn->query($doctors_sql);

// Get patients list for the select input
$patients_sql = "SELECT patient_id, name FROM patients";
$patients_result = $conn->query($patients_sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the form
    $doctor_id = $_POST['doctor_id'];
    $patient_id = $_POST['patient_id'];
    $appointment_date = $_POST['appointment_date'];
    $status = $_POST['status'];

    // Insert data into appointment_schedule table
    $sql = "INSERT INTO appointment_schedule (doctor_id, patient_id, appointment_date, status) 
            VALUES ('$doctor_id', '$patient_id', '$appointment_date', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment scheduled successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Appointment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Schedule Appointment</h1>
        <form method="POST" action="appointment_schedule_insert.php">
            <label for="doctor_id">Select Doctor:</label>
            <select name="doctor_id" required>
                <option value="">-- Select Doctor --</option>
                <?php while ($doctor = $doctors_result->fetch_assoc()) { ?>
                    <option value="<?php echo $doctor['doctor_id']; ?>"><?php echo $doctor['name']; ?></option>
                <?php } ?>
            </select>
            
            <label for="patient_id">Select Patient:</label>
            <select name="patient_id" required>
                <option value="">-- Select Patient --</option>
                <?php while ($patient = $patients_result->fetch_assoc()) { ?>
                    <option value="<?php echo $patient['patient_id']; ?>"><?php echo $patient['name']; ?></option>
                <?php } ?>
            </select>
            
            <label for="appointment_date">Appointment Date:</label>
            <input type="datetime-local" name="appointment_date" required>
            
            <label for="status">Status:</label>
            <select name="status" required>
                <option value="scheduled">Scheduled</option>
                <option value="completed">Completed</option>
                <option value="canceled">Canceled</option>
            </select>

            <button type="submit">Schedule Appointment</button>
        </form>

        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
