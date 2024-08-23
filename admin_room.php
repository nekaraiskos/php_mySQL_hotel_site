<?php 
// require_once 'C:/xampp/htdocs/21_8/includes/add_room/add_room_view.inc.php';
// require_once 'C:/xampp/htdocs/21_8/includes/dbh.inc.php';
   require_once 'includes/dbh.inc.php';
   require_once 'includes/add_room/add_room_view.inc.php';
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
                           <a href="admin_main_page.html"><img src="images/logo.png" alt="#" /></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                  <nav class="navigation navbar navbar-expand-md navbar-dark ">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
                        aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto">
                           <li class="nav-item ">
                              <a class="nav-link" href="admin_main_page.html">Home</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="about.html">About</a>
                           </li>
                           <li class="nav-item active">
                              <a class="nav-link" href="admin_room.php">Our room</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="specialOffers.html">Special Offers</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="blog.html">Blog</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="contact.html">Contact Us</a>
                           </li>
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
   <div class="back_re">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="title">
                  <h2>Our Room</h2>
               </div>
            </div>
         </div>
      </div>
   </div>





   <!-- our_room -->
<div class="our_room">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<div class="titlepage">
				<p class="margin_0">Lorem Ipsum available, but the majority have suffered </p>
			</div>
			</div>
		</div>
		<!-- <button id="addRoomBtn" class="btn btn-success">Add New Room</button> -->
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
		</div>  

      <?php 
         // require_once 'includes/add_room/add_room_view.inc.php';
         // require_once 'includes/dbh.inc.php';
         display_admin_rooms($pdo);
      ?>

		<!-- Trigger Button to Open Add Room form -->
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRoomModal">Add New Room</button>
  <!-- Modal Structure -->
   <div class="modal fade" id="addRoomModal" tabindex="-1">
<!-- </div> aria-labelledby="addRoomModalLabel" aria-hidden="true"> -->
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="addRoomModalLabel"> Add New Room</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
            </div>
            <!-- ADD ROOM POPUP MENU-->
            <div class="modal-body">
               <?php 
               //    if (isset($_SESSION['error_message'])) {
               //       echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
               //       unset($_SESSION['error_message']); // Clear the message after displaying it
               //   }
               ?>
               <form action="includes/add_room/add_room.inc.php" method="post" enctype="multipart/form-data">
               <!-- </form>enctype="multipart/form-data"> -->
                  <div class="form-group">
                     <label for="RoomName" class="form-label">Room Name </label>
                     <input type="text" id="RoomName" name="room_name" class="form-control">
                  </div>
                  <div class="form-group">
                     <label for="PricePerNight" class="form-label">Price Per Night</label>
                     <input type="number" id="PricePerNight" name="price_per_night" class="form-control">
                  </div>
                  <div class="form-group">
                     <label for="NumOfBeds" class="form-label">Number of Beds</label>
                     <input type="number" id="NumOfBeds" name="num_of_beds" class="form-control">
                  </div>
                  <!-- <div class="form-group">
                     <label for="RoomType" class="form-label">Room Type</label>
                     <input type="text" id="RoomType" name="room_type" class="form-control">
                  </div> -->

                  <div class="form-group">
                     <label for="RoomType">Room Type</label>
                     <select id="RoomType" name="room_type" class="form-control">
                        <option value="Single" >Single</option>
                        <option value="Double" >Double</option>
                        <option value="Suite" >Suite</option>
                     </select>
                  </div>

                  <div class="form-group">
                     <label for="HasHotTub" class="form-label">Has Hot Tub</label>
                     <input type="checkbox" id="HasHotTub" name="has_hot_tub" class="form-control">
                  </div>
                  <div class="form-group">
                     <label for="Capacity" class="form-label">Capacity</label>
                     <input type="number" id="Capacity" name="capacity" class="form-control">
                  </div>
                  <div class="form-group">
                     <label for="Image" class="form-label"></label>Room Image</label>
                     <input type="file" id="image" name="image" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary">Add Room</button>
               </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close</button>
            </div>
         </div>
      </div>
   </div>
  
	</div>
</div>
   <!-- end our_room -->


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
                     <li><a href="#">Home</a></li>
                     <li><a href="about.html"> about</a></li>
                     <li class="active"><a href="admin_room.php">Our Room</a></li>
                     <li><a href="specialOffers.html">Special Offers</a></li>
                     <li><a href="blog.html">Blog</a></li>
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