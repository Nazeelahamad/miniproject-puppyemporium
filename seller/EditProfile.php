<?php
session_start();
include("../Assets/Connection/Connection.php");
include("Head.php");

$selQry = "SELECT * FROM tbl_owner WHERE owner_id = '".$_SESSION['oid']."'";
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
    } elseif(!preg_match("/^[a-zA-Z ]+$/", $name)) {
        echo "<script>alert('Name can only contain letters and spaces.'); window.history.back();</script>";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.history.back();</script>";
    } elseif(!preg_match("/^[0-9]{10}$/", $contact)) {
        echo "<script>alert('Contact number must be exactly 10 digits.'); window.history.back();</script>";
    } else {
        // Update profile in database
        $upQry = "UPDATE tbl_owner SET owner_name='".$name."', owner_email='".$email."', owner_contact='".$contact."', owner_address='".$address."' WHERE owner_id=".$_SESSION["oid"];
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
    .update-form {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .update-form label {
        font-weight: bold;
        margin-bottom: 10px;
    }
    .update-form input[type="text"], .update-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .update-form textarea {
        resize: none;
    }
    .update-form input[type="submit"] {
        background-color: #7AB730;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .update-form input[type="submit"]:hover {
        background-color: #6b9834;
    }
</style>

<script>
    function validateForm() {
        var name = document.getElementById("txt_name").value.trim();
        var email = document.getElementById("txt_email").value.trim();
        var contact = document.getElementById("txt_contact").value.trim();
        var address = document.getElementById("txt_address").value.trim();

        var namePattern = /^[a-zA-Z ]+$/;
        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        var contactPattern = /^[0-9]{10}$/;

        if (name === "" || email === "" || contact === "" || address === "") {
            alert("All fields are required.");
            return false;
        }
        if (!namePattern.test(name)) {
            alert("Name can only contain letters and spaces.");
            return false;
        }
        if (!emailPattern.test(email)) {
            alert("Invalid email format.");
            return false;
        }
        if (!contactPattern.test(contact)) {
            alert("Contact number must be exactly 10 digits.");
            return false;
        }
        return true;
    }
</script>
</head>

<body>
    <div class="container">
        <a href="HomePage.php" class="btn btn-success">Home</a>
        <div class="update-form">
            <h3>Update Profile</h3>
            <form id="form1" name="form1" method="post" action="" onsubmit="return validateForm();">
                <div class="form-group">
                    <label for="txt_name">Name:</label>
                    <input type="text" name="txt_name" value="<?php echo $data["owner_name"]?>" id="txt_name" />
                </div>
                <div class="form-group">
                    <label for="txt_email">Email:</label>
                    <input type="text" name="txt_email" value="<?php echo $data["owner_email"]?>" id="txt_email" />
                </div>
                <div class="form-group">
                    <label for="txt_contact">Contact:</label>
                    <input type="text" name="txt_contact" value="<?php echo $data["owner_contact"]?>" id="txt_contact" />
                </div>
                <div class="form-group">
                    <label for="txt_address">Address:</label>
                    <textarea name="txt_address" id="txt_address" cols="45" rows="5"><?php echo $data["owner_address"] ?></textarea>
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
