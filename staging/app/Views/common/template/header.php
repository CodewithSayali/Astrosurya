<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <title>Astro surya</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
        <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/style1.css" />
<!--        <link rel="stylesheet" type="text/css" href="<?//= base_url(); ?>/assets/css/toastr.css" />-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<!--        <script src="<?= base_url(); ?>/assets/js/toastr.js" type="text/javascript"></script>-->
        <script src="<?= base_url(); ?>/assets/js/form_validation.js"></script>
    </head>

    <body>
        <div class="menu-sec " id="masthead">
            <div class="main-menu">
                <div class="container">
                    <div class="top-menu">
                        <div class="logo-sec">
                            <div class="logo">
                                <a href="<?= base_url('/') ?>"><img src="assets/image/menu-logo.png"></a>
                            </div>
                            <div class="home-menu">
                                <div class="home-icon">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                </div>
                                <div class="reach">
                                    <p>Reach Us</p>
                                    <p>Mumbai, India</p>
                                </div>
                            </div>
                            <div class="home-menu">
                                <div class="home-icon">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </div>
                                <div class="reach">
                                    <p>Talk to Astrologers</p>
                                    <a href="tel:8767377034">8767377034</a> <a href="tel:8828332980">/ 8828332980</a>
                                </div>
                            </div>
                            <div class="home-menu">
                                <div class="home-icon">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </div>
                                <div class="reach mail">
                                    <li><a href="mailto:support@astrosurya.in">support@astrosurya.in</a></li>
                                    <li><a href="mailto:info@astrosurya.in">info@astrosurya.in</a></li>
                                </div>
                            </div>
                        </div>
                        <div class="login-sec">
                            <div class="search-but">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </div>
                            <div class="login-but">
                                <?php 
                                 $session = session();
                                //echo "session=".$session->get('user_id');?>
                                <?php if (session()->get('loggedIn') == true) { ?>
                                    <a href="<?= base_url('logout') ?>">LOGOUT</a>
                                <?php } else { ?>
                                    <a href="<?= base_url('login') ?>">LOGIN</a> /
                                    <a href="<?= base_url('register') ?>">REGISTER</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="topmb-menu" >
                        <div class="logo">
                            <a href="<?= base_url('/') ?>"><img src="assets/image/menu-logo.png"></a>
                        </div>

                        <div id="mySidenav" class="sidenav">
                            <div class="logo_ham">
                                <a href="<?= base_url('/') ?>"><img src="assets/image/logoham.png"></a>
                                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">Ã—</a>
                            </div>
                            <ul>
                                <li> <a href="<?= base_url('/') ?>">Home</a></li>
                                <li><a href="<?= base_url('service') ?>">Services</a></li>
                                <li> <a href="<?= base_url('about-us') ?>">About Us</a></li>
                                <li><a href="<?= base_url('western-astrology') ?>">Kundali</a></li>
                                <li> <a href="<?= base_url('contact-us') ?>">Personal Reports</a></li>
                                <li> <a href="<?= base_url('contact-us') ?>">Contact Us</a></li>
                            </ul>

                            <div class="login-mb">
                                <?php if (session()->get('loggedIn') == 'true') { ?>
                                    <a href="<?= base_url('logout') ?>">LOGOUT</a>
                                <?php } else { ?>
                                    <a href="<?= base_url('login') ?>">LOGIN</a>
                                    <a href="<?= base_url('register') ?>">REGISTER</a>
                                <?php } ?>
                            </div>
                        </div>

                        <span onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i></span>



                    </div>
                    <div class="menu-pages" id="masthead">
                        <ul class="menu">
                            <ul class="page-link">
                                <li <?php if ($current_page == 'index') {
                                    echo 'class="header-active"';
                                } ?>><a href="<?= base_url('/') ?>">Home</a></li>
                                <li <?php if ($current_page == 'service') {
                                    echo 'class="header-active"';
                                } ?>><a href="<?= base_url('service') ?>">Services</a></li>
           <!--                     <li <?php if ($current_page == '') {
                                    echo 'class="header-active"';
                                } ?>><a href="contactus">Vastu</a></li>-->
                                <li <?php if ($current_page == 'about-us') {
                                    echo 'class="header-active"';
                                } ?>><a href="<?= base_url('about-us') ?>">About Us</a></li>
                                <li <?php if ($current_page == 'western-astrology') {
                                    echo 'class="header-active"';
                                } ?>><a href="<?= base_url('western-astrology') ?>">Kundali</a></li>
                                <li <?php if ($current_page == '') {
                                    echo 'class="header-active"';
                                } ?>><a href="<?= base_url('contact-us') ?>">Personal Reports</a></li>
                                <li <?php if ($current_page == 'contactus') {
                                    echo 'class="header-active"';
                                } ?>><a href="<?= base_url('contact-us') ?>">Contact Us</a></li>
                                <!--<li <?php if ($current_page == 'numerology') {
                                    echo 'class="header-active"';
                                } ?>><a href="numerology">Lucky Number</a></li>-->
                                <!--<li <?php if ($current_page == '') {
                                    echo 'class="header-active"';
                                } ?>><a href="contactus">Gem Stone</a></li>-->
                                <!--<li <?php if ($current_page == '') {
                                    echo 'class="header-active"';
                                } ?>><a href="contactus">Career</a></li>-->
                                <!--<li <?php if ($current_page == '') {
                                    echo 'class="header-active"';
                                } ?>><a href="contactus">Astrologer</a></li>-->
                            </ul>
                            <ul class="soc-link">
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.facebook.com/Astro-Surya-100148684922725"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCkLOHwUE4cwnQZiDHYt21TQ"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                            <ul class="card">
                                <li><a href="#"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a></li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>