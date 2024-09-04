<?php

session_start(); // Ensure session is started

// Retrieve form data
$search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : null;

try {
    require_once "../dbh.inc.php";     // Connect to the database.
    require_once "offers_model.inc.php";

    // Call the function to get available rooms
    $search_offers = get_search_offers($pdo, $search);

    if (!empty($search_offers)) {
        // Store the available rooms in the session
        $_SESSION['special_offers'] = $search_offers;
    }

    // Redirect to a new page with filter parameters
    header("Location: ../../special_offers.php?search=" . urlencode($search));
    exit(); // Make sure to exit after redirect

} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>
