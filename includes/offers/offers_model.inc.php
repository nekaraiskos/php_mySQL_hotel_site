<?php
//                              TAKE CARE OF QUERING THE DATABASE 
function get_all_offers($pdo) {
    $query = "SELECT * FROM special_offer";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);   
    return $offers;
}

function get_special_offer($pdo, $offer_id) {
    $query = "SELECT * FROM special_offer WHERE SpecialOfferID = :offer_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':offer_id', $offer_id, PDO::PARAM_INT);    
    $stmt->execute();
    
    $special_offer = $stmt->fetch(PDO::FETCH_ASSOC);   
    return $special_offer;
}

function get_offer_rooms($pdo, $offer_id) {
    // Step 1: Get RoomIDs from the combination table where SpecialOfferID matches $offer_id
    $sql1 = "
        SELECT RoomID
        FROM combination
        WHERE SpecialOfferID = ?
    ";

    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute([$offer_id]);

    // Fetch RoomIDs
    $roomIds = $stmt1->fetchAll(PDO::FETCH_COLUMN, 0);

    if (empty($roomIds)) {
        echo "No rooms found for the given offer.";
        return [];
    }

    // Step 2: Get details of rooms from the room table using the fetched RoomIDs
    $placeholders = implode(',', array_fill(0, count($roomIds), '?'));
    $sql2 = "
        SELECT *
        FROM room
        WHERE RoomID IN ($placeholders)
    ";

    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute($roomIds);

    // Fetch and return room details
    $rooms = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    return $rooms;
}


function get_room($pdo, $room_id) {
    $query = "SELECT * FROM room WHERE RoomID = :room_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);    
    $stmt->execute();
    
    $curr_room = $stmt->fetch(PDO::FETCH_ASSOC);   
    return $curr_room;
}