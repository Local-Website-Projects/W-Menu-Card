<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-C1Z97B3DEK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-C1Z97B3DEK');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menusz - Find Restaurant Menu Online</title>
    <meta name="description" content="Welcome to Menusz – your ultimate destination for exploring and showcasing restaurant menus online!">
    <meta name="keywords" content="Menusz, Restaurant menus online, View restaurant menu, Restaurant menus khulna, Online menu with prices, Restaurant menu photos, Local restaurant menus, QR code menu search">
    <link rel="icon" href="assets_home/img/logo-anex-2.png">
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="assets_home/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets_home/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets_home/css/owl.theme.default.min.css">
    <!-- fancybox -->
    <link rel="stylesheet" href="assets_home/css/jquery.fancybox.min.css">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="assets_home/css/fontawesome.min.css">
    <!-- style -->
    <link rel="stylesheet" href="assets_home/css/style.css">
    <!-- responsive -->
    <link rel="stylesheet" href="assets_home/css/responsive.css">
    <!-- color -->
    <link rel="stylesheet" href="assets_home/css/color.css">
    <style>
        .autocomplete-container {
            position: relative;
            width: 100%;
        }

        .suggestions-list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: white;
            border-top: none;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            list-style: none;
            padding: 0;
            margin: 0;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 20px;
        }

        .suggestions-list li {
            padding: 10px;
            cursor: pointer;
            transition: background 0.2s ease;
            text-align: left; /* Align text to the left */
        }

        .suggestions-list li:hover {
            background-color: #f0f0f0;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            height: 80%;
            max-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        #reader {
            width: 100%;
        }
    </style>
</head>
<body>

<!-- preloader -->
<div class="preloader">
    <span class="loader"> </span>
</div>
<!-- preloader end -->


<!-- header -->
<header id="stickyHeader">
    <div class="container">
        <div class="top-bar">
            <div class="logo">
                <a href="#">
                    <img alt="logo" style="max-width: 180px" src="assets_home/img/logo1.png">
                </a>
            </div>
            <div class="login">
                <a href="#">Search</a>
                <a class="btn" onclick="openModal()"><span>Search with QR</span></a>
            </div>
        </div>
    </div>
</header>
<!-- header end -->
<!-- Hero Section -->
<section id="home" class="hero-section subscribe-with">
    <div class="container">
        <div class="row">
            <!-- Modal -->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div id="reader"></div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="hero-text">
                    <h1>Easy Way to Find Restaurant's Menu: Near You</h1>
                </div>
                <div class="subscribe-text mt-5">
                    <p>Search Restaurant</p>
                    <form class="get-subscribee" id="subscribe-form" method="post" action="Restaurant">
                        <div class="autocomplete-container" style="position: relative; display: flex; border: 1px solid #ccc; border-radius: 4px; overflow: hidden; max-width: 400px;">
                            <!-- Dropdown -->
                            <select id="category-select" required style="border: none; padding: 10px; width: 40%; outline: none;">
                                <option value="" disabled selected>Location</option>
                                <?php
                                $fetch_location = $db_handle->runQuery("select * from locations");
                                $fetch_location_no = $db_handle->numRows("select * from locations");
                                for($i=0; $i<$fetch_location_no; $i++){
                                    ?>
                                    <option value="<?php echo $fetch_location[$i]['location_id'];?>"><?php echo $fetch_location[$i]['location_name'];?></option>
                                    <?php
                                }
                                ?>
                            </select>

                            <!-- Input field -->
                            <input type="text" id="email-input" name="restaurant_name"
                                   placeholder="Enter Restaurant Name" autocomplete="off" required disabled
                                   style="border: none; padding: 10px; width: 60%; outline: none;">
                        </div>

                        <ul id="suggestions" class="suggestions-list"></ul>

                        <button type="submit" name="search_restaurant" class="btn" style="margin-top: 10px; z-index: 0;">Find Menu</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <img alt="img" class="shaps-dots" src="assets_home/img/shaps-dots.png">
</section>
<!-- Hero Section end -->

