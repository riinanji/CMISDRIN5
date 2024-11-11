<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("include/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        if ($bd) {
            // Prepared statement to fetch user data
            $stmt = $bd->prepare("SELECT user_ID, password, userAccess_ID FROM tbl_user WHERE userEmail = ? AND status = 1 LIMIT 1");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                // Compare the entered password with the hashed password stored in the database using bcrypt
                if (password_verify($password, $user['password'])) {
                    // Password is correct
                    $_SESSION['login'] = $username;
                    $_SESSION['id'] = $user['user_ID'];
                    $_SESSION['role'] = $user['userAccess_ID'];

                    $uip = $_SERVER['REMOTE_ADDR'];
                    $status = 1;

                    // Log user login
                    if (isset($_SESSION['id']) && !is_null($_SESSION['id'])) {
                        $log_stmt = $bd->prepare("INSERT INTO userlog(user_ID, username, userip, status) VALUES (?, ?, ?, ?)");
                        $log_stmt->bind_param("issi", $_SESSION['id'], $username, $uip, $status);
                        $log_stmt->execute();
                    } else {
                        echo 'Session ID is not set or is null.';
                    }

                    // Redirect based on user role
                    if ($_SESSION['role'] == 1) {
                        header("Location: admin/DB.php");
                    } elseif ($_SESSION['role'] == 2) {
                        header("Location: users/dashboard.php");
                    }
                    exit();
                } else {
                    $errormsg = "Invalid password.";
                }
            } else {
                $errormsg = "No user found with that username or account is inactive.";
            }
        } else {
            $errormsg = "Database connection error.";
        }
    } else {
        $errormsg = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS | User Login</title>
    <link href="users/assets/css/bootstrap.css" rel="stylesheet">
    <link href="users/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="users/assets/css/style.css" rel="stylesheet">
    <link href="users/assets/css/style-responsive.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f9fc;
            font-family: 'Arial', sans-serif;
        }
        #login-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 400px; /* Adjusted width for a professional look */
            text-align: center; /* Center text */
            
        
    margin-top: 50px !important;
}

            
        
        .logo {
            display: block;
            margin: 160px auto 20px; /* Increased top margin to lower the logo */
            width: 190px; /* Set a fixed width for the logo */
            height: auto; /* Maintain aspect ratio */
        }
        .form-login-heading {
            margin-bottom: 20px;
            font-size: 28px; /* Larger font for heading */
            color: #4b6f89;
            font-weight: 600; /* Bolder font */
        }
        .login-wrap {
            margin-bottom: 20px;
        }
        .form-control {
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ced4da; /* Bootstrap border color */
            padding: 10px;
        }
        .form-control:focus {
            border-color: #80bdff; /* Bootstrap focus color */
            box-shadow: 0 0 0.2rem rgba(0, 123, 255, .25);
        }
        .btn-theme {
            background-color: #4b6f89;
            color: #ffffff;
            font-weight: bold;
            border: none; /* Remove border */
            transition: background-color 0.3s ease; /* Transition effect */
        }
        .btn-theme:hover {
            background-color: #3a5c76; /* Darker on hover */
        }
        .registration {
            margin-top: 15px;
            font-size: 14px; /* Consistent font size */
        }
        .registration a {
            color: #4b6f89; /* Link color */
            text-decoration: none; /* Remove underline */
        }
        .registration a:hover {
            text-decoration: underline; /* Underline on hover */
        }
        .modal-header {
            background-color: #4b6f89;
            color: white;
            border-bottom: none; /* Remove border */
        }
        .modal-footer .btn {
            background-color: #4b6f89;
            color: white;
        }
        .modal-footer .btn:hover {
            background-color: #3a5c76;
        }
    </style>
</head>
<body>
    <div id="login-page">
        <div class="container">
            <!-- Logo -->
             <img src="admin/staff/uploads/agusan.jpg" alt="Logo" class="logo"> 
            <form class="form-login" name="login" method="post">
                <h2 class="form-login-heading">Sign In</h2>
                <p style="color:red; text-align: center;">
                    <?php if (isset($errormsg)) { echo htmlentities($errormsg); } ?>
                </p>
                <div class="login-wrap">
                    <input type="text" class="form-control" name="username" placeholder="Email" required autofocus>
                    <input type="password" class="form-control" name="password" required placeholder="Password">
                    <label class="checkbox">
                        <span class="pull-right">
                            <a data-toggle="modal" href="#myModal">Forgot Password?</a>
                        </span>
                    </label>
                    <button class="btn btn-theme" name="submit" type="submit">
                        <i class="fa fa-lock"></i> SIGN IN
                    </button>
                    <hr>
                </div>
            </form>
            <div class="registration">
                Don't have an account yet?<br/>
                <a href="users/registration.php">Create an account</a>
            </div>

            <!-- Modal for Forgot Password -->
            <form class="form-login" name="forgot" method="post">
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Forgot Password?</h4>
                            </div>
                            <div class="modal-body">
                                <p>Enter your details below to reset your password.</p>
                                <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control" required>
                                <input type="text" name="contact" placeholder="Contact No" autocomplete="off" class="form-control" required>
                                <input type="password" class="form-control" placeholder="New Password" id="password" name="password" required>
                                <input type="password" class="form-control" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" required>
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                <button class="btn btn-theme" type="submit" name="change" onclick="return valid();">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="users/assets/js/jquery.js"></script>
    <script src="users/assets/js/bootstrap.min.js"></script>
</body>
</html>
