<?php
   require_once 'includes/config_session.inc.php';
   require_once 'includes/login/login_view.inc.php';

   //session_start(); // Make sure the session is started

   // Check if the user is logged in
   $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>keto</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- bootstrap css -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <!-- style css -->
   <link rel="stylesheet" href="css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- fevicon -->
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
   <!-- Tweaks for older IEs-->
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
      media="screen">
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
   <!-- loader  -->
   <div class="loader_bg">
      <div class="loader"><img src="images/loading.gif" alt="#" /></div>
   </div>
   <!-- end loader -->
   <!-- header -->
   <header>
      <!-- header inner -->
      <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                  <div class="full">
                     <div class="center-desk">
                        <div class="logo">
                           <a href="main_page.php"><img src="images/logo.png" alt="#" /></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                  <!-- Navigation Bar -->
                  <nav class="navigation navbar navbar-expand-md navbar-dark">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
                        aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto d-flex align-items-center">
                           <li class="nav-item active">
                              <a class="nav-link" href="main_page.php">Home</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="about.html">About</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="get_all_rooms.php">Our&nbsp;rooms</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="specialOffers.html">Special&nbsp;Offers</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="services.html">Services</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="contact.html">Contact&nbsp;Us</a>
                           </li>
                        </ul>
                        <ul class="navbar-nav ml-auto d-flex align-items-center">
                           <?php if (!empty($userId)): ?>
                              <li class="nav-item">
                                 <span class="navbar-text" style="color: #FFD700;">User ID: <?php echo htmlspecialchars($userId); ?></span> <!-- Change color here -->
                              </li>
                              <li class="nav-item">
                                 <form class="form-inline" action="includes/logout/logout.inc.php" method="post">
                                    <button class="btn btn-danger ml-2" type="submit">Logout</button>
                                 </form>
                              </li>
                           <?php endif; ?>
                        </ul>
                     </div>
                  </nav>


               </div>
            </div>
         </div>
      </div>
   </header>
   <!-- end header inner -->
   <!-- end header -->
   <!-- banner -->
   <section class="banner_main">
      <div id="myCarousel" class="carousel slide banner" data-ride="carousel">
         <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
         </ol>
         <div class="carousel-inner">
            <div class="carousel-item active">
               <img class="first-slide" src="images/banner1.jpg" alt="First slide">
               <div class="container">
               </div>
            </div>
            <div class="carousel-item">
               <img class="second-slide" src="images/banner2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
               <img class="third-slide" src="images/banner3.jpg" alt="Third slide">
            </div>
         </div>
         <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
         </a>
      </div>
      <div class="booking_ocline">
         <div class="container">
            <div class="row">
               <div class="col-md-5">
                  <div class="book_room">
                     <h1>Book a Room Online</h1>
                     <form class="book_now" action="includes/book_now/book_now.inc.php" method="post">
                        <div class="row">
                           <div class="col-md-12">
                              <label for="arrival">Arrival</label>
                              <img class="date_cua" src="images/date.png" alt="Date Icon">
                              <input id="arrival" class="online_book" type="date" name="arrival" required>
                           </div>
                           <div class="col-md-12">
                              <label for="departure">Departure</label>
                              <img class="date_cua" src="images/date.png" alt="Date Icon">
                              <input id="departure" class="online_book" type="date" name="departure" required>
                           </div>
                           <div class="col-md-12">
                              <button class="book_btn" type="submit">Book Now</button>
                           </div>
                           <div class="col-md-12">                              
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </section>
   <!-- end banner -->
   <!-- about -->
   <div class="about">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-5">
               <div class="titlepage">
                  <h2>About Us</h2>
                  <p>The passage experienced a surge in popularity during the 1960s when Letraset used it on their
                     dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their
                     software. Today it's seen all around the web; on templates, websites, and stock designs. Use our
                     generator to get your own, or read on for the authoritative history of lorem ipsum. </p>
                  <a class="read_more" href="Javascript:void(0)"> Read More</a>
               </div>
            </div>
            <div class="col-md-7">
               <div class="about_img">
                  <figure><img src="images/about.png" alt="#" /></figure>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end about -->
   <!-- our_room -->
   <div class="our_room">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Our Rooms</h2>
                  <p>Lorem Ipsum available, but the majority have suffered </p>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-4 col-sm-6">
               <div id="serv_hover" class="room">
                  <div class="room_img">
                     <figure><img src="images/room1.jpg" alt="#" /></figure>
                  </div>
                  <div class="bed_room">
                     <h3>Bed Room</h3>
                     <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there </p>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-sm-6">
               <div id="serv_hover" class="room">
                  <div class="room_img">
                     <figure><img src="images/room2.jpg" alt="#" /></figure>
                  </div>
                  <div class="bed_room">
                     <h3>Bed Room</h3>
                     <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there </p>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-sm-6">
               <div id="serv_hover" class="room">
                  <div class="room_img">
                     <figure><img src="images/room3.jpg" alt="#" /></figure>
                  </div>
                  <div class="bed_room">
                     <h3>Bed Room</h3>
                     <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there </p>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-sm-6">
               <div id="serv_hover" class="room">
                  <div class="room_img">
                     <figure><img src="images/room4.jpg" alt="#" /></figure>
                  </div>
                  <div class="bed_room">
                     <h3>Bed Room</h3>
                     <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there </p>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-sm-6">
               <div id="serv_hover" class="room">
                  <div class="room_img">
                     <figure><img src="images/room5.jpg" alt="#" /></figure>
                  </div>
                  <div class="bed_room">
                     <h3>Bed Room</h3>
                     <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there </p>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-sm-6">
               <div id="serv_hover" class="room">
                  <div class="room_img">
                     <figure><img src="images/room6.jpg" alt="#" /></figure>
                  </div>
                  <div class="bed_room">
                     <h3>Bed Room</h3>
                     <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end our_room -->
   <!-- Speacial Offers -->
   <div class="specialoffers">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Special Offers</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-3 col-sm-6">
               <div class="specialOffers_img">
                  <figure><img src="images/specialOffers1.jpg" alt="#" /></figure>
               </div>
            </div>
            <div class="col-md-3 col-sm-6">
               <div class="specialOffers_img">
                  <figure><img src="images/specialOffers2.jpg" alt="#" /></figure>
               </div>
            </div>
            <div class="col-md-3 col-sm-6">
               <div class="specialOffers_img">
                  <figure><img src="images/specialOffers3.jpg" alt="#" /></figure>
               </div>
            </div>
            <div class="col-md-3 col-sm-6">
               <div class="specialOffers_img">
                  <figure><img src="images/specialOffers4.jpg" alt="#" /></figure>
               </div>
            </div>
            <div class="col-md-3 col-sm-6">
               <div class="specialOffers_img">
                  <figure><img src="images/specialOffers5.jpg" alt="#" /></figure>
               </div>
            </div>
            <div class="col-md-3 col-sm-6">
               <div class="specialOffers_img">
                  <figure><img src="images/specialOffers6.jpg" alt="#" /></figure>
               </div>
            </div>
            <div class="col-md-3 col-sm-6">
               <div class="specialOffers_img">
                  <figure><img src="images/specialOffers7.jpg" alt="#" /></figure>
               </div>
            </div>
            <div class="col-md-3 col-sm-6">
               <div class="specialOffers_img">
                  <figure><img src="images/specialOffers8.jpg" alt="#" /></figure>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end specialOffers -->
   <!-- services -->
   <div class="services">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Services</h2>
                  <p>Lorem Ipsum available, but the majority have suffered </p>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-4">
               <div class="services_box">
                  <div class="services_img">
                     <figure><img src="images/services1.jpg" alt="#" /></figure>
                  </div>
                  <div class="services_room">
                     <h3>Bed Room</h3>
                     <span>The standard chunk </span>
                     <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything
                        embarrassing hidden in the middle of text. All the Lorem Ipsum generatorsIf you are </p>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="services_box">
                  <div class="services_img">
                     <figure><img src="images/services2.jpg" alt="#" /></figure>
                  </div>
                  <div class="services_room">
                     <h3>Bed Room</h3>
                     <span>The standard chunk </span>
                     <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything
                        embarrassing hidden in the middle of text. All the Lorem Ipsum generatorsIf you are </p>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="services_box">
                  <div class="services_img">
                     <figure><img src="images/services3.jpg" alt="#" /></figure>
                  </div>
                  <div class="services_room">
                     <h3>Bed Room</h3>
                     <span>The standard chunk </span>
                     <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything
                        embarrassing hidden in the middle of text. All the Lorem Ipsum generatorsIf you are </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end services -->
   <!--  contact -->
   <div class="contact">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Contact Us</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <form id="request" class="main_form">
                  <div class="row">
                     <div class="col-md-12 ">
                        <input class="contactus" placeholder="Name" type="type" name="Name">
                     </div>
                     <div class="col-md-12">
                        <input class="contactus" placeholder="Email" type="type" name="Email">
                     </div>
                     <div class="col-md-12">
                        <input class="contactus" placeholder="Phone Number" type="type" name="Phone Number">
                     </div>
                     <div class="col-md-12">
                        <textarea class="textarea" placeholder="Message" type="type" Message="Name">Message</textarea>
                     </div>
                     <div class="col-md-12">
                        <button class="send_btn">Send</button>
                     </div>
                  </div>
               </form>
            </div>
            <div class="col-md-6">
               <div class="map_main">
                  <div class="map-responsive">
                     <iframe
                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Eiffel+Tower+Paris+France"
                        width="600" height="400" frameborder="0" style="border:0; width: 100%;"
                        allowfullscreen=""></iframe>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end contact -->
   <!--  footer -->
   <footer>
      <div class="footer">
         <div class="container">
            <div class="row">
               <div class=" col-md-4">
                  <h3>Contact US</h3>
                  <ul class="conta">
                     <li><i class="fa fa-map-marker" aria-hidden="true"></i> Address</li>
                     <li><i class="fa fa-mobile" aria-hidden="true"></i> +01 1234569540</li>
                     <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="#"> demo@gmail.com</a></li>
                  </ul>
               </div>
               <div class="col-md-4">
                  <h3>Menu Link</h3>
                  <ul class="link_menu">
                     <li class="active"><a href="#">Home</a></li>
                     <li><a href="about.html"> about</a></li>
                     <li><a href="get_all_rooms.php">Our Rooms</a></li>
                     <li><a href="specialOffers.html">Special Offers</a></li>
                     <li><a href="services.html">Services</a></li>
                     <li><a href="contact.html">Contact Us</a></li>
                  </ul>
               </div>
               <div class="col-md-4">
                  <h3>News letter</h3>
                  <form class="bottom_form">
                     <input class="enter" placeholder="Enter your email" type="text" name="Enter your email">
                     <button class="sub_btn">subscribe</button>
                  </form>
                  <ul class="social_icon">
                     <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                     <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                     <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                     <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="copyright">
            <div class="container">
               <div class="row">
                  <div class="col-md-10 offset-md-1">

                     <p>
                        © 2019 All Rights Reserved. Design by <a href="https://html.design/"> Free Html Templates</a>
                        <br><br>
                        Distributed by <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
                     </p>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </footer>
   <!-- end footer -->
   <!-- Javascript files-->
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="js/jquery-3.0.0.min.js"></script>
   <!-- sidebar -->
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>
</body>

</html>