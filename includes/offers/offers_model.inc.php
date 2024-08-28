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

function get_offer_available_rooms($pdo, $offer_id, $arrival, $departure, $room_type, $num_beds, $capacity, $sort_order, $search) {
    $params = [];

    // Step 1: Find all room IDs that are already booked during the given period    
    if ($arrival != "" && $departure != "") {
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
        $bookedRooms = [];
    }

    // Step 2: Find all RoomIDs associated with the given SpecialOfferID
    $query = "
        SELECT RoomID
        FROM combination
        WHERE SpecialOfferID = :offer_id
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':offer_id', $offer_id);
    $stmt->execute();

    $offerRooms = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);  // Fetch only the room IDs

    // Step 3: Build the base query
    $query = "SELECT * FROM room";
    $conditions = [];

    // Filter to include only rooms associated with the special offer
    if (!empty($offerRooms)) {
        $placeholders = [];
        foreach ($offerRooms as $index => $roomID) {
            $placeholder = ":offerRoom_$index";
            $placeholders[] = $placeholder;
            $params[$placeholder] = $roomID;
        }
        $conditions[] = "RoomID IN (" . implode(', ', $placeholders) . ")";
    }
    
    // Exclude booked rooms if any
    if (!empty($bookedRooms)) {
        // Use named placeholders for the NOT IN clause
        $placeholders = [];
        foreach ($bookedRooms as $index => $roomID) {
            $placeholders[] = ":roomID_$index";
            $params[":roomID_$index"] = $roomID;
        }
        $conditions[] = "RoomID NOT IN (" . implode(', ', $placeholders) . ")";
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

    // Bind all parameters directly in the execute() method
    $stmt->execute($params);

    $availableRooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $availableRooms;
}


function make_special_resrv($pdo, $user_id, $room_id, $offer_id, $arrival, $departure, $totalCost) {
    // Insert the reservation into the makes_special_resrv table
    $query = "
        INSERT INTO makes_special_resrv 
        (FullPrice, CheckIn, CheckOut, FK1_CustomerID, FK2_RoomID, FK3_SpecialOfferID)    
        VALUES 
        (:fullPrice, :checkIn, :checkOut, :fK1_CustomerID, :fK2_RoomID, :fK3_SpecialOfferID);
    ";

    $stmt = $pdo->prepare($query);
    
    // Bind parameters to the SQL query
    $stmt->bindParam(':fullPrice', $totalCost);
    $stmt->bindParam(':checkIn', $arrival);
    $stmt->bindParam(':checkOut', $departure);
    $stmt->bindParam(':fK1_CustomerID', $user_id);
    $stmt->bindParam(':fK2_RoomID', $room_id);
    $stmt->bindParam(':fK3_SpecialOfferID', $offer_id);
    
    // Execute the query
    if ($stmt->execute()) {
        return 1;  // Success
    } else {
        return -1; // Failure
    }
}
