<?php
session_start();
include("../assets/connection/connection.php");

if(isset($_GET['pid'])) {
    $puppy_id = $_GET['pid'];
    $selQry = "SELECT p.*, c.category_name, o.owner_name FROM tbl_puppy p 
               INNER JOIN tbl_category c ON p.category_id = c.category_id 
               INNER JOIN tbl_owner o ON p.owner_id = o.owner_id 
               WHERE p.puppy_id = '$puppy_id'";
    $result = $con->query($selQry);
    $puppy = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puppy Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .puppy-details {
            margin-top: 50px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .puppy-photo {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }
        .puppy-photo:hover {
            transform: scale(1.05);
        }
        .gallery-thumbnails img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: transform 0.3s ease, opacity 0.3s;
        }
        .gallery-thumbnails img:hover {
            transform: scale(1.1);
            opacity: 0.8;
        }
        .puppy-info h3 {
            font-weight: bold;
            color: #343a40;
        }
        .puppy-info p {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 5px;
        }
        .price-tag {
            background-color:rgba(20, 216, 62, 0.93);
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 10px;
            font-size: 24px;
            font-weight: bold;
        }

       .btn-request {
            background: #28a745;
            border: none;
            color:white;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .btn-request:hover {
            background: #218838;
            color:white;
        }
        @media (max-width: 768px) {
            .puppy-photo {
                max-height: 300px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="puppy-details">
        <?php if(isset($puppy)) { ?>
            <div class="row">
                <div class="col-md-6">
                    <img src="../assets/Files/Puppies/<?php echo $puppy['puppy_photo']; ?>" class="puppy-photo" alt="<?php echo $puppy['puppy_name']; ?>" id="mainPuppyImage">
                </div>
                <div class="col-md-6 puppy-info">
                    <h3><?php echo $puppy['puppy_name']; ?></h3>
                    <div class="price-tag">Rs. <?php echo $puppy['puppy_price']; ?>/-</div>
                    <p><strong><b>Date of Birth:</b></strong> <?php echo $puppy['puppy_dob']; ?></p>
                    <p><strong><b>Category:</b></strong> <?php echo $puppy['category_name']; ?></p>
                    <p><strong><b>Gender:</b></strong> <?php echo ucfirst($puppy['puppy_gender']); ?></p>
                    <p><strong><b>Stock Left:</b></strong> <?php echo $puppy['puppy_stock']; ?></p>
                    <p><strong><b>Owner:</b></strong> <?php echo $puppy['owner_name']; ?></p>
                    <p><?php echo $puppy['puppy_details']; ?></p>
                    <a href="SearchPuppy.php?pid=<?php echo $puppy['puppy_id']; ?>&amt=<?php echo $puppy['puppy_price']; ?>" class="btn btn-request">Request</a>
                </div>
            </div>

            <!-- Gallery Thumbnails -->
            <div class="gallery-thumbnails mt-4 d-flex flex-wrap">
                <?php
                $selglry = "SELECT * FROM tbl_gallery WHERE puppy_id = '" . $_GET['pid'] . "'";
                $result = $con->query($selglry);
                if ($result->num_rows > 0) {
                    while ($gdata = $result->fetch_assoc()) {
                ?>
                <img src="../assets/Files/Puppies/<?php echo $gdata["gallery_file"]; ?>" 
                     alt="<?php echo $puppy["puppy_name"]; ?>" 
                     class="thumbnail" 
                     onclick="changeImage(this.src)">
                <?php
                    }
                }
                ?>
            </div>
        <?php } else { ?>
            <p class="text-center text-danger">Puppy details not found.</p>
        <?php } ?>
    </div>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function changeImage(src) {
        document.getElementById("mainPuppyImage").src = src;
    }
</script>
</body>
</html>
