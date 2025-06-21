<?php
include('../assets/connection/connection.php');

session_start();
include("Head.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Request History</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
    }

    .table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }

    .table th, .table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .table th {
        background-color: #7AB730;
        color: #fff;
    }

    .table td {
        background-color: #f9f9f9;
    }

    .btn {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
    }

    .btn-success {
      background-color: #337ab7;
      border: none;
      color: #fff;
    }
    
    .btn-success:hover {
      background-color: #23527c;
    }
    
    .btn-chat {
      background-color: #80669d;
      border: none;
      color: #fff;
    }
    
    .btn-chat:hover {
      background-color: #9b82b1;
    }
    
    .btn-payment {
      background-color: #34c759;
      border: none;
      color: #fff;
    }
    
    .btn-payment:hover {
      background-color: #2ea543;
    }

    .delivery-status {
        display: inline-block;
        padding: 5px 10px;
        font-size: 14px;
        color: #fff;
        background-color:rgb(71, 179, 118);
        border-radius: 3px;
        font-weight: bold;
        text-align: center;
    }
</style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Request History
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Seller</th>
                                        <th>Puppy</th>
                                        <th>Request Amount</th>
                                        <th>Request Date</th>
                                        <th>Status</th>
                                        <th>Delivery Status</th>
                                        <th>Reply</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i=0; 
                                    $selQry = "SELECT r.*, p.*, o.*, r.delivery_status FROM tbl_request r INNER JOIN tbl_puppy p ON r.puppy_id = p.puppy_id INNER JOIN tbl_owner o ON p.owner_id = o.owner_id WHERE r.user_id = '".$_SESSION['uid']."'";
                                    $row=$con->query($selQry); 
                                    while($data=$row->fetch_assoc()) { 
                                    $i++; 
                                    ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $data['owner_name']?></td>
                                        <td><?php echo $data['puppy_name']?></td>
                                        <td><?php echo $data['request_ammount']?></td>
                                        <td><?php echo $data['request_date']?></td>
                                        <td>
                                            <?php 
                                            if($data['request_status'] == '1') { 
                                                echo "Accepted"; 
                                            } else if($data['request_status'] == '2') { 
                                                echo "Rejected"; 
                                            } else if($data['request_status'] == '3') { 
                                                echo "Payment Completed"; 
                                            } 
                                            ?>
                                        </td>
                                        <td>
                                            <span class="delivery-status"> <?php if($data['request_status'] == '3') echo $data['delivery_status']; ?> </span>
                                        </td>
                                        <td>
                                            <?php 
                                            if($data['request_status'] == 1) { 
                                                echo $data['request_reply']; 
                                                ?>
                                                <a href="Chat.php?id=<?php echo $data['owner_id']?>" class="btn btn-chat btn-sm">Chat</a>
                                                <a href="Payment.php?rid=<?php echo $data['request_id']?>" class="btn btn-payment btn-sm">Payment</a>
                                            <?php } else if($data['request_status'] == 0) { 
                                                echo "Not Replied"; 
                                            } 
                                            else if($data['request_status'] == '3') {
                                                ?>
                                                <a href="Bill.php?id=<?php echo $data['request_id']?>" class="btn btn-success btn-sm">Bill</a>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </form>
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
