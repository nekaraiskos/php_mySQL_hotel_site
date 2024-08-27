<?php
//                              TAKE CARE OF QUERING THE DATABASE 

function get_available_rooms($pdo, $arrival, $departure, $room_type, $num_beds, $capacity, $sort_order, $search) {
    if ($arrival != "" && $departure != "") {
        // Step 1: Find all room IDs that are already booked during the given period
        $query = "
            SELECT FK2_RoomID 
            FROM makes_simple_resrv
            WHERE NOT (:departure <= CheckIn OR :arrival >= CheckOut)
            UNION
            SELECT FK2_RoomID 
            FROM makes_special_resrv
            WHERE NOT (:departure <= CheckIn OR :arrival >= CheckOut)
        ";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':arrival', $arrival);
        $stmt->bindParam(':departure', $departure);
        $stmt->execute();

        $bookedRooms = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);  // Fetch only the room IDs
    }
    else {
        $bookedRooms = "";
    }
        
    // Step 2: Build the base query
    $query = "SELECT * FROM room";
    $conditions = [];
    $params = [];

    if (!empty($bookedRooms)) {
        $placeholders = rtrim(str_repeat('?,', count($bookedRooms)), ',');
        $conditions[] = "RoomID NOT IN ($placeholders)";
        $params = array_merge($params, $bookedRooms);
    }

    // Apply filters if provided
    if (!empty($room_type)) {
        $conditions[] = "RoomType = :room_type";
        $params[':room_type'] = $room_type;
    }
    if (!empty($num_beds)) {
        $conditions[] = "NumOfBeds = :num_beds";
        $params[':num_beds'] = $num_beds;
    }
    if (!empty($capacity)) {
        $conditions[] = "Capacity = :capacity";
        $params[':capacity'] = $capacity;
    }

    // Add search filter if provided
    if (!empty($search)) {
        $conditions[] = "(RoomName LIKE :search)";
        $params[':search'] = '%' . $search . '%';  // Add wildcards for partial matching
    }

    // Combine conditions into the query
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    // Add sorting if the sort_order is provided
    if (!empty($sort_order)) {
        $query .= " ORDER BY PricePerNight " . ($sort_order === 'asc' ? 'ASC' : 'DESC');
    }

    // Prepare and execute the query
    $stmt = $pdo->prepare($query);
    foreach ($params as $key => $value) {
        $stmt->bindValue(is_int($key) ? ($key + 1) : $key, $value);
    }
    $stmt->execute();

    $availableRooms = $stmt->fetchAll(PDO::FETCH_ASSOC);   
    return $availableRooms;
}

function get_all_rooms($pdo) {
    $query = "SELECT * FROM room";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

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
