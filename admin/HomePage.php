<?php
session_start();
include('../assets/connection/connection.php');
$user_query = "SELECT COUNT(*) as total_users FROM tbl_user";
$user_result = $con->query($user_query);
$user_data = $user_result->fetch_assoc();
$new_user_query = "SELECT COUNT(*) as new_users FROM tbl_user WHERE user_created_at > DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)";
$new_user_result = $con->query($new_user_query);
$new_user_data = $new_user_result->fetch_assoc();

$seller_query = "SELECT COUNT(*) as total_sellers FROM tbl_owner";
$seller_result = $con->query($seller_query);
$seller_data = $seller_result->fetch_assoc();

$new_seller_query = "SELECT COUNT(*) as new_sellers FROM tbl_owner WHERE owner_created_at > DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)";
$new_seller_result = $con->query($new_seller_query);
$new_seller_data = $new_seller_result->fetch_assoc();

// Fetch the number of products
$product_query = "SELECT SUM(puppy_stock) as total_stock FROM tbl_puppy";
$product_result = $con->query($product_query);
$product_data = $product_result->fetch_assoc();

// Fetch the number of orders
$order_query = "SELECT COUNT(*) as total_orders FROM tbl_request where request_status = 3";
$order_result = $con->query($order_query);
$order_data = $order_result->fetch_assoc();

?>




<!DOCTYPE html>


<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../Assets/Templates/Admin/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <style>
      body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            font-size: 14px;
        }
        .badge-info {
            background-color: #17a2b8;
            color: #fff;
        }

    </style>
  
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../Assets/Templates/Admin/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../Assets/Templates/Admin/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../Assets/Templates/Admin/assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <svg
                  width="25"
                  viewBox="0 0 25 42"
                  version="1.1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                  <defs>
                    <path
                      d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                      id="path-1"
                    ></path>
                    <path
                      d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                      id="path-3"
                    ></path>
                    <path
                      d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                      id="path-4"
                    ></path>
                    <path
                      d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                      id="path-5"
                    ></path>
                  </defs>
                  <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                      <g id="Icon" transform="translate(27.000000, 15.000000)">
                        <g id="Mask" transform="translate(0.000000, 8.000000)">
                          <mask id="mask-2" fill="white">
                            <use xlink:href="#path-1"></use>
                          </mask>
                          <use fill="#696cff" xlink:href="#path-1"></use>
                          <g id="Path-3" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-3"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                          </g>
                          <g id="Path-4" mask="url(#mask-2)">
                            <use fill="#696cff" xlink:href="#path-4"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                          </g>
                        </g>
                        <g
                          id="Triangle"
                          transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                        >
                          <use fill="#696cff" xlink:href="#path-5"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Admin Panel</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="HomePage.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            
            <!-- Components -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Components</span></li>
            <!-- Cards -->
            <li class="menu-item">
              <a href="Category.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Category</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="district.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">district</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="place.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Place</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="OwnerVerification.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Owner verification</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="SellerList.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Seller List</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="UserList.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">User List</div>
              </a>
            </li>
            
            <li class="menu-item">
              <a href="ViewComplaints.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">View Complaints</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="RepliedComplaints.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Replied Complaints</div>
              </a>
            </li>
            
            
            
            </li>
            <!-- <li class="menu-item">
              <a
                href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                target="_blank"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">Documentation</div>
              </a> -->
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->
              


               

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../Assets/Templates/Admin/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../Assets/Templates/Admin/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">Admin</span>
                            <small class="text-muted"></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
        
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="../Logout.php">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
              <div class="col-md-3">
                <div class="card mb-4">
                <div class="card-body text-center">
                  <div class="d-flex justify-content-center mb-3">
                  <i class="fas fa-users fa-3x text-primary"></i>
                  </div>
                  <h5 class="card-title">Total Users</h5>
                  <h1 class="card-text text-primary"><?php echo $user_data['total_users']; ?></h1>
                  <h5 class="card-title">New Users</h5>
                  <h1 class="card-text text-success"><?php echo $new_user_data['new_users']; ?></h1>
                </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card mb-4">
                <div class="card-body text-center">
                  <div class="d-flex justify-content-center mb-3">
                  <i class="fas fa-user-tie fa-3x text-primary"></i>
                  </div>
                  <h5 class="card-title">Total Sellers</h5>
                  <h1 class="card-text text-primary"><?php echo $seller_data['total_sellers']; ?></h1>
                  <h5 class="card-title">New Sellers</h5>
                  <h1 class="card-text text-success"><?php echo $new_seller_data['new_sellers']; ?></h1>
                </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card mb-4">
                <div class="card-body text-center">
                  <div class="d-flex justify-content-center mb-3">
                  <i class="fas fa-boxes fa-3x text-primary"></i>
                  </div>
                  <h5 class="card-title">Total Products</h5>
                  <h1 class="card-text text-primary"><?php echo $product_data['total_stock']; ?></h1>
                  <h5 class="card-title">Total Orders</h5>
                  <h1 class="card-text text-primary"><?php echo $order_data['total_orders']; ?></h1>
                </div>
                </div>
              </div>
              
              <div class="container">
        <h2 class="text-center mb-4">Purchased Users</h2>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Seller Name</th>
                            <th>Puppy Name</th>
                            <th>Request Amount</th>
                            <th>Request Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_request r 
                                    INNER JOIN tbl_user u ON r.user_id = u.user_id 
                                    INNER JOIN tbl_puppy p ON r.puppy_id = p.puppy_id 
                                    INNER JOIN tbl_owner s ON p.owner_id = s.owner_id 
                                    WHERE r.request_status = '3'";
                        $row = $con->query($selQry);
                        while ($data = $row->fetch_assoc()) {
                            $i++;
                        ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $data['user_name'] ?></td>
                                <td><?php echo $data['owner_name'] ?></td>
                                <td><?php echo $data['puppy_name'] ?></td>
                                <td><?php echo $data['request_ammount'] ?></td>
                                <td><?php echo $data['request_date'] ?></td>
                                <td>
                                    <span class='badge badge-info'>Payment Completed</span>
                                </td>
                            </tr>
                        <?php
                         } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

  

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../Assets/Templates/Admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../Assets/Templates/Admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="../Assets/Templates/Admin/assets/vendor/js/bootstrap.js"></script>
    <script src="../Assets/Templates/Admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../Assets/Templates/Admin/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../Assets/Templates/Admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../Assets/Templates/Admin/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../Assets/Templates/Admin/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
