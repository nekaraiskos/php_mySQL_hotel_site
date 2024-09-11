<?php
// session_start(); // Start session to access session variables

require_once 'includes/admin_services/admin_services_view.inc.php';
require_once 'includes/dbh.inc.php';
// $user_id = $_SESSION["user_id"];
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

<body class="main-layout inner_page">
   <!-- loader  -->
   <div class="loader_bg">
      <div class="loader"><img src="images/loading.gif" alt="#" /></div>
   </div>
   <!-- end loader -->
   <!-- header -->
   <!-- header inner -->
   <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                  <div class="full">
                     <div class="center-desk">
                        <div class="logo">
                           <a href="admin_main_page.php"><img src="images/my_logo.png" alt="#" /></a>
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
                        <ul class="navbar-nav mr-auto">
                           <li class="nav-item">
                              <a class="nav-link" href="admin_main_page.php">Home</a>
                           </li>
                           <!-- <li class="nav-item">
                              <a class="nav-link" href="about.html">About</a>
                           </li> -->
                           <li class="nav-item">
                              <a class="nav-link" href="admin_room.php">Our&nbsp;rooms</a>
                           </li>
                           <li class="nav-item active">
                              <a class="nav-link" href="admin_services.php">Services</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="admin_special_offers.php">Special&nbsp;Offers</a>
                           </li>
                           
                           <!-- <li class="nav-item">
                              <a class="nav-link" href="contact.html">Contact&nbsp;Us</a>
                           </li> -->
                        </ul>
                        <form class="form-inline" action="includes/logout/logout.inc.php" method="post">
                           <button class="btn btn-danger ml-2" type="submit">Logout</button>
                        </form>
                     </div>
                  </nav>

               </div>
            </div>
         </div>
      </div>
   </header>
   <!-- end header inner -->
   <!-- end header -->
   <div class="back_re">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="title">
                  <h2>Services</h2>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="activity_services">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h1>Activities</h1>
               </div>
            </div>
         </div>
         <div class="row">
            <?php display_admin_activity_services($pdo) ?>
         </div>

         <!-- <div class="row" >
            <?php // output_activity_services()?>
         </div> -->

         <!-- Button to trigger the modal -->
         <!-- <div class="row"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addActivityServiceModal"> Add Activity Service</button></div> -->
         <div class="container">
         <div class="center">
         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addActivityServiceModal"> Add Activity Service</button>
         </div></div>

      <!-- Add Activity Service Modal -->
      <div class="modal fade" id="addActivityServiceModal" tabindex="-1" role="dialog" aria-labelledby="addActivityServiceModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="addActivityServiceModalLabel">Add Activity Service</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <form id="addActivityServiceForm" action="includes/admin_services/add_activity_service.inc.php" method="post" enctype="multipart/form-data" >
                     <div class="modal-body">
                        <div class="form-group">
                              <label for="serviceName">Service Name</label>
                              <input type="text" class="form-control" id="serviceName" name="serviceName" required>
                        </div>
                        <div class="form-group">
                              <label for="price">Price</label>
                              <input type="text" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                              <label for="availabilityHours">Availability Hours</label>
                              <input type="text" class="form-control" id="availabilityHours" name="availabilityHours" required>
                        </div>
                        <div class="form-group">
                              <label for="description">Description</label>
                              <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                              <label for="image">Image</label>
                              <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="form-group">
                              <label for="difficultyLevel">Difficulty Level</label>
                              <input type="text" class="form-control" id="difficultyLevel" name="difficultyLevel" required>
                        </div>
                        <div class="form-group">
                              <label for="minimumAge">Minimum Age</label>
                              <input type="number" class="form-control" id="minimumAge" name="minimumAge" required>
                        </div>
                        <div class="form-group">
                              <label for="duration">Duration (in hours)</label>
                              <input type="text" class="form-control" id="duration" name="duration" required>
                        </div>
                        <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="bookingRequired" name="bookingRequired">
                              <label class="form-check-label" for="bookingRequired">Booking Required</label>
                        </div>
                        <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="guideRequired" name="guideRequired">
                              <label class="form-check-label" for="guideRequired">Guide Required</label>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                     </div>
                  </form>
            </div>
         </div>
      </div>

      </div>

   <div>
   <div class="wellness_services">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h1>Wellness</h1>
               </div>
            </div>
            <div class = "row">
               <!-- display_admin_wellness_services($pdo) -->
                <?php display_admin_wellness_services($pdo) ?>
            </div>
         </div>

      <div class="container">
      <div class="center">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addWellnessServiceModal"> Add Wellness Service</button>
      </div></div>
         <!-- Add Wellness Service Modal -->
      <div class="modal fade" id="addWellnessServiceModal" tabindex="-1" role="dialog" aria-labelledby="addWellnessServiceModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="addWellnessServiceModalLabel">Add Wellness Service</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <form id="addWellnessServiceForm" action="includes/admin_services/add_wellness_service.inc.php" method="post" enctype="multipart/form-data">
                     <div class="modal-body">
                        <!-- Service Table Fields -->
                        <div class="form-group">
                              <label for="serviceName">Service Name</label>
                              <input type="text" class="form-control" id="serviceName" name="serviceName" required>
                        </div>
                        <div class="form-group">
                              <label for="price">Price</label>
                              <input type="text" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                              <label for="availabilityHours">Availability Hours</label>
                              <input type="text" class="form-control" id="availabilityHours" name="availabilityHours" required>
                        </div>
                        <div class="form-group">
                              <label for="description">Description</label>
                              <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                              <label for="image">Image</label>
                              <input type="file" class="form-control" id="image" name="image" required>
                        </div>

                        <!-- Wellness Table Fields -->
                        <div class="form-group">
                              <label for="roomType">Room Type</label>
                              <input type="text" class="form-control" id="roomType" name="roomType" required>
                        </div>
                        <!-- <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="therapistRequired" name="therapistRequired">
                              <label class="form-check-label" for="therapistRequired">Therapist Required</label>
                        </div> -->
                        <div class="form-group">
                              <label for="treatmentType">Treatment Type</label>
                              <input type="text" class="form-control" id="treatmentType" name="treatmentType" required>
                        </div>
                        <div class="form-group">
                              <label for="duration">Duration (in hours)</label>
                              <input type="text" class="form-control" id="duration" name="duration" required>
                        </div>

                        <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="therapistRequired" name="therapistRequired">
                              <label class="form-check-label" for="therapistRequired">Therapist Required</label>
                        </div>
                        <!-- Common Field -->
                        <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="bookingRequired" name="bookingRequired">
                              <label class="form-check-label" for="bookingRequired">Booking Required</label>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                     </div>
                  </form>
            </div>
         </div>
      </div>

   </div>
   </div>

   <div class="culinary_services">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h1>Culinary Experiences</h1>
            </div>
         </div>
      </div>
      <div class="row">
         <?php display_admin_culinary_services($pdo); ?>
      </div>

      <!-- Button to trigger the modal -->
      <div class="container">
      <div class="center">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCulinaryServiceModal"> Add Culinary Experience</button>
      </div></div>
      <!-- Add Culinary Service Modal -->
      <div class="modal fade" id="addCulinaryServiceModal" tabindex="-1" role="dialog" aria-labelledby="addCulinaryServiceModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="addCulinaryServiceModalLabel">Add Culinary Experience</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <form id="addCulinaryServiceForm" action="includes/admin_services/add_culinary_service.inc.php" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                     <div class="form-group">
                        <label for="serviceName">Service Name</label>
                        <input type="text" class="form-control" id="serviceName" name="serviceName" required>
                     </div>
                     <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price" required>
                     </div>
                     <div class="form-group">
                        <label for="availabilityHours">Availability Hours</label>
                        <input type="text" class="form-control" id="availabilityHours" name="availabilityHours" required>
                     </div>
                     <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                     </div>
                     <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                     </div>
                     <div class="form-group">
                        <label for="mealType">Meal Type</label>
                        <input type="text" class="form-control" id="mealType" name="mealType" required>
                     </div>
                     <!-- <div class="form-group">
                        <label for="specialDietary">Special Dietary</label>
                        <input type="text" class="form-control" id="specialDietary" name="specialDietary" required>
                     </div> -->
                     <div class="form-group">
                        <label for="menuOptions">Menu Options</label>
                        <input type="text" class="form-control" id="menuOptions" name="menuOptions" required>
                     </div>
                     <div class="form-group">
                        <label for="dressCode">Dress Code</label>
                        <input type="text" class="form-control" id="dressCode" name="dressCode" required>
                     </div>
                     <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="bookingRequired" name="bookingRequired">
                        <label class="form-check-label" for="bookingRequired">Booking Required</label>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Save</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>




   <!-- services -->
   <!-- <div class="services" style="background: url('images/Activities.jfif') no-repeat; background-size: 100% 100%;">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <p class="margin_0" style="color: #333; font-size: 24px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                     Activities
                  </p>
               </div>
            </div>
         </div>
         <div class="row">
            <?php //output_activity_services();?>            
         </div>
      </div> 
       Extra space with "See more" button -->
      <!-- <div style="text-align: right; margin-right: 20px;">
         <a href="includes/services/services.inc.php?services=Activities" class="btn btn-primary" style="padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none;">
            See more
         </a>
      </div>     
   </div> -->
   <!-- end services -->

   <!-- services -->
   <!-- <div class="services" style="background: url('images/wellness.jpg') no-repeat; background-size: 100% 100%;">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <p class="margin_0" style="color: #333; font-size: 24px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                     Wellness
                  </p>
               </div>
            </div>
         </div>
         <div class="row">
            <?php //output_wellness_services(); ?>
         </div>
      </div>
       Extra space with "See more" button -->
      <!-- <div style="text-align: right; margin-right: 20px;">
         <a href="includes/services/services.inc.php?services=Wellness" class="btn btn-primary" style="padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none;">
            See more
         </a>
      </div>   
   </div> -->
   <!-- end services -->

   <!-- services -->
   <!-- <div class="services" style="background: url('images/CulinaryExperiences.jpg') no-repeat; background-size: 100% 100%;">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <p class="margin_0" style="font-size: 24px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                     Culinary Experiences
                  </p>
               </div>
            </div>
         </div>
         <div class="row">
            <?php //output_culinary_services(); ?>
         </div>
      </div>
         Extra space with "See more" button -->
         <!-- <div style="text-align: right; margin-right: 20px;">
            <a href="includes/services/services.inc.php?services=Culinary" class="btn btn-primary" style="padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none;">
               See more
            </a>
         </div>   
   </div> -->
   <!-- end services -->

   <!--  footer -->
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
                     <!-- <li><a href="about.html"> about</a></li> -->
                     <li><a href="admin_room.php">Our Rooms</a></li>
                     <li><a href="admin_services.php">Services</a></li>
                     <li><a href="admin_special_offers.html">Special Offers</a></li>
                     <!-- <li><a href="admin_services.php">Services</a></li> -->
                     <!-- <li><a href="contact.html">Contact Us</a></li> -->
                  </ul>
               <!-- </div> -->
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
