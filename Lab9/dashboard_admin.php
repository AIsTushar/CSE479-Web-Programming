<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
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
        <?php session_start(); ?>
        <h2>Welcome <?php echo $_SESSION['name']; ?> <strong>!</strong></h2>
        <ul class="list-group mt-3">
            <li class="list-group-item"><a href="profile.php">Profile</a></li>
            <li class="list-group-item"><a href="change_password.php">Change Password</a></li>
            <li class="list-group-item"><a href="view_users.php">View Users</a></li>
            <li class="list-group-item"><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</body>

</html>