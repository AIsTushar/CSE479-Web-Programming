<?php
session_start();

// Redirect to login page if user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$error_message = "";

if (isset($_POST['register'])) {
    // Check if the required fields are set in the $_POST array
    if (isset($_POST['id'], $_POST['password'], $_POST['confirm_password'], $_POST['name'], $_POST['email'], $_POST['user_type'])) {
        $id = $_POST['id'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $user_type = $_POST['user_type'];

        $conn = new mysqli("localhost", "root", "", "lab9");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the information is already provided and saved
        $check_query = "SELECT * FROM users WHERE id='$id' OR email='$email'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            $error_message = "The information is already provided, please try to login!";
        } else {
            // Insert new user data into the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO users (id, password, name, email, user_type) VALUES ('$id', '$hashed_password', '$name', '$email', '$user_type')";

            if ($conn->query($insert_query) === TRUE) {
                header("Location: login.php");
                exit();
            } else {
                $error_message = "Error: " . $conn->error;
            }
        }

        $conn->close();
    } else {
        $error_message = "Please fill in all the required fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
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
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Registration</h2>
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
                        <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="user_type">User Type</label>
                        <select class="form-control" name="user_type" id="user_type" required>
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" name="register" class="btn btn-primary">Register</button>
                        <a href="login.php" class="btn btn-link">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
