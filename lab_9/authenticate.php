<?php
// Database connection code here

$id = $_POST['id'];
$password = $_POST['password'];

// Query to retrieve user data based on the provided ID
$query = "SELECT * FROM users WHERE id = '$id'";
// Execute the query and fetch the user data

if ($user && password_verify($password, $user['password'])) {
  // Set session variables
  session_start();
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['user_name'] = $user['name'];
  $_SESSION['user_type'] = $user['usertype'];

  header("Location: profile.php");
} else {
  echo "Invalid login credentials.";
}
?>