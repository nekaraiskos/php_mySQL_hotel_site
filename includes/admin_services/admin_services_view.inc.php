<?php

function display_admin_activity_services($pdo) {

    $sql = 'SELECT * FROM service s JOIN activity a ON s.ServiceID = a.ServiceID';
    $stmt = $pdo -> prepare($sql);
    $stmt ->execute();

    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<div class="row>';
    foreach($activities as $activity) {
        echo '<div class="col-md-4 col-sm-6">';
        echo '<div id="serv_hover" class="room">';

        echo '<div class="room_img">';
        // Display image
        if (!empty($activity['Image'])) {
            // Use the relative path stored in the database
            $imageSrc = htmlspecialchars($activity['Image']);
            echo "<figure><img src='" . $imageSrc . "' alt='Activity Image' /></figure>";
        } else {
            echo '<p>No image available.</p>';
        }

        echo '<div class="bed_room">';
        echo "<h3>" . htmlspecialchars($activity['ServiceName']) . "</h3>";
        echo '<p>' . "Description: " . htmlspecialchars($activity['Description']) . '</p>';
        echo '<p>' . "Difficulty Level: " . htmlspecialchars($activity['DifficultyLevel']) . '</p>';
        echo '<p>' . "Minimum Age: " . htmlspecialchars($activity['MinimumAge']) . '</p>';
        echo '<p>' . "Guide Required: " . htmlspecialchars(($activity['GuideRequired'] == 0? "Yes": "No")) . '</p>';
        echo '<p>' . "Booking Required: " . htmlspecialchars(($activity['BookingRequired'] == 0? "Yes": "No")) . '</p>';
        echo '<p>' . "Duration(hours): " . htmlspecialchars($activity['Duration']) . '</p>';
        echo '<p>' . "Price: " . htmlspecialchars($activity['Price']) . '&#8364</p>';
        echo '<p>' . "Availability Hours: " . htmlspecialchars($activity['AvailabilityHours']) . '</p>';

        echo '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editActivityModal' . $activity['ServiceID'] . '">Edit</button> ';

        echo '<form action="includes/admin_services/delete_activity_service.inc.php" method="post" onsubmit="return confirm(\'Are you sure you want to delete this room?\');">';
        echo '<input type="hidden" name="serviceID" value="' . htmlspecialchars($activity['ServiceID']) . '">';
        echo '<button type="submit" class="btn btn-danger">Delete</button>';
        echo '</form>';

        generate_edit_modal_activity($activity);
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

    }
    echo '</div>';
}

function generate_edit_modal_activity($activity) {
    ?>
    <div class="modal fade" id="editActivityModal<?php echo $activity['ServiceID']; ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Activity Service - <?php echo htmlspecialchars($activity['ServiceName']); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="includes/admin_services/edit_activity_services.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="serviceID" value="<?php echo $activity['ServiceID']; ?>">
                        
                        <div class="form-group">
                            <label for="ServiceName">Service Name</label>
                            <input type="text" id="ServiceName" name="serviceName" class="form-control" value="<?php echo htmlspecialchars($activity['ServiceName']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="Price">Price</label>
                            <input type="number" id="Price" name="price" class="form-control" value="<?php echo htmlspecialchars($activity['Price']); ?>">
                        </div>

                        <div class="form-group">
                            <label for="AvailabilityHours">Availability Hours</label>
                            <input type="text" id="AvailabilityHours" name="availabilityHours" class="form-control" value="<?php echo htmlspecialchars($activity['AvailabilityHours']); ?>">
                        </div>

                        <div class="form-group">
                              <label for="description">Description</label>
                              <textarea class="form-control" id="Description" name="description" rows="3" ><?php  echo htmlspecialchars($activity['Description']); ?></textarea>
                              <!-- value="<?php // echo htmlspecialchars($activity['Description']); ?>" -->
                        </div>

                        <div class="form-group">
                            <label for="Image">Room Image</label>
                            <input type="file" id="Image" name="image" class="form-control">
                            <?php if (!empty($activity['Image'])): ?>
                                <figure><img src='"<?php echo htmlspecialchars($activity['Image']); ?>"' alt='Activity Image' style="width: 100px; height: 100px;"></figure>";
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="difficultyLevel">Difficulty Level</label>
                            <input type="text" class="form-control" id="difficultyLevel" name="difficultyLevel" value="<?php echo htmlspecialchars($activity['DifficultyLevel']); ?>">
                        </div>

                        <div class="form-group">
                              <label for="minimumAge">Minimum Age</label>
                              <input type="number" class="form-control" id="minimumAge" name="minimumAge" value="<?php echo htmlspecialchars($activity['MinimumAge']); ?>">
                        </div>

                        <div class="form-group">
                              <label for="duration">Duration (in hours)</label>
                              <input type="text" class="form-control" id="duration" name="duration" value="<?php echo htmlspecialchars($activity['Duration']); ?>">
                        </div>
                        <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="bookingRequired" name="bookingRequired" <?php if (!$activity['BookingRequired']) echo 'checked'; ?>>
                              <label class="form-check-label" for="bookingRequired" >Booking Required</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="guideRequired" name="guideRequired" <?php if (!$activity['GuideRequired']) echo 'checked'; ?>>
                            <label class="form-check-label" for="guideRequired" >Guide Required</label>
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