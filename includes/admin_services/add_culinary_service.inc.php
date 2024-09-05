<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture the form data
    $serviceName = $_POST['serviceName'];
    $price = $_POST['price'];
    $availabilityHours = $_POST['availabilityHours'];
    $description = $_POST['description'];
    $bookingRequired = isset($_POST['bookingRequired']) ? 1 : 0;
    $image = $_FILES['image']['name'];
    $imagepath = "images/" . $image;

    // Culinary-specific fields
    $mealType = $_POST['mealType'];
    $specialDietary = $_POST['specialDietary'];
    $menuOptions = $_POST['menuOptions'];
    $dressCode = $_POST['dressCode'];

    require_once '../dbh.inc.php';
    require_once 'add_activity_service_model.inc.php';

    // Add service to the generic service table
    add_service_to_table($pdo, $price, $bookingRequired, $description, $serviceName, $availabilityHours, $imagepath);

    // Get the last inserted service ID
    $serviceID = $pdo->lastInsertId();

    // Add service to the culinary_experience table
    add_service_to_culinary($pdo, $serviceID, $mealType, $specialDietary, $menuOptions, $dressCode);

    // Redirect to the services page with a success message
    header('Location: ../../admin_services.php?message=ServiceAddedSuccessfully');
    exit;
}
?>
