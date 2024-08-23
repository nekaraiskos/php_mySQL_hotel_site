<?php

session_start(); // Ensure session is started

try {
    require_once "../dbh.inc.php";     // Connect to the database.
    require_once "services_model.inc.php";

    $type = htmlspecialchars($_GET['services']);

    if ($type == "Wellness") {
        $services = get_all_wellness($pdo); 
    }
    else if ($type == "Activities") {
        $services = get_all_activities($pdo);
    }
    else if ($type == "Culinary") {
        $services = get_all_culinary($pdo);
    }
    else {
        // Redirect to a main page -> ERROR
        header("Location: ../../main_page.php");
        exit(); // Make sure to exit after redirect
    }
      
    // Store the data to a session variable
    $_SESSION['services'] = $services;
    $_SESSION['type'] = $type;

    // Redirect to a new page with filter parameters
    header("Location: ../../services_details.php");
    exit(); // Make sure to exit after redirect

} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}

