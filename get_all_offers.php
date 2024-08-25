<?php

session_start(); // Ensure session is started

try {
    require_once "includes/dbh.inc.php";     // Connect to the database.
    require_once "includes/offers/offers_model.inc.php";

    // Call the function to get available rooms
    $allOffers = get_all_offers($pdo);
          
    // Store all the offers in the session
    $_SESSION['special_offers'] = $allOffers;

    // Redirect to a new page with filter parameters
    header("Location: special_offers.php");
    exit(); // Make sure to exit after redirect

} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}

?>
