<?php 
session_start(); 
include('../assets/connection/connection.php'); 
include("Head.php");

if(isset($_POST['submitbtn'])) {
    $photo=$_FILES['photo']['name'];
    $temp=$_FILES['photo']['tmp_name'];
    move_uploaded_file($temp,'../assets/Files/Puppies/'.$photo);
    $insqry = "insert into tbl_gallery(gallery_file,puppy_id) values('".$photo."','".$_SESSION["pid"]."')";
    if($con->query($insqry)) { 
?>
        <script> 
            alert("Data inserted.."); 
        </script>
<?php 
    } 
}

if(isset($_GET['did'])) {
    $delQry = "delete from tbl_gallery where gallery_id= ".$_GET['did'];
    if($con->query($delQry)) { 
?>
        <script> 
            alert("Deleted"); 
            window.location="Gallery.php"; 
        </script>
<?php 
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
<!--     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
 -->    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
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
        .file-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="HomePage.php" class="btn btn-primary">Home</a>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="photo">File:</label>
                <input type="file" name="photo" id="photo" class="file-input">
            </div>
            <div class="form-group">
                <input type="submit" name="submitbtn" id="submitbtn" value="Submit" class="btn btn-success">
            </div>
            <div class="table-container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Si.No</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i=0; 
                        $selqry = "select * from tbl_gallery WHERE puppy_id='".$_SESSION["pid"]."'";
                        $result = $con->query($selqry);
                        while($row= $result->fetch_assoc()) {
                            $i++;
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img src="../assets/Files/Puppies/<?php echo $row["gallery_file"];?>" width="100px" height="100px"/></td>
                                <td><a href="Gallery.php?did=<?php echo $row['gallery_id']?>">Delete</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</body>
</html>
<?php include("Foot.php"); ?>