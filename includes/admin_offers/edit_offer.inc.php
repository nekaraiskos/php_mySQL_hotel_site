<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include database connection
    require_once '../dbh.inc.php';
    require_once 'admin_offers_model.inc.php';
    
    // Get the form inputs
    $offerID = $_POST['offer_id'];
    $description = $_POST['description'];
    $discount = $_POST['discount'];
    $serviceID = $_POST['serviceID'];
    $image = $_FILES['image']['tmp_name'];
    
    $uploadOk = 1;

    // Check if the file is a valid image
    if(!empty($image)) {
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
    }

    if ($uploadOk == 1) {
        if (!empty($_FILES['image']['tmp_name'])) {
            $imagePath = 'images/' . $_FILES['image']['name'];
            // move_uploaded_file($_FILES['Image']['tmp_name'], $imagePath);
        } else {
            $sql = 'SELECT * FROM special_offer WHERE SpecialOfferID = :SpecialOfferID';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':SpecialOfferID', $offerID, PDO::PARAM_INT);
            $stmt->execute();
    
            // Step 2: Fetch the result
            $imagePath = $stmt->fetchAll(PDO::FETCH_ASSOC);
            print_r($imagePath);
            $imagePath = $imagePath[0]['Image'];
            echo '<pre>';
            print_r($imagePath);
            echo '</pre>';
        }
        
        edit_special_offer($pdo, $offerID, $description, $discount, $imagePath, $serviceID);
        header("Location: ../../admin_special_offers.php?edit_special_offer=success");
        exit();
    } else {
        echo "Sorry, editing failed.";
        exit();
    }

    // Validate the inputs (you can add more validation logic if needed)
    // if (empty($description) || empty($discount) || empty($serviceID)) {
    //     header("Location: ../../admin_offers.php?error=emptyfields");
    //     exit;
    // }



} else {
    // Redirect if the request method is not POST
    header("Location: ../../admin_offers.php");
    exit;
}
