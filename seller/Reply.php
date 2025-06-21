
<?php
session_start();
  
include("../assets/connection/connection.php");
include("Head.php");
if(isset($_POST["submit"])) {
    $reply = trim($_POST["reply"]);

    if(empty($reply)) {
        echo "<script>alert('Please enter a reply.'); window.history.back();</script>";
    } else {
        $upQry = "UPDATE tbl_request SET request_reply='$reply', request_status='1' WHERE request_id='".$_GET['Aid']."'";
        if($con->query($upQry)) {
            echo "<script>alert('Reply sent'); window.location='ViewRequest.php';</script>";
        }
    }
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
        }
        
        input[type="submit"] {
            background-color: #7AB730;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        input[type="submit"]:hover {
            background-color: #6b9834;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reply to Request</h2>
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group">
                <label for="reply">Reply:</label>
                <textarea name="reply" id="reply" cols="45" rows="5" required></textarea>
            </div>
            <div class="text-center">
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>
<?php
include("Foot.php");
?>