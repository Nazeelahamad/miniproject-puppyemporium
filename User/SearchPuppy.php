<?php
include('../assets/connection/connection.php');
session_start();
include("Head.php");

if(isset($_GET['pid'])){
    $insQry="insert into tbl_request (request_date,user_id,puppy_id,request_ammount) VALUES(curdate(),'".$_SESSION['uid']."','".$_GET['pid']."','".$_GET['amt']."')";
    if($con->query($insQry)){
    ?>
    <script>
    alert("Request Sent");
    window.location="Homepage.php";
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
<title>Search Puppies</title>
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

    .puppy-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .puppy-card {
        border: 1px solid #ddd;
        padding: 10px;
        margin: 10px;
        width: 200px;
        text-align: center;
    }

    .puppy-card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Search Puppies
                    </div>
                    <div class="card-body">
                        <form id="form1" name="form1" method="post" action="">
                            <table class="form-table">
                                <tr>
                                    <td>
                                        <label for="category">Category</label>
                                        <select name="category" id="category" class="form-control">
                                            <option>--select--</option>
                                            <?php 
                                            $selqry="select * from tbl_category";
                                            $result=$con->query($selqry); 
                                            while($row= $result->fetch_assoc()) { 
                                            ?>
                                            <option value="<?php echo $row['category_id']?>"><?php echo $row['category_name']?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" value="Search" name='txt_submit' class="btn btn-success">
                                        <input type="reset" value="Cancel" name='txt_submit' class="btn btn-secondary">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        $selPet="select * from tbl_puppy p 
                 inner join tbl_category c on c.category_id=p.category_id 
                 inner join tbl_owner o on p.owner_id=o.owner_id 
                 where p.puppy_stock > 0 and o.owner_status = '1'";
        if(isset($_POST['txt_submit']) && isset($_POST['category'])){
            $selPet="select * from tbl_puppy p 
                     inner join tbl_category c on c.category_id=p.category_id 
                     inner join tbl_owner o on p.owner_id=o.owner_id 
                     where p.category_id=".$_POST['category']." and p.puppy_stock > 0 and o.owner_status = '1'";
        }
        $res=$con->query($selPet); 
        if($res->num_rows>0){ 
        ?>
        <div class="puppy-container">
            <?php 
            while($data= $res->fetch_assoc()) { 
            ?>
            <div class="puppy-card">
                <img src="../assets/Files/Puppies/<?php echo $data["puppy_photo"] ?>" alt="<?php echo $data["puppy_name"]; ?>">
                <p><?php echo $data["puppy_name"]; ?></p>
                <p><?php echo $data["category_name"]; ?></p>
                <p>Rs.<?php echo $data["puppy_price"]; ?>/-</p>
                <p><a href="SearchPuppy.php?pid=<?php echo $data["puppy_id"]; ?>&amt=<?php echo $data["puppy_price"]; ?>" class="btn btn-success">Request</a></p>
                <p><a href="ViewPuppy.php?pid=<?php echo $data["puppy_id"];?>">view more</a></p>
                <p>Stock Left: <?php echo $data['puppy_stock']; ?></p> <!-- Display stock here -->
            </div>
            <?php } ?>
        </div>
        <?php } else{ 
            echo "<p>No puppies found.</p>";
        } ?>
    </div>
</body>
</html>
<?php
include("Foot.php");
?>