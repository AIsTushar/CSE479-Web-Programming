<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
</head>
<link rel="stylesheet" href="styles.css">

<body>
  <div class="container">
    <h2>Login</h2>
    <form action="authenticate.php" method="POST">
      <input type="text" name="id" placeholder="User ID" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="submit" value="Login">
    </form>
  </div>
</body>

</html>