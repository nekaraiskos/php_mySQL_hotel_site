<?php

function delete_room($pdo, $RoomID) {
    
    $sql = "DELETE FROM room WHERE RoomID = $RoomID";
    
    $stmt = $pdo->prepare($sql);
    $stmt -> execute();

}