<?php
session_start();

// Database connection code here

$currentPassword = $_POST['current_password'];
$newPassword = $_POST['new_password'];
$confirmNewPassword = $_POST['confirm_new_password'];

// Validate inputs here

// Retrieve the user's hashed password from the database based on the user ID stored in the session
$query = "SELECT password FROM users WHERE id = '{$_SESSION['user_id']}'";
// Execute the query and fetch the user data

if ($user && password_verify($currentPassword, $user['password'])) {
  if ($newPassword === $confirmNewPassword) {
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $updateQuery = "UPDATE users SET password = '$hashedNewPassword' WHERE id = '{$_SESSION['user_id']}'";
    // Execute the update query

    echo "Password changed successfully.";
  } else {
    echo "New passwords do not match.";
  }
} else {
  echo "Current password is incorrect.";
}
?>