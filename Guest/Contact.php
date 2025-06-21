<?php
session_start();
include("../assets/connection/connection.php");
include("Head.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Puppy Emporium</title>
<!--     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
 -->    <style>
        .contact-section {
            padding: 50px 0;
            background-color: #f8f9fa;
        }
        .contact-section h2 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #343a40;
        }
        .contact-section p {
            font-size: 18px;
            color: #6c757d;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container contact-section">
        <h2>Contact Us</h2>
        <p>We'd love to hear from you! Whether you have questions about our adorable puppies, need more information, or just want to say hello, feel free to contact us. Our team is here to assist you.</p>
        <div class="row">
            <div class="col-md-6">
                <h3>Contact Information</h3>
                <p><i class="bi bi-geo-alt text-primary me-2"></i>pups shop, Muvattupuzha</p>
                <p><i class="bi bi-envelope-open text-primary me-2"></i><a href="mailto:puppyemporium@gmail.com">puppyemporium@gmail.com</a></p>
                <p><i class="bi bi-telephone text-primary me-2"></i><a href="tel:+918590616546">+91 859 0616546</a></p>
            </div>
        </div>
    </div>

    <?php include("Foot.php"); ?>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>