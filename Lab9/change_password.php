<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

$error_message = "";
$success_message = "";

if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Validate the input
    if (empty($current_password) || empty($new_password) || empty($confirm_new_password)) {
        $error_message = "Please fill in all fields.";
    } elseif ($new_password !== $confirm_new_password) {
        $error_message = "New passwords do not match.";
    } else {
        // Connect to the database and fetch the user's current hashed password
        $conn = new mysqli("localhost", "root", "", "lab9");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT password FROM users WHERE id = '$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            if (password_verify($current_password, $hashed_password)) {
                // Hash the new password and update it in the database
                $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_sql = "UPDATE users SET password = '$new_hashed_password' WHERE id = '$user_id'";
                if ($conn->query($update_sql) === TRUE) {
                    $success_message = "Password changed successfully. Please login with the new password.";
                } else {
                    $error_message = "Error updating password: " . $conn->error;
                }
            } else {
                $error_message = "Current password is incorrect.";
            }
        } else {
            $error_message = "User not found.";
        }

        $conn->close();
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Change Password</h2>
        <?php if ($error_message !== "") { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php } elseif ($success_message !== "") { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
            <p>Click <a href="login.php">here</a> to log in with the new password.</p>
        <?php } else { ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" class="form-control" name="current_password" id="current_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" name="new_password" id="new_password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_new_password">Confirm New Password</label>
                    <input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password" required>
                </div>
                <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                <div class="mt-3">
                    <a href="<?php echo $user_type === 'User' ? 'dashboard_user.php' : 'dashboard_admin.php'; ?>" class="btn btn-primary">Back to Dashboard</a>
                </div>
            </form>
        <?php } ?>
    </div>
</body>
</html>

