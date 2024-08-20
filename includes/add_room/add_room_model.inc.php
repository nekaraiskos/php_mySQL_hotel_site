<?php

declare(strict_types=1);

function insert_room_to_table($pdo, $RoomName, $PricePerNight, $NumOfBeds, $RoomType, $HasHotTub, $Capacity, $imgContent) {
    // try {
        // Insert the room into the database
    $sql = "INSERT INTO room (RoomName, PricePerNight, NumOfBeds, RoomType, HasHotTub, Capacity, RoomImage) 
            VALUES (:RoomName, :PricePerNight, :NumOfBeds, :RoomType, :HasHotTub, :Capacity, :RoomImage)";

    $stmt = $pdo->prepare($sql);

    $stmt -> bindParam(":RoomName", $RoomName);
    $stmt -> bindParam(":PricePerNight", $PricePerNight);
    $stmt -> bindParam(":NumOfBeds", $NumOfBeds);
    $stmt -> bindParam(":RoomType", $RoomType);
    $stmt -> bindParam(":HasHotTub", $HasHotTub);
    $stmt -> bindParam(":Capacity", $Capacity);
    $stmt -> bindParam(":RoomImage", $imgContent);
    
    $stmt -> execute();
}