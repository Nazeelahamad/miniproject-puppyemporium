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
    <title>About Us - Puppy Emporium</title>
<!--     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
 -->    <style>
        .about-section {
            padding: 50px 0;
            background-color: #f8f9fa;
        }
        .about-section h2 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #343a40;
        }
        .about-section p {
            font-size: 18px;
            color: #6c757d;
            line-height: 1.6;
        }
        .values-section {
            padding: 50px 0;
            background-color: #ffffff;
        }
        .values-section h2 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #343a40;
        }
        .values-section p {
            font-size: 18px;
            color: #6c757d;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container about-section">
        <h2>About Us</h2>
        <p>Welcome to Puppy Emporium! We are dedicated to providing the best puppies to loving homes. Our mission is to connect families with their perfect furry companions. We believe in responsible breeding and ensure that all our puppies are healthy, happy, and well-socialized.</p>
        <p>At Puppy Emporium, we take pride in our commitment to animal welfare. Our team of experienced breeders and caregivers work tirelessly to ensure that each puppy receives the best care possible. We are passionate about what we do and strive to make the adoption process as smooth and enjoyable as possible for our customers.</p>
    </div>

    <div class="container values-section">
        <h2>Our Values</h2>
        <p><strong>Quality Care:</strong> We prioritize the health and well-being of our puppies, providing them with the best care and attention.</p>
        <p><strong>Responsible Breeding:</strong> We follow ethical breeding practices to ensure the health and happiness of our puppies.</p>
        <p><strong>Customer Satisfaction:</strong> We are committed to providing excellent customer service and support throughout the adoption process.</p>
        <p><strong>Community Engagement:</strong> We actively participate in community events and initiatives to promote responsible pet ownership.</p>
    </div>

    <?php include("Foot.php"); ?>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>