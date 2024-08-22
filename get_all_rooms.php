<?php

session_start(); // Ensure session is started

try {
    require_once "includes/dbh.inc.php";     // Connect to the database.
    require_once "includes/book_now/book_now_model.inc.php";

    // Call the function to get available rooms
    $allRooms = get_all_rooms($pdo);
          
    // Store the available rooms in the session
    $_SESSION['available_rooms'] = $allRooms;

    // Redirect to a new page with filter parameters
    header("Location: room.php");
    exit(); // Make sure to exit after redirect

} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}

?>
