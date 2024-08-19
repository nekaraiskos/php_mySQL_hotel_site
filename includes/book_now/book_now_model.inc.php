<?php
//                              TAKE CARE OF QUERING THE DATABASE 

function get_available_rooms(object $pdo, string $arrival, string $departure) {

    // Step 1: Find all room IDs that are already booked during the given period
    $query = "
        SELECT FK2_RoomID 
        FROM makes_simple_resrv 
        WHERE (CheckIn < :departure AND CheckOut > :arrival)
        ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':arrival', $arrival);
    $stmt->bindParam(':departure', $departure);
    $stmt->execute();
    
    $bookedRooms = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);  // Fetch only the room IDs

    // Step 2: Find all rooms that are not booked during the given period
    if (!empty($bookedRooms)) {
        // Create a placeholder string for the IN clause
        $placeholders = rtrim(str_repeat('?,', count($bookedRooms)), ',');

        $query = "
            SELECT * 
            FROM room 
            WHERE RoomID NOT IN ($placeholders)
        ";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute($bookedRooms);
    } else {
        // If no rooms are booked, select all rooms
        $query = "SELECT * FROM room";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }

    $availableRooms = $stmt->fetchAll(PDO::FETCH_ASSOC);   
    return $availableRooms;
}


