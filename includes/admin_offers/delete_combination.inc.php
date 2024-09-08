<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $offerID = $_POST['offer_id'];
    $roomID = $_POST['room_id'];

    require_once '../dbh.inc.php';
    require_once 'admin_offers_model.inc.php';

    //delete from combination the line that has both ID's(unique)
    delete_combination($pdo, $offerID, $roomID);
    header('Location: ../../admin_special_offers.php?deleteCombination=success');
    exit();
}