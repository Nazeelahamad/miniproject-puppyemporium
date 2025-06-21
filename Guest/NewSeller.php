
<?php
include('../assets/connection/connection.php');

if(isset($_POST['submitbtn'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $place = $_POST['place'];

    // File uploads
    $photo = $_FILES['photo']['name'];
    $proof = $_FILES['proof']['name'];
    $temp = $_FILES['photo']['tmp_name'];
    $ptemp = $_FILES['proof']['tmp_name'];

    // Check if email already exists
    $emailCheck = "SELECT * FROM tbl_owner WHERE owner_email = '$email'";
    $result = $con->query($emailCheck);
    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists. Please use a different email.');</script>";
    } else {
        // Validate inputs
        if (empty($name) || empty($address) || empty($contact) || empty($email) || empty($password) || empty($place) || empty($photo) || empty($proof)) {
            echo "<script>alert('Please fill in all fields.');</script>";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
            echo "<script>alert('Name should contain only letters and spaces.');</script>";
        } elseif (!preg_match("/^[0-9]{10}+$/", $contact)) {
            echo "<script>alert('Contact should be a 10-digit number.');</script>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format.');</script>";    
        } elseif (strlen($password) < 8) {
            echo "<script>alert('Password should be at least 8 characters long.');</script>";
        } else {
            // Upload files
            move_uploaded_file($temp, '../assets/Files/Seller/Photo/'.$photo);
            move_uploaded_file($ptemp, '../assets/Files/Seller/Photo/'.$proof);

            // Insert into database
            $insqry = "INSERT INTO tbl_owner (owner_name, owner_address, owner_contact, owner_email, owner_password, owner_photo, owner_proof, place_id,owner_created_at) VALUES ('$name', '$address', '$contact', '$email', '$password', '$photo', '$proof', '$place',CURRENT_TIMESTAMP)";
            if($con->query($insqry)) {
                echo "<script>alert('Registration Completed.'); window.location = 'Login.php';</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>New Seller Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/Templates/Login/style.css">
</head>

<body>
    <div class="wrapper">
        <div class="title-text">
            <div class="title login"> New Seller Registration </div>
        </div>
        <div class="form-inner">
            <form id="registrationForm" action="" method="post" enctype="multipart/form-data" class="login" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="district">District</label>
                    <select name="district" id="district" class="form-control" onChange="getPlace(this.value)" required>
                        <option value="">--Select</option>
                        <?php 
                            $selqry = "select * from tbl_district";
                            $result = $con->query($selqry);
                            while ($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row['district_id']?>"><?php echo $row['district_name']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="place">Place</label>
                    <select name="place" id="place" class="form-control" required>
                        <option value="">--Select</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required placeholder="Enter Name" pattern="[A-Za-z\s]+" title="Only letters and spaces allowed">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" class="form-control" required placeholder="Enter Address" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="contact">Contact</label>
                    <input type="text" name="contact" id="contact" class="form-control" required="required" placeholder="Enter Contact">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required placeholder="Enter Password"
                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                        title="Password must be at least 8 characters long, include an uppercase letter, a lowercase letter, a number, and a special character (@$!%*?&).">
                </div>

                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="proof">Proof</label>
                    <input type="file" name="proof" id="proof" class="form-control" required>
                </div>
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" name="submitbtn" id="submitbtn" value="SignUp" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
        function getPlace(did) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
                success: function(result) {
                    $("#place").html(result);
                }
            });
        }

        function validateForm() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var contact = document.getElementById("contact").value;
            var photo = document.getElementById("photo").value;
            var proof = document.getElementById("proof").value;

            // Validate name
            if (name.trim() === "") {
                alert("Please enter your name.");
                return false;
            }

            // Validate email format
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Validate contact number
            var contactPattern = /^[0-9]{10}$/;
            if (!contactPattern.test(contact)) {
                alert("Please enter a valid 10-digit contact number.");
                return false;
            }

            // Validate strong password
            var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordPattern.test(password)) {
                alert("Password must be at least 8 characters long, include an uppercase letter, a lowercase letter, a number, and a special character (@$!%*?&).");
                return false;
            }

            // Validate file uploads
            if (photo === "" || proof === "") {
                alert("Please upload required files.");
                return false;
            }

            // Check email existence
            $.ajax({
                type: "POST",
                url: "../Assets/AjaxPages/CheckEmail.php",
                data: {email: email},
                success: function(result) {
                    if (result == "exists") {
                        alert("Email already exists. Please use a different email.");
                        return false;
                    } else {
                        return true;
                    }
                }
            });
        }
    </script>
</body>
</html>