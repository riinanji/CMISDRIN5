<?php
// Include the database connection file
include('../include/config.php'); 

// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['login'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}
?>

<aside>
    <div id="sidebar" class="nav-collapse">
        <ul class="sidebar-menu" id="nav-accordion">
            <p class="centered">
                <a href="profile.php">
                    <img src="../img/agusan.jpg" class="img-circle" width="60">
                </a>
            </p>
            <?php 
            $query = mysqli_query($bd, "SELECT fullName FROM tbl_user WHERE userEmail='" . $_SESSION['login'] . "'");
            while ($row = mysqli_fetch_array($query)) { 
            ?> 
                <h5 class="centered"><?php echo htmlentities($row['fullName']); ?></h5>
            <?php } ?>
            
            <!-- Dashboard -->
            <li class="mt">
                <a href="dashboard.php">
                    <i class="bi bi-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Add Complaint -->
            <li class="sub-menu">
                <a href="register-complaint.php">
                    <i class="bi bi-file-earmark-plus"></i>
                    <span>Add Complaint</span>
                </a>
            </li>

            <!-- Complaint History -->
            <li class="sub-menu">
                <a href="complaint-history.php">
                    <i class="bi bi-clock-history"></i>
                    <span>Transaction Complaints</span>
                </a>
            </li>

            <!-- Tools & Equipment -->
            <li class="sub-menu">
                <a href="tool_equipment.php">
                    <i class="bi bi-tools"></i>
                    <span>Tools & Equipment</span>
                </a>
            </li>

            <!-- Account Setting -->
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="bi bi-person-gear"></i>
                    <span>Account Setting</span>
                </a>
                <ul class="sub">
                    <li><a href="profile.php">Profile</a></li>
                </ul>
                <ul class="sub">
                    <li><a href="logout.php">Log out</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>

<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
