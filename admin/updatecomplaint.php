<?php
session_start();
include('../include/config.php');


// If the form is submitted
if (isset($_POST['update'])) {
    $complaintnumber = $_GET['cid'];
    $status = $_POST['status'];
    $remark = $_POST['remark'];

    // Insert the remark into the complaintremark table
    $query = mysqli_query($bd, "INSERT INTO complaintremark(complaint_ID, status, remark) VALUES('$complaintnumber', '$status', '$remark')");
    
    // Update the status of the complaint in tblcomplaints
    $sql = mysqli_query($bd, "UPDATE tblcomplaints SET status='$status' WHERE complaint_ID='$complaintnumber'");

    if ($query && $sql) {
        echo "<script>alert('Complaint details updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating complaint details');</script>";
    }
}
?>

<script language="javascript" type="text/javascript">
function f2() {
    window.close();
}

function f3() {
    window.print();
}
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Complaint</title>
    <style>
        body {
            background: linear-gradient(135deg, #f0f4f8, #dfe9f3);
            font-family: 'Open Sans', sans-serif;
        }
        .form-container {
            margin-left: 50px;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 50px auto;
        }
        h2 {
            text-align: center;
            background: linear-gradient(135deg, #4b6f89, #3a5c76);
            color: #ffffff;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            font-weight: bold;
        }
        form {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table tr {
            height: 50px;
        }
        select, textarea, input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1em;
            margin-bottom: 20px;
        }
        input[type="submit"] {
            background-color: #4b6f89;
            color: #ffffff;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }
        input[type="submit"]:hover {
            background-color: #3a5c76;
            transform: translateY(-3px);
        }
        .close-button {
            background-color: gray;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
        }
        .close-button:hover {
            background-color: #666666;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Update Complaint</h2>
    <form name="updateticket" id="updatecomplaint" method="post"> 
        <table>
           
            <tr>
                <td><b>Status</b></td>
                <td>
                    <select name="status" required="required">
                        <option value="">Select Status</option>
                        <option value="in process">In Process</option>
                       
                        <option value="closed">Closed</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Remark</b></td>
                <td><textarea name="remark" cols="50" rows="10" required="required"></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="update" value="Submit"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button class="close-button" onClick="return f2();">Close this tab</button>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
