<?php

function output_special_offers() {
    if (isset($_SESSION['special_offers'])) {
        $special_offers = $_SESSION['special_offers'];
    
        // Display the available rooms
        foreach ($special_offers as $offer) {
            // URL for booking the specific room
            $bookingUrl = 'includes/offers/offers.inc.php?offer_id=' . urlencode($offer['SpecialOfferID']);
            
            echo '<div class="col-md-4 col-sm-6">';
            echo '<div id="serv_hover" class="room">';
            
            // Display the room image wrapped in an anchor tag
            echo '<div class="room_img">';
            echo '<a href="' . $bookingUrl . '">';
            
            if (!empty($offer['Image'])) {
                $imageSrc = htmlspecialchars($offer['Image']); // Sanitize the image path
                echo '<div class="room-image-container">';
                echo '<img class="room-image" src="' . $imageSrc . '" alt="Offer Image" />';
                echo '</div>';
            } else {
                echo '<div class="room-image-container">';
                echo '<img class="room-image" src="images/placeholder.jpg" alt="No Image Available" />';
                echo '</div>';
            }
            
            echo '</a>'; // Close anchor tag
            echo '</div>'; // Close .room_img
            
            echo '<div class="bed_room">';
            echo '<h3> Discount: ' . htmlspecialchars($offer['Discount']) . '</h3>';            
            echo '<p>' . htmlspecialchars($offer['Description']) . '<br>';
            
            echo '<a href="' . $bookingUrl . '" class="btn btn-primarystyle="padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none;">See More</a>'; // Book Now button
            echo '</div>'; // Close .bed_room
            
            echo '</div>'; // Close .room
            echo '</div>'; // Close .col-md-4
        }        
    }     
    else {
        echo 'No available Offers found.';
    }
}

function output_the_offer() {
    if (isset($_SESSION['special_offer'])) {
        $special_offer = $_SESSION['special_offer'];

        echo "<div class='row'>";
        echo "<div class='col-md-12'>";
        echo "<div class='titlepage'>";
        echo "<p class='margin_0'>" . htmlspecialchars($special_offer['Description']) .  "</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        if(isset($_SESSION['offer_rooms'])) {

            $offer_rooms = $_SESSION['offer_rooms'];
            // Display the available rooms
            foreach ($offer_rooms as $room) {
                echo '<div class="room-details">';
                if (!empty($room['Image'])) {
                    $imageSrc = htmlspecialchars($room['Image']); // Sanitize the image path
                    echo '<div class="room-image-container">';
                    echo '<img class="room-image" src="' . $imageSrc . '" alt="Room Image" />';
                    echo '</div>';
                } else {
                    echo '<div class="room-image-container">';
                    echo '<img class="room-image" src="images/placeholder.jpg" alt="No Image Available" />';
                    echo '</div>';
                }
                
                echo '<div class="room-info">';
                echo '<h2>' . htmlspecialchars($room['RoomName']) . '</h3>';
                echo '<h3>' . "Room Type: " . htmlspecialchars($room['RoomType']) . '</h3>';
                echo '<h3>' . "Number Of Beds: " . htmlspecialchars($room['NumOfBeds']) . '</h3>';
                echo '<h3>' . "Capacity: " . htmlspecialchars($room['Capacity']) . '</h3>';
                
                if ($room['HasHotTub'] == 1) {
                    echo '<h3 class="hot-tub">Hot Tub Included</h3>';
                }
                echo '</div>';
                echo '</div>';
            }
        }
        else {
            echo 'No available Rooms';
        }
    
        
    }     
    else {
        echo 'No available Offers found.';
    }
    
}