<?php
include ('../include/config.php'); // Include your DB configuration
include('includes/header.php'); // Include header
include('includes/sidebar.php'); // Include sidebar

// Fetch staff data, including status
$query = "SELECT id, name, position, phone_number, status FROM staff"; // Added status to the query
$result = mysqli_query($bd, $query);
$staffs = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Group staff by position
$staffByPosition = [];
foreach ($staffs as $staff) {
    $staffByPosition[$staff['position']][] = $staff;
}

// Sort positions by the number of staff members
arsort($staffByPosition);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff List</title>

    <!-- Latest Bootstrap 5.3.0 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link type="text/css" href="css/theme.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #e2e2e2, #ffffff);
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            top: 100px;
            max-width: 1200px;
            margin-top: 20px;
        }
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .search-input {
            width: 300px;
            padding: 10px;
            border-radius: 8px;
            border: 2px solid #6c757d;
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            font-size: 1rem;
            color: #333;
        }
        .search-input::placeholder {
            color: #888;
        }
        .staff-list {
            margin-top: 10px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        .position-column {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .position-column:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
        .position-header {
            font-size: 1.3rem;
            font-weight: 600;
            color: black;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #6c757d;
        }
        .staff-card {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #f1f1f1;
        }
        .staff-name, .staff-phone, .staff-status {
            font-size: 0.9rem;
        }
        .staff-name {
            font-weight: 600;
            color: #333;
        }
        .staff-status {
            color: #6c757d; /* Default color */
            font-style: italic;
            align-self: center;
        }
        .staff-status.active {
            color: #28a745; /* Green color for active status */
        }
        .btn-primary {
            background-color: #6c757d !important;
            border-color: #6c757d !important;
            color: white !important;
        }
        .btn-primary:hover {
            background-color: #5a6268 !important;
            border-color: #5a6268 !important;
        }
        .page-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 700;
            color: #343a40;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }
        header, footer {
            background-color: #2c3e50;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        footer {
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="page-title">Staff List</h1>
        
        <!-- Toolbar with Add New Staff and Search Bar -->
        <div class="toolbar">
            <a href="staff/create.php" class="btn btn-primary">Add New Staff</a>
            <!-- Global Search Bar -->
            <input type="text" class="form-control search-input" placeholder="Search All Staff..." onkeyup="filterStaff()">
        </div>

        <div class="staff-list">
            <?php foreach ($staffByPosition as $position => $staffsInPosition): ?>
                <div class="position-column">
                    <div class="position-header"><?php echo htmlspecialchars($position); ?></div>
                    <?php foreach ($staffsInPosition as $staff): ?>
                        <div class="staff-card" data-name="<?php echo htmlspecialchars($staff['name']); ?>">
                            <a href="staff/view.php?id=<?php echo $staff['id']; ?>" class="text-decoration-none">
                                <div class="staff-name"><?php echo htmlspecialchars($staff['name']); ?></div>
                                <div class="staff-phone"><?php echo htmlspecialchars($staff['phone_number']); ?></div>
                            </a>
                            <span class="staff-status <?php echo ($staff['status'] == 'active') ? 'active' : ''; ?>">
                                <?php echo htmlspecialchars($staff['status']); ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Latest jQuery and Bootstrap 5.3.0 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // JavaScript function to filter staff cards and positions using the global search input
        function filterStaff() {
            let filter = document.querySelector('.search-input').value.toLowerCase();
            let staffCards = document.querySelectorAll('.staff-card');

            staffCards.forEach(card => {
                let name = card.dataset.name.toLowerCase();
                if (name.includes(filter)) {
                    card.style.display = 'flex'; // Set display to flex
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>

<footer>
    <p>&copy; 2024 Agusan Canyon. All rights reserved.</p>
</footer>

</html>