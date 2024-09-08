<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture the form data
    $description = $_POST['description'];
    $discount = $_POST['discount'];
    $serviceID = $_POST['serviceID'];
    $image = $_FILES['image']['tmp_name'];
    // $imagePath = "images/offers/" . $image; // Save image path
    
    // Upload the image
    // move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

    require_once '../../dbh.inc.php';
    require_once '../admin_offers_model.inc.php';

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
        $image = $_FILES['image']['name'];
        $imagePath = "images/" . $image;
        
        insert_special_offer($pdo, $description, $discount, $imagePath, $serviceID);
        header("Location: ../../../admin_special_offers.php?add_special_offer=success");
        exit();
    } else {
        echo "Sorry, your file was not uploaded.";
        exit();
    }

    // Redirect to admin page with success message
    // header('Location: ../../admin_services.php?offer=success');
    // exit();
}
