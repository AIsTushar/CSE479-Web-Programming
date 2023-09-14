<?php
// Database connection code here

$id = $_POST['id'];
$name = $_POST['name'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
$email = $_POST['email'];
$usertype = $_POST['usertype'];

// Validate inputs here

// Check if passwords match
if ($password !== $confirmpassword) {
  die("Passwords do not match.");
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user data into the database
$query = "INSERT INTO users (id, name, password, email, usertype) VALUES ('$id', '$name', '$hashedPassword', '$email', '$usertype')";
// Execute the query

echo "Registration successful. <a href='login.php'>Login here</a>";
?>