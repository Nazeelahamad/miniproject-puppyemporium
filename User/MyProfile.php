<?php
session_start();
include("../assets/connection/connection.php");
include("Head.php");
$user = "SELECT * FROM tbl_user u inner join tbl_place p on u.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id WHERE user_id = '".$_SESSION['uid']."'";
$result=$con->query($user);
$data=$result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile</title>
<!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }
    
    .profile-container {
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .profile-header {
      background-color: #007bff;
      color: #fff;
      padding: 10px;
      border-radius: 10px 10px 0 0;
    }
    
    .profile-table {
      font-size: 16px;
    }
    
    .profile-table th {
      width: 30%;
    }
  </style>
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">My Profile</h3>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td><?php echo $data['user_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $data['user_email'] ?></td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td><?php echo $data['user_contact'] ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo $data['user_address'] ?></td>
                    </tr>
                    <tr>
                        <th>District</th>
                        <td><?php echo $data['district_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Place</th>
                        <td><?php echo $data['place_name'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <a href="EditProfile.php" class="btn btn-success">Edit Profile</a>
                            <a href="ChangePassword.php" class="btn btn-warning">Change Password</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <?php include("Foot.php"); ?>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
</body>
</html>
