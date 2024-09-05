<?php
// Start session to access session variables and connect to the database
session_start(); 
require_once "../dbh.inc.php";
require_once "services_model.inc.php";

// Submit Reservation
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the form
    $full_price = $_POST['full_price'];

    $service_id = $_SESSION["service_id"];
    $num_people = $_SESSION["num_people"];
    $appointed_time = $_SESSION["appointed_time"];

    $user_id = $_SESSION["user_id"];

    $res = book_service($pdo, $user_id, $service_id, $num_people, $appointed_time, $full_price);    

    if ($res == 1) {
        // Redirect to a success page
        header('Location: ../book_now/reservation_success.php');
        exit();
    } else {
        // Redirect to an error page
        header('Location: ../book_now/reservation_error.php');
        exit();
    }
}
