<?php
function output_available_rooms($arrival, $departure) {
    if (isset($_SESSION['available_rooms'])) {
        $availableRooms = $_SESSION['available_rooms'];
    
        // Display the available rooms
        foreach ($availableRooms as $room) {
            // URL for booking the specific room
            $bookingUrl = 'room_details.php?room_id=' . urlencode($room['RoomID'])
                                         . '&arrival=' . urlencode($arrival) . '&departure=' . urlencode($departure);
            
            echo '<div class="col-md-4 col-sm-6">';
            echo '<div id="serv_hover" class="room">';
            
            // Display the room image wrapped in an anchor tag
            echo '<div class="room_img">';
            echo '<a href="' . $bookingUrl . '">';
            
            if (!empty($room['Image'])) {
                $imageData = base64_encode($room['Image']);
                $imageSrc = 'data:image/jpeg;base64,' . $imageData; // Adjust MIME type based on image format
                echo '<figure><img src="' . $imageSrc . '" alt="Room Image" /></figure>';
            } else {
                echo '<figure><img src="images/placeholder.jpg" alt="No Image Available" /></figure>'; // Use a placeholder image if no image is available
            }
            
            echo '</a>'; // Close anchor tag
            echo '</div>'; // Close .room_img
            
            echo '<div class="bed_room">';
            echo '<h3>' . htmlspecialchars($room['RoomName']) . '</h3>';            
            echo '<p>Room Type: ' . htmlspecialchars($room['RoomType']) . '<br>';
            echo '<p>Number Of Beds: ' . htmlspecialchars($room['NumOfBeds']) . '<br>';
            echo 'Capacity: ' . htmlspecialchars($room['Capacity']) . '<br>';
            if ($room['HasHotTub'] == 1) {
                echo 'Hot Tub Included<br>';
            }
            echo 'Price Per Night: $' . htmlspecialchars($room['PricePerNight']) . '</p>';
            echo '<a href="' . $bookingUrl . '" class="btn-primary">Book Now</a>'; // Book Now button
            echo '</div>'; // Close .bed_room
            
            echo '</div>'; // Close .room
            echo '</div>'; // Close .col-md-4
        }        
    }     
    else {
        echo 'No available rooms found.';
    }    
}

function output_room_info($curr_room, $arrival, $departure, $user_id) {
    echo '<div class="room-details">';
    
    if (!empty($curr_room['Image'])) {
        $imageData = base64_encode($curr_room['Image']);
        $imageSrc = 'data:image/jpeg;base64,' . $imageData;
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
    echo '<h3 class="price-per-night">Price Per Night: $' . htmlspecialchars($curr_room['PricePerNight']) . '</h3>';    
    echo '<h3 class="price-per-night">Stay Duration: ' . $stayDuration . ' nights</h3>';     
    echo '<h3 class="price-per-night">Total cost: $' . ($stayDuration * $curr_room['PricePerNight']) . '</h3>';
    // Book Now Button
    // $bookingUrl = 'booking.php?room_id=' . urlencode($curr_room['RoomID']);
    // echo '<a href="' . $bookingUrl . '" class="btn btn-primary">Book Now</a>';
    // Inside your current code:
    echo '<form action="includes/book_now/make_simple_resrv.inc.php" method="POST">';
    echo '<input type="hidden" name="room_id" value="' . htmlspecialchars($curr_room['RoomID']) . '">';
    echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($user_id) . '">';
    echo '<input type="hidden" name="arrival" value="' . htmlspecialchars($arrival) . '">';
    echo '<input type="hidden" name="departure" value="' . htmlspecialchars($departure) . '">';    
    echo '<input type="hidden" name="totalCost" value="' . htmlspecialchars($stayDuration * $curr_room['PricePerNight']) . '">';
    echo '<button type="submit" class="btn btn-primary">Book Now</button>';
    echo '</form>';

    echo '</div>'; // Close .room-info
    echo '</div>'; // Close .room-details
}
?>
