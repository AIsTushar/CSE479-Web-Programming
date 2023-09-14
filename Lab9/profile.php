
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['name']; 
$user_type = $_SESSION['user_type'];

// Connect to MySQL database
$conn = new mysqli("localhost", "root", "", "lab9");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user's profile data from the database
$sql = "SELECT id, name, email, user_type FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $user_profile_data = $result->fetch_assoc();
} else {
    // Handle the case when user data is not found
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
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
        <h2>Welcome <?php echo $user_name; ?> to your profile</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Profile Information</h5>
                <p class="card-text"><strong>ID:</strong> <?php echo $user_profile_data['id']; ?></p>
                <p class="card-text"><strong>Name:</strong> <?php echo $user_profile_data['name']; ?></p>
                <p class="card-text"><strong>Email:</strong> <?php echo $user_profile_data['email']; ?></p>
                <p class="card-text"><strong>User Type:</strong> <?php echo $user_profile_data['user_type']; ?></p>
            </div>
            <div class="mt-3">
            <a href="<?php echo $user_type === 'User' ? 'dashboard_user.php' : 'dashboard_admin.php'; ?>" class="btn btn-primary">Back to Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>