<!-- About -->
<section id="about" class="unlimited-design no-bottom gap"
         style="background-image: url(assets_home/img/background_1.png);">
    <div class="container">
        <div class="heading">
            <h2>Make Your Menu Online and Easy to <span>Find with Us</span></h2>
        </div>
        <div class="row background-color">
            <div class="offset-lg-1 col-lg-10">
                <img class="position-relative" src="assets_home/img/next-level.jpg" alt="img">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="count-style">
                            <div class="count-text">
                                <h3 data-max="50"><sub>+</sub></h3>
                                <span>Total Restaurants</span>
                            </div>
                            <img src="assets_home/img/certification-1.png" alt="certification-1">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="count-style">
                            <div class="count-text">
                                <h3 data-max="1"><sub>k+</sub></h3>
                                <span>Daily Visitors</span>
                            </div>
                            <img src="assets_home/img/project-management-1.png" alt="certification-1">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="count-style">
                            <div class="count-text">
                                <h3 data-max="10"></h3>
                                <span>Total Country</span>
                            </div>
                            <img src="assets_home/img/bad-review-1.png" alt="certification-1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img alt="img" class="shaps-line" src="assets_home/img/shaps-dots.png">
    <img alt="img" class="shaps-dots" src="assets_home/img/shaps-dots.png">
</section>
<!-- About end -->


<!-- Provide -->
<section class="gap no-top provide">
    <div class="container">
        <div class="container gap no-bottom">
            <div class="recommended">
                <h5>Restaurants registered with us.</h5>
            </div>
            <div class="clients-slider owl-carousel">
                <div class="item">
                    <img alt="clients" src="assets_home/img/clients-1.png">
                </div>
                <div class="item">
                    <img alt="clients" src="assets_home/img/clients-2.png">
                </div>
                <div class="item">
                    <img alt="clients" src="assets_home/img/clients-3.png">
                </div>
                <div class="item">
                    <img alt="clients" src="assets_home/img/clients-4.png">
                </div>
                <div class="item">
                    <img alt="clients" src="assets_home/img/clients-5.png">
                </div>
                <div class="item">
                    <img alt="clients" src="assets_home/img/clients-1.png">
                </div>
                <div class="item">
                    <img alt="clients" src="assets_home/img/clients-2.png">
                </div>
                <div class="item">
                    <img alt="clients" src="assets_home/img/clients-3.png">
                </div>
                <div class="item">
                    <img alt="clients" src="assets_home/img/clients-4.png">
                </div>
                <div class="item">
                    <img alt="clients" src="assets_home/img/clients-5.png">
                </div>
                <div class="item">
                    <img alt="clients" src="assets_home/img/clients-6.png">
                </div>
                <div class="item">
                    <img alt="clients" src="assets_home/img/clients-7.png">
                </div>
            </div>
        </div>
    </div>
    <img alt="img" class="shaps-dots" src="assets_home/img/shaps-dots.png">
</section>
<!-- Provide end -->


