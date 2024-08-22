<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $roomid = $_POST["room_id"];

    try {
        require_once '../dbh.inc.php';
        require_once 'delete_room_model.inc.php';
        
        delete_room($pdo, $roomid);
        header("Location: ../../admin_room.php?delete=success");
        exit();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}