<?php
include('../include/config.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$msg = ''; // Initialize message variable

if (isset($_POST['submit'])) {
    $fullname = mysqli_real_escape_string($bd, $_POST['fullname']);
    $email = mysqli_real_escape_string($bd, $_POST['email']);
    $password = mysqli_real_escape_string($bd, $_POST['password']);
    $contactno = mysqli_real_escape_string($bd, $_POST['contactno']);
    $status = 1;
    $userAccess_ID = 2; // Regular user

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $checkEmail = mysqli_query($bd, "SELECT userEmail FROM tbl_user WHERE userEmail='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
        $msg = "Email is already registered!";
    } else {
        // Insert user into the database
        $query = "INSERT INTO tbl_user (fullName, userEmail, password, contactNo, status, userAccess_ID) VALUES ('$fullname', '$email', '$hashed_password', '$contactno', '$status', '$userAccess_ID')";
        if (mysqli_query($bd, $query)) {
            $msg = "Account created successfully! You can now log in.";
        } else {
            $msg = "Error: " . mysqli_error($bd);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>CMS | User Registration</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
    function userAvailability() {
        $("#loaderIcon").show();
        $.ajax({
            url: "check_availability.php",
            data: 'email=' + $("#email").val(),
            type: "POST",
            success: function(data) {
                $("#user-availability-status1").html(data);
                $("#loaderIcon").hide();
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + error);
                $("#loaderIcon").hide();
            }
        });
    }
    </script>
</head>
<body>
    <div id="login-page">
        <div class="container">
            <form class="form-login" method="post" action="">
                <h2 class="form-login-heading">User Registration</h2>
                <p style="padding-left: 1%; color: green">
                    <?php if ($msg) { echo htmlentities($msg); } ?>
                </p>
                <div class="login-wrap">
                    <input type="text" class="form-control" placeholder="Full Name" name="fullname" required="required" autofocus>
                    <br>
                    <input type="email" class="form-control" placeholder="Email" id="email" onBlur="userAvailability()" name="email" required="required">
                    <span id="user-availability-status1" style="font-size:12px;"></span>
                    <br>
                    <input type="password" class="form-control" placeholder="Password" required="required" name="password"><br>
                    <input type="text" class="form-control" maxlength="10" name="contactno" placeholder="Contact no" required="required" autofocus>
                    <br>
                    <button class="btn btn-theme btn-block" type="submit" name="submit" id="submit"><i class="fa fa-user"></i> Register</button>
                    <hr>
                    <div class="registration">
                        Already Registered?<br/>
                        <a href="../login.php">Sign in</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
