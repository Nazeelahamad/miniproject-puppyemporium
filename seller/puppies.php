<?php
session_start();
include('../assets/connection/connection.php');

include("Head.php");
if(isset($_POST['txt_submit']))
{ 
 $name=$_POST['txt_name'];
 $dob=$_POST['txt_dob'];
 $details=$_POST['txt_details'];
 $category=$_POST['txt_category'];
 $price=$_POST['txt_price'];
 $gender=$_POST['gender'];
 
 $photo=$_FILES['file_photo']['name'];
 $temp=$_FILES['file_photo']['tmp_name'];
 move_uploaded_file($temp,'../assets/Files/Puppies/'.$photo);
 
 $insqry = "insert into tbl_puppy(puppy_name,puppy_dob,puppy_details,puppy_price,category_id,puppy_gender,owner_id,puppy_photo) values('".$name."','".$dob."','".$details."','".$price."','".$category."','".$gender."','".$_SESSION['oid']."','".$photo."')";
 if($con->query($insqry))
 {
		?>
        <script>
		alert("data inserted..")
		window.location = "puppies.php"
		</script>
        <?php
	}
}

if(isset($_GET['did']))
{
	$delQry = "delete from tbl_puppy where puppy_id = ".$_GET['did'];
    $res=$con->query($delQry);
	header("location:puppies.php");
	  
}


if(isset($_GET['pid'])) {
  $_SESSION["pid"] = $_GET["pid"];
  ?>
  <script> 
      window.location = "Gallery.php"; 
  </script> 
  <?php
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADDPuppies</title>
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
        
        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        
        .form-container label {
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .form-container input[type="text"], .form-container input[type="date"], .form-container input[type="file"], .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
        }
        
        .form-container input[type="submit"] {
            background-color: #7AB730;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .form-container input[type="submit"]:hover {
            background-color: #6b9834;
        }
        
        .table-container {
            margin-top: 20px;
        }
        
        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table-container th, .table-container td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        
        .table-container th {
            background-color: #7AB730;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h3>Add Puppy</h3>
            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <div class="form-group">
                    <label for="txt_name">Name:</label>
                    <input type="text" name="txt_name" id="txt_name" required="required" placeholder="Enter Name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="txt_dob">DOB:</label>
                    <input type="date" name="txt_dob" id="txt_dob" required="required" placeholder="Enter DOB" class="form-control">
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender" value="male">
                        <label class="form-check-label" for="gender">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="female">
                        <label class="form-check-label" for="gender2">Female</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt_details">Details:</label>
                    <textarea name="txt_details" id="txt_details" cols="45" rows="5" required="required" placeholder="Enter Details" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="file_photo">Image:</label>
                    <input type="file" name="file_photo" id="file_photo" required="required" placeholder="Enter Image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="txt_category">Category:</label>
                    <div class="form-group">
                    <label for="txt_category">Category:</label>
                    <select name="txt_category" id="txt_category" class="form-control">
                        <option>--Select--</option>
                        <?php 
                        $selqry = "select * from tbl_category";
                        $result = $con->query($selqry);
                        while ($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row['category_id']?>"><?php echo $row['category_name']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="txt_price">Price:</label>
                    <input type="text" name="txt_price" id="txt_price" required="required" placeholder="Enter Price" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="txt_submit" id="txt_submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
        <div class="table-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>SI no</th>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Details</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=0;
                    $selqry = "select *from tbl_puppy p inner join tbl_category c on c.category_id=p.category_id WHERE p.owner_id = '".$_SESSION['oid']."'";
                    $result = $con->query($selqry);
                    while($data= $result->fetch_assoc()) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data["puppy_name"]; ?></td>
                        <td><?php echo $data["puppy_dob"]; ?></td>
                        <td><?php echo $data["puppy_details"]; ?></td>
                        <td><?php echo $data["category_name"]; ?></td>
                        <td><?php echo $data["puppy_price"]; ?></td>
                        <td><img src="../assets/Files/Puppies/<?php echo $data["puppy_photo"];?>" width="75" height="75" /></td>
                        <td>
                            <a href="puppies.php?pid=<?php echo $data['puppy_id'] ?>">ADDPhotos</a><br>
                            <a href="EditPuppies.php?puppy_id=<?php echo $data['puppy_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="puppies.php?did=<?php echo $data['puppy_id']?>">Delete</a><br>
                            <a href="AddStock.php?puppy_id=<?php echo $data['puppy_id']?>">Add Stock</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php
include("Foot.php");
?>