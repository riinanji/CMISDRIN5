<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | staff list</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0; /* Remove default body margin */
            margin-left: 0px;
            margin-right: 0px;
        }
        .header {
            background-color: gray;
            display: flex;
            justify-content: center; 
            align-items: center;
            height: 60px;
            padding: 0 15px; 
            position: relative; /* Ensure positioning */
        }
        .sidebar-toggle-box {
            background-color: #332e2e;
            border: none;
            border-radius: 4px;
            padding: 8px;
            cursor: pointer;
            display: flex; 
            justify-content: center; 
            align-items: center; 
            position: absolute; /* Position it relative to the header */
            left: 15px; /* Adjust this for placement */
            z-index: 10; /* Ensure it sits above other content */
        }
        .fa-bars {
            color: #fff;
            font-size: 25px; 
        }
        .navbar-brand {
            font-size: 1.9em;
           
            text-align: center;
            flex-grow: 1; 
            text-decoration: none;
            color: #fff; /* Make content text white */
            font-weight: bold; /* Make content text bold */
        }
        .content {
            transition: margin-left 0.3s; /* Smooth transition for content */
            margin-left: 200px; /* Default sidebar width */
            color: #fff; /* Make content text white */
            font-weight: bold; /* Make content text bold */
        }
        .content.expand {
            margin-left: 0; /* Shift content to full width when sidebar is hidden */
        }
        .sidebar {
            width: 200px;
            background-color: #f8f9fa;
            height: 100vh;
            position: fixed;
            transition: margin-left 0.3s; /* Smooth transition for sidebar */
            margin-left: -200px; /* Start hidden */
        }
        .sidebar.show {
            margin-left: 0; /* Show sidebar */
        }
    </style>
</head>
<body>
<header class="header black-bg">
    <div class="sidebar-toggle-box" id="burgerMenuButton">
        <div class="fa fa-bars"></div>
    </div>
    <a href="DB.php" class="navbar-brand">COMPLAINTS MANAGEMENT AND INFORMATION SYSTEM OF BARANGAY AGUSAN CANYON</a>
    <div class="top-menu">
        
    </div>
</header>
<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        let sidebarVisible = false; // Track sidebar visibility

        $('#burgerMenuButton').click(function() {
            sidebarVisible = !sidebarVisible; // Toggle visibility state

            if (sidebarVisible) {
                $('#sidebar').addClass('show'); // Show sidebar
                $('#mainContent').removeClass('expand'); // Keep content normal
            } else {
                $('#sidebar').removeClass('show'); // Hide sidebar
                $('#mainContent').addClass('expand'); // Expand content
            }
        });
    });
</script>
</body>
</html>
