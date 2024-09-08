<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $offerID = $_POST['offer_id'];

    require_once '../dbh.inc.php';
    require_once 'admin_offers_model.inc.php';

    //Delete offer and return to page
    delete_offer($pdo, $offerID);
    header('Location: ../../admin_special_offers.php?deleteSpecialOffer=success');
    exit();
}