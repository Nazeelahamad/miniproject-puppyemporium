<?php
include('../assets/connection/connection.php');
include("Head.php");
if(isset($_POST['submitbtn']))
{
 $place=$_POST[ 'placetxt'];
 $district=$_POST['district_id'];
 $insqry = "insert into tbl_place(place_name,district_id) values('".$place."','".$district."')";
 if($con->query($insqry))
 {
		?>
        <script>
		alert("data inserted..")
		window.location = "place.php"
		</script>
        <?php
	}
	
}


if(isset($_GET['did']))
{
	$delQry = "delete from tbl_place where place_id = ".$_GET['did'];
      if($con->query($delQry))
	  {
	 ?>
     <script>
	 alert("Deleted");
	 window.location="Place.php";
	 </script>
     <?php
	  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Place</title>
</head>

<body>

<div class="container my-5">
    <h3 class="text-center mb-4">Add Place and View List</h3>

    <!-- Form Section -->
    <form id="form1" name="form1" method="post" action="">
        <div class="mb-3 row">
            <label for="district_id" class="col-sm-2 col-form-label">District</label>
            <div class="col-sm-10">
                <select name="district_id" id="district_id" class="form-select">
                    <option>--Select--</option>
                    <?php
                    $selqry = "select * from tbl_district";
                    $result = $con->query($selqry);
                    while($row = $result->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['district_id'] ?>"><?php echo $row['district_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="placetxt" class="col-sm-2 col-form-label">Place</label>
            <div class="col-sm-10">
                <input type="text" name="placetxt" id="placetxt" class="form-control" required="required" placeholder="Enter Place" />
            </div>
        </div>

        <div class="text-center">
            <input type="submit" name="submitbtn" id="submitbtn" value="Submit" class="btn btn-primary" />
        </div>
    </form>

    <!-- Table Section -->
    <table class="table table-bordered table-hover table-striped text-center mt-5">
        <thead class="table-dark">
            <tr>
                <th>SINO</th>
                <th>Place</th>
                <th>District</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i = 0;
        $selqry = "select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
        $result = $con->query($selqry);
        while($row = $result->fetch_assoc()) {
            $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row["place_name"]; ?></td>
            <td><?php echo $row["district_name"]; ?></td>
            <td><a href="place.php?did=<?php echo $row['place_id'] ?>" class="btn btn-danger btn-sm">Delete</a></td>
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