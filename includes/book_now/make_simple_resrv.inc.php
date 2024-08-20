<?php
// Start session to access session variables and connect to the database
session_start(); 
require_once "../dbh.inc.php";
require_once "book_now_model.inc.php";

// Submit Reservation
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the form
    $user_id = $_POST['user_id'];
    $room_id = $_POST['room_id'];
    $arrival = $_POST['arrival'];
    $departure = $_POST['departure'];    
    $totalCost = $_POST['totalCost'];

    $res = make_simple_resrv($pdo, $user_id, $room_id, $arrival, $departure, $totalCost);    

    // if ($res == 1) {
    //     echo "Reservation successful!";
    // } else {
    //     echo "There was an error with your reservation.";
    // }
    if ($res == 1) {
        // Redirect to a success page
        header('Location: reservation_success.php');
        exit();
    } else {
        // Redirect to an error page
        header('Location: reservation_error.php');
        exit();
    }
}


// // Check if the form was submitted
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     // Get the data from the form
//     $user_id = $_POST['user_id'];
//     $room_id = $_POST['room_id'];
//     $arrival = $_POST['arrival'];
//     $departure = $_POST['departure'];    
//     $totalCost = $_POST['totalCost'];

//     // Insert the reservation into the makes_simple_resrv table
//     $query = "INSERT INTO makes_simple_resrv (FullPrice, CheckIn, CheckOut, FK1_CustomerID, FK2_RoomID)    
//               VALUES (:fullPrice, :checkIn, :checkOut, :fK1_CustomerID, :fK2_RoomID);";

//     $stmt = $pdo->prepare($query);    
//     $stmt->bindParam(':fullPrice', $totalCost);
//     $stmt->bindParam(':checkIn', $arrival);
//     $stmt->bindParam(':checkOut', $departure);
//     $stmt->bindParam(':fK1_CustomerID', $user_id);
//     $stmt->bindParam(':fK2_RoomID', $room_id);
    
//     // Execute the query
//     if ($stmt->execute()) {
//         echo "Reservation successful!";
//     } else {
//         echo "There was an error with your reservation.";
//     }
// }



