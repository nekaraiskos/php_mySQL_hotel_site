<?php
//                              TAKE CARE OF QUERING THE DATABASE 

// Allow the code to have type declarations in order to avoid certain erros.
declare(strict_types=1);


function get_user(object $pdo, string $username) {

    // Search if the given username exists in table "customer" and if it does, return the whole registry.
    $query = "SELECT * FROM customer WHERE username = :username;";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);    
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);  // Use the name of the collumn and not the index of the table for reference.
    return $results;
}

function get_admin(object $pdo, string $username) {

    // Search if the given username exists in table "customer" and if it does, return the whole registry.
    $query = "SELECT * FROM admin_table WHERE username = :username;";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);    
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);  // Use the name of the collumn and not the index of the table for reference.
    return $results;
}
