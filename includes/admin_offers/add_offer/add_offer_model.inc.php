<?php

// function get_services_with_types($pdo) {
//     $sql = "SELECT s.ServiceID, s.ServiceName, IF(a.ServiceID IS NOT NULL, 'Activity', IF(w.ServiceID IS NOT NULL, 'Wellness', 'Culinary')) AS ServiceType
//             FROM service s
//             LEFT JOIN activity a ON s.ServiceID = a.ServiceID
//             LEFT JOIN wellness w ON s.ServiceID = w.ServiceID
//             LEFT JOIN culinary_experience c ON s.ServiceID = c.ServiceID";
    
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

// function insert_special_offer($pdo, $description, $discount, $imagePath, $serviceID) {
//     $sql = "INSERT INTO special_offer (Description, Discount, Image, ServiceID) 
//             VALUES (:Description, :Discount, :Image, :ServiceID)";
    
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindParam(':Description', $description);
//     $stmt->bindParam(':Discount', $discount);
//     $stmt->bindParam(':Image', $imagePath);
//     $stmt->bindParam(':ServiceID', $serviceID);
//     $stmt->execute();
// }
