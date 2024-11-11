<?php  
include('../include/config.php'); 
session_start();

// Check if the 'cid' parameter is provided in the URL
if (!isset($_GET['cid'])) {
    echo "No complaint selected.";
    exit();
}

// Get the complaint ID from the URL
$cid = $_GET['cid'];

// Corrected SQL query to fetch complaint and address details
$stmt = mysqli_prepare($bd, "
SELECT tblcomplaints.*, 
       state.complainantAddress AS complainantAddress, 
       state.respondentAddress1 AS respondentAddress1,
       complaintremark.remark as remark
FROM tblcomplaints
LEFT JOIN state ON state.user_ID = tblcomplaints.state
LEFT JOIN complaintremark ON complaintremark.complaint_ID = tblcomplaints.complaint_ID
WHERE tblcomplaints.complaint_ID = ?");


if ($stmt === false) {
    die("Failed to prepare statement: " . mysqli_error($bd));
}

// Bind the complaint ID to the SQL query
mysqli_stmt_bind_param($stmt, 'i', $cid);

// Execute the query
mysqli_stmt_execute($stmt);

// Get the result of the query
$result = mysqli_stmt_get_result($stmt);

// Check if any data was returned
if ($row = mysqli_fetch_array($result)) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=8.5in, height=11in, initial-scale=1.0">
    <title>Reklamo Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0 auto;
            width: 8.5in;
            height: 11in;
            padding: 20px;
            line-height: 1.0;
            position: relative;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .center {
            text-align: center;
        }
        label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
        }
        .form-section {
            margin-bottom: 15px;
        }
        .signature-section, .chairman-signature {
            text-align: center;
            margin-top: 40px;
        }
        .signature {
            display: inline-block;
            border-bottom: 1px solid #000;
            width: 250px;
        }
        .print-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .print-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Logo and Title Header -->
    <div class="header">
        <img src="../img/agusan.jpg" class="img-circle" width="200">
        <div class="center">
            <p><strong>Republic of the Philippines</strong></p>
            <p><strong>Province of Bukidnon</strong></p>
            <p><strong>Municipality of Manolo Fortich</strong></p>
            <p><strong>BARANGAY AGUSAN CANYON</strong></p>
            <p><strong>OFFICE OF THE PUNONG BARANGAY</strong></p>
        </div>
    </div>

    <!-- Form Content -->
    <div class="form-section">
        <label>Nagsumbong:</label>
        <span><?php echo htmlentities($row['complainantName']); ?></span>
        <hr>
    </div>
    
    <div class="form-section">
        <label>Address:</label>
        <span><?php echo htmlentities($row['complainantAddress']); ?></span>
        <hr>
    </div>

    <div class="form-section">
        <label>Contact #:</label>
        <span><?php echo htmlentities($row['complainantContact']); ?></span>
        <hr>
    </div>

    <h3>LABAN KAY/KINA:</h3>
    <hr>

    <div class="form-section">
        <label>Ang gi-sumbong:</label>
        <span><?php echo htmlentities($row['respondentName']); ?></span>
        <hr>
    </div>

    <div class="form-section">
        <label>Address:</label>
        <span><?php echo htmlentities($row['respondentAddress1']); ?></span>
        <hr>
    </div>

    <div class="form-section">
        <label>Contact #:</label>
        <span><?php echo htmlentities($row['respondentContact']); ?></span>
        <hr>
    </div>

    <!-- Reklamo Section -->
    <div class="content-section">
        <p><strong>REKLAMO</strong></p>
        <p>AKO/KAMI, ay nagrereklamo laban sa mga ipinagsusumbong na binanggit sa itaas dahil sa paglabag sa
        aking/aming mga kapakanan sa sumusunod na pamararaan:</p>
        <p><?php echo htmlentities($row['complaintDetails']); ?></p>
        <hr>
    </div>

    <!-- Kalunasan Section -->
    <div class="content-section">
        <p>DAHIL DITO, AKO/KAMI, nakikiusap na ipagkaloob sa akin/amin ang sumusunod na (mag) kalunasan nang naalinsunod sa batas at/o pagkamatuwiran:</p>
        <p><?php echo htmlentities($row['remark']); ?></p>
        <hr>
    </div>

    <!-- Date Section -->
    <div class="form-section">
        <p>Ginawa ngayong ika :  <?php echo htmlentities($row['regDate']); ?></p>
    </div>

    <!-- Signature Section -->
    <!-- <div class="signature-section">
        <p class="signature"></p>
        <p class="subtext">(Mga) Nagsumbong</p>
    </div> -->

    <div class="form-section">
        <p>Tinanggap at inihain ngayong ika ______ araw ng ______, 2024.</p>
    </div>

    <!-- Chairman Signature Section -->
    <div class="chairman-signature">
        <img src="../img/Picture1.png" class="img-circle" width="80">
        <p><strong>BEN I. DACAYO</strong></p>
        <p>Punong Barangay/Lupon Chairman</p>
    </div>

    <!-- Print Button -->
    <button class="print-button" onclick="window.print()">Print</button>

</body>
</html>

<?php 
} else {
    echo "Complaint not found.";
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($bd);
?>
