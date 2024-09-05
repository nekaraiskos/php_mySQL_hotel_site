<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $price = $_POST['price'];
    $bookingRequired = isset($_POST['bookingRequired']) ? 1 : 0;
    $description = $_POST['description'];
    $serviceName = $_POST['serviceName'];
    $availabilityHours = $_POST['availabilityHours'];
    $mealType = $_POST['mealType'];
    $specialDietary = $_POST['specialDietary'];
    $menuOptions = $_POST['menuOptions'];
    $dressCode = $_POST['dressCode'];
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

    // Update the culinary_experience table
    edit_culinary_table($pdo, $mealType, $specialDietary, $menuOptions, $dressCode, $serviceID);
    // Update the service table
    edit_service_table($pdo, $price, $bookingRequired, $description, $serviceName, $availabilityHours, $imagePath, $serviceID);

    // Redirect back to the admin services page
    header('Location: ../../admin_services.php?edit=success');
    exit();
} else {
    header('Location: ../../admin_services.php');
    exit();
}
?>
