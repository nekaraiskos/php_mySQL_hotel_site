<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $price = $_POST['price'];
    $bookingRequired = isset($_POST['bookingRequired']) ? 1 : 0;
    $description = $_POST['description'];
    $serviceName = $_POST['serviceName'];
    $availabilityHours = $_POST['availabilityHours'];
    $roomType = $_POST['roomType'];
    $treatmentType = $_POST['treatmentType'];
    $duration = $_POST['duration'];
    $therapistRequired = isset($_POST['therapistRequired']) ? 1 : 0;
    $serviceID = $_POST['serviceID'];

    require_once '../dbh.inc.php';
    require_once 'admin_services_model.inc.php';

    // Handle image upload if a new image is uploaded
    if (!empty($_FILES['image']['tmp_name'])) {
        $imagePath = 'images/' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        $sql = 'SELECT Image FROM service WHERE ServiceID = :ServiceID';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':ServiceID', $serviceID, PDO::PARAM_INT);
        $stmt->execute();

        $imagePath = $stmt->fetchColumn();
    }

    // Update the wellness table
    edit_wellness_table($pdo, $roomType, $therapistRequired, $treatmentType, $duration, $serviceID);
    // Update the service table
    edit_service_table($pdo, $price, $bookingRequired, $description, $serviceName, $availabilityHours, $imagePath, $serviceID);

    // Redirect back to the admin services page
    header('Location: ../../admin_services.php?edit=success');
    exit();
} else {
    // If ServiceID is not set, redirect to the admin services page
    header('Location: admin_services.php');
    exit();
}

