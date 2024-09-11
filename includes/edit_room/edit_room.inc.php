<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $roomid = $_POST["room_id"];
    $roomname = $_POST["room_name"];
    $pricepernight = $_POST["price_per_night"];
    $numofbeds = $_POST["num_of_beds"];
    $roomtype = $_POST["room_type"];
    $hashottub = isset($_POST["has_hot_tub"]) ? 1 : 0;
    $capacity = $_POST["capacity"];
    $image = $_FILES['image']['tmp_name'];

    try {
        require_once '../dbh.inc.php';
        require_once 'edit_room_model.inc.php';
        require_once '../check_room_image.php';


        // Handle image upload if a new image is uploaded
        if (!empty($_FILES['image']['tmp_name'])) {
            $imagePath = 'images/' . $_FILES['image']['name'];
        } else {
            $sql = 'SELECT Image FROM room WHERE RoomID = :RoomID';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':RoomID', $roomid, PDO::PARAM_INT);
            $stmt->execute();

            $imagePath = $stmt->fetchColumn();
        }

            

        edit_room($pdo, $roomid, $roomname, $pricepernight, $numofbeds, $roomtype, $hashottub, $capacity, $imagePath);
        header("Location: ../../admin_room.php?edit=success");
        exit();

    }catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

}else {
    die();
}

