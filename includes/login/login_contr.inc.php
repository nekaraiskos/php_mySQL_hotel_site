<?php

// bool -> $results is empty 
// array -> $results has the registry 
function is_username_wrong(bool|array $results) {

    if (!$results) {
        return true;
    }
    else {
        return false;
    }
}

function is_password_wrong(string $pwd, string $hashedPwd) {
    return !password_verify($pwd, $hashedPwd);
}

function is_input_empty(string $username, string $pwd) {
    if(empty($username) || empty($pwd)) {
        return true;
    }
    else {
        return false;
    }
}