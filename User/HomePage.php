<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php include("Head.php") ?>

    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-uppercase text-dark mb-lg-4">PUPS SHOP</h1>
                    <h1 class="text-uppercase text-white mb-lg-4">Make Your Pets Happy</h1>
                    <p class="fs-4 text-white mb-lg-4">Find Your Forever Friend at Puppy Emporium – Where Every Puppy Finds a Loving Home!</p>
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5">
                        <a href="../Guest/about.php" class="btn btn-outline-light border-2 py-md-3 px-md-5 me-5">Read More</a>
                        <!-- <button type="button" class="btn-play" data-bs-toggle="modal"
                            data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                        <h5 class="font-weight-normal text-white m-0 ms-4 d-none d-sm-block">Play Video</h5> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Video Modal Start -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                            allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Modal End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded" src="../assets/Templates/Main/img/about.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="border-start border-5 border-primary ps-5 mb-5">
                        <h6 class="text-primary text-uppercase">About Us</h6>
                        <h1 class="display-5 text-uppercase mb-0">We Keep Your Pets Happy All Time</h1>
                    </div>
                    <h4 class="text-body mb-4">Find Your Forever Friend at Puppy Emporium – Where Every Puppy Finds a Loving Home!</h4>
                    <div class="bg-light p-4">
                        <ul class="nav nav-pills justify-content-between mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item w-50" role="presentation">
                                <button class="nav-link text-uppercase w-100 active" id="pills-1-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-1"
                                    aria-selected="true">Our Mission</button>
                            </li>
                            <li class="nav-item w-50" role="presentation">
                                <button class="nav-link text-uppercase w-100" id="pills-2-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2"
                                    aria-selected="false">Our Vission</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                                <p class="mb-0">Welcome to Puppy Emporium!

Discover the perfect furry friend at Puppy Emporium, where joy, loyalty, and love come in the form of adorable puppies. We are dedicated to connecting you with happy, healthy, and well-cared-for pups, ready to become your family’s newest member. Explore a wide variety of breeds, all raised with love and care, ensuring they’re as playful and affectionate as they are cute. Whether you’re looking for a lifelong companion or a new best friend, Puppy Emporium is here to make your journey a delightful experience. Your perfect puppy awaits!</p>
                            </div>
                            <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                                <p class="mb-0">**Our Vision: Bringing Joy, Love, and Companionship to Every Home, One Puppy at a Time**

