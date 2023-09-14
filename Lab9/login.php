<?php
session_start();

// Redirect to dashboard if user is already logged in
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] === 'User') {
        header("Location: dashboard_user.php");
    } elseif ($_SESSION['user_type'] === 'Admin') {
        header("Location: dashboard_admin.php");
    }
    exit();
}

$error_message = "";

if (isset($_POST['login'])) {
    $user_id = $_POST['id'];
    $password = $_POST['password'];

    // Connect to the database and fetch user data
    $conn = new mysqli("localhost", "root", "", "lab9");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['user_type'] = $row['user_type'];

            if ($row['user_type'] === 'User') {
                header("Location: dashboard_user.php");
            } elseif ($row['user_type'] === 'Admin') {
                header("Location: dashboard_admin.php");
            }
            exit();
        } else {
            $error_message = "Invalid Information";
        }
    } else {
        $error_message = "Invalid Information";
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="login-container">
            <div class="col-md-6">
                <h2 class="text-center">Login</h2>
                <?php if ($error_message !== "") { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php } ?>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" name="id" id="id" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                    <a href="registration.php" class="btn btn-link">Register</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>