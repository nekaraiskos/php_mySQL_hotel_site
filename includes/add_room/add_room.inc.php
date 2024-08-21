<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $roomname = $_POST["room_name"];
    $pricepernight = $_POST["price_per_night"];
    $numofbeds = $_POST["num_of_beds"];
    $roomtype = $_POST["room_type"];
    $hashottub = isset($_POST["has_hot_tub"]) ? 1 : 0;
    $capacity = $_POST["capacity"];
    $image = $_FILES["image"]['tmp_name'];

    try {
        require_once "../dbh.inc.php"; // Database connection
        require_once "add_room_model.inc.php";
        require_once "add_room_contr.inc.php";

        $errors = [];

        $imgContent = file_get_contents($image);

        // Check if the file is a valid image
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

        if ($uploadOk == 1) {
            insert_room_to_table($pdo, $roomname, $pricepernight, $numofbeds, $roomtype, $hashottub, $capacity, $imgContent);
            header("Location: ../../admin_room.html?upload=success");
            exit();
        } else {
            echo "Sorry, your file was not uploaded.";
            exit();
        }

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    die();
}
