<?php
session_start();

if (isset($_POST['login'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];

    // Connect to MySQL database
    $conn = new mysqli("localhost", "root", "", "lab9");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user data from the database
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['name'] = $row['name']; // Store user's name in the session
            
            if ($row['user_type'] === 'Admin') {
                header("Location: dashboard_admin.php"); // Redirect to admin dashboard
                exit();
            } else {
                header("Location: dashboard_user.php"); // Redirect to user dashboard
                exit();
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }

    $conn->close();
}
?>
