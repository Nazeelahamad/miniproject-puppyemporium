<?php
include('../assets/connection/connection.php');
include("Head.php");
if(isset($_POST[ 'btn_submit' ])){
	$category=$_POST[ 'txt_category' ];
	$insqry = "insert into tbl_category(category_name) values('".$category."')";
	if($con->query($insqry))
	{
		?>
        <script>
		alert("data inserted..")
		window.location = "Category.php"
		</script>
        <?php
	}
	
}
if(isset($_GET['did']))
{
	$delqry="delete from tbl_category where category_id='".$_GET['did']."'";
	if($con->query($delqry))
	{
		?>
        <script>
		alert['deleted'];
		window.location="Category.php";
		</script>
        <?php
	}
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Category</title>
</head>
<body>
    <div class="container mt-5">
        <form id="form1" name="form1" method="post" action="">
            <!-- Form Section -->
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Category Form</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="txt_category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="txt_category" name="txt_category" required="required" placeholder="Enter Category" />
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="btn_submit" name="btn_submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Table Section -->
            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>SI.NO</th>
                                <th>CATEGORY</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 0;
                            $selqry = "select * from tbl_category";
                            $result = $con->query($selqry);
                            while ($row = $result->fetch_assoc()) {
                                $i++;
                            ?> 
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row["category_name"]; ?></td>
                                <td><a href="Category.php?did=<?php echo $row['category_id']?>" class="btn btn-danger btn-sm">Delete</a></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
                          </body>
</html>
<?php
include("Foot.php")
?>