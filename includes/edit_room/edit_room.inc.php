<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $roomid = $_POST["room_id"];
    $roomname = $_POST["room_name"];
    $pricepernight = $_POST["price_per_night"];
    $numofbeds = $_POST["num_of_beds"];
    $roomtype = $_POST["room_type"];
    $hashottub = isset($_POST["has_hot_tub"]) ? 1 : 0;
    $capacity = $_POST["capacity"];

    try {
        require_once '../dbh.inc.php';
        require_once 'edit_room_model.inc.php';
        require_once '../check_room_image.php';


        // Update Room Image if provided
        if (!empty($_FILES['image']['tmp_name'])) {
            $image = $_FILES['image']['tmp_name'];
            $imgContent = file_get_contents($image);
            // $uploadOk = check_image($image);
            $check = getimagesize($image);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Optional file size check
            if ($_FILES["image"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if($uploadOk == 1) {
                edit_room_image($pdo, $roomid, $roomname, $pricepernight, $numofbeds, $roomtype, $hashottub, $capacity, $imgContent);
                header("Location: ../../admin_room.php?edit=success");
                exit();
            }else {
                echo "Sorry, your file was not uploaded.";
                exit();
            }
            
        } else {

            edit_room_no_image($pdo, $roomid, $roomname, $pricepernight, $numofbeds, $roomtype, $hashottub, $capacity);
            header("Location: ../../admin_room.php?edit=success");
            exit();
            // $query = "UPDATE room SET RoomName = ?, PricePerNight = ?, NumOfBeds = ?, RoomType = ?, HasHotTub = ?, Capacity = ? WHERE RoomID = ?";
            // $stmt = $pdo->prepare($query);
            // $stmt->execute([$room_name, $price_per_night, $num_of_beds, $room_type, $has_hot_tub, $capacity, $room_id]);
        }

        // header("Location: ../../admin_room.php"); // Redirect back to the admin_room page
        // exit();

    }catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

}else {
    die();
}

