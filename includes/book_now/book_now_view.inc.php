<?php
function output_available_rooms() {
    if (isset($_SESSION['available_rooms'])) {
        $availableRooms = $_SESSION['available_rooms'];
    
        // Display the available rooms
        foreach ($availableRooms as $room) {
            // URL for booking the specific room
            $bookingUrl = 'room_details.php?room_id=' . urlencode($room['RoomID']);
            
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
            //echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
            echo '</div>'; // Close .bed_room
            
            echo '</div>'; // Close .room
            echo '</div>'; // Close .col-md-4
        }
    
        // Optionally, clear the session variable if you no longer need it
        unset($_SESSION['available_rooms']);
    } else {
        echo 'No available rooms found.';
    }    
}
?>
