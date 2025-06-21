<?php
include("../assets/connection/connection.php");

session_start();
include("Head.php");
if(isset($_POST["submit"]))
{
	$reply=$_POST["reply"];
	if(empty($reply)) {
		echo "<script>alert('Reply cannot be empty');</script>";
	} else {
		$upQry="update tbl_complaint set complaint_reply	='".$reply."',complaint_status='1' where complaint_id='".$_GET['id']."'";
		if($con->query($upQry))
		{
			echo "reply sent";
			?>
			<script>
			window.location="ViewComplaints.php";
			</script>
			<?php
		}
	}
}
?>

<!DOCTYPE html PUBLIC >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<div class="container mt-5">
    <h3 class="text-center mb-4">Submit a Reply</h3>

    <form id="form1" name="form1" method="post" action="">
        <div class="mb-3">
            <label for="reply" class="form-label">Reply</label>
            <textarea name="reply" id="reply" class="form-control" cols="45" rows="5" placeholder="Enter your reply"></textarea>
        </div>
        
        <div class="text-center">
            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary" />
        </div>
    </form>
</div>
</body>
</html>
<?php
include("Foot.php")
?>