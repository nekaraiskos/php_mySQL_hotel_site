<?php

require_once 'admin_offers_model.inc.php';
// Fetch all special offers from the database
// $sql = "SELECT * FROM special_offers";
// $stmt = $pdo->prepare($sql);
// $stmt->execute();
// $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);


function display_special_offers($pdo) {
    require_once 'includes/dbh.inc.php';
    $offers = get_special_offers($pdo);
    if (empty($offers)) {
        echo '<p>No special offers available.</p>';
    } else {
        echo '<div class="row">'; // Open row with special offers 
        foreach ($offers as $offer) {
            echo '<div class="col-md-4 col-sm-6">';
            echo '<div id="serv_hover" class="room">';
            echo '<div class="room_img">';

            // Display the offer image, with a placeholder if no image is available
            if (!empty($offer['Image'])) {
                $imageSrc = htmlspecialchars($offer['Image']);
                echo '<figure><img src="' . $imageSrc . '" alt="Offer Image" /></figure>';
            } else {
                echo '<p>No image available.</p>'; //'<figure><img src="images/placeholder.jpg" alt="No Image Available" /></figure>';
            }
            echo '</a>';
            echo '</div>'; // Close offer_img

            $services = get_services_with_types($pdo); // Function to fetch services and types
            foreach ($services as $service) {
                if($service['ServiceID'] == $offer['ServiceID']) {
                    $serviceName = $service['ServiceName'];
                    break;
                }
            }

            echo '<div class="bed_room">';
            echo '<h3>' . htmlspecialchars($offer['Description']) . '</h3>';
            echo '<p>Discount: ' . htmlspecialchars($offer['Discount']) . '%</br>';
            echo '<p>Associated Service: ' . htmlspecialchars($serviceName) . '</p>';

            // Add to Room button
            echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addOfferToRoomModal' . $offer['SpecialOfferID'] . '">Add to Room</button>';
            echo '</br><button type="button" class="btn btn-success" data-toggle="modal" data-target="#deleteCombinationModal' . $offer['SpecialOfferID'] . '">Remove Connection to Room</button>';
            echo '</br>';
            // Edit and Delete buttons
            echo '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editOfferModal' . $offer['SpecialOfferID'] . '">Edit</button>';
                
            
            echo '<form action="includes/admin_offers/delete_offer.inc.php" method="post" onsubmit="return confirm(\'Are you sure you want to delete this offer?\');">';
            echo '<input type="hidden" name="offer_id" value="' . htmlspecialchars($offer['SpecialOfferID']) . '">';
            echo '<button type="submit" class="btn btn-danger">Delete</button>';
            echo '</form>';

            // echo '
            echo '</div>';
            echo '</div>';
            echo '</div>';

            // Generate the edit modal for the offer
            generate_edit_offer_modal($offer, $pdo);

            // Generate the add-to-room modal for the offer
            generate_add_to_room_modal($offer, $pdo);
            generate_delete_combination_modal($offer, $pdo);
        }
        echo '</div>';
    }
}
?>

<?php
// Function to generate the edit modal for each offer
function generate_edit_offer_modal($offer, $pdo) {
    ?>
    <div class="modal fade" id="editOfferModal<?php echo $offer['SpecialOfferID']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Offer <?php // echo htmlspecialchars($offer['Description']); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="includes/admin_offers/edit_offer.inc.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="offer_id" value="<?php echo $offer['SpecialOfferID']; ?>">

                        <div class="form-group">
                            <label for="Description">Offer Description</label>
                            <textarea id="Description" name="description" class="form-control" rows="3" required><?php echo htmlspecialchars($offer['Description']); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="Discount">Discount (%)</label>
                            <input type="number" id="Discount" name="discount" class="form-control" value="<?php echo htmlspecialchars($offer['Discount']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="Image">Offer Image</label>
                            <input type="file" id="Image" name="image" class="form-control">
                            <?php if (!empty($offer['Image'])): ?>
                                <img src="<?php echo htmlspecialchars($offer['Image']); ?>" alt="Offer Image" class="offer-image" style="width: 100px; height: 100px;">
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                        <?php
                        // Assuming this variable is retrieved before rendering the form (for example, from the database)
                        $selectedServiceID = $offer['ServiceID'];  // This should be passed when editing a special offer
                        echo '<label for="service">Select Service</label>';
                        echo '<select class="form-control" id="service" name="serviceID" required>';
                        echo '<option value="">-- Select a Service --</option>';
                            // <?php
                            // Fetch all services from the database and display as options in the dropdown
                        $services = get_services_with_types($pdo); // Function to fetch services and types
                        foreach ($services as $service) {
                            // Check if this service ID matches the selected one
                            $isSelected = ($service['ServiceID'] == $selectedServiceID) ? 'selected' : '';
                            
                            // Output the option tag with the service name and type, with the selected attribute if applicable
                            echo "<option value='" . htmlspecialchars($service['ServiceID']) . "' $isSelected>" 
                                . htmlspecialchars($service['ServiceName']) . " (" . htmlspecialchars($service['ServiceType']) . ")</option>";
                        }
                        ?>
                        </select>

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

// Function to generate the "Add to Room" modal for each offer
function generate_add_to_room_modal($offer, $pdo) {
    ?>
    <div class="modal fade" id="addOfferToRoomModal<?php echo $offer['SpecialOfferID']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Offer to Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="includes/admin_offers/add_offer_to_room.inc.php" method="post">
                        <input type="hidden" name="offer_id" value="<?php echo $offer['SpecialOfferID']; ?>">

                        <div class="form-group">
                            <label for="room_id">Select Room</label>
                            <select id="room_id" name="room_id" class="form-control" required>
                                <option value="">-- Select a Room --</option>
                                <?php
                                // Fetch all rooms from the database
                                $sqlRooms = "SELECT * FROM room";
                                $stmtRooms = $pdo->prepare($sqlRooms);
                                $stmtRooms->execute();
                                $rooms = $stmtRooms->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($rooms as $room) {
                                    echo '<option value="' . htmlspecialchars($room['RoomID']) . '">' . htmlspecialchars($room['RoomName']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Offer to Room</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function generate_delete_combination_modal($offer, $pdo) {
    ?>
    <div class="modal fade" id="deleteCombinationModal<?php echo $offer['SpecialOfferID']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Combination with Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="includes/admin_offers/delete_combination.inc.php" method="post">
                        <input type="hidden" name="offer_id" value="<?php echo $offer['SpecialOfferID']; ?>">

                        <div class="form-group">
                            <label for="room_id">Select Room</label>
                            <select id="room_id" name="room_id" class="form-control" required>
                                <option value="">-- Select a Room --</option>
                                <?php
                                // Fetch all rooms from the database
                                $sqlRooms = "SELECT r.* FROM room r JOIN combination c ON r.RoomID = c.RoomID WHERE c.SpecialOfferID = :offer_id;" ;
                                $stmtRooms = $pdo->prepare($sqlRooms);
                                $stmtRooms->bindParam(':offer_id', $offer['SpecialOfferID'], PDO::PARAM_INT);
                                $stmtRooms->execute();
                                $rooms = $stmtRooms->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($rooms as $room) {
                                    echo '<option value="' . htmlspecialchars($room['RoomID']) . '">' . htmlspecialchars($room['RoomName']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
