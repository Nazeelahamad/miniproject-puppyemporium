<?php
session_start();
include('../assets/connection/connection.php');
include("Head.php");

if (isset($_GET['puppy_id'])) {
    $puppy_id = $_GET['puppy_id']; // Get the puppy_id from the URL
}

if (isset($_POST['txt_submit'])) {
    $puppy_id = $_POST['txt_puppy'];
    $new_stock = $_POST['txt_stock'];
    
    // Update the stock of the selected puppy
    $updateStockQuery = "UPDATE tbl_puppy SET puppy_stock = puppy_stock + '$new_stock' WHERE puppy_id = '$puppy_id' AND owner_id = '".$_SESSION['oid']."'";
    
    if ($con->query($updateStockQuery)) {
        ?>
        <script>
        alert("Stock updated successfully!");
        window.location = "puppies.php";  // Redirect to puppies page after success
        </script>
        <?php
    } else {
        ?>
        <script>
        alert("Error updating stock.");
        window.location = "addstock.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Puppy Stock</title>
    <style>
        /* Styling similar to your previous form */
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
        
        .form-container input[type="number"], .form-container select {
            width: 100%;
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
            <h3>Add Stock for Puppies</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label for="txt_puppy">Selected Puppy:</label>
                    <select name="txt_puppy" id="txt_puppy" readonly>
                        <?php 
                        // Fetch the selected puppy details
                        $selPuppyQuery = "SELECT * FROM tbl_puppy WHERE owner_id = '".$_SESSION['oid']."' AND puppy_id = '$puppy_id'";
                        $result = $con->query($selPuppyQuery);
                        $row = $result->fetch_assoc();
                        echo "<option value='".$row['puppy_id']."'>".$row['puppy_name']." (Current Stock: ".$row['puppy_stock'].")</option>";
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="txt_stock">Add Stock:</label>
                    <input type="number" name="txt_stock" id="txt_stock" required placeholder="Enter the number of puppies to add">
                </div>
                
                <div class="form-group">
                    <input type="submit" name="txt_submit" value="Update Stock">
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php include("Foot.php"); ?>
