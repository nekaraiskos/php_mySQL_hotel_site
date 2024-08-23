<?php

session_start(); // Ensure session is started

try {
    require_once "includes/dbh.inc.php";     // Connect to the database.
    require_once "includes/services/services_model.inc.php";
    
    $activities = get_some_activities($pdo);
    $_SESSION['activities'] = $activities;

    $wellness = get_some_wellness($pdo);
    $_SESSION['wellness'] = $wellness;

    $culinary = get_some_culinary($pdo);
    $_SESSION['culinary'] = $culinary;

    // Redirect to a new page with filter parameters
    header("Location: services.php");
    exit(); // Make sure to exit after redirect

} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}

?>
