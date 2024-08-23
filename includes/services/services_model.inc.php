<?php
//                              TAKE CARE OF QUERING THE DATABASE 

function get_some_activities($pdo) {
    // Step 1: Retrieve the first three ServiceID values from the activities table
    $sql1 = "
        SELECT ServiceID
        FROM activity
        ORDER BY ServiceID
        LIMIT 3
    ";

    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute();

    // Fetch ServiceIDs
    $serviceIds = $stmt1->fetchAll(PDO::FETCH_COLUMN, 0);

    if (empty($serviceIds)) {
        echo "No activities found.";
        exit();
    }

    // Step 2: Fetch ServiceName, Description, and Image from the service table using the ServiceIDs
    $placeholders = implode(',', array_fill(0, count($serviceIds), '?'));
    $sql2 = "
        SELECT ServiceName, Description, Image
        FROM service
        WHERE ServiceID IN ($placeholders)
    ";

    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute($serviceIds);

    // Fetch results
    $services = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    return $services;
}

function get_some_wellness($pdo) {
    // Step 1: Retrieve the first three ServiceID values from the wellness table
    $sql1 = "
        SELECT ServiceID
        FROM wellness
        ORDER BY ServiceID
        LIMIT 3
    ";

    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute();

    // Fetch ServiceIDs
    $serviceIds = $stmt1->fetchAll(PDO::FETCH_COLUMN, 0);

    if (empty($serviceIds)) {
        echo "No Services found.";
        exit();
    }

    // Step 2: Fetch ServiceName, Description, and Image from the service table using the ServiceIDs
    $placeholders = implode(',', array_fill(0, count($serviceIds), '?'));
    $sql2 = "
        SELECT ServiceName, Description, Image
        FROM service
        WHERE ServiceID IN ($placeholders)
    ";

    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute($serviceIds);

    // Fetch results
    $services = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    return $services;
}

function get_some_culinary($pdo) {
    // Step 1: Retrieve the first three ServiceID values from the culinary table
    $sql1 = "
        SELECT ServiceID
        FROM culinary_experience
        ORDER BY ServiceID
        LIMIT 3
    ";

    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute();

    // Fetch ServiceIDs
    $serviceIds = $stmt1->fetchAll(PDO::FETCH_COLUMN, 0);

    if (empty($serviceIds)) {
        echo "No Culinary experiences found.";
        exit();
    }

    // Step 2: Fetch ServiceName, Description, and Image from the service table using the ServiceIDs
    $placeholders = implode(',', array_fill(0, count($serviceIds), '?'));
    $sql2 = "
        SELECT ServiceName, Description, Image
        FROM service
        WHERE ServiceID IN ($placeholders)
    ";

    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute($serviceIds);

    // Fetch results
    $services = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    return $services;
}

function get_all_activities($pdo) {
    // Step 1: Retrieve all records from the activity table and 
    // their corresponding data from the service table
    $sql = "
        SELECT activity.*, service.*
        FROM activity
        JOIN service ON activity.ServiceID = service.ServiceID
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch all combined activity and service records
    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $activities;
}
function get_all_wellness($pdo) {}
function get_all_culinary($pdo) {}