<?php
include('../assets/connection/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request_id = $_POST['request_id'];
    $delivery_status = $_POST['delivery_status'];

    $update_query = "UPDATE tbl_request SET delivery_status = '$delivery_status' WHERE request_id = '$request_id'";
    if ($con->query($update_query)) {
        echo "<script>alert('Status updated successfully.'); window.location = 'ViewRequest.php';</script>";
    } else {
        echo "<script>alert('Error updating status.');</script>";
    }
}
?>