<?php
//                              TAKE CARE OF QUERING THE DATABASE 

function get_available_rooms($pdo, $arrival, $departure, $room_type, $num_beds, $capacity, $sort_order, $search) {
    if ($arrival != "" && $departure != "") {
        // Step 1: Find all room IDs that are already booked during the given period
        $query = "
            SELECT FK2_RoomID 
            FROM makes_simple_resrv 
            WHERE !(:departure <= CheckIn OR :arrival >=CheckOut)            
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

function get_room($pdo, $room_id) {
    $query = "SELECT * FROM room WHERE RoomID = :room_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);    
    $stmt->execute();
    
    $curr_room = $stmt->fetch(PDO::FETCH_ASSOC);   
    return $curr_room;
}

function make_simple_resrv($pdo, $user_id, $room_id, $arrival, $departure, $totalCost) {
    // Insert the reservation into the makes_simple_resrv table
    $query = "INSERT INTO makes_simple_resrv (FullPrice, CheckIn, CheckOut, FK1_CustomerID, FK2_RoomID)    
            VALUES (:fullPrice, :checkIn, :checkOut, :fK1_CustomerID, :fK2_RoomID);";

    $stmt = $pdo->prepare($query);    
    $stmt->bindParam(':fullPrice', $totalCost);
    $stmt->bindParam(':checkIn', $arrival);
    $stmt->bindParam(':checkOut', $departure);
    $stmt->bindParam(':fK1_CustomerID', $user_id);
    $stmt->bindParam(':fK2_RoomID', $room_id);
    
    // Execute the query
    if ($stmt->execute()) {
        return 1;
    } else {
        return -1;
    }
}
