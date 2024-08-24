<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture the form data
    $serviceName = $_POST['serviceName'];
    $price = $_POST['price'];
    $availabilityHours = $_POST['availabilityHours'];
    $description = $_POST['description'];
    // $image =  $_FILE['image'];  
    $bookingRequired = isset($_POST['bookingRequired']) ? 1 : 0;
    $image = $_FILES['image']['name'];
    // echo $image;

    $imagepath = "images/" . $image;

    $difficultyLevel = $_POST['difficultyLevel'];
    $minimumAge = $_POST['minimumAge'];
    $duration = $_POST['duration'];
    $guideRequired = isset($_POST['guideRequired']) ? 1 : 0;

    require_once '../dbh.inc.php';
    require_once 'add_activity_service_model.inc.php';

    add_service_to_table($pdo, $price, $bookingRequired, $description, $serviceName, $availabilityHours, $imagepath);

    $serviceID = $pdo->lastInsertId();
    // echo $serviceID;
    add_service_to_activities($pdo, $serviceID, $difficultyLevel, $minimumAge, $guideRequired, $duration);

    header('Location: ../../admin_services.php?message=ServiceAddedSuccessfully');
    exit;
    

    // Database connection

    
    // Redirect to the services page with a success message
    // header('Location: ../services.php?message=ServiceAddedSuccessfully');
    // exit;


}
