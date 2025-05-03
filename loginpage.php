<?php
session_start();
include 'db_config.php';

if(isset($_POST['submit'])) {
    $u = $_POST['username'];
    $p = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username='$u' AND password='$p'";
    $res = mysqli_query($conn, $query);

    if(mysqli_num_rows($res) == 1) {
        $_SESSION['username'] = $u;
        header('Location: index.php'); // After login, go to main page
        exit;
    } else {
        $err = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Blood Bank</title>
  <link rel="stylesheet" href="style.css">
</head>
<!-- <body> -->
<body class="login-page">
<div class="container">
  <h1>Blood Bank Login</h1>
  <?php if (isset($err)) echo "<p class='error'>$err</p>"; ?>
  <form method="post">
  <label for="username">Username:</label>
      <input id="username" type="text" name="username" required>
      <label for="password">Password:</label>
      <input id="password" type="password" name="password" required>
      <button type="submit" name="submit">Login</button>
  </form>
</div>
</body>
</html>