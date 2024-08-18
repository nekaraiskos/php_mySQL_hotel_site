<?php
//                              TAKE CARE OF QUERING THE DATABASE 

// Allow the code to have type declarations in order to avoid certain erros.
declare(strict_types=1);


function get_username(object $pdo, string $username) {

    // Search table "customer" to check if the given username already exists.
    $query = "SELECT username FROM customer WHERE username = :username;";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);    
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);  // Use the name of the collumn and not the index of the table for reference.
    return $results;
}

function get_email(object $pdo, string $email) {

    // Search table "customer" to check if the given email already exists.
    $query = "SELECT email FROM customer WHERE email = :email;";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":email", $email);    
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);  // Use the name of the collumn and not the index of the table for reference.
    return $results;
}

function set_user(object $pdo, string $username, string $fname, string $lname, string $phoneNum, string $pwd, string $email) {
    // Search table "customer" to check if the given email already exists.
    $query = "INSERT INTO customer (username, pwd, email, fname, lname, phoneNumber) VALUES (:username, :pwd, :email, :fname, :lname, :phoneNum);";

    $stmt = $pdo->prepare($query);

    // Hash the password for security
    $options = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":fname", $fname);
    $stmt->bindParam(":lname", $lname);
    $stmt->bindParam(":phoneNum", $phoneNum);
    $stmt->execute();
}