At Puppy Emporium, our vision is to create a world where every puppy finds a loving and caring home. We believe in fostering lifelong bonds between families and their pets, ensuring each puppy is healthy, happy, and ready to bring joy to their new families. With a commitment to responsible breeding, ethical practices, and the highest standards of care, we aim to set the benchmark in the pet community. Our mission is not just to match puppies with owners but to nurture lasting relationships that enrich both lives.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    
<!-- Products Start -->
<div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-primary text-uppercase">Products</h6>
                <h1 class="display-5 text-uppercase mb-0">TOP DEALS</h1>
            </div>
            <div class="owl-carousel product-carousel">
                <div class="pb-5">
                    <div class="product-item position-relative bg-light d-flex flex-column text-center">
                    <img class="img-fluid mb-4" src="../assets/Files/Puppies/beagle.jpeg" alt="">
                        <h6 class="text-uppercase">beagle</h6>
                        <h5 class="text-primary mb-0">Rs.25000.00</h5>
                        <div class="btn-action d-flex justify-content-center">
                            <a class="btn btn-primary py-2 px-3" href="SearchPuppy.php"><i class="bi bi-cart"></i></a>
                            <a class="btn btn-primary py-2 px-3" href="SearchPuppy.php"><i class="bi bi-eye"></i></a>
                        </div>
                    </div>
                </div>
                <div class="pb-5">
                    <div class="product-item position-relative bg-light d-flex flex-column text-center">
                        <img class="img-fluid mb-4" src="../assets/Files/Puppies/akita.jpeg" alt="">
                        <h6 class="text-uppercase">ankita</h6>
                        <h5 class="text-primary mb-0">Rs.60000.00</h5>
                        <div class="btn-action d-flex justify-content-center">
                            <a class="btn btn-primary py-2 px-3" href=""><i class="bi bi-cart"></i></a>
                            <a class="btn btn-primary py-2 px-3" href=""><i class="bi bi-eye"></i></a>
                        </div>
                    </div>
                </div>
                <div class="pb-5">
                    <div class="product-item position-relative bg-light d-flex flex-column text-center">
                    <img class="img-fluid mb-4" src="../assets/Files/Puppies/german.jpeg" alt="">
                        <h6 class="text-uppercase">German</h6>
                        <h5 class="text-primary mb-0">Rs.13000.00</h5>
                        <div class="btn-action d-flex justify-content-center">
                            <a class="btn btn-primary py-2 px-3" href=""><i class="bi bi-cart"></i></a>
                            <a class="btn btn-primary py-2 px-3" href=""><i class="bi bi-eye"></i></a>
                        </div>
                    </div>
                </div>
                <div class="pb-5">
                    <div class="product-item position-relative bg-light d-flex flex-column text-center">
                    <img class="img-fluid mb-4" src="../assets/Files/Puppies/cane.jpeg" alt="">
                        <h6 class="text-uppercase">cane</h6>
                        <h5 class="text-primary mb-0">Rs.50000.00</h5>
                        <div class="btn-action d-flex justify-content-center">
                            <a class="btn btn-primary py-2 px-3" href=""><i class="bi bi-cart"></i></a>
                            <a class="btn btn-primary py-2 px-3" href=""><i class="bi bi-eye"></i></a>
                        </div>
                    </div>
                </div>
                <div class="pb-5">
                    <div class="product-item position-relative bg-light d-flex flex-column text-center">
                    <img class="img-fluid mb-4" src="../assets/Files/Puppies/dane.jpg" alt="">
                        <h6 class="text-uppercase">Dane</h6>
                        <h5 class="text-primary mb-0">Rs.30000.00</h5>
                        <div class="btn-action d-flex justify-content-center">
                            <a class="btn btn-primary py-2 px-3" href=""><i class="bi bi-cart"></i></a>
                            <a class="btn btn-primary py-2 px-3" href=""><i class="bi bi-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
    

    <!-- Offer Start -->
    <div class="container-fluid bg-offer my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5 justify-content-start">
                <div class="col-lg-7">
                    <div class="border-start border-5 border-dark ps-5 mb-5">
                        <h6 class="text-dark text-uppercase">Special Offer</h6>
                        <h1 class="display-5 text-uppercase text-white mb-0">Save up to 50% on all puppies your first order</h1>
                    </div>
                    <p class="text-white mb-4">Don't miss out on our limited-time offer! At Puppy Emporium, we are offering an incredible discount of up to 50% on all puppies for your first order. This is the perfect opportunity to bring home a new furry friend at an unbeatable price. Our puppies are healthy, happy, and ready to join your family. Shop now and take advantage of this special offer before it's gone!</p>
                    <a href="SearchPuppy.php" class="btn btn-light py-md-3 px-md-5 me-3">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->

    


    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-primary text-uppercase">Team Members</h6>
                <h1 class="display-5 text-uppercase mb-0">Best Sellers</h1>
            </div>
            <div class="owl-carousel team-carousel position-relative" style="padding-right: 25px;">
                <div class="team-item">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="../assets/Files/Seller/Photo/c99245e3-e719-477a-931c-41e7c4a4cfcd.jpg" alt="">
                        <div class="team-overlay">
                            <div class="d-flex align-items-center justify-content-start">
                               <a class="btn btn-light btn-square i-1" href="https://www.instagram.com/jinsjogy7067670?igsh=dTJubGRsZWx3MWxt"><i class="bi bi-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light text-center p-4">
                        <h5 class="text-uppercase"></h5>Jins jogy
                        <p class="m-0">Designation</p>
                    </div>
                </div>
                <div class="team-item">
                    <div class="position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="../assets/Files/Seller/Photo/nazeel.png" alt="">
                    <div class="team-overlay">
                            <div class="d-flex align-items-center justify-content-start">
                                <a class="btn btn-light btn-square mx-1" href="https://www.instagram.com/nazeelahamad/profilecard/?igsh=MXV3YjAwZDJhYW9zZA=="><i class="bi bi-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light text-center p-4">
                        <h5 class="text-uppercase">Nazeel Ahamad</h5>
                        <p class="m-0">Designation</p>
                    </div>
                </div>
                
    </div>
    <!-- Team End -->


     <!-- Testimonial Start -->
     <div class="container-fluid bg-testimonial py-5" style="margin: 45px 0;">
        <div class="container py-5">
            <div class="row justify-content-end">
                <div class="col-lg-7">
                    <div class="owl-carousel testimonial-carousel bg-white p-5">
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-4">
                                <img class="img-fluid mx-auto" src="../assets/Templates/Main/img/testimonial-1.jpg" alt="">
                                <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white" style="width: 45px; height: 45px;">
                                    <i class="bi bi-chat-square-quote text-primary"></i>
                                </div>
                            </div>
                            <p>I had an amazing experience with Online Puppy Emporium! The adoption process was smooth, and the team was incredibly helpful in answering all my questions. My new puppy is healthy, playful, and has brought so much joy into my life. I highly recommend this place to anyone looking for a loving furry companion!</p>
                            <hr class="w-25 mx-auto">
                            <h5 class="text-uppercase">Emma Johnson</h5>
                            <span>Happy Pet Parent</span>
                        </div>
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-4">
                                <img class="img-fluid mx-auto" src="../assets/Templates/Main/img/testimonial-2.jpg" alt="">
                                <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white" style="width: 45px; height: 45px;">
                                    <i class="bi bi-chat-square-quote text-primary"></i>
                                </div>
                            </div>
                            <p>Finding the perfect furry friend was so easy with Online Puppy Emporium! The website is user-friendly, and the customer service team ensured I had all the necessary details before bringing my puppy home. My little pup is adorable, well-trained, and full of energy. Thank you for making this such a wonderful experience.</p>
                            <hr class="w-25 mx-auto">
                            <h5 class="text-uppercase">Michael Rodriguez</h5>
                            <span>Proud Dog Owner</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    
    

   

<?php
include("Foot.php");
?>