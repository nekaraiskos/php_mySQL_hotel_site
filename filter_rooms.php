<?php

session_start(); // Ensure session is started

// Retrieve form data
$arrival = isset($_GET['arrival']) ? htmlspecialchars($_GET['arrival']) : '';
$departure = isset($_GET['departure']) ? htmlspecialchars($_GET['departure']) : '';
$room_type = isset($_GET['room_type']) ? htmlspecialchars($_GET['room_type']) : '';
$num_beds = isset($_GET['num_beds']) ? htmlspecialchars($_GET['num_beds']) : '';
$capacity = isset($_GET['capacity']) ? htmlspecialchars($_GET['capacity']) : '';
$sort_order = isset($_GET['sort_order']) ? htmlspecialchars($_GET['sort_order']) : '';
$search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';

try {
    require_once "includes/dbh.inc.php";     // Connect to the database.
    require_once "includes/book_now/book_now_model.inc.php";

    // Call the function to get available rooms
    $availableRooms = get_available_rooms($pdo, $arrival, $departure, $room_type, $num_beds, $capacity, $sort_order, $search);
          
    // Store the available rooms in the session
    $_SESSION['available_rooms'] = $availableRooms;

    // Redirect to a new page with filter parameters
    header("Location: room.php?arrival=" . urlencode($arrival) . "&departure=" . urlencode($departure) . "&room_type=" . urlencode($room_type) . "&num_beds=" . urlencode($num_beds) . "&capacity=" . urlencode($capacity) . "&sort_order=" . urlencode($sort_order) . "&search=" . urlencode($search));
    exit(); // Make sure to exit after redirect

} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}

?>
