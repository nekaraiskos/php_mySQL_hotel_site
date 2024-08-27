<?php
// Start session to access session variables and connect to the database
session_start(); 
require_once "../dbh.inc.php";
require_once "offers_model.inc.php";

// Submit Reservation
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the form
    $room_id = $_POST['room_id'];
    $user_id = $_POST['user_id'];
    $offer_id = $_POST['offer_id'];
    $arrival = $_POST['arrival'];
    $departure = $_POST['departure'];    
    $totalCost = $_POST['totalCost'];

    if ($arrival == "" || $departure = "" || $totalCost = "") {
        header('Location: ../../offer_page.php');
        exit();
    }
    else {
        $res = make_special_resrv($pdo, $user_id, $room_id, $offer_id, $arrival, $departure, $totalCost);    
    
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
}