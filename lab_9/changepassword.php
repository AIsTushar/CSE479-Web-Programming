<!DOCTYPE html>
<html>

<head>
  <title>Change Password</title>
</head>

<body>
  <h2>Change Password</h2>
  <form action="changepassword_action.php" method="POST">
    <input type="password" name="current_password" placeholder="Current Password" required><br>
    <input type="password" name="new_password" placeholder="New Password" required><br>
    <input type="password" name="confirm_new_password" placeholder="Confirm New Password" required><br>
    <input type="submit" value="Change Password">
  </form>
</body>

</html>