<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Management System</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Align items to the top */
            background-image: url('users/staff/uploads/san.jpg'); /* Path to the background image */
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background */
            background-repeat: no-repeat; /* Prevent repetition */
            font-family: Arial, sans-serif;
            position: relative; /* For positioning the button */
            padding-top: 30px; /* Added padding to avoid text being too close to the top */
        }

        .container {
            text-align: center;
            padding: 40px;
            border-radius: 10px;
        }

        h1 {
            font-size: 54px; /* Larger font size for the title */
            color: #ffffff; /* Pure white for clear contrast */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Adding a shadow to make the text stand out */
        }

        .get-started {
            position: absolute; /* Position the button absolutely */
            top: 20px; /* Distance from the top */
            right: 20px; /* Distance from the right */
            padding: 5px 10px; /* Reduced padding */
            font-size: 18px; /* Smaller font size */
            color: white; /* Button text color */
            background-color: #007BFF; /* Button background color */
            text-decoration: none; /* Remove underline */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s;
        }

        .get-started:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
    </style>
</head>
<body>
    <a href="login.php" class="get-started">Get Started</a>
    <div class="container">
        <h1>Complaint Management and Information System</h1>
    </div>
</body>
</html>
