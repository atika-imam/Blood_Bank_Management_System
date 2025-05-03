<?php
session_start();
if (! isset($_SESSION['username'])) {
  header('Location: loginpage.php');
  exit;
}
include 'db_config.php';
$blood = $_POST['blood'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Search Blood Records</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Search Blood Records</h1>
    <form method="post" action="search.php">
    <label>Select Blood Group:</label>
<select name="blood" required>
  <option value="">-- Choose --</option>
  <?php
    $blood_groups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    foreach ($blood_groups as $bg) {
      $sel = ($bg == $blood) ? ' selected' : '';
      echo "<option value='$bg'$sel>$bg</option>";
    }
  ?>

      </select>
      <button type="submit">Search</button>
    </form>

    <?php if($blood): ?>
      <h2>Results for “<?php echo htmlspecialchars($blood); ?>”</h2>

      <h3>Donors</h3>
      <table>
        <tr><th>Name</th><th>Age</th><th>Gender</th><th>Contact</th></tr>
        <?php
        $dq = $conn->prepare("SELECT name, age, gender, contact_no FROM donors WHERE blood_group=?");
        $dq->bind_param('s',$blood);
        $dq->execute();
        $dr = $dq->get_result();
        if($dr->num_rows){
          while($row = $dr->fetch_assoc()){
            echo "<tr><td>{$row['name']}</td><td>{$row['age']}</td><td>{$row['gender']}</td><td>{$row['contact_no']}</td></tr>";
          }
        } else {
          echo "<tr><td colspan='4'>No donors found</td></tr>";
        }
        ?>
      </table>

      <h3>Patients</h3>
      <table>
        <tr><th>Name</th><th>Age</th><th>Gender</th><th>Disease</th><th>Contact</th></tr>
        <?php
        $pq = $conn->prepare("SELECT name, age, gender, disease, contact_no FROM patients WHERE blood_group=?");
        $pq->bind_param('s',$blood);
        $pq->execute();
        $pr = $pq->get_result();
        if($pr->num_rows){
          while($row = $pr->fetch_assoc()){
            echo "<tr><td>{$row['name']}</td><td>{$row['age']}</td><td>{$row['gender']}</td><td>{$row['disease']}</td><td>{$row['contact_no']}</td></tr>";
          }
        } else {
          echo "<tr><td colspan='5'>No patients found</td></tr>";
        }
        ?>
      </table>
    <?php endif; ?>
    <p><a href="index.php" class="back-link">← Back to Home</a></p>
  </div>
</body>
</html>