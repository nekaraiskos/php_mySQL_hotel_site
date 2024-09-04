<?php

// Allow the code to have type declarations in order to avoid certain erros.
declare(strict_types=1);

// If we have some data from a previous try that had an error, include that data inside the form,
// so the user will not need to rewrite them.
function signup_inputs() {
    // If the username was given AND it has NOT already been taken, set it again.
    echo '<div class="form-group">';
    if (isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["errors_signup"]["username_taken"])) {
        echo '<input type="text" name="username" placeholder="Username" value="' . $_SESSION["signup_data"]["username"] . '">';        
    }
    else {
        echo '<input type="text" name="username" placeholder="Username">';
    }
    echo '</div>';

    // If the Fname was given , set it again.
    echo '<div class="form-group">';
    if (isset($_SESSION["signup_data"]["fname"])) {        
        echo '<input type="text" name="fname" placeholder="First Name" value="' . $_SESSION["signup_data"]["fname"] . '">';        
    }
    else {
        echo '<input type="text" name="fname" placeholder="First Name">';
    }
    echo '</div>';

    // If the Lname was given , set it again.
    echo '<div class="form-group">';
    if (isset($_SESSION["signup_data"]["lname"])) {
        echo '<input type="text" name="lname" placeholder="Last Name" value="' . $_SESSION["signup_data"]["lname"] . '">';
        
    }
    else {
        echo '<input type="text" name="lname" placeholder="Last Name">';
    }
    echo '</div>';

    // The user should always re-enter the password.
    echo '<div class="form-group">';
    echo '<input type="password" name="pwd" placeholder="Password">';
    echo '</div>';

    // If the email was given AND it was valid, set it again.
    echo '<div class="form-group">';
    if (isset($_SESSION["signup_data"]["email"]) && 
        !isset($_SESSION["errors_signup"]["email_used"]) && 
        !isset($_SESSION["errors_signup"]["invalid_email"])) {
        echo '<input type="text" name="email" placeholder="E-mail" value="' . $_SESSION["signup_data"]["email"] . '">';
    }
    else {
        echo '<input type="text" name="email" placeholder="E-mail">';
    }
    echo '</div>';

    // If the phone number was given AND it was valid, set it again.
    echo '<div class="form-group">';
    if (isset($_SESSION["signup_data"]["phoneNum"]) && !isset($_SESSION["errors_signup"]["invalid_phoneNum"])) {
        echo '<input type="text" name="phoneNum" placeholder="Phone Number" value="' . $_SESSION["signup_data"]["phoneNum"] . '">';
    }
    else {
        echo '<input type="text" name="phoneNum" placeholder="Phone Number">';
    }    
    echo '</div>';

    unset($_SESSION['signup_data']);
    
}

function check_signup_errors() {
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];

        echo "<br>";
        foreach ($errors as $error) {
            echo "<p>" . $error . "</p>";
        }

        // After using a session variable delete it for security reasons.
        unset($_SESSION['errors_signup']);
    }

    else if (isset($_GET["signup"]) && $_GET["signup"] == "success") {
        echo "<br>";
        echo "<p>Signup Success!</p>";
    }
}


