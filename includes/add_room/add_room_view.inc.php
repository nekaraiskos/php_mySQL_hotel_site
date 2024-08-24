<?php

require_once "add_room_model.inc.php";

function display_admin_rooms($pdo) {
    require_once "C:/xampp/htdocs/21_8/includes/dbh.inc.php";
    $rooms = get_admin_rooms($pdo);
    if(empty($rooms)) {
        echo  'No available rooms.';
    }
    else {
        // echo '<div class = "our_room">';
        echo '<div class="row">'; // Open row with rooms 
        foreach ($rooms as $room) {
                
            echo '<div class="col-md-4 col-sm-6">';
            echo '<div id="serv_hover" class="room">';
            
            // Display the room image wrapped in an anchor tag
            echo '<div class="room_img">';
            if (!empty($room['Image'])) {
                $imageData = base64_encode($room['Image']);
                $imageSrc = 'data:image/jpeg;base64,' . $imageData; // Adjust MIME type based on image format
                echo '<figure><img src="' . $imageSrc . '" alt="#" /></figure>';
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
            echo 'Price Per Night: &#8364' . htmlspecialchars($room['PricePerNight']) . '</p>';

            echo '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editRoomModal' . $room['RoomID'] . '">Edit</button> ';
            // echo '<button type="button" class="btn btn-danger" onclick="deleteRoom(' . $room['RoomID'] . ')">Delete</button>';
            // echo '<br>';

            // Add the Delete button form
            echo '<form action="includes/delete_room/delete_room.inc.php" method="post" onsubmit="return confirm(\'Are you sure you want to delete this room?\');">';
            echo '<input type="hidden" name="room_id" value="' . htmlspecialchars($room['RoomID']) . '">';
            echo '<button type="submit" class="btn btn-danger">Delete</button>';
            echo '</form>';


            // create_edit_room_modal($room);
            generate_edit_modal($room);

            echo '</div>'; // Close .bed_room
            echo '</div>'; // Close .room
            echo '</div>'; // Close .col-md-4
        }        
        echo '</div>'; // Close .row
    }     
}
function generate_edit_modal($room) {
    ?>
    <div class="modal fade" id="editRoomModal<?php echo $room['RoomID']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Room - <?php echo htmlspecialchars($room['RoomName']); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="includes/edit_room/edit_room.inc.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="room_id" value="<?php echo $room['RoomID']; ?>">
                        
                        <div class="form-group">
                            <label for="RoomName">Room Name</label>
                            <input type="text" id="RoomName" name="room_name" class="form-control" value="<?php echo htmlspecialchars($room['RoomName']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="PricePerNight">Price Per Night</label>
                            <input type="number" id="PricePerNight" name="price_per_night" class="form-control" value="<?php echo htmlspecialchars($room['PricePerNight']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="NumOfBeds">Number of Beds</label>
                            <input type="number" id="NumOfBeds" name="num_of_beds" class="form-control" value="<?php echo htmlspecialchars($room['NumOfBeds']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="RoomType">Room Type</label>
                            <select id="RoomType" name="room_type" class="form-control">
                                <option value="Single" <?php if ($room['RoomType'] == 'Single') echo 'selected'; ?>>Single</option>
                                <option value="Double" <?php if ($room['RoomType'] == 'Double') echo 'selected'; ?>>Double</option>
                                <option value="Suite" <?php if ($room['RoomType'] == 'Suite') echo 'selected'; ?>>Suite</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="HasHotTub">Has Hot Tub</label>
                            <input type="checkbox" id="HasHotTub" name="has_hot_tub" class="form-control" <?php if ($room['HasHotTub']) echo 'checked'; ?>>
                        </div>

                        <div class="form-group">
                            <label for="Capacity">Capacity</label>
                            <input type="number" id="Capacity" name="capacity" class="form-control" value="<?php echo htmlspecialchars($room['Capacity']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="Image">Room Image</label>
                            <input type="file" id="Image" name="image" class="form-control">
                            <?php if (!empty($room['Image'])): ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($room['Image']); ?>" alt="Room Image" class="room-image" style="width: 100px; height: 100px;">
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}


function create_edit_room_modal($room) {
    echo '<div class="modal fade" id="#editRoomModal' . $room['RoomID'] . '" tabindex="-1">';
    //modal structure
    echo '<div class="modal-dialog">';
    echo '<div class="modal-content">';
    echo '<div class="modal-header">';
    echo '<h5 class="modal-title" id="addRoomModalLabel"> Edit Room ' . $room['RoomName'] .'</h5>';
    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>';
    echo '</div>'; // Close .modal-header

    echo '<div class="modal-body">';
    echo '<form action="../edit_room/edit_room.inc.php" method="post" enctype="multipart/form-data">';

    echo '<div class="form-group">';
    echo '<label for="RoomNum" class="form-label">Room Name </label>';
    echo '<input type="text" id="RoomName" name="room_name" class="form-control">';
    echo '</div>'; // Close .form-group

    echo '<div class="form-group">';
    echo '<label for="PricePerNight" class="form-label">Price Per Night </label>';
    echo '<input type="number" id="PricePerNight" name="price_per_night" class="form-control">';
    echo '</div>'; // Close .form-group price 

    echo '<div class="form-group">';
    echo '<label for="NumOfBeds" class="form-label">Number of Beds </label>';
    echo '<input type="number" id="NumOfBeds" name="num_of_beds" class="form-control">';
    echo '</div>'; // Close .form-group num of beds

    echo '<div class="form-group">';
    echo '<label for="RoomType" class="form-label">Room Type </label>';
    echo '<input type="text" id="RoomType" name="room_type" class="form-control">';
    echo '</div>'; // Close .form-group num of room type

    echo '<div class="form-group">';
    echo '<label for="HasHotTub" class="form-label">Has Hot Tub </label>';
    echo '<input type="checkbox" id="HasHotTub" name="has_hot_tub" class="form-control">';
    echo '</div>'; // Close .form-group num of hot tub

    echo '<div class="form-group">';
    echo '<label for="Capacity" class="form-label">Capacity </label>';
    echo '<input type="number" id="Capacity" name="capacity" class="form-control">';
    echo '</div>'; // Close .form-group num of capacity

    echo '<div class="form-group">';
    echo '<label for="Image">Room Image</label>';
    echo '<input type="file" id="Image" name="image" class="form-control">';
    if (!empty($room['Image'])){ 
        echo '<img src="data:image/jpeg;base64, base64_encode(' . $room['Image'] . '); " alt="Room Image" class="room-image" style="width: 100px; height: 100px;">';
    }
    echo '</div>';

    echo '<button type="submit" class="btn btn-primary">Save</button>';
    echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>';

    echo '</div>';
    echo '</div>';
    echo '</div>';
}

// Function to generate the HTML for each room slot
function generate_room_slot($room) {
    ob_start(); // Start output buffering to capture the HTML
    ?>
    <div class="bed_room">
        <h3><?php echo htmlspecialchars($room['RoomName']); ?></h3>
        <p>Price Per Night: $<?php echo htmlspecialchars($room['PricePerNight']); ?></p>
        <p>Number of Beds: <?php echo htmlspecialchars($room['NumOfBeds']); ?></p>
        <p>Room Type: <?php echo htmlspecialchars($room['RoomType']); ?></p>
        <p>Capacity: <?php echo htmlspecialchars($room['Capacity']); ?></p>
        <p>Has Hot Tub: <?php echo $room['HasHotTub'] ? 'Yes' : 'No'; ?></p>
        <img src="path/to/images/<?php echo htmlspecialchars($room['Image']); ?>" alt="Room Image" class="room-image">
    </div>
    <?php
    return ob_get_clean(); // Return the captured HTML
}
// } catch (PDOException $e) {
//     die("Query failed: " . $e->getMessage());
// }
