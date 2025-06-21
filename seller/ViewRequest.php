<?php
session_start();
include('../assets/connection/connection.php');

include("Head.php");


if(isset($_GET['Rid']))
{
	$upQry="update tbl_request set request_status='2' where request_id='".$_GET['Rid']."'";
	if($con->query($upQry))
	{
		?>
        <script>
		alert("Rejected")
		window.location="ViewRequest.php";
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
    
    .container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .table th, .table td {
        padding: 10px;
        border: 1px solid #ddd;
    }
    
    .table th {
        background-color: #7AB730;
        color: #fff;
    }
    
    .badge {
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 10px;
    }
    
    .badge-success {
        background-color: #2ecc71;
    }
    
    .badge-danger {
        background-color: #e74c3c;
    }
    
    .badge-info {
        background-color: #9b59b6;
    }
    
    .badge-warning {
        background-color: #f1c40f;
    }
    
    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    
    .btn-success {
        background-color: #2ecc71;
        color: #fff;
    }
    
    .btn-danger {
        background-color: #e74c3c;
        color: #fff;
    }
    .delivery-status-select {
    background-color: #f1f8e9;
    border: 1px solid #7cb342;
    border-radius: 5px;
    padding: 5px 10px;
    color: #33691e;
    font-weight: bold;
    width: auto;
    display: inline-block;
  }

        .delivery-status-select:focus {
            outline: none;
            border-color: #689f38;
            box-shadow: 0 0 5px rgba(104, 159, 56, 0.5);
        }

</style>
</head>

<body>
    <div class="container">
        <h2>Requests</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Puppy</th>
                    <th>Request Amount</th>
                    <th>Request Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=0;
                $selQry="select * from tbl_request r inner join tbl_user u on r.user_id=u.user_id inner join tbl_puppy p on r.puppy_id=p.puppy_id where owner_id='".$_SESSION['oid']."'";
                $row=$con->query($selQry);
                while($data=$row->fetch_assoc()) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $data['user_name']?></td>
                    <td><?php echo $data['puppy_name']?></td>
                    <td><?php echo $data['request_ammount']?></td>
                    <td><?php echo $data['request_date']?></td>
                    <td>
                        <?php 
                        if($data['request_status'] == '1') {
                            echo "<span class='badge badge-success'>Accepted</span>";
                        } else if($data['request_status'] == '2') {
                            echo "<span class='badge badge-danger'>Rejected</span>";
                        } else if($data['request_status'] == '3') {
                            echo "<span class='badge badge-info'>Payment Completed</span>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if($data['request_status'] == 1) {
                            echo $data['request_reply'];
                            ?>
                                <a href="Chat.php?id=<?php echo $data['user_id']?>" class="btn btn-success">Chat</a>

                            <?php
                            echo "<span class='badge badge-warning'>Payment Pending</span>";
                        } else if($data['request_status'] == 0) {
                        ?>
                            <a href="Reply.php?Aid=<?php echo $data['request_id']?>" class="btn btn-success">Accept</a>
                            <a href="ViewRequest.php?Rid=<?php echo $data['request_id']?>" class="btn btn-danger">Reject</a>
                        <?php 
                        }
                        ?>
                         <?php 
                        if($data['request_status'] == '3') {
                            ?>
                            <form action="UpdateStatus.php" method="post">
                                <input type="hidden" name="request_id" value="<?php echo $data['request_id']; ?>">
                                <select name="delivery_status" class="form-select delivery-status-select" onchange="this.form.submit()">
                                    <option value="On the Way" <?php if($data['delivery_status'] == 'On the Way') echo 'selected'; ?>>Puppy is On the Way</option>
                                    <option value="Delivered" <?php if($data['delivery_status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                                </select>
                            </form>

                            <?php
                        }
                        ?>

                    </td>
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
include("Foot.php");
?>