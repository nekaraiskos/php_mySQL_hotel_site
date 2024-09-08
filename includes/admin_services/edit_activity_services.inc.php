<?php

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $price = $_POST['price'];
    $bookingRequired = isset($_POST['bookingRequired']) ? 1 : 0;
    $description = $_POST['description'];
    $serviceName = $_POST['serviceName'];
    $availabilityHours = $_POST['availabilityHours'];
    // $image = $_FILES['image']['name'];
    $difficultyLevel = $_POST['difficultyLevel'];
    $minimumAge = $_POST['minimumAge'];
    $duration = $_POST['duration'];
    $guideRequired = isset($_POST['guideRequired']) ? 1 : 0;
    $serviceid = $_POST['serviceID'];

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    echo '<pre>';
    echo 'Service ID: ';
    var_dump($serviceid);
    echo '</pre'>
    print_r($_FILES['image']['tmp_name']);
    echo '<pre>';
    print_r($_FILES['image']['name']);
    echo '</pre>';

    require_once '../dbh.inc.php';
    require_once 'admin_services_model.inc.php';

    // Handle image upload if a new image is uploaded
    if (!empty($_FILES['image']['tmp_name'])) {
        $imagePath = 'images/' . $_FILES['image']['name'];
        // move_uploaded_file($_FILES['Image']['tmp_name'], $imagePath);
    } else {
        $sql = 'SELECT * FROM service WHERE ServiceID = :ServiceID';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':ServiceID', $serviceid, PDO::PARAM_INT);
        $stmt->execute();

        // Step 2: Fetch the result
        $imagePath = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print_r($imagePath);
        $imagePath = $imagePath[0]['Image'];
        echo '<pre>';
        print_r($imagePath);
        echo '</pre>';
    }



    // Update the activity table
    edit_activity_table($pdo, $difficultyLevel, $minimumAge, $duration, $guideRequired, $serviceid);
    // Update the service table
    edit_service_table($pdo, $price, $bookingRequired, $description, $serviceName, $availabilityHours, $imagePath, $serviceid);
    // echo $pdo, $difficultyLevel, $minimumAge, $duration, $guideRequired, $serviceID, $price, $bookingRequired, $description, $serviceName, $availabilityHours, $imagePath;

    // Redirect back to the admin services page
    header('Location: ../../admin_services.php?edit=success');
    exit();
}
else {
// If ServiceID is not set, redirect to the admin services page
header('Location: admin_services.php');
exit();
}