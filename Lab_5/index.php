<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="url"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        textarea {
            resize: vertical;
        }

        .error-message {
            color: red;
        }

        .btn {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="router_ip">IP address of your router (default: 192.168.0.1):</label>
                <input type="text" id="router_ip" name="router_ip" value="192.168.0.1" required>
            </div>

            <div class="form-group">
                <label for="personal_url">Personal web URL:</label>
                <input type="url" id="personal_url" name="personal_url" required>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
            </div>

            <div class="form-group">
                <label>Gender:</label>
                <label for="male">Male</label>
                <input type="radio" id="male" name="gender" value="male" required>
                <label for="female">Female</label>
                <input type="radio" id="female" name="gender" value="female" required>
            </div>

            <div class="form-group">
                <label for="mobile_number">Mobile Number:</label>
                <input type="text" id="mobile_number" name="mobile_number" required>
            </div>

            <div class="form-group">
                <label for="brief_info">Brief info (maximum 50 words):</label>
                <textarea id="brief_info" name="brief_info" rows="5" maxlength="250" required></textarea>
            </div>

            <button type="submit" class="btn">Register</button>
        </form>
    </div>

    <!-- PHP part  -->
    <?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $router_ip = $_POST["router_ip"];
    $personal_url = $_POST["personal_url"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $mobile_number = $_POST["mobile_number"];
    $brief_info = $_POST["brief_info"];

    // Regular expressions for validation
    $name_pattern = "/^(?=.{4,20}$)([a-zA-Z]+)\s?([a-zA-Z]+)?\s?([a-zA-Z]+)?$/";
    $email_pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    $password_pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{7,25}$/";
    $ip_address_pattern = "/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/";
    $url_pattern = "/^https?:\/\/[^\s]+$/";
    $date_pattern = "/^(\d{4})-(\d{2})-(\d{2})$/";
    $mobile_number_pattern = "/^01[3-9]\d{8}$/";
    $brief_info_pattern = "/^[a-zA-Z0-9\s]{1,250}$/";

    // Validation checks
    $errors = [];
    if (empty($name) || !preg_match($name_pattern, $name)) {
        $errors["name"] = "Name must be 4-20 characters long, with a first name and last name.";
    }

    if (empty($email) || !preg_match($email_pattern, $email)) {
        $errors["email"] = "Please enter a valid email address.";
    }

    if (empty($password) || !preg_match($password_pattern, $password)) {
        $errors["password"] = "Password must contain an uppercase letter, a lowercase letter, and a number. It should be 7-25 characters long.";
    }

    if (empty($router_ip) || !preg_match($ip_address_pattern, $router_ip)) {
        $errors["router_ip"] = "Please enter a valid IP address.";
    }

    if (empty($personal_url) || !preg_match($url_pattern, $personal_url)) {
        $errors["personal_url"] = "Please enter a valid URL.";
    }

    if (empty($dob) || !preg_match($date_pattern, $dob)) {
        $errors["dob"] = "Please enter a valid date in the format YYYY-MM-DD.";
    }

    if (empty($gender)) {
        $errors["gender"] = "Please select a gender.";
    }

    if (empty($mobile_number) || !preg_match($mobile_number_pattern, $mobile_number)) {
        $errors["mobile_number"] = "Please enter a valid Bangladeshi mobile number.";
    }

    if (empty($brief_info) || str_word_count($brief_info) > 50 || !preg_match($brief_info_pattern, $brief_info)) {
        $errors["brief_info"] = "Brief info should not contain more than 50 words and must have only alphanumeric characters.";
    }


    // If there are no errors
    if (empty($errors)) {
        echo "<h3>Registration Successful!</h3>";
        echo "<p>Thank you for registering.</p>";
    } else {
        echo "<h3>Registration Failed</h3>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li class='error-message'>$error</li>";
        }
        echo "</ul>";
    }
}
?>

</body>
</html>
