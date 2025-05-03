<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

include('db_config.php');

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the form
    $blood_group = $_POST['blood_group'];
    $quantity = (int)$_POST['quantity'];

    // Insert or update blood stock
    $sql = "INSERT INTO blood_stock (blood_group, quantity) 
            VALUES ('$blood_group', $quantity)
            ON DUPLICATE KEY UPDATE quantity = GREATEST(0, quantity + $quantity)";

    if ($conn->query($sql) === TRUE) {
        echo "Blood stock updated successfully!";
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
    <title>Update Blood Stock</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Update Blood Stock</h1>

        <?php if (!empty($message)) echo $message; ?>

        <form method="POST" action="add_blood_stock.php">
            <label for="blood_group">Blood Group:</label>
            <select name="blood_group" id="blood_group" required>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>

            <label for="quantity">Units to Add/Subtract:</label>
            <input type="number" name="quantity" id="quantity" placeholder="Use negative to subtract" required>

            <button type="submit">Update Stock</button>
        </form>

        <p><a href="index.php" class="back-link">← Back to Home</a></p>
    </div>
</body>
</html>
