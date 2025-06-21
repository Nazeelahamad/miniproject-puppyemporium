<?php
include('../assets/connection/connection.php');

$email = $_POST['email'];

$emailCheck = "SELECT * FROM tbl_user WHERE user_email = '$email'";
$result = $con->query($emailCheck);
if ($result->num_rows > 0) {
    echo "exists";
} else {
    echo "available";
}
?>