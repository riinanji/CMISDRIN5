<?php
include '../../include/config.php'; // Include your DB configuration

// Check if ID is provided
if (!isset($_GET['id'])) {
    die('ID is required');
}

$id = intval($_GET['id']); // Get the staff ID from the URL

// Fetch staff data for editing
$query = "SELECT * FROM staff WHERE id = ?";
$stmt = mysqli_prepare($bd, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$staff = mysqli_fetch_assoc($result);

if (!$staff) {
    die('Staff not found');
}

// Define the target directory
$targetDir = __DIR__ . "/../../staff/uploads/"; // Use absolute path

// Ensure directory exists
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0755, true); // Create directory if it doesn't exist
}

// Update staff data if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($bd, $_POST['name']);
    $age = intval($_POST['age']);
    $address = mysqli_real_escape_string($bd, $_POST['address']);
    $position = mysqli_real_escape_string($bd, $_POST['position']);
    $status = mysqli_real_escape_string($bd, $_POST['status']);
    $sex = mysqli_real_escape_string($bd, $_POST['sex']);
    $phone_number = mysqli_real_escape_string($bd, $_POST['phone_number']);

    // Handle image upload
    $profile_picture = $staff['profile_picture']; // Default to current picture
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profile_picture = basename($_FILES['profile_picture']['name']);
        $targetFilePath = $targetDir . $profile_picture;
        if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFilePath)) {
            die('Error moving uploaded file');
        }
    }

    // Update query
    $updateQuery = "UPDATE staff SET name=?, age=?, address=?, position=?, status=?, sex=?, phone_number=?, profile_picture=? WHERE id=?";
    $updateStmt = mysqli_prepare($bd, $updateQuery);
    mysqli_stmt_bind_param($updateStmt, 'sissssssi', $name, $age, $address, $position, $status, $sex, $phone_number, $profile_picture, $id);

    if (mysqli_stmt_execute($updateStmt)) {
        // Redirect to the view page after update, including the staff ID in the URL
        header('Location: http://localhost/cmisdrin5/admin/staff/view.php?id=' . $id);
        exit;
    } else {
        echo 'Error: ' . mysqli_error($bd);
    }
    mysqli_stmt_close($updateStmt);
}

mysqli_stmt_close($stmt);
mysqli_close($bd);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f7f6;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            font-size: 1.5rem;
            border-bottom: 0;
        }
        .card-body {
            padding: 2rem;
        }
        .form-control, .btn {
            border-radius: 0.25rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .img-thumbnail {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                Edit Staff
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="profile_picture">Profile Picture</label>
                        <?php if ($staff['profile_picture']): ?>
                            <div class="mb-2">
                                <img src="../../staff/uploads/<?php echo htmlspecialchars($staff['profile_picture']); ?>" class="img-thumbnail" alt="Profile Picture">
                            </div>
                        <?php endif; ?>
                        <input type="file" id="profile_picture" name="profile_picture" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($staff['name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" class="form-control" value="<?php echo htmlspecialchars($staff['age']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" class="form-control" value="<?php echo htmlspecialchars($staff['address']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" id="position" name="position" class="form-control" value="<?php echo htmlspecialchars($staff['position']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" id="status" name="status" class="form-control" value="<?php echo htmlspecialchars($staff['status']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <input type="text" id="sex" name="sex" class="form-control" value="<?php echo htmlspecialchars($staff['sex']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control" value="<?php echo htmlspecialchars($staff['phone_number']); ?>" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="http://localhost/cmisdrin4/admin/staff/view.php" class="btn btn-secondary">Cancel</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
