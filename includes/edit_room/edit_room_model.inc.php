<?php

function edit_room_no_image($pdo, $RoomID, $RoomName, $PricePerNight, $NumOfBeds, $RoomType, $HasHotTub, $Capacity) {

    $sql = "UPDATE room 
            SET RoomName = :RoomName, PricePerNight = :PricePerNight, NumOfBeds = :NumOfBeds, RoomType = :RoomType, HasHotTub = :HasHotTub, Capacity = :Capacity
            WHERE RoomID = $RoomID";

    $stmt = $pdo->prepare($sql);

    $stmt -> bindParam(":RoomName", $RoomName);
    $stmt -> bindParam(":PricePerNight", $PricePerNight);
    $stmt -> bindParam(":NumOfBeds", $NumOfBeds);
    $stmt -> bindParam(":RoomType", $RoomType);
    $stmt -> bindParam(":HasHotTub", $HasHotTub);
    $stmt -> bindParam(":Capacity", $Capacity);
   
    $stmt -> execute();
}

function edit_room($pdo, $RoomID, $RoomName, $PricePerNight, $NumOfBeds, $RoomType, $HasHotTub, $Capacity, $imgContent) {

    $sql = "UPDATE room 
            SET RoomName = :RoomName, PricePerNight = :PricePerNight, NumOfBeds = :NumOfBeds, 
            RoomType = :RoomType, HasHotTub = :HasHotTub, Capacity = :Capacity, Image = :ImgContent 
            WHERE RoomID = $RoomID";

    $stmt = $pdo->prepare($sql);

    $stmt -> bindParam(":RoomName", $RoomName);
    $stmt -> bindParam(":PricePerNight", $PricePerNight);
    $stmt -> bindParam(":NumOfBeds", $NumOfBeds);
    $stmt -> bindParam(":RoomType", $RoomType);
    $stmt -> bindParam(":HasHotTub", $HasHotTub);
    $stmt -> bindParam(":Capacity", $Capacity);
    $stmt->bindParam(":ImgContent", $imgContent);
    
    $stmt -> execute();
}