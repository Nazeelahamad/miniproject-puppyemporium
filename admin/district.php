<?php
include('../assets/connection/connection.php');
include("Head.php");
if(isset($_POST[ 'btn_submit' ])){
	$district=$_POST[ 'txt_district' ];
	$insqry = "insert into tbl_district(district_name) values('".$district."')";
	if($con->query($insqry))
	{
		?>
        <script>
		alert("data inserted..")
		window.location = "district.php"
		</script>
        <?php
	}
	//echo $district;
	
}

if(isset($_GET['did']))
{
	$delQry = "delete from tbl_district where district_id = ".$_GET['did'];
    $res=$con->query($delQry);
	header("location:district.php");
	  
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District</title>
</head>

<body>

<div class="container mt-5">
    <!-- Home Link -->
    <div class="text-center mb-4">
        <a href="HomePage.php" class="btn btn-outline-primary">Home</a>
    </div>

    <!-- Form Section -->
    <form id="form1" name="form1" method="post" action="">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>District Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="txt_district" class="form-label">District</label>
                            <input type="text" name="txt_district" id="txt_district" class="form-control" required="required" placeholder="Enter District" />
                        </div>
                        <div class="text-center">
                            <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Table Section -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>SI.NO</th>
                        <th>DISTRICT</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $selqry = "select * from tbl_district";
                    $result = $con->query($selqry);
                    while ($row = $result->fetch_assoc()) {
                        $i++;
                    ?> 
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row["district_name"]; ?></td>
                        <td><a href="district.php?did=<?php echo $row['district_id']?>" class="btn btn-danger btn-sm">Delete</a></td> 
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
                  </body>
</html>
<?php
include("Foot.php")
?>