<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Head.php");

$selQry = "SELECT * FROM tbl_user WHERE user_id = '".$_SESSION['uid']."'";
$result = $con->query($selQry);
$data = $result->fetch_assoc();

if(isset($_POST["btn_update"])) {
    $name = trim($_POST["txt_name"]);
    $email = trim($_POST["txt_email"]);
    $contact = trim($_POST["txt_contact"]);
    $address = trim($_POST["txt_address"]);

    // Validation
    if(empty($name) || empty($email) || empty($contact) || empty($address)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        echo "<script>alert('Name should contain only letters and spaces.'); window.history.back();</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.history.back();</script>";
    } elseif (!preg_match("/^[0-9]{10}$/", $contact)) {
        echo "<script>alert('Contact number should be exactly 10 digits.'); window.history.back();</script>";
    } else {
        // Update query
        $upQry = "UPDATE tbl_user SET user_name='$name', user_email='$email', user_contact='$contact', user_address='$address' WHERE user_id=".$_SESSION["uid"];
        if($con->query($upQry)) {
            echo "<script>alert('Profile updated successfully.'); window.location='MyProfile.php';</script>";
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
<title>Edit Profile</title>
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
        var name = document.getElementById("txt_name").value.trim();
        var email = document.getElementById("txt_email").value.trim();
        var contact = document.getElementById("txt_contact").value.trim();
        var address = document.getElementById("txt_address").value.trim();

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var contactPattern = /^[0-9]{10}$/;

        if (name === "" || email === "" || contact === "" || address === "") {
            alert("All fields are required.");
            return false;
        }
        if (!/^[a-zA-Z\s]+$/.test(name)) {
            alert("Name should contain only letters and spaces.");
            return false;
        }
        if (!emailPattern.test(email)) {
            alert("Please enter a valid email.");
            return false;
        }
        if (!contactPattern.test(contact)) {
            alert("Contact number should be exactly 10 digits.");
            return false;
        }
        return true;
    }
</script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Edit Profile
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="" onsubmit="return validateForm();">
                            <div class="form-group">
                                <label for="txt_name">Name</label>
                                <input type="text" name="txt_name" value="<?php echo htmlspecialchars($data["user_name"]); ?>" id="txt_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="txt_email">Email</label>
                                <input type="email" name="txt_email" value="<?php echo htmlspecialchars($data["user_email"]); ?>" id="txt_email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="txt_contact">Contact</label>
                                <input type="text" name="txt_contact" value="<?php echo htmlspecialchars($data["user_contact"]); ?>" id="txt_contact" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="txt_address">Address</label>
                                <textarea name="txt_address" id="txt_address" cols="45" rows="5" class="form-control"><?php echo htmlspecialchars($data["user_address"]); ?></textarea>
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
                                                                                