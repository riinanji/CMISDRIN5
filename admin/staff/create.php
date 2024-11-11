<?php
include '../../include/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $position = $_POST['position'];
    $status = $_POST['status'];
    $sex = $_POST['sex'];
    $phone_number = $_POST['phone_number'];

    // Handle image upload
    $profile_picture = '';
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $targetDir = "uploads/";
        $profile_picture = uniqid() . '_' . basename($_FILES['profile_picture']['name']); // Use unique filename
        $targetFilePath = $targetDir . $profile_picture;
        
        // Check if the upload was successful
        if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFilePath)) {
            // Handle error
            echo "Error uploading file.";
            exit;
        }
    }

    $query = "INSERT INTO staff (profile_picture, name, age, address, position, status, sex, phone_number) 
              VALUES ('$profile_picture', '$name', '$age', '$address', '$position', '$status', '$sex', '$phone_number')";
    
    if (mysqli_query($bd, $query)) {
        header("Location: http://localhost/cmisdrin5/admin/staff.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($bd);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Staff</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background: #ffffff;
            padding: 20px; /* Reduced padding */
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            max-width: 500px; /* Reduced max-width */
            width: 100%;
        }
        h1 {
            color: #007bff;
            font-size: 1.5rem; /* Reduced font size */
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group label {
            font-weight: 500;
            color: #333;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: 500;
            padding: 10px 15px; /* Reduced padding */
            font-size: 14px; /* Reduced font size */
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004a8c;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            font-weight: 500;
            padding: 10px 15px; /* Reduced padding */
            font-size: 14px; /* Reduced font size */
            transition: background-color 0.3s ease, border-color 0.3s ease;
            margin-top: 15px;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 10px; /* Reduced padding */
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }
        .form-control-file {
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 4px; /* Reduced padding */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Staff</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" class="form-control-file" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" name="age" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" name="position" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="status">Marital Status</label>
                <input type="text" name="status" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="sex">Sex</label>
                <input type="text" name="sex" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add Staff</button>
            <a href="http://localhost/cmisdrin4/admin/staff.php" class="btn btn-secondary btn-block">Back to Staff List</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
