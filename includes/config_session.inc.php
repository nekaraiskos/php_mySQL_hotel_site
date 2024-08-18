<?php

// Mandatory to secure our session
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

session_start();

// Check if a user is logged-in right now (by checking if this session variable exists)
if (isset($_SESSION["user_id"]) || isset($_SESSION["admin_id"])) {                  // LOGGED IN
    if (!isset($_SESSION['last_regeneration'])) {   // The session_id does not exist -> create its    
        regenerate_session_id_loggedin();
    }
    else {                                          // Update the session_id after a time interval (set to 30min)
        $interval = 60 * 30;
    
        if (time() - $_SESSION['last_regeneration'] >= $interval) {     
            regenerate_session_id_loggedin();
        }
    }
}
else {  // NOT LOGGED IN
    if (!isset($_SESSION['last_regeneration'])) {   // The session_id does not exist -> create its    
        regenerate_session_id();
    }
    else {                                          // Update the session_id after a time interval (set to 30min)
        $interval = 60 * 30;
    
        if (time() - $_SESSION['last_regeneration'] >= $interval) {     
            regenerate_session_id();
        }
    }
}


function regenerate_session_id() {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}

// Create a new session id with the user's id included.
function regenerate_session_id_loggedin() {

    session_regenerate_id(true);
    
    // Get the session variable "user_id" to use it in concatenation.
    // $userId = $_SESSION["user_id"];
    $userId = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : $_SESSION["admin_id"];
    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $userId;
    session_id($sessionId);
    
    $_SESSION['last_regeneration'] = time();
}
// function regenerate_session_id_loggedin() {
//     session_regenerate_id(true);
    
//     if (isset($_SESSION["user_id"])) {
//         $userId = $_SESSION["user_id"];
//         $newSessionId = session_create_id();
//         $sessionId = $newSessionId . "_user_" . $userId;
//         session_id($sessionId);
//     } elseif (isset($_SESSION["admin_id"])) {
//         $adminId = $_SESSION["admin_id"];
//         $newSessionId = session_create_id();
//         $sessionId = $newSessionId . "_admin_" . $adminId;
//         session_id($sessionId);
//     }

//     $_SESSION['last_regeneration'] = time();
// }
