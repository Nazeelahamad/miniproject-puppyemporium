<?php include("Head.php") ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Replied Complaints</title>
</head>
<body>
    <div class="container my-5">
        <h3 class="text-center mb-4">Replied Complaints</h3>
        <table class="table table-bordered table-hover table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>Si no</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Complaint</th>
                    <th>Reply</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include('../assets/connection/connection.php');
                $i = 0;
                $selqry = "SELECT * FROM tbl_complaint c 
                            INNER JOIN tbl_user u ON c.user_id = u.user_id 
                            WHERE c.complaint_status = '1'";
                $result = $con->query($selqry);
                while ($row = $result->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row["user_name"]; ?></td>
                        <td><?php echo $row["complaint_title"]; ?></td>
                        <td><?php echo $row["complaint_content"]; ?></td>
                        <td><?php echo $row["complaint_reply"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php include("Foot.php")
 ?>