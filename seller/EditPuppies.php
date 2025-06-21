<?php
session_start();
include('../assets/connection/connection.php');
include("Head.php");

$puppy = null;

if (isset($_GET['puppy_id'])) {
    $puppy_id = $_GET['puppy_id']; // Get the puppy_id from the URL

    // Fetch the puppy details
    $selPuppyQuery = "SELECT * FROM tbl_puppy WHERE owner_id = ? AND puppy_id = ?";
    $stmt = $con->prepare($selPuppyQuery);
    $stmt->bind_param("ii", $_SESSION['oid'], $puppy_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $puppy = $result->fetch_assoc();
    } else {
        echo "<script>alert('Puppy not found.'); window.location='puppies.php';</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('No puppy ID provided.'); window.location='puppies.php';</script>";
}

if (isset($_POST['txt_submit'])) {
    $name = $_POST['txt_name'];
    $dob = $_POST['txt_dob'];
    $details = $_POST['txt_details'];
    $category = $_POST['txt_category'];
    $price = $_POST['txt_price'];
    $gender = $_POST['gender'];
    
    $photo = $_FILES['file_photo']['name'];
    $temp = $_FILES['file_photo']['tmp_name'];
    
    if (!empty($photo)) {
        move_uploaded_file($temp, '../assets/Files/Puppies/'.$photo);
        $updatePuppyQuery = "UPDATE tbl_puppy SET puppy_name=?, puppy_dob=?, puppy_details=?, category_id=?, puppy_price=?, puppy_gender=?, puppy_photo=? WHERE puppy_id=? AND owner_id=?";
        $stmt = $con->prepare($updatePuppyQuery);
        $stmt->bind_param("sssidsiii", $name, $dob, $details, $category, $price, $gender, $photo, $puppy_id, $_SESSION['oid']);
    } else {
        $updatePuppyQuery = "UPDATE tbl_puppy SET puppy_name=?, puppy_dob=?, puppy_details=?, category_id=?, puppy_price=?, puppy_gender=? WHERE puppy_id=? AND owner_id=?";
        $stmt = $con->prepare($updatePuppyQuery);
        $stmt->bind_param("sssidsii", $name, $dob, $details, $category, $price, $gender, $puppy_id, $_SESSION['oid']);
    }
    
    if ($stmt->execute()) {
        echo "<script>alert('Puppy details updated successfully!'); window.location='puppies.php';</script>";
    } else {
        echo "<script>alert('Error updating puppy details.'); window.location='EditPuppies.php?puppy_id=$puppy_id';</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Puppy Details</title>
    <style>
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        
        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        
        .form-container label {
            font-weight: bold;
        }
        
        .form-container input[type="text"], .form-container input[type="date"], .form-container textarea, .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        .form-container input[type="file"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        .form-container input[type="submit"] {
            background-color: #7AB730;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .form-container input[type="submit"]:hover {
            background-color: #6b9834;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h3>Edit Puppy Details</h3>
            <?php if ($puppy): ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txt_name">Name:</label>
                    <input type="text" name="txt_name" id="txt_name" value="<?php echo htmlspecialchars($puppy['puppy_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="txt_dob">DOB:</label>
                    <input type="date" name="txt_dob" id="txt_dob" value="<?php echo htmlspecialchars($puppy['puppy_dob']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender" value="male" <?php if($puppy['puppy_gender'] == 'male') echo 'checked'; ?>>
                        <label class="form-check-label" for="gender">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="female" <?php if($puppy['puppy_gender'] == 'female') echo 'checked'; ?>>
                        <label class="form-check-label" for="gender2">Female</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt_details">Details:</label>
                    <textarea name="txt_details" id="txt_details" cols="45" rows="5" required><?php echo htmlspecialchars($puppy['puppy_details']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="file_photo">Image:</label>
                    <input type="file" name="file_photo" id="file_photo">
                    <img src="../assets/Files/Puppies/<?php echo htmlspecialchars($puppy['puppy_photo']); ?>" width="75" height="75">
                </div>
                <div class="form-group">
                    <label for="txt_category">Category:</label>
                    <select name="txt_category" id="txt_category" class="form-control">
                        <option>--Select--</option>
                        <?php 
                        $selqry = "select * from tbl_category";
                        $result = $con->query($selqry);
                        while ($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row['category_id']?>" <?php if($puppy['category_id'] == $row['category_id']) echo 'selected'; ?>><?php echo htmlspecialchars($row['category_name'])?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="txt_price">Price:</label>
                    <input type="text" name="txt_price" id="txt_price" value="<?php echo htmlspecialchars($puppy['puppy_price']); ?>" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="txt_submit" value="Update Puppy">
                </div>
            </form>
            <?php else: ?>
            <p>Puppy details not found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php include("Foot.php"); ?>