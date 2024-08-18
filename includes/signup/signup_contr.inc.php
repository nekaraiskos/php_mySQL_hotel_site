<?php

// Allow the code to have type declarations in order to avoid certain erros.
declare(strict_types=1);

function is_input_empty(string $username, string $pwd, string $email) {
    if(empty($username) || empty($pwd) || empty($email)) {
        return true;
    }
    else {
        return false;
    }
}

function is_email_invalid(string $email) {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    else {
        return false;
    }   
}

function is_username_taken(object $pdo, string $username) {
    if (get_username($pdo, $username)) {
        return true;
    }    
    else {
        return false;
    }
}

function is_email_registered(object $pdo, string $email) {
    if (get_email($pdo, $email)) {
        return true;
    }    
    else {
        return false;
    }
}

function is_phone_invalid(string $phone) {
    // This pattern matches phone numbers in various formats, e.g., +1234567890, (123) 456-7890, 123-456-7890
    $pattern = '/^\+?[0-9\s\-\(\)]{7,20}$/';
    
    if(!preg_match($pattern, $phone)) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $username, string $fname, string $lname, string $phoneNum, string $pwd, string $email) {
    set_user($pdo, $username, $fname, $lname, $phoneNum, $pwd, $email);
}