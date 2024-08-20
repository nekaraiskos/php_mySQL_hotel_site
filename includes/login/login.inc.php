<?php
// Do not allow access to this page if the form is not filled.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grab data from the user
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {

        session_start();

        require_once "../dbh.inc.php";     // Connect to the database.
        require_once "login_model.inc.php";
        require_once "login_contr.inc.php";

        // ERROR HANDLING
        $errors = [];
        // 1) Empty data
        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        $results = get_user($pdo, $username);

        // 2) Non-existent username 
        if (is_username_wrong($results)) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }
        // 3) Password does not match  
        else if (is_password_wrong($pwd, $results["pwd"])) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        // If there are errors, redirect back with errors in session
        if ($errors) {
            $_SESSION["errors_login"] = $errors;
            header("Location: ../../index.php");
            exit();
        }

        require_once '../config_session.inc.php';

        $newSessionId = session_create_id();
        $sessionID = $newSessionId . "_" . $result["ID"];
        session_id($sessionID);    

        // User Logged in
        $_SESSION["user_id"] = $results["CustomerID"];
        $_SESSION["user_username"] = htmlspecialchars($results["Username"]); // Sanitize data 
        $_SESSION['last_regeneration'] = time();  // Store the time of the session regeneration

        header("Location: ../../index.php?login_user=success");
        exit();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../../index.php");
    exit();
}
