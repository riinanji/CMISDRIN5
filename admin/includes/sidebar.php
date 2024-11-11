<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            overflow-x: hidden; /* Prevent horizontal scroll */
        }
        .sidebar {
            position: fixed;
            top: 60px; /* Adjust to match the header height */
            width: 250px; /* Reduced width from 300px to 200px */
            background-color: #343a40;
            color: #fff;
            height: calc(100% - 60px); /* Adjust height to fit header */
            left: -200px; /* Initially hidden */
            transition: all 0.3s ease;
            overflow-y: auto; /* Enable vertical scroll for sidebar */
        }
        .sidebar.open {
            left: 0; /* Show when open */
        }
        .sidebar ul {
            list-style-type: none;
            padding-left: 0;
        }
        .sidebar ul li {
            padding: 8px 12px; /* Reduced padding */
            text-align: left;
        }
        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
            font-size: 15px;
            padding: 10px; /* Reduced padding */
        }
        .sidebar ul li a:hover {
            background-color: skyblue;
            text-decoration: none;
            border-radius: 4px;
        }
        .content {
            margin-top: 50px;
            margin-left: 200px; /* Adjusted for smaller sidebar */
            padding: 20px;
            width: calc(100% - 200px); /* Adjust width according to the new sidebar size */
            transition: margin-left 0.3s ease, width 0.3s ease; /* Smooth transition */
        }

         /* diri sa content drin ang ma isbog sa left side ang div sa dashboard */
         


        .toggle-button {
            font-size: 30px;
            position: fixed;
            top: 20px;
            left: 20px;
            cursor: pointer;
            color: #343a40;
            transition: all 0.3s;
        }
        .bi-chevron-down.rotate {
            transform: rotate(180deg);
            transition: transform 0.3s ease; /* Smooth transition for rotation */
        }
        
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="DB.php">
                    <i class="bi bi-house"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#togglePages" aria-expanded="false">
                    <i class="bi bi-person"></i>
                    Manage Complaints
                    <i class="bi bi-chevron-down float-end"></i>
                </a>
                <ul id="togglePages" class="collapse">
                    <li>
                        <a href="complaint-details.php">
                            <i class="bi bi-eye"></i> <!-- Changed to eye icon -->
                            View Complaints
                        </a>
                    </li>
                    <li>
                        <a href="complaint_history.php">
                            <i class="bi bi-clock-history"></i> <!-- Changed to clock icon for history -->
                            Transaction Complaints
                        </a>
                    </li>
                    <li>
                        <a href="category.php">
                            <i class="bi bi-tags"></i> <!-- Changed to tags icon -->
                            Add Category
                        </a>
                    </li>
                    
                    
                </ul>
            </li>

            <li>
                <a href="tools_equipment.php" class="nav-link">
                    <i class="bi bi-tools"></i>
                    Tools & Equipment
                </a>
            </li>
            <li>
                <a href="staff.php" class="nav-link">
                    <i class="bi bi-person"></i>
                    Staff
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#toggleUsers" aria-expanded="false">
                    <i class="bi bi-person"></i>
                    User Management
                    <i class="bi bi-chevron-down float-end"></i>
                </a>
                <ul id="toggleUsers" class="collapse">
                    <li>
                        <a href="manage-users.php">
                            <i class="bi bi-person"></i>
                            Manage Users
                        </a>
                    </li>
                    <li>
                        <a href="user-logs.php">
                            <i class="bi bi-list-task"></i>
                            User Login Log
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Chevron rotation for collapse links
            $('.nav-link[data-bs-toggle="collapse"]').on('click', function() {
                $(this).find('.bi-chevron-down').toggleClass('rotate');
            });

            // Toggle sidebar visibility
            $('#burgerMenuButton').click(function() {
                $('.sidebar').toggleClass('open');
                $('.sidebar').toggleClass('shift'); // Shift the content
            });
        });
    </script>

</body>
</html>
