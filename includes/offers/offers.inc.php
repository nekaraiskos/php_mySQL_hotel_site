<?php

session_start(); // Ensure session is started

try {
    require_once "../dbh.inc.php";     // Connect to the database.
    require_once "offers_model.inc.php";

    $offer_id = htmlspecialchars($_GET['offer_id']);

    $special_offer = get_special_offer($pdo, $offer_id);
    $offer_rooms = get_offer_rooms($pdo, $offer_id);
    $service_name = get_service_name($pdo, $special_offer['ServiceID']);

    $_SESSION['special_offer'] = $special_offer;
    $_SESSION['offer_rooms'] = $offer_rooms;
    $_SESSION['service_name'] = $service_name;

    // Redirect to a new page with filter parameters
    header("Location: ../../offer_page.php");
    exit(); // Make sure to exit after redirect

} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}