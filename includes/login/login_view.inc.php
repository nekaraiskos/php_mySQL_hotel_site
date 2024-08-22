<?php

// Allow the code to have type declarations in order to avoid certain erros.
declare(strict_types=1);

function output_username() {
    if (isset($_SESSION["user_id"])) {
        echo "You are logged in as " . $_SESSION["user_username"];
    }
    else {
        echo "You are not logged in";
    }
}

function check_login_errors() {    
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        echo "<br>";

        foreach($errors as $error) {
            echo '<p>' . $error . '</p>';
        }

        unset($_SESSION["errors_login"]);

    }
    else if (isset($_GET["login_user"]) && $_GET["login_user"] == "success") {
        echo "<br>";
        echo "<p>Login Success!</p>";
        header("Location: main_page.php");      
    }    
    else if (isset($_GET["login_admin"]) && $_GET["login_admin"] == "success") {
        echo "<br>";
        echo "<p>Login Success!</p>";
        header("Location: admin_main_page.html");
    }
}