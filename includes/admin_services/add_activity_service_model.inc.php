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

function add_service_to_wellness($pdo, $serviceID, $roomType, $therapistRequired, $treatmentType, $duration) {
    $sql = "INSERT INTO wellness (ServiceID, RoomType, TherapistRequired, TreatmentType, Duration)
            VALUES (:ServiceID, :RoomType, :TherapistRequired, :TreatmentType, :Duration)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':ServiceID', $serviceID);
    $stmt->bindParam(':RoomType', $roomType);
    $stmt->bindParam(':TherapistRequired', $therapistRequired);
    $stmt->bindParam(':TreatmentType', $treatmentType);
    $stmt->bindParam(':Duration', $duration);

    $stmt->execute();
}

function add_service_to_culinary($pdo, $serviceID, $mealType, $menuOptions, $dressCode) {
    $sql = "INSERT INTO culinary_experience (ServiceID, MealType, MenuOptions, DressCode)
            VALUES (:ServiceID, :MealType, :MenuOptions, :DressCode)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':ServiceID', $serviceID);
    $stmt->bindParam(':MealType', $mealType);
    // $stmt->bindParam(':SpecialDietary', $specialDietary);
    $stmt->bindParam(':MenuOptions', $menuOptions);
    $stmt->bindParam(':DressCode', $dressCode);

    $stmt->execute();
}

