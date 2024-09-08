<?php

function edit_service_table($pdo, $price, $bookingRequired, $description, $serviceName, $availabilityHours, $imagePath, $serviceID) {
    $sql = "UPDATE service 
            SET Price = :Price, BookingRequired = :BookingRequired, Description = :Description, 
                ServiceName = :ServiceName, AvailabilityHours = :AvailabilityHours, Image = :Image 
            WHERE ServiceID = :ServiceID";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':Price', $price);
    $stmt->bindParam(':BookingRequired', $bookingRequired);
    $stmt->bindParam(':Description', $description);
    $stmt->bindParam(':ServiceName', $serviceName);
    $stmt->bindParam(':AvailabilityHours', $availabilityHours);
    $stmt->bindParam(':Image', $imagePath);
    $stmt->bindParam(':ServiceID', $serviceID);
    $stmt->execute();
}

function edit_activity_table($pdo, $difficultyLevel, $minimumAge, $duration, $guideRequired, $serviceID) {
    
    // Update the activity table
    $sql = "UPDATE activity 
            SET DifficultyLevel = :DifficultyLevel, MinimumAge = :MinimumAge, 
                Duration = :Duration, GuideRequired = :GuideRequired 
            WHERE ServiceID = :ServiceID";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':DifficultyLevel', $difficultyLevel);
    $stmt->bindParam(':MinimumAge', $minimumAge);
    $stmt->bindParam(':Duration', $duration);
    $stmt->bindParam(':GuideRequired', $guideRequired);
    $stmt->bindParam(':ServiceID', $serviceID);
    $stmt->execute();
}

function edit_wellness_table($pdo, $roomType, $therapistRequired, $treatmentType, $duration, $serviceID) {
    $sql = "UPDATE wellness 
            SET RoomType = :RoomType, TherapistRequired = :TherapistRequired, 
                TreatmentType = :TreatmentType, Duration = :Duration 
            WHERE ServiceID = :ServiceID";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':RoomType', $roomType);
    $stmt->bindParam(':TherapistRequired', $therapistRequired);
    $stmt->bindParam(':TreatmentType', $treatmentType);
    $stmt->bindParam(':Duration', $duration);
    $stmt->bindParam(':ServiceID', $serviceID);
    $stmt->execute();
}

function edit_culinary_table($pdo, $mealType, $menuOptions, $dressCode, $serviceID) {
    $sql = "UPDATE culinary_experience 
            SET MealType = :MealType, 
                MenuOptions = :MenuOptions, DressCode = :DressCode 
            WHERE ServiceID = :ServiceID";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':MealType', $mealType);
    // $stmt->bindParam(':SpecialDietary', $specialDietary);
    $stmt->bindParam(':MenuOptions', $menuOptions);
    $stmt->bindParam(':DressCode', $dressCode);
    $stmt->bindParam(':ServiceID', $serviceID);
    $stmt->execute();
}