<!-- Footer -->
<footer class="footer" style="background-image: url(assets_home/img/footer.jpg);">
    <div class="container">
        <div class="heading">
            <h2>Want to register <span>Your Restaurant</span> with us?</h2>
            <p>Fell Free to leave us a message</p>
            <a href="https://wa.me/8801729277765" target="_blank" class="btn">Contact Us</a>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="address">
                    <i>
                        <svg width="47" height="50" viewBox="0 0 47 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_17_753" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="-4" y="0"
                                  width="51" height="50">
                                <path d="M-3.3158 0.10495H46.4211V49.8418H-3.3158V0.10495Z" fill="white"/>
                            </mask>
                            <g mask="url(#mask0_17_753)">
                                <path d="M36.5038 43.0766C36.5038 46.2763 33.9101 48.8701 30.7102 48.8701H24.4349C22.2404 48.8701 20.2344 47.6306 19.2533 45.6673L17.9574 43.0766L15.0606 48.8701L12.1637 43.0766L9.26706 48.8701L6.37028 43.0766L3.4734 48.8701L0.576715 43.0766L-2.32007 48.8701"
                                      stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M22.5484 25.9446C22.5484 26.481 22.1134 26.916 21.577 26.916C21.0405 26.916 20.6055 26.481 20.6055 25.9446C20.6055 25.4082 21.0405 24.9732 21.577 24.9732C22.1134 24.9732 22.5484 25.4082 22.5484 25.9446Z"
                                      fill="black"/>
                                <path d="M18.5355 22.8072C17.3528 21.4293 16.2909 20.0241 15.4209 18.6625C14.7041 17.5415 14.9208 16.0562 15.8621 15.1147L19.1319 11.845C19.8352 11.1417 19.8352 10.0013 19.1319 9.29796L11.4372 1.60332C10.7338 0.900013 9.59338 0.900013 8.8891 1.60332L6.94236 3.55103C3.78242 6.71107 2.92747 11.5322 4.91122 15.5374C8.44137 22.6628 16.8694 34.7502 30.8627 41.6114C34.8785 43.5804 39.792 42.745 42.955 39.583L44.9465 37.5916C45.6497 36.8873 45.6497 35.7469 44.9465 35.0436L37.1838 27.3499C36.4795 26.6456 35.3391 26.6456 34.6357 27.3499L31.3659 30.6188C30.4255 31.5601 28.9402 31.7767 27.8183 31.0598C26.8289 30.4278 25.8162 29.6942 24.8075 28.8862"
                                      stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </g>
                        </svg>
                    </i>
                    <div>
                        <h3>phone:</h3>
                        <p>Business:<a href="callto:+8801729277765">+880 1729 277 765</a></p>
                        <p>Support:<a href="callto:+8801729277768">+880 1729 277 768</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="address location">
                    <div><i>
                            <svg width="55" height="55" viewBox="0 0 55 55" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_17_805" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0"
                                      y="0" width="55" height="55">
                                    <path d="M0 -7.62939e-06H55V55H0V-7.62939e-06Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask0_17_805)">
                                    <path d="M11.3867 53.9258H43.6133" stroke="black" stroke-width="2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M27.5 29.0039C22.7616 29.0039 18.9062 25.1485 18.9062 20.4102C18.9062 15.6718 22.7616 11.8164 27.5 11.8164C32.2384 11.8164 36.0938 15.6718 36.0938 20.4102C36.0938 25.1485 32.2384 29.0039 27.5 29.0039Z"
                                          stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                    <path d="M38.2422 40.3906C38.2422 40.9839 37.7612 41.4648 37.168 41.4648C36.5748 41.4648 36.0938 40.9839 36.0938 40.3906C36.0938 39.7973 36.5748 39.3164 37.168 39.3164C37.7612 39.3164 38.2422 39.7973 38.2422 40.3906Z"
                                          fill="black"/>
                                    <path d="M34.3065 44.2846L27.5001 53.9258L12.0216 32.001C9.59928 28.7709 8.16412 24.7586 8.16412 20.4101C8.16412 9.73134 16.8213 1.07421 27.5001 1.07421C38.1789 1.07421 46.836 9.73134 46.836 20.4101C46.836 24.7586 45.4007 28.7709 42.9785 32.001L39.8795 36.3907"
                                          stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </g>
                            </svg>
                        </i></div>
                    <div>
                        <h3>Address</h3>
                        <p>16 KDA Avenue, Moylapota<br> Khulna 9100</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="address email">
                    <div><i>
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_17_765)">
                                    <path d="M45.5384 8H2.46159C1.10766 8 0 9.10766 0 10.4615V37.5385C0 38.8922 1.10766 40.0001 2.46159 40.0001H45.5385C46.8923 40.0001 48.0001 38.8924 48.0001 37.5385V10.4615C48 9.10766 46.8923 8 45.5384 8ZM44.6147 9.84603L25.416 24.2462C25.0708 24.5089 24.5409 24.6732 23.9999 24.6708C23.459 24.6732 22.9292 24.5089 22.5839 24.2462L3.38522 9.84603H44.6147ZM34.3594 25.1964L44.8209 38.1195C44.8314 38.1325 44.8443 38.1423 44.8554 38.154H3.14456C3.15562 38.1418 3.16856 38.1325 3.17906 38.1195L13.6406 25.1964C13.9612 24.8001 13.9004 24.2191 13.5034 23.8978C13.1071 23.5773 12.5261 23.6381 12.2055 24.0344L1.84612 36.8314V10.9999L21.4768 25.723C22.2147 26.2725 23.1125 26.5144 23.9998 26.5168C24.8859 26.515 25.7844 26.2731 26.5228 25.723L46.1535 10.9999V36.8312L35.7944 24.0344C35.4738 23.6382 34.8923 23.5772 34.4965 23.8978C34.0996 24.2184 34.0387 24.8001 34.3594 25.1964Z"
                                          fill="black"/>
                                </g>
                            </svg>
                        </i></div>
                    <div>
                        <h3>Email:</h3>
                        <a href="mailto:info@domainname.com">business@menusz.com</a>
                        <a href="mailto:business@domain.com">support@menusz.com</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row copyright">
            <div class="col-12 text-center">
                <!--<a href="#"><img src="assets_home/img/logo-w.png" alt="logo" style="max-width: 180px"></a>-->
                <p>© <?php echo date("Y"); ?> Menusz. All Rights Reserved | Developed with <a href="https://frogbid.com/" target="_blank" style="color: #108A00;">FrogBID</a></p>
                <!--<ul class="social-icon">
                    <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                </ul>-->
            </div>
        </div>
    </div>
</footer>
<!-- Footer end -->

<!-- Progress -->
<div id="progress">
    <span id="progress-value"><i class="fa-solid fa-arrow-up"></i></span>
