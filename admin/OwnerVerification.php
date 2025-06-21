<?php
include('../assets/connection/connection.php');
include("Head.php");

if(isset($_GET['acid']))
{
	$delQry = "update tbl_owner set owner_status='1' where owner_id = ".$_GET['acid'];
    $res=$con->query($delQry);
	?>
      <script>
		alert("Accepted..")
		window.location = "OwnerVerification.php"
		</script>
       <?php
	  
}



if(isset($_GET['rejid']))
{
	$delQry = "update tbl_owner set owner_status='2' where owner_id = ".$_GET['rejid'];
    $res=$con->query($delQry);
	?>
      <script>
		alert("Rejected..")
		window.location = "OwnerVerification.php"
		</script>
       <?php
	  
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OwnerVerification</title>
</head>

<body>
<div class="container mt-5">
    <h3 class="text-center">New Owner List</h3>
    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>Si.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Proof</th>
                <th>Photo</th>
                <th>Place</th>
                <th>District</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $selqry = "select * from tbl_owner o inner join tbl_place p on o.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id where o.owner_status='0'";
            $result = $con->query($selqry);
            while ($row = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row["owner_name"]; ?></td>
                <td><?php echo $row["owner_email"]; ?></td>
                <td><?php echo $row["owner_contact"]; ?></td>
                <td><img src="../assets/Files/Seller/Photo/<?php echo $row["owner_proof"]; ?>" width="60" height="60" class="img-thumbnail" /></td>
                <td><img src="../assets/Files/Seller/Photo/<?php echo $row["owner_photo"]; ?>" width="60" height="60" class="img-thumbnail" /></td>
                <td><?php echo $row["place_name"]; ?></td>
                <td><?php echo $row["district_name"]; ?></td>
                <td><a href="OwnerVerification.php?acid=<?php echo $row['owner_id'] ?>" class="btn btn-success btn-sm">Accept</a> / 
                    <a href="OwnerVerification.php?rejid=<?php echo $row['owner_id'] ?>" class="btn btn-danger btn-sm">Reject</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <h3 class="text-center mt-5">Accepted List</h3>
    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>Si.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Proof</th>
                <th>Photo</th>
                <th>Place</th>
                <th>District</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $selqry = "select * from tbl_owner o inner join tbl_place p on o.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id where o.owner_status='1'";
            $result = $con->query($selqry);
            while ($row = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row["owner_name"]; ?></td>
                <td><?php echo $row["owner_email"]; ?></td>
                <td><?php echo $row["owner_contact"]; ?></td>
                <td><img src="../assets/Files/Seller/Photo/<?php echo $row["owner_proof"]; ?>" width="60" height="60" class="img-thumbnail" /></td>
                <td><img src="../assets/Files/Seller/Photo/<?php echo $row["owner_photo"]; ?>" width="60" height="60" class="img-thumbnail" /></td>
                <td><?php echo $row["place_name"]; ?></td>
                <td><?php echo $row["district_name"]; ?></td>
                <td><a href="OwnerVerification.php?rejid=<?php echo $row['owner_id'] ?>" class="btn btn-danger btn-sm">Reject</a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <h3 class="text-center mt-5">Rejected List</h3>
    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>Si.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Proof</th>
                <th>Photo</th>
                <th>Place</th>
                <th>District</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $selqry = "select * from tbl_owner o inner join tbl_place p on o.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id where o.owner_status='2'";
            $result = $con->query($selqry);
            while ($row = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row["owner_name"]; ?></td>
                <td><?php echo $row["owner_email"]; ?></td>
                <td><?php echo $row["owner_contact"]; ?></td>
                <td><img src="../assets/Files/Seller/Photo/<?php echo $row["owner_proof"]; ?>" width="60" height="60" class="img-thumbnail" /></td>
                <td><img src="../assets/Files/Seller/Photo/<?php echo $row["owner_photo"]; ?>" width="60" height="60" class="img-thumbnail" /></td>
                <td><?php echo $row["place_name"]; ?></td>
                <td><?php echo $row["district_name"]; ?></td>
                <td><a href="OwnerVerification.php?acid=<?php echo $row['owner_id'] ?>" class="btn btn-success btn-sm">Accept</a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
          </body>
</html>
<?php
include("Foot.php")
?>