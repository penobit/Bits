<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> iLite PHP Framework by Penobit</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="/assets/themes/iLite/assets/img/favicon.ico">

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/slicknav.css">
  <link rel="stylesheet" href="assets/css/flaticon.css">
  <link rel="stylesheet" href="assets/css/progressbar_barfiller.css">
  <link rel="stylesheet" href="assets/css/gijgo.css">
  <link rel="stylesheet" href="assets/css/animate.min.css">
  <link rel="stylesheet" href="assets/css/animated-headline.css">
  <link rel="stylesheet" href="assets/css/magnific-popup.css">
  <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/themify-icons.css">
  <link rel="stylesheet" href="assets/css/slick.css">
  <link rel="stylesheet" href="assets/css/nice-select.css">
  <link rel="stylesheet" href="assets/fonts/fonts.css">
  <link rel="stylesheet" href="assets/css/style.scss">
</head>

<body>

  <div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
      <div class="preloader-inner position-relative">
        <div class="preloader-circle"></div>
        <div class="preloader-img pere-text">
          <img src="assets/img/logo/loder.png" alt="">
        </div>
      </div>
    </div>
  </div>

  <header>

    <div class="header-area header-transparent">
      <div class="main-header ">
        <div class="header-bottom  header-sticky">
          <div class="container-fluid">
            <div class="row align-items-center">

              <div class="col-xl-2 col-lg-2">
                <div class="logo">
                  <a href="<?php echo url(); ?>">
                    <img src="assets/img/logo/logo.png" alt="">
                  </a>
                </div>
              </div>
              <div class="col-xl-10 col-lg-10">
                <div class="menu-wrapper  d-flex align-items-center justify-content-end">

                  <div class="main-menu d-none d-lg-block">
                    <nav>
                      <ul id="navigation">
                        <li class="active">
                          <a href="<?php echo url(); ?>">Home</a>
                        </li>
                        <li>
                          <a href="<?= url('features');?>">Features</a>
                        </li>
                        <li>
                          <a href="about">About</a>
                        </li>
                        <li>
                          <a href="#">FAQ</a>
                        </li>
                        <li>
                          <a href="#">Blog</a>
                          <ul class="submenu">
                            <li>
                              <a href="#">Blog</a>
                            </li>
                            <li>
                              <a href="#">Blog Details</a>
                            </li>
                            <li>
                              <a href="#">Element</a>
                            </li>
                          </ul>
                        </li>
                        <li>
                          <a href="#">Contact</a>
                        </li>
                      </ul>
                    </nav>
                  </div>

                  <div class="header-right-btn d-none d-lg-block ml-65">
                    <a href="<?= url("login");?>" class="border-btn">Log in</a>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="mobile_menu d-block d-lg-none"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </header>