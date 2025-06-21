<?php
session_start();
include("../assets/connection/connection.php");
include("Head.php");

$owner = "SELECT * FROM tbl_owner o inner join tbl_place p on o.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id WHERE owner_id = '".$_SESSION['oid']."'";
$result=$con->query($owner);
$data=$result->fetch_assoc();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MyProfile</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
    }

    .profile-container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .profile-header {
        background-color: #7AB730;
        color: #fff;
        padding: 10px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .profile-info {
        padding: 20px;
    }

    .profile-info .card {
        border: 1px solid #ddd;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 10px;
    }

    .profile-info .card h4 {
        margin-top: 0;
    }

    .profile-info .card .label {
        font-weight: bold;
        color: #666;
    }

    .profile-actions {
        text-align: center;
        padding: 20px;
    }

    .btn {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
    }

    .btn-success {
        background-color: #7AB730;
        border: none;
        color: #fff;
    }

    .btn-success:hover {
        background-color: #6b9834;
    }

    .profile-pic {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin: 20px auto;
    }
</style>
</head>

<body>
    <div class="container">
        
        <div class="profile-container">
            <div class="profile-header">
                <h3>MY PROFILE</h3>
            </div>
            <div class="profile-info">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="../assets/Files/seller/Photo/<?php echo $data["owner_photo"];?>" width="75" height="75" alt="<?php echo $data['owner_name'];?>" class="profile-pic">
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <h4>Personal Info</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="label">Name:</label>
                                    <span><?php echo $data['owner_name'];?></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="label">Email:</label>
                                    <span><?php echo $data['owner_email'];?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="label">Contact:</label>
                                    <span><?php echo $data['owner_contact'];?></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="label">Address:</label>
                                    <span><?php echo $data['owner_address'];?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <h4>Location</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="label">District:</label>
                                    <span><?php echo $data['district_name'];?></span>
                                </div>
                                <div class="col-md-6">
                                    <label class="label">Place:</label>
                                    <span><?php echo $data['place_name'];?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-actions">
                <a href="EditProfile.php" class="btn btn-success">Edit Profile</a>
                <a href="ChangePassword.php" class="btn btn-success">Change Password</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include("Foot.php");
?>