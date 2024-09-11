<?php

function get_services_with_types($pdo) {
    $sql = "SELECT s.ServiceID, s.ServiceName, IF(a.ServiceID IS NOT NULL, 'Activity', 
            IF(w.ServiceID IS NOT NULL, 'Wellness', 'Culinary')) AS ServiceType
            FROM service s
            LEFT JOIN activity a ON s.ServiceID = a.ServiceID
            LEFT JOIN wellness w ON s.ServiceID = w.ServiceID
            LEFT JOIN culinary_experience c ON s.ServiceID = c.ServiceID";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insert_special_offer($pdo, $description, $discount, $imagePath, $serviceID) {
    $sql = "INSERT INTO special_offer (Description, Discount, Image, ServiceID) 
            VALUES (:Description, :Discount, :Image, :ServiceID)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':Description', $description);
    $stmt->bindParam(':Discount', $discount);
    $stmt->bindParam(':Image', $imagePath);
    $stmt->bindParam(':ServiceID', $serviceID);
    $stmt->execute();
}

function get_special_offers($pdo) {
    $sql = "SELECT * FROM special_offer";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $offers;
}

function edit_special_offer($pdo, $offerID, $description, $discount, $imagePath, $serviceID) {
     // Update the special offer in the database
    $sql = "UPDATE special_offer SET Description = :description, Discount = :discount, ServiceID = :serviceID, Image = :image 
    WHERE SpecialOfferID = :offerID";

$stmt = $pdo->prepare($sql);

// Bind parameters
$stmt->bindParam(':description', $description);
$stmt->bindParam(':discount', $discount);
$stmt->bindParam(':serviceID', $serviceID);
$stmt->bindParam(':image', $imagePath);
$stmt->bindParam(':offerID', $offerID);

$stmt->execute();
}

function add_new_combination($pdo, $roomID, $offerID) {

    $sql = "INSERT INTO combination (RoomID, SpecialOfferID) VALUES (:RoomID, :OfferID)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':RoomID', $roomID);
    $stmt->bindParam(':OfferID', $offerID);
    $stmt->execute();
}

function check_if_combination_exists($pdo, $roomID, $offerID){
    $sql = 'SELECT * FROM combination WHERE (RoomID = :RoomID and SpecialOfferID = :OfferID)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':RoomID', $roomID);
    $stmt->bindParam(':OfferID', $offerID);
    $stmt->execute();
    if(!empty($stmt->fetchAll(PDO::FETCH_ASSOC))){
        return true;
    } else return false;
}
function delete_combination($pdo, $offerID, $roomID) {
    $sql = 'DELETE FROM combination WHERE (RoomID = :RoomID and SpecialOfferID = :OfferID)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':RoomID', $roomID);
    $stmt->bindParam(':OfferID', $offerID);
    $stmt->execute();
}

function delete_offer($pdo, $offerID) {
    $sql = 'DELETE FROM special_offer WHERE SpecialOfferID = :OfferID';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':OfferID', $offerID);
    $stmt->execute();
}




