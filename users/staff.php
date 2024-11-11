<?php
ob_start(); // Start output buffering

include '../include/config.php'; // Include your DB configuration
include('../include/sidebar.php'); 

// Handle Borrow Tool Form Submission
if (isset($_POST['borrow_tool'])) {
    $id = $_POST['id'];
    $borrowed_by = $_POST['borrowed_by'];
    $phone_number = $_POST['phone_number'];
    $date_borrowed = $_POST['date_borrowed'];
    $date_to_return = $_POST['date_to_return'];
    $quantity = $_POST['quantity'];

    // Check available quantity before borrowing
    $sql_check_quantity = "SELECT quantity FROM tools_equipment WHERE id = $id";
    $result_check = $conn->query($sql_check_quantity);
    $tool = $result_check->fetch_assoc();

    if ($tool['quantity'] >= $quantity) {
        // Update tool status to borrowed and insert into borrowed_tools table
        $sql_borrow_tool = "INSERT INTO borrowed_tools (tool_id, borrowed_by, phone_number, date_borrowed, date_to_return, quantity) 
                            VALUES ($id, '$borrowed_by', '$phone_number', '$date_borrowed', '$date_to_return', $quantity)";
        $conn->query($sql_borrow_tool);

        // Update the original quantity in the tools_equipment table
        $sql_update_quantity = "UPDATE tools_equipment SET quantity = quantity - $quantity WHERE id = $id";
        $conn->query($sql_update_quantity);
    } else {
        echo "<script>alert('Cannot borrow tool. Not enough quantity available.');</script>";
    }
}

// Fetch available tools
$sql_available = "SELECT * FROM tools_equipment WHERE quantity > 0";
$result_available = $conn->query($sql_available);

// Fetch borrowed tools
$sql_borrowed = "SELECT bt.*, te.name FROM borrowed_tools bt JOIN tools_equipment te ON bt.tool_id = te.id";
$result_borrowed = $conn->query($sql_borrowed);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <style>
        /* Your CSS Styles */
    </style>
    <script>
        function hideAlerts() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 2000);
            });
        }
        window.onload = hideAlerts;
    </script>
</head>
<body>

<?php include("../include/header.php"); ?>

<div class="container">
    <!-- Success/Error Messages -->
    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($_GET['message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>

    <h2>Tools & Equipment List</h2>

    <div class="button-container mb-3">
        <div class="left-buttons">
            <a href="borrow_tools.php" class="redirect-button">Borrow Tools</a>
            <a href="return_tools.php" class="redirect-button">Return Tool</a>
        </div>
        <div class="right-buttons">
            <a href="tools_history.php" class="redirect-button">Borrowed History</a>
        </div>
    </div>

    <div class="row">
        <div class="column">
            <h2>Available Tools & Equipment</h2>
            <table id="availableTools">
                <thead>
                    <tr>
                        <th>Tool/Equipment Name</th>
                        <th>Quantity</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($result_available->num_rows > 0) {
                    while($row = $result_available->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['name']}</td>
                                <td>{$row['quantity']}</td>
                                <td>{$row['status']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No available tools</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

        <div class="column">
            <h2>Borrowed Tools & Equipment</h2>
            <table id="borrowedTools">
                <thead>
                    <tr>
                        <th>Tool/Equipment Name</th>
                        <th>Borrowed By</th>
                        <th>Phone Number</th>
                        <th>Date Borrowed</th>
                        <th>Date to Return</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($result_borrowed->num_rows > 0) {
                    while($row = $result_borrowed->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['name']}</td>
                                <td>{$row['borrowed_by']}</td>
                                <td>{$row['phone_number']}</td>
                                <td>{$row['date_borrowed']}</td>
                                <td>{$row['date_to_return']}</td>
                                <td>{$row['quantity']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No borrowed tools</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="note-container">
        <p class="note">* Tools must be returned on or before the due date to avoid penalties.</p>
    </div>
</div>

<!-- Include Footer -->

<!-- JS scripts -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/common-scripts.js"></script>
<script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="assets/js/bootstrap-switch.js"></script>
<script src="assets/js/jquery.tagsinput.js"></script>
<script src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/js/bootstrap-daterangepicker/date.js"></script>
<script src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script src="assets/js/form-component.js"></script>
</body>
</html>

<?php
$conn->close(); // Close the database connection
ob_end_flush(); // End output buffering and flush output
?>
