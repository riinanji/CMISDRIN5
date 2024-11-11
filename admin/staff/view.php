<?php
include '../../include/config.php'; // Include your DB configuration

// Check if ID is provided
if (!isset($_GET['id'])) {
    die('ID is required');
}

$id = intval($_GET['id']); // Get the staff ID from the URL

// Fetch staff data
$query = "SELECT * FROM staff WHERE id = ?";
$stmt = mysqli_prepare($bd, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$staff = mysqli_fetch_assoc($result);

if (!$staff) {
    die('Staff not found');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #007bff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .profile-info {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .profile-info h2 {
            margin-bottom: 20px;
        }
        .profile-info table {
            width: 100%;
            margin-bottom: 20px;
        }
        .profile-info td {
            padding: 10px;
        }
        .btn-warning, .btn-danger, .btn-secondary {
            margin: 5px;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .back-button {
            position: absolute;
            top: 15px;
            left: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="http://localhost/cmisdrin5/admin/staff.php" class="btn btn-secondary back-button">Back to Staff List</a>
        <div class="profile-info text-center mt-5">
            <?php 
                $profile_picture = htmlspecialchars($staff['profile_picture']);
                $imagePath = 'uploads/' . $profile_picture;
                $defaultImagePath = 'uploads/default.png';
            ?>
            <img src="<?php echo !empty($profile_picture) && file_exists('uploads/' . $profile_picture) ? $imagePath : $defaultImagePath; ?>" alt="Profile Picture" class="profile-pic">
            <h2><?php echo htmlspecialchars($staff['name']); ?></h2>
            <table class="table table-bordered">
                <tr><td><strong>Age:</strong></td><td><?php echo htmlspecialchars($staff['age']); ?></td></tr>
                <tr><td><strong>Address:</strong></td><td><?php echo htmlspecialchars($staff['address']); ?></td></tr>
                <tr><td><strong>Position:</strong></td><td><?php echo htmlspecialchars($staff['position']); ?></td></tr>
                <tr><td><strong>Status:</strong></td><td><?php echo htmlspecialchars($staff['status']); ?></td></tr>
                <tr><td><strong>Sex:</strong></td><td><?php echo htmlspecialchars($staff['sex']); ?></td></tr>
                <tr><td><strong>Phone Number:</strong></td><td><?php echo htmlspecialchars($staff['phone_number']); ?></td></tr>
            </table>

            <a href="edit.php?id=<?php echo $staff['id']; ?>" class="btn btn-warning">Edit</a>
            <a href="delete.php?id=<?php echo $staff['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this staff member?')">Delete</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
