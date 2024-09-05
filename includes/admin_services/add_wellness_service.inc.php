<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture the form data for the 'service' table
    $serviceName = $_POST['serviceName'];
    $price = $_POST['price'];
    $availabilityHours = $_POST['availabilityHours'];
    $description = $_POST['description'];
    $bookingRequired = isset($_POST['bookingRequired']) ? 1 : 0;
    $image = $_FILES['image']['name'];

    // Path for saving the image
    $imagepath = "images/" . $image;

    // Capture the form data for the 'wellness' table
    $roomType = $_POST['roomType'];
    $therapistRequired = isset($_POST['therapistRequired']) ? 1 : 0;
    $treatmentType = $_POST['treatmentType'];
    $duration = $_POST['duration'];

    // Include the database connection and the model
    require_once '../dbh.inc.php';
    require_once 'add_activity_service_model.inc.php';

    // Insert into the 'service' table
    add_service_to_table($pdo, $price, $bookingRequired, $description, $serviceName, $availabilityHours, $imagepath);

    // Get the last inserted ServiceID
    $serviceID = $pdo->lastInsertId();

    // Insert into the 'wellness' table
    add_service_to_wellness($pdo, $serviceID, $roomType, $therapistRequired, $treatmentType, $duration);

    // Redirect to the services page with a success message
    header('Location: ../../admin_services.php?message=ServiceAddedSuccessfully');
    exit;
}

?>
