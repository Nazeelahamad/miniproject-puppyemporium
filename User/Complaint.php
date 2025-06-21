<?php
include("../assets/connection/connection.php");
session_start();  
include("Head.php");


if(isset($_POST["btn_submit"]))
{
	$title=$_POST["txt_title"];
	$content=$_POST["txt_content"];
	if(empty($title) || empty($content)) {
		echo "<script>alert('Title and Content cannot be empty');</script>";
	} else {
		$insQry="insert into tbl_complaint(complaint_title,	complaint_content,user_id)values('".$title."','".$content."','".$_SESSION['uid']."')";
		if($con->query($insQry))
		{
			echo "";
		}
	}
}
if(isset($_GET["did"])) { 
  $did=$_GET["did"]; 
  $delQry="delete from tbl_complaint where complaint_id=".$did; 
  if($con->query($delQry)) { 
?> 
      <script> 
          window.location="Complaint.php"; 
      </script> 
<?php 
  } 
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
    }

    .form-table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }

    .form-table th, .form-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .form-table th {
        background-color: #7AB730;
        color: #fff;
    }

    .complaint-table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }

    .complaint-table th, .complaint-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .complaint-table th {
        background-color: #7AB730;
        color: #fff;
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
</style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Submit Complaint
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="">
                            <table class="form-table">
                                <tr>
                                    <td>Title</td>
                                    <td>
                                        <input type="text" name="txt_title" id="txt_title" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Complaint</td>
                                    <td>
                                        <textarea name="txt_content" id="txt_content" cols="45" rows="5" class="form-control"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="text-center">
                                            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-success">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Complaint History
                    </div>
                    <div class="card-body">
                        <table class="complaint-table">
                            <thead>
                                <tr>
                                    <th>SI NO</th>
                                    <th>Title</th>
                                    <th>Complaint</th>
                                    <th>Complaint Reply</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $selQry="select * from tbl_complaint WHERE user_id='".$_SESSION["uid"]."'";
                                $result=$con->query($selQry); 
                                $i=0; 
                                while($data=$result->fetch_assoc()) { 
                                $i++; 
                                ?>
                                <tr>
                                    <td><?php echo $i?></td>
                                    <td><?php echo $data["complaint_title"]; ?></td>
                                    <td><?php echo $data["complaint_content"]; ?></td>
                                    <td>
                                        <?php 
                                        if($data['complaint_status']==1) { 
                                            echo $data['complaint_reply']; 
                                        } else { 
                                            echo "Not Replied"; 
                                        } 
                                        ?>
                                    </td>
                                    <td>
                                        <a href="Complaint.php?did=<?php echo $data["complaint_id"]; ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include("Foot.php");
?>