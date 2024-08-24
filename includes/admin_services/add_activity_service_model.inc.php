<?php

function add_service_to_table($pdo, $price, $bookingRequired, $description, $serviceName, $availabilityHours, $imagepath) {

    $sql = "INSERT INTO service (Price, BookingRequired, Description, ServiceName, AvailabilityHours, Image)
            VALUES (:Price, :BookingRequired, :Description, :ServiceName, :AvailabilityHours, :Image)";

    $stmt = $pdo ->prepare($sql);

    $stmt -> bindParam(':Price', $price);
    $stmt -> bindParam(':BookingRequired', $bookingRequired);
    $stmt -> bindParam(':Description', $description);
    $stmt -> bindParam(':ServiceName', $serviceName);
    $stmt -> bindParam(':AvailabilityHours', $availabilityHours);
    $stmt -> bindParam(':Image', $imagepath);

    $stmt -> execute();
    // header('Location: ../../admin_services.php?message=ServiceAddedSuccessfully');
}

function add_service_to_activities($pdo, $serviceID, $difficultyLevel, $minimumAge, $guideRequired, $duration) {

    $sql = "INSERT INTO activity (ServiceID, DifficultyLevel, MinimumAge, GuideRequired, Duration)
            VALUES (:ServiceID, :DifficultyLevel, :MinimumAge, :GuideRequired, :Duration)";

    $stmt = $pdo -> prepare($sql);

    $stmt->execute([
        ':ServiceID' => $serviceID,
        ':DifficultyLevel' => $difficultyLevel,
        ':MinimumAge' => $minimumAge,
        ':Duration' => $duration,
        ':GuideRequired' => $guideRequired
    ]);
}