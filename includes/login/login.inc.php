<?php

// Do not allow to access this page if the form is not filled.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grab data from the user
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $usertype = $_POST["user_type"];

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
        // if($usertype === "user") {
        if(!strcmp($usertype, "user")) {
            $results = get_user($pdo, $username);
        }
        else {
            $results = get_admin($pdo, $username);
        }

        // 2) Non-existent username 
        if (is_username_wrong($results)) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }
        // 3) Password does not match  
        // else {
        //     if($usertype == "user") {
        //         if (is_password_wrong($pwd, $results["pwd"], true)) {
        //             $errors["login_incorrect"] = "Incorrect login info!";
        //         }
        //     }else {
        //         if (is_password_wrong($pwd, $results["pwd"], false)) {
        //             $errors["login_incorrect"] = "Incorrect login info!";
        //         }
        //     }
        // }
        else if(is_password_wrong($pwd, $results["pwd"], $usertype)) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }        

        if ($errors) {
            $_SESSION["errors_login"] = $errors;            
            header("Location: ../../index.php");
            exit();
        }
        
        require_once "../config_session.inc.php";

        // session_name('user_session');
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $results["id"];
        session_id($sessionId);

        // User Logged in
        $_SESSION["user_id"] = $results["CustomerID"];
        $_SESSION["user_username"] = htmlspecialchars($results["username"]);    // Sanitize data 
        $_SESSION['last_regeneration'] = time();                                       

        // header("Location: ../../index.php?login=success");

        if(!strcmp($usertype, "user")) {
            header("Location: ../../index.php?login_user=success");
        }
        else {
            header("Location: ../../index.php?login_admin=success");
        }

        $pdo = null;
        $stmt = null;

        // check_login_errors($_SESSION["user_username"]); // <!--This is the problem --
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

}
else {
    header("Location: ../../index.php");
    die();
}