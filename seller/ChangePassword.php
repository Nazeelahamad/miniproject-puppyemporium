<?php
session_start();
include("../Assets/Connection/Connection.php");
include("Head.php");

$selQry = "SELECT * FROM tbl_owner WHERE owner_id=" . $_SESSION["oid"];
$result = $con->query($selQry);
$data = $result->fetch_assoc();

if (isset($_POST["btn_update"])) {
    $oldpassword = trim($_POST["txt_oldpassword"]);
    $newpassword = trim($_POST["txt_newpassword"]);
    $confirmpassword = trim($_POST["txt_confirmpassword"]);

    // Fetch existing password from database
    $dbpassword = $data['owner_password'];

    // Validation
    if (empty($oldpassword) || empty($newpassword) || empty($confirmpassword)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
    } elseif ($dbpassword !== $oldpassword) {
        echo "<script>alert('Incorrect old password.'); window.history.back();</script>";
    } elseif (strlen($newpassword) < 8 || !preg_match("/[A-Z]/", $newpassword) || !preg_match("/[a-z]/", $newpassword) || !preg_match("/[0-9]/", $newpassword) || !preg_match("/[\W]/", $newpassword)) {
        echo "<script>alert('New password must be at least 8 characters long and include an uppercase letter, lowercase letter, number, and special character.'); window.history.back();</script>";
    } elseif ($newpassword !== $confirmpassword) {
        echo "<script>alert('New password and confirm password do not match.'); window.history.back();</script>";
    } else {
        // Update password in database
        $upQry = "UPDATE tbl_owner SET owner_password='" . $confirmpassword . "' WHERE owner_id=" . $_SESSION["oid"];
        if ($con->query($upQry)) {
            echo "<script>alert('Password updated successfully.'); window.location='MyProfile.php';</script>";
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

    .password-form {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .password-form label {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .password-form input[type="password"], .password-form input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .password-form input[type="submit"] {
        background-color: #7AB730;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .password-form input[type="submit"]:hover {
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
    <div class="container">
        <a href="HomePage.php" class="btn btn-success">Home</a>
        <div class="password-form">
            <h3>Change Password</h3>
            <form id="form1" name="form1" method="post" action="" onsubmit="return validateForm();">
                <div class="form-group">
                    <label for="txt_oldpassword">Old Password:</label>
                    <input type="password" name="txt_oldpassword" id="txt_oldpassword" />
                </div>
                <div class="form-group">
                    <label for="txt_newpassword">New Password:</label>
                    <input type="password" name="txt_newpassword" id="txt_newpassword" />
                </div>
                <div class="form-group">
                    <label for="txt_confirmpassword">Confirm Password:</label>
                    <input type="password" name="txt_confirmpassword" id="txt_confirmpassword" />
                </div>
                <div class="text-center">
                    <input type="submit" name="btn_update" id="btn_update" value="Update" />
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
include("Foot.php");
?>
