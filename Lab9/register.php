<?php
// register.php
if (isset($_POST['register'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];

    // Validate and sanitize inputs

    // Connect to MySQL database
    $conn = new mysqli("localhost", "root", "", "lab9");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $sql = "INSERT INTO users (id, password, name, email, user_type) VALUES ('$id', '$hashed_password', '$name', '$email', '$user_type')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
