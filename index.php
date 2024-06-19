<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$updated_at = date("Y-m-d H:i:s");
$_GET['restaurant_id'] = 2;
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>Restaurant Menu Card</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta name="format-detection" content="">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">

    <!-- Stylesheet -->
    <link href="assets/vendor/magnific-popup/magnific-popup.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="assets/vendor/rangeslider/rangeslider.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&amp;family=Lobster+Two:ital,wght@0,400;0,700;1,400;1,700&amp;family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
          rel="stylesheet">
    <style>
        @media (min-width: 740px) {
            #first-section{
                min-height: 920px;
            }
        }
    </style>

</head>
<body id="bg">
<div id="loading-area" class="loading-page-3">
    <img src="assets/images/loading.gif" alt="">
</div>
<div class="page-wraper">

    <!-- Header -->
    <header class="site-header mo-left header header-transparent style-1">
        <!-- Main Header -->
        <div class="sticky-header main-bar-wraper navbar-expand-lg">
            <div class="main-bar clearfix ">
                <div class="container clearfix">

                    <!-- Website Logo -->
                    <div class="logo-header mostion">
                        <a href="index.php" class="anim-logo"><img src="assets/images/logo.png" alt="/"></a>
                        <a href="index.php" class="anim-logo-white"><img src="assets/images/logo2.png" alt="/"></a>
                    </div>

                    <!-- Nav Toggle Button -->
                    <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <!-- Header Nav -->
                    <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                        <div class="logo-header">
                            <a href="index.php" class="anim-logo"><img src="assets/images/logo.png" alt="/"></a>
                        </div>
                        <div class="dz-social-icon">
                            <?php
                            $fetch_contact_data = $db_handle->runQuery("select * from restaurant_contact where user_id = {$_GET['restaurant_id']}");
                            ?>
                            <ul>
                                <li><a target="_blank" class="fab fa-facebook-f"
                                       href="<?php echo $fetch_contact_data[0]['facebook']; ?>"></a></li>
                                <li><a target="_blank" class="fab fa-instagram"
                                       href="<?php echo $fetch_contact_data[0]['insta']; ?>"></a></li>
                                <li><a target="_blank" class="fab fa-youtube"
                                       href="<?php echo $fetch_contact_data[0]['youtube']; ?>"></a></li>
                                <li><a target="_blank" class="fa fa-globe"
                                       href="<?php echo $fetch_contact_data[0]['website']; ?>"></a></li>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Main Header End -->
    </header>
    <!-- Header -->

    <div class="page-content bg-white">
        <!-- Banner  -->
        <div class="dz-bnr-inr style-1 text-center bg-parallax"
             style="background-image:url('assets/images/banner/bnr1.jpg'); background-size:cover; background-position:center;">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <?php
                    $fetch_user = $db_handle->runQuery("select * from users where user_id = {$_GET['restaurant_id']}");
                    ?>
                    <h1><?php echo $fetch_user[0]['restaurant_name']; ?></h1>
                    <!-- Breadcrumb Row -->
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Our Menu</li>
                        </ul>
                    </nav>
                    <!-- Breadcrumb Row End -->
                </div>
            </div>
        </div>
        <!-- Banner End -->

        <!-- Our Menu-->
        <section class="content-inner section-wrapper-7 overflow-hidden bg-white">
            <div class="container">
                <div class="row inner-section-wrapper" id="first-section">
                    <?php
                    $fetch_category = $db_handle->runQuery("select * from category where user_id = {$_GET['restaurant_id']} and status = 1 limit 2");
                    for ($i = 0; $i < 2; $i++) {
                        ?>
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="menu-head">
                                <h4 class="title text-primary"><?php echo ucwords(strtolower($fetch_category[$i]['category_name'])); ?></h4>
                            </div>
                            <?php
                            $fetch_items = $db_handle->runQuery("select * from items where cat_id = {$fetch_category[$i]['cat_id']} and status = 1");
                            $fetch_items_no = $db_handle->numRows("select * from items where cat_id = {$fetch_category[$i]['cat_id']} and status = 1");
                            for ($j = 0; $j < $fetch_items_no; $j++) {
                                ?>
                                <div class="dz-shop-card style-2 m-b30 p-0 shadow-none">
                                    <div class="dz-content">
                                        <div class="dz-head">
                                            <p class="header-text"><a
                                                        href="#"><?php echo $fetch_items[$j]['item_name']; ?></a></p>
                                            <span class="img-line"></span>
                                            <p class="header-price"><?php echo $fetch_items[$j]['item_price']; ?></p>
                                        </div>
                                        <p class="dz-body" style="text-align: justify">
                                            <?php echo $fetch_items[$j]['short_desc']; ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="row">
                    <?php
                    $fetch_category_new = $db_handle->runQuery("select * from category where user_id = {$_GET['restaurant_id']} and status = 1");
                    $fetch_category_new_no = $db_handle->numRows("select * from category where user_id = {$_GET['restaurant_id']} and status = 1");
                    if ($fetch_category_new_no > 2) {
                        for ($i = 2; $i < $fetch_category_new_no; $i++) {
                            ?>
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="menu-head">
                                    <h4 class="title text-primary"><?php echo ucwords(strtolower($fetch_category_new[$i]['category_name'])); ?></h4>
                                </div>
                                <?php
                                $fetch_items_new = $db_handle->runQuery("select * from items where cat_id = {$fetch_category_new[$i]['cat_id']} and status = 1");
                                $fetch_items_new_no = $db_handle->numRows("select * from items where cat_id = {$fetch_category_new[$i]['cat_id']} and status = 1");
                                for ($j = 0; $j < $fetch_items_new_no; $j++) {
                                    ?>
                                    <div class="dz-shop-card style-2 m-b30 p-0 shadow-none">
                                        <div class="dz-content">
                                            <div class="dz-head">
                                                <span class="header-text"><a href="#"><?php echo $fetch_items_new[$j]['item_name']; ?></a></span>
                                                <span class="img-line"></span>
                                                <span class="header-price"><?php echo $fetch_items_new[$j]['item_price']; ?></span>
                                            </div>
                                            <p class="dz-body" style="text-align: justify">
                                                <?php echo $fetch_items_new[$j]['short_desc']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <?php
                        $fetch_note = $db_handle->runQuery("select note from users where user_id = {$_GET['restaurant_id']}");
                        ?>
                        <p><?php echo $fetch_note[0]['note'];?></p>
                    </div>
                </div>
            </div>
            <img class="bg1 dz-move-down" src="assets/images/background/pic12.png" alt="/">
            <img class="bg2 dz-move-down" src="assets/images/background/pic14.png" alt="/">
        </section>
        <!-- Our Menu-->

    </div>
    <!--Footer-->
    <footer class="site-footer style-1 bg-dark" id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="widget widget_getintuch">
                            <h5 class="footer-title">Address</h5>
                            <ul>
                                <li>
                                    <i class="flaticon-placeholder"></i>
                                    <p><?php echo $fetch_contact_data[0]['address'];?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-2 col-md-6 col-sm-6">
                        <div class="widget widget_getintuch">
                            <h5 class="footer-title">Email</h5>
                            <ul>
                                <li>
                                    <i class="flaticon-email"></i>
                                    <p><?php echo $fetch_contact_data[0]['email_one'];?> <br>
                                        <?php echo $fetch_contact_data[0]['email_two'];?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="widget widget_getintuch">
                            <h5 class="footer-title">Call Us</h5>
                            <ul>
                                <li>
                                    <i class="flaticon-phone-call"></i>
                                    <p><?php echo $fetch_contact_data[0]['contact_number_one'];?> <br>
                                        <?php echo $fetch_contact_data[0]['contact_number_two'];?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6	">
                        <div class="widget widget_getintuch">
                            <h5 class="footer-title">Visit Us</h5>
                            <div class="dz-social-icon">
                                <ul>
                                    <li><a target="_blank" class="fab fa-facebook-f"
                                           href="<?php echo $fetch_contact_data[0]['facebook'];?>"></a></li>
                                    <li><a target="_blank" class="fab fa-instagram"
                                           href="<?php echo $fetch_contact_data[0]['insta'];?>"></a></li>
                                    <li><a target="_blank" class="fab fa-youtube" href="<?php echo $fetch_contact_data[0]['youtube'];?>"></a></li>
                                    <li><a target="_blank" class="fa fa-globe" href="<?php echo $fetch_contact_data[0]['website'];?>"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom Part -->
        <div class="container">
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-xl-6 col-md-6 text-md-start">
                        <p>Copyright <span id="currentYear">2018</span> All rights reserved.</p>
                    </div>
                    <div class="col-xl-6 col-md-6 text-md-end">
                        <span class="copyright-text">Developed By <a
                                    href="https://frogbid.com/" target="_blank">FrogBID</a></span>
                    </div>
                </div>
            </div>
        </div>
        <img class="bg1 dz-move" src="assets/images/background/pic5.png" alt="/">
        <img class="bg2 dz-move" src="assets/images/background/pic6.png" alt="/">
    </footer>
    <!--Footer-->

    <div class="scroltop-progress scroltop-primary">
        <svg width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
        </svg>
    </div>

</div>
<!-- JAVASCRIPT FILES ========================================= -->
<script src="assets/js/jquery.min.js"></script><!-- JQUERY.MIN JS -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="assets/vendor/bootstrap-select/js/bootstrap-select.min.js"></script><!-- BOOTSTRAP SELEECT -->
<script src="assets/vendor/magnific-popup/magnific-popup.js"></script><!-- MAGNIFIC POPUP JS -->
<script src="assets/vendor/counter/waypoints-min.js"></script><!-- WAYPOINTS JS -->
<script src="assets/vendor/counter/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script><!-- OWL-CAROUSEL -->
<script src="assets/js/dz.carousel.min.js"></script><!-- OWL-CAROUSEL -->
<script src="assets/js/dz.ajax.js"></script><!-- AJAX -->
<script src="assets/js/custom.min.js"></script><!-- CUSTOM JS -->
<script src="assets/js/dznav-init.js"></script><!-- DZNAV INIT -->
<script src="assets/vendor/rangeslider/rangeslider.js"></script><!-- CUSTOM JS -->

<script>
    // JavaScript to get the current year and update the content
    function displayCurrentYear() {
        // Get the current year
        var currentYear = new Date().getFullYear();

        // Find the element by ID and update its content
        document.getElementById('currentYear').textContent = currentYear;
    }

    // Ensure the function runs after the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        displayCurrentYear();
    });
</script>
</body>

</html>