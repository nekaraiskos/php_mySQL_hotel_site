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
            echo '<h3> Discount: ' . htmlspecialchars($offer['Discount']) . '%</h3>';            
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

function output_the_offer($arrival, $departure) {
    if (isset($_SESSION['special_offer'])) {
        $special_offer = $_SESSION['special_offer'];

        echo "<div class='row'>";
        echo "<div class='col-md-12'>";
        echo "<div class='titlepage'>";
        echo "<p class='margin_0'>" . htmlspecialchars($special_offer['Description']) .  "</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        if (isset($_SESSION['offer_rooms'])) {
            $offer_rooms = $_SESSION['offer_rooms'];

            // Display the available rooms
            foreach ($offer_rooms as $room) {
                echo '<div class="room-details" style="margin-right:10px;">'; // Add vertical space here
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

                // Convert arrival and departure to DateTime objects
                $arrivalDate = new DateTime($arrival);
                $departureDate = new DateTime($departure);

                // Calculate the difference in days between check-in and check-out
                $stayDuration = $departureDate->diff($arrivalDate)->days;
        
                // Inside your current code:
                echo '<form action="book_offer.php" method="POST">';
                echo '<input type="hidden" name="room_id" value="' . htmlspecialchars($room['RoomID']) . '">';
                // echo '<input type="hidden" name="user_id" value="' . $_SESSION["user_id"] . '">';
                // echo '<input type="hidden" name="offer_id" value="' . htmlspecialchars($special_offer['SpecialOfferID']) . '">';
                echo '<input type="hidden" name="arrival" value="' . htmlspecialchars($arrival) . '">';
                echo '<input type="hidden" name="departure" value="' . htmlspecialchars($departure) . '">';    
                // echo '<input type="hidden" name="totalCost" value="' . htmlspecialchars($stayDuration * $room['PricePerNight']) . '">';
                // echo '<input type="hidden" name="discount" value="' . htmlspecialchars($special_offer['Discount']) . '">';

                echo '<button type="submit" class="btn btn-primary">Book Now</button>';
                echo '</form>';

                echo '</div>';
                echo '</div>';
            }
        } else {
            echo 'No available Rooms';
        }

    } else {
        echo 'No available Offers found.';
    }
}

function output_offer_info($curr_room, $special_offer, $service_name, $arrival, $departure, $user_id) {
    echo '<div class="room-details">';

    // Display the room image using the file path stored in the database
    if (!empty($curr_room['Image'])) {
        $imageSrc = htmlspecialchars($curr_room['Image']); // Sanitize the image path
        echo '<div class="room-image-container">';
        echo '<img class="room-image" src="' . $imageSrc . '" alt="Room Image" />';
        echo '</div>';
    } else {
        echo '<div class="room-image-container">';
        echo '<img class="room-image" src="images/placeholder.jpg" alt="No Image Available" />';
        echo '</div>';
    }
    
    echo '<div class="room-info">';
    echo '<h2>' . htmlspecialchars($curr_room['RoomName']) . '</h3>';
    echo '<h3>' . "Room Type: " . htmlspecialchars($curr_room['RoomType']) . '</h3>';
    echo '<h3>' . "Number Of Beds: " . htmlspecialchars($curr_room['NumOfBeds']) . '</h3>';
    echo '<h3>' . "Capacity: " . htmlspecialchars($curr_room['Capacity']) . '</h3>';
    
    if ($curr_room['HasHotTub'] == 1) {
        echo '<h3 class="hot-tub">Hot Tub Included</h3>';
    }

    // Convert arrival and departure to DateTime objects
    $arrivalDate = new DateTime($arrival);
    $departureDate = new DateTime($departure);

    // Calculate the difference in days between check-in and check-out
    $stayDuration = $departureDate->diff($arrivalDate)->days;

    echo '<h3>' . "Check-in: " . htmlspecialchars($arrival) . '</h3>';
    echo '<h3>' . "Check-out: " . htmlspecialchars($departure) . '</h3>';
    echo '<h3>' . "Included service: " . htmlspecialchars($service_name) . '</h3>';

    echo '<h3 class="price-per-night">Price Per Night: $' . htmlspecialchars($curr_room['PricePerNight']) . '</h3>';    
    echo '<h3 class="price-per-night">Stay Duration: ' . $stayDuration . ' nights</h3>';     
    echo '<h3 class="price-per-night">Offer Discount: ' . htmlspecialchars($special_offer['Discount']) . '</h3>';     

    $total_cost = $stayDuration * $curr_room['PricePerNight'] - $stayDuration * $curr_room['PricePerNight']*htmlspecialchars($special_offer['Discount'])/100;
    echo '<h3 class="price-per-night">Total cost: $' . ($total_cost) . '</h3>';
    // Book Now Button
    // $bookingUrl = 'make_special_resrv.inc.php';
    // echo '<a href="' . $bookingUrl . '" class="btn btn-primary">Book Now</a>';
    // Inside your current code:
    echo '<form action="includes/offers/make_special_resrv.inc.php" method="POST">';
    echo '<input type="hidden" name="room_id" value="' . htmlspecialchars($curr_room['RoomID']) . '">';
    echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($user_id) . '">';
    echo '<input type="hidden" name="offer_id" value="' . htmlspecialchars($special_offer['SpecialOfferID']) . '">';
    echo '<input type="hidden" name="arrival" value="' . htmlspecialchars($arrival) . '">';
    echo '<input type="hidden" name="departure" value="' . htmlspecialchars($departure) . '">';    
    echo '<input type="hidden" name="totalCost" value="' . $total_cost . '">';
    echo '<button type="submit" class="btn btn-primary">Book Now</button>';
    echo '</form>';

    echo '</div>'; // Close .room-info
    echo '</div>'; // Close .room-details
}
