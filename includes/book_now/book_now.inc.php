<?php

// Do not allow to access this page if the form is not filled.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grab data from the user
    $arrival = $_POST["arrival"];
    $departure = $_POST["departure"];

    try {
        require_once "../dbh.inc.php";     // Connect to the database.        
        require_once "book_now_contr.inc.php";        
        require_once "book_now_model.inc.php";

        // ERROR HANDLING
        $errors = [];
        // 1) Empty data
        if (empty_dates($arrival, $departure)) {
            $errors["empty_dates"] = "Fill in all fields!";
        }
        // // 2) Valid dates
        if (!valid_dates($arrival, $departure)) {
            $errors["valid_dates"] = "Given dates are invalid!";
        }

        $availableRooms = get_available_rooms($pdo, $arrival, $departure, "", "", "", "", "");

        // Errors EXIST -> Start a session
        session_start(); // Ensure session is started

        if ($errors) {
            $_SESSION["errors_book_now"] = $errors;
            
            header("Location: ../../main_page.php");
            die();
        }
        
        // Store the available rooms in the session
        $_SESSION['available_rooms'] = $availableRooms;

        // Redirect to a new page
        header("Location: ../../room.php?arrival=" . urlencode($arrival) . "&departure=" . urlencode($departure));
        exit(); // Make sure to exit after redirect

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else {
    header("Location: ../../index.php");
    die();
}