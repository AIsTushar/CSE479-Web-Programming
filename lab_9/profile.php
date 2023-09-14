<!DOCTYPE html>
<html>

<head>
  <title>Profile</title>
</head>

<body>
  <h2>Welcome,
    <?php echo $_SESSION['user_name']; ?>
  </h2>
  <a href="changepassword.php">Change Password</a><br>
  <a href="logout.php">Logout</a>

  <?php if ($_SESSION['user_type'] === 'admin'): ?>
    <a href="allusers.php">View All Users</a>
  <?php endif; ?>
</body>

</html>