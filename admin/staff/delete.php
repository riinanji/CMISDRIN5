<?php
include '../../include/config.php'; // Include your DB configuration

// Ensure that the ID is properly sanitized
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Prepare the SQL statement
    $stmt = $bd->prepare("DELETE FROM staff WHERE id=?");
    $stmt->bind_param('i', $id); // 'i' indicates the type is integer

    if ($stmt->execute()) {
        header('Location: http://localhost/cmisdrin5/admin/staff.php'); // Redirect to the staff list after deletion
        exit;
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
} else {
    echo 'Invalid ID';
}

$bd->close();
?>
