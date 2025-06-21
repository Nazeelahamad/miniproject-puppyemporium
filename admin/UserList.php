session_start();
<?php
include("Head.php")
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UserList</title>
</head>

<body>
<div class="container my-5">
    <h3 class="text-center mb-4">User Details</h3>
    <form id="form1" name="form1" method="post" action="">
        <table class="table table-bordered table-hover table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>SI NO</th>
                    <th>USER</th>
                    <th>EMAIL</th>
                    <th>CONTACT</th>
                    <th>ADDRESS</th>
                    <th>PLACE</th>
                    <th>DISTRICT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../assets/connection/connection.php');
                $i = 0;
                $selqry = "select *from tbl_user u inner join tbl_place p on u.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id";
                $result = $con->query($selqry);
                while ($row = $result->fetch_assoc()) {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row["user_name"]; ?></td>
                    <td><?php echo $row["user_email"]; ?></td>
                    <td><?php echo $row["user_contact"]; ?></td>
                    <td><?php echo $row["user_address"]; ?></td>
                    <td><?php echo $row["place_name"]; ?></td>
                    <td><?php echo $row["district_name"]; ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </form>
</div>
              </body>
</html>
<?php
include("Foot.php")
?>