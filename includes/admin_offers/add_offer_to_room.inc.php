<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $offerID = $_POST['offer_id'];
    $roomID = $_POST['room_id'];

    require_once '../dbh.inc.php';
    require_once 'admin_offers_model.inc.php';

    // Check if offer is already connected with the room

    //If yes, return without doing anything
    if(check_if_combination_exists($pdo, $roomID, $offerID)) {
        header('Location: ../../admin_special_offers.php?combinationAlreadyExists=True');
        exit();
    }

    //Else add new special offer with that room / entry to 'combination'
    add_new_combination($pdo, $roomID, $offerID);
    header('Location: ../../admin_special_offers.php?combination=success');
    exit();
}