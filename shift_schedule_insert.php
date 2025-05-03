<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

// Initialize variables
$selected_type = $_POST['emp_type'] ?? '';
$selected_id = $_POST['emp_id'] ?? '';
$shift_date = $_POST['shift_date'] ?? '';
$message = '';

// Time components
$start_hour = $_POST['start_hour'] ?? '';
$start_min = $_POST['start_min'] ?? '';
$start_ampm = $_POST['start_ampm'] ?? '';
$end_hour = $_POST['end_hour'] ?? '';
$end_min = $_POST['end_min'] ?? '';
$end_ampm = $_POST['end_ampm'] ?? '';

// Construct shift_time string
$shift_time = "$start_hour:$start_min $start_ampm - $end_hour:$end_min $end_ampm";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    !empty($selected_id) &&
    !empty($shift_date) &&
    !empty($start_hour) && !empty($start_min) && !empty($start_ampm) &&
    !empty($end_hour) && !empty($end_min) && !empty($end_ampm)) {

    if ($selected_type === 'doctor') {
        $sql = "INSERT INTO shift_schedule (doctor_id, shift_date, shift_time)
                VALUES ('$selected_id', '$shift_date', '$shift_time')";
    } elseif ($selected_type === 'nurse') {
        $sql = "INSERT INTO shift_schedule (nurse_id, shift_date, shift_time)
                VALUES ('$selected_id', '$shift_date', '$shift_time')";
    } else {
        $message = "Invalid employee type selected.";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Shift Scheduled added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$doctor_result = $conn->query("SELECT doctor_id, name FROM doctors");
$nurse_result = $conn->query("SELECT nurse_id, name FROM nurse");
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Shift Schedule</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table, th, td {
            border: none;
            padding: 5px;
        }
        select {
            margin: 2px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Add Shift Schedule</h1>

    <?php if (!empty($message)) echo "<p><strong>$message</strong></p>"; ?>

    <form method="POST" action="shift_schedule_insert.php">
        <label>Select Employee Type:</label>
        <select name="emp_type" onchange="this.form.submit()" required>
            <option value="">-- Choose Type --</option>
            <option value="doctor" <?= $selected_type == 'doctor' ? 'selected' : '' ?>>Doctor</option>
            <option value="nurse" <?= $selected_type == 'nurse' ? 'selected' : '' ?>>Nurse</option>
        </select>

        <?php if ($selected_type == 'doctor'): ?>
            <label>Select Doctor:</label>
            <select name="emp_id" required>
                <?php while($row = $doctor_result->fetch_assoc()): ?>
                    <option value="<?= $row['doctor_id'] ?>" <?= $selected_id == $row['doctor_id'] ? 'selected' : '' ?>>
                        <?= $row['doctor_id'] ?> - <?= $row['name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        <?php elseif ($selected_type == 'nurse'): ?>
            <label>Select Nurse:</label>
            <select name="emp_id" required>
                <?php while($row = $nurse_result->fetch_assoc()): ?>
                    <option value="<?= $row['nurse_id'] ?>" <?= $selected_id == $row['nurse_id'] ? 'selected' : '' ?>>
                        <?= $row['nurse_id'] ?> - <?= $row['name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        <?php endif; ?>

        <label>Shift Date:</label>
        <input type="date" name="shift_date" required>

        <label>Shift Time:</label>
        <table>
            <tr>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
            <tr>
                <td>
                    <select name="start_hour" required>
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select> :
                    <select name="start_min" required>
                        <?php for ($i = 0; $i <= 59; $i++): ?>
                            <option value="<?= sprintf("%02d", $i) ?>"><?= sprintf("%02d", $i) ?></option>
                        <?php endfor; ?>
                    </select>
                    <select name="start_ampm" required>
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                </td>

                <td>
                    <select name="end_hour" required>
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select> :
                    <select name="end_min" required>
                        <?php for ($i = 0; $i <= 59; $i++): ?>
                            <option value="<?= sprintf("%02d", $i) ?>"><?= sprintf("%02d", $i) ?></option>
                        <?php endfor; ?>
                    </select>
                    <select name="end_ampm" required>
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                </td>
            </tr>
        </table>

        <button type="submit">Add Shift</button>
    </form>

    <p><a href="index.php" class="back-link">← Back to Home</a></p>
</div>
</body>
</html>
