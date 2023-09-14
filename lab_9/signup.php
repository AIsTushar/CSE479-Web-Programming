<!DOCTYPE html>
<html>

<head>
  <title>Sign Up</title>
</head>
<link rel="stylesheet" href="styles.css">

<body>
  <div class="container">
    <h2>Sign Up</h2>
    <form action="register.php" method="POST">
      <input type="text" name="id" placeholder="User ID" required><br>
      <input type="text" name="name" placeholder="Full Name" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="password" name="confirmpassword" placeholder="Confirm Password" required><br>
      <input type="email" name="email" placeholder="Email" required><br>
      <select name="usertype">
        <option value="normal">Normal User</option>
        <option value="admin">Admin</option>
      </select><br>
      <input type="submit" value="Sign Up">
    </form>
  </div>
</body>

</html>