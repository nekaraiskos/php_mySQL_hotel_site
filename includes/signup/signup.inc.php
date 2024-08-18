<?php

// Do not allow to access this page if the form is not filled.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grab data from the user
    $username = $_POST["username"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];
    $phoneNum = $_POST["phoneNum"];

    try {
        require_once "../dbh.inc.php";     // Connect to the database.
        require_once "signup_model.inc.php";
        require_once "signup_contr.inc.php";

        // ERROR HANDLING
        $errors = [];
        // 1) Empty data
        if (is_input_empty($username, $pwd, $email)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        // 2) Invalid Email
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invalid email used!";
        }

        // 3) Username already in use
        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already taken!";
        }

        // 4) Email already in use
        if (is_email_registered($pdo, $email)) {
            $errors["email_used"] = "Email already registered!";
        }

        // 5) Invalid Phone Number
        if (is_phone_invalid($phoneNum)) {
            $errors["invalid_phoneNum"] = "Invalid phone number!";
        }

        // Errors EXIST -> Start a session
        require_once "../config_session.inc.php";
        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            // Store the given data (apart from password), so that the user will not need to rewrite them.
            $signupData = [
                "username" => $username,
                "fname" => $fname,
                "lname" => $lname,
                "phoneNum" => $phoneNum,
                "email" => $email
            ];
            $_SESSION["signup_data"] = $signupData;


            header("Location: ../../index.php");
            die();
        }

        // Add a new registry in "customer".
        create_user($pdo, $username, $fname, $lname, $phoneNum, $pwd, $email);

        header("Location: ../../index.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

}
else {
    header("Location: ../../index.php");
    die();
}