<?php
session_start();
include('../include/config.php');

// Check if uid is set
if (isset($_GET['uid'])) {
    $userId = $_GET['uid'];

    // Fetch user details
    $query = "SELECT * FROM tbl_user WHERE user_ID = '$userId'";
    $result = mysqli_query($bd, $query);

    if (!$result) {
        echo "Error: " . mysqli_error($bd);
        exit;
    }

    $user = mysqli_fetch_array($result);
    if (!$user) {
        echo "User not found.";
        exit;
    }
} else {
    echo "User ID not specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Styles remain the same as before */
        body {
            background: linear-gradient(to right, #e2e2e2, #ffffff);
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fdf6e3; /* Light brown background */
        }
        h3 {
            font-size: 22px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            background: linear-gradient(45deg, #ff9966, #ff5e62); /* Gradient for title */
            color: white;
            padding: 10px;
            border-radius: 8px;
        }
        p {
            font-size: 18px;
            margin: 10px 0;
        }
        .btn {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>User Profile</h3>
        <p>Name: <?php echo htmlentities($user['fullName']); ?></p>
        <p>Email: <?php echo htmlentities($user['userEmail']); ?></p>
        <p>Contact: <?php echo htmlentities($user['contactNo']); ?></p>
        <a href="manage-users.php" class="btn btn-secondary">Back</a>
    </div>
</body>
</html>