</div>

<script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>

<script>
    // Enable input field after dropdown is selected
    document.getElementById('category-select').addEventListener('change', function () {
        document.getElementById('email-input').disabled = false;
        document.getElementById('email-input').focus();
    });
</script>
<script>
    let html5QrCode;

    function openModal() {
        const modal = document.getElementById('myModal');
        modal.style.display = "block";
        startScan();
    }

    function closeModal() {
        const modal = document.getElementById('myModal');
        modal.style.display = "none";
        stopScan();
    }

    function startScan() {
        html5QrCode = new Html5Qrcode("reader");

        Html5Qrcode.getCameras().then(cameras => {
            if (cameras && cameras.length) {
                // Try to find the back camera
                let backCamera = cameras.find(camera => camera.label.toLowerCase().includes('back') || camera.label.toLowerCase().includes('rear'));
                const cameraId = backCamera ? backCamera.id : cameras[0].id;

                html5QrCode.start(
                    cameraId,
                    {
                        fps: 10,
                        qrbox: {width: 250, height: 250}
                    },
                    qrCodeMessage => {
                        if (isValidUrl(qrCodeMessage)) {
                            window.location.href = qrCodeMessage;
                        } else {
                            alert(`QR Code detected: ${qrCodeMessage}`);
                        }
                        stopScan();
                    },
                    errorMessage => {
                        console.warn("QR Code scan failed.", errorMessage);
                    })
                    .catch(err => {
                        console.error("Failed to start QR Code scanning.", err);
                    });
            } else {
                alert("No cameras found. Please ensure your device has a camera and that it is working properly.");
            }
        }).catch(err => {
            console.error("Error in getting cameras.", err);
            alert("Error in accessing camera: " + (err.message || err));
        });
    }

    function stopScan() {
        if (html5QrCode) {
            html5QrCode.stop().then(ignore => {
                // QR Code scanning is stopped.
            }).catch(err => {
                console.error("Failed to stop QR Code scanning.", err);
            });
        }
    }

    // Function to validate URL
    function isValidUrl(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    }

    // Close the modal when the user clicks on <span> (x)
    document.getElementsByClassName('close')[0].onclick = function () {
        closeModal();
    }

    // Close the modal when the user clicks anywhere outside of the modal
    window.onclick = function (event) {
        const modal = document.getElementById('myModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>

<!-- jQuery -->
<script src="assets_home/js/jquery-3.6.0.min.js"></script>
<!-- Bootstrap Js -->
<script src="assets_home/js/bootstrap.min.js"></script>
<script src="assets_home/js/owl.carousel.min.js"></script>
<!-- fancybox -->
<script src="assets_home/js/jquery.fancybox.min.js"></script>
<script src="assets_home/js/custom.js"></script>
<!-- Email Js -->
<script src="assets_home/js/sweetalert.min.js"></script>
<script src="assets_home/js/contact.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('email-input');
        const suggestionsList = document.getElementById('suggestions');

        input.addEventListener('input', function () {
            const value = input.value.trim().toLowerCase();

            if (value.length > 0) {
                fetchSuggestions(value);
            } else {
                suggestionsList.innerHTML = '';
                suggestionsList.style.display = 'none';
            }
        });

        suggestionsList.addEventListener('click', function (e) {
            if (e.target.tagName === 'LI') {
                input.value = e.target.textContent;
                suggestionsList.innerHTML = '';
                suggestionsList.style.display = 'none';
            }
        });

        async function fetchSuggestions(query) {
            const locationSelect = document.getElementById('category-select');
            const locationId = locationSelect.value;

            if (!locationId) return; // prevent fetch if location is not selected

            try {
                const response = await fetch(`fetch-suggestions.php?query=${encodeURIComponent(query)}&location_id=${encodeURIComponent(locationId)}`);

                if (response.ok) {
                    const suggestions = await response.json();
                    suggestionsList.innerHTML = '';

                    if (suggestions.length > 0) {
                        suggestions.forEach(suggestion => {
                            const li = document.createElement('li');
                            li.textContent = suggestion;
                            suggestionsList.appendChild(li);
                        });
                        suggestionsList.style.display = 'block';
                    } else {
                        suggestionsList.style.display = 'none';
                    }
                } else {
                    console.error('Failed to fetch suggestions:', response.statusText);
                }
            } catch (error) {
                console.error('Error fetching suggestions:', error);
            }
        }

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.autocomplete-container')) {
                suggestionsList.innerHTML = '';
                suggestionsList.style.display = 'none';
            }
        });
    });

</script>
</body>
