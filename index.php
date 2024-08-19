<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup/signup_view.inc.php';
require_once 'includes/login/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keto - Login & Signup</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>
<body class="main-layout">
    <!-- Loader -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#"/></div>
    </div>

    <!-- Header -->
    <header>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="index.php"><img src="images/logo.png" alt="#" /></a>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->

    <!-- Login and Signup Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h3>Login</h3>
                <form action="includes/login/login.inc.php" method="post">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="password" name="pwd" class="form-control" placeholder="Password">
                    </div>
                    <button class="btn btn-primary">Login</button>
                </form>

                <?php check_login_errors(); ?>
            </div>

            <div class="col-md-6">
                <h3>Signup</h3>
                <form action="includes/signup/signup.inc.php" method="post">
                    <?php signup_inputs(); ?>
                    <button class="btn btn-success">Signup</button>
                </form>

                <?php check_signup_errors(); ?>
            </div>
        </div>        
    </div>
    <!-- End Login and Signup Section -->

    <!-- Footer -->
    <footer>
        <div class="footer">
            <div class="container">
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
    <!-- End Footer -->

    <!-- JavaScript Files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
