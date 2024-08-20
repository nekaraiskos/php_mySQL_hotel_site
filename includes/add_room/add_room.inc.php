<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grab data from the user
    // $username = $_POST["username"];
    // $pwd = $_POST["pwd"];
    // $usertype = $_POST["user_type"];

    $roomname = $_POST["room_name"];
    $pricepernight = $_POST["price_per_night"];
    $numofbeds = $_POST["num_of_beds"];
    $roomtype = $_POST["room_type"];
    // if (isset($_POST["has_hot_tub"])) {
    //     $hashottub = 1;
    // } else $hashottub = 0;
    isset($_POST["has_hot_tub"]) ? $hashottub = 1 : $hashottub = 0;
    // $hashottub = $_POST["has_hot_tub"];
    $capacity = $_POST["capacity"];
    // $target_dir = "../../images";
    // $target_file = $target_dir . basename($_FILES["image"]["name"]);
    // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $image = $_FILES["image"]['tmp_name'];
    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';

    try {
        require_once "../dbh.inc.php";     // Connect to the database.
        require_once "add_room_model.inc.php";
        require_once "add_room_contr.inc.php";

        // ERROR HANDLING
        $errors = [];

        // Handle image upload
        // $image = $_FILES['image']['tmp_name'];
        $imgContent = file_get_contents($image);

        // Check if image file is an actual image or fake image
        $check = getimagesize($image);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (Optional: You can remove this if not needed)
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            insert_room_to_table($pdo, $roomname, $pricepernight, $numofbeds, $roomtype, $hashottub, $capacity, $image);
    
            header("Location: ../../admin_room.html?upload=success");
            // echo
            // exit();

        } else {
            echo "Sorry, your file was not uploaded.";
            exit();
        }

        // check_login_errors($_SESSION["user_username"]); // <!--This is the problem --
        // die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

}
else {
    die();
}