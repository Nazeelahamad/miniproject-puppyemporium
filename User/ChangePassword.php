<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Head.php");

$selQry = "SELECT * FROM tbl_user WHERE user_id = ".$_SESSION["uid"];
$result = $con->query($selQry);
$data = $result->fetch_assoc();

if(isset($_POST["btn_update"])) {
    $oldpassword = trim($_POST["txt_oldpassword"]);
    $newpassword = trim($_POST["txt_newpassword"]);
    $confirmpassword = trim($_POST["txt_confirmpassword"]);

    // Fetch existing password from database
    $dbpassword = $data['user_password'];

    // Validation
    if(empty($oldpassword) || empty($newpassword) || empty($confirmpassword)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
    } elseif($dbpassword !== $oldpassword) {
        echo "<script>alert('Incorrect old password.'); window.history.back();</script>";
    } elseif(strlen($newpassword) < 8 || !preg_match("/[A-Z]/", $newpassword) || !preg_match("/[a-z]/", $newpassword) || !preg_match("/[0-9]/", $newpassword) || !preg_match("/[\W]/", $newpassword)) {
        echo "<script>alert('New password must be at least 8 characters long and include an uppercase letter, lowercase letter, number, and special character.'); window.history.back();</script>";
    } elseif($newpassword !== $confirmpassword) {
        echo "<script>alert('New password and confirm password do not match.'); window.history.back();</script>";
    } else {
        // Update password in database
        $upQry = "UPDATE tbl_user SET user_password='".$confirmpassword."' WHERE user_id=".$_SESSION["uid"];
        if($con->query($upQry)) {
            echo "<script>alert('Password updated successfully.'); window.location='Changepassword.php';</script>";
        } else {
            echo "<script>alert('Update failed. Please try again.'); window.history.back();</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Change Password</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
    }
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        padding: 10px;
        background-color: #7AB730;
        color: #fff;
        text-align: center;
        font-size: 18px;
    }
    .card-body {
        padding: 20px;
    }
    .form-control {
        border-radius: 5px;
        padding: 10px;
    }
    .btn-success {
        background-color: #7AB730;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
    }
    .btn-success:hover {
        background-color: #6b9834;
    }
</style>

<script>
    function validateForm() {
        var oldPassword = document.getElementById("txt_oldpassword").value.trim();
        var newPassword = document.getElementById("txt_newpassword").value.trim();
        var confirmPassword = document.getElementById("txt_confirmpassword").value.trim();

        var passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W]).{8,}$/;

        if (oldPassword === "" || newPassword === "" || confirmPassword === "") {
            alert("All fields are required.");
            return false;
        }
        if (!passwordPattern.test(newPassword)) {
            alert("New password must be at least 8 characters long and include an uppercase letter, lowercase letter, number, and special character.");
            return false;
        }
        if (newPassword !== confirmPassword) {
            alert("New password and confirm password do not match.");
            return false;
        }
        return true;
    }
</script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Change Password
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="" onsubmit="return validateForm();">
                            <div class="form-group">
                                <label for="txt_oldpassword">Old Password</label>
                                <input type="password" name="txt_oldpassword" id="txt_oldpassword" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="txt_newpassword">New Password</label>
                                <input type="password" name="txt_newpassword" id="txt_newpassword" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="txt_confirmpassword">Confirm Password</label>
                                <input type="password" name="txt_confirmpassword" id="txt_confirmpassword" class="form-control">
                            </div>
                            <div class="text-center">
                                <input type="submit" name="btn_update" id="btn_update" value="Update" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
include("Foot.php");
?>
