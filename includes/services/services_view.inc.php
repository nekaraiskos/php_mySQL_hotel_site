<?php

function output_activity_services() {

    // Check if the session variable exists
    if (isset($_SESSION['activities'])) {
        $activities = $_SESSION['activities'];

        // Process or display the services data as needed
        foreach ($activities as $activity) {
            echo "<div class='col-md-4'>";
            echo "<div class='services_box'>";
            echo "<div class='services_img'>";

            // Display image
            if (!empty($activity['Image'])) {
                // Use the relative path stored in the database
                $imageSrc = htmlspecialchars($activity['Image']);
                echo "<figure><img src='" . $imageSrc . "' alt='Activity Image' /></figure>";
            } else {
                echo '<p>No image available.</p>';
            }

            echo "</div>";
            echo "<div class='services_room'>";
            echo "<h3>" . htmlspecialchars($activity['ServiceName']) . "</h3>";
            echo "<span>The standard chunk </span>";
            echo "<p>" . htmlspecialchars($activity['Description']) . "</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No services data found.";
    }
}

function output_wellness_services() {

    // Check if the session variable exists
    if (isset($_SESSION['wellness'])) {
        $wellness = $_SESSION['wellness'];

        // Process or display the services data as needed
        foreach ($wellness as $service) {
            echo "<div class='col-md-4'>";
            echo "<div class='services_box'>";
            echo "<div class='services_img'>";

            // Display image
            if (!empty($service['Image'])) {
                // Use the relative path stored in the database
                $imageSrc = htmlspecialchars($service['Image']);
                echo "<figure><img src='" . $imageSrc . "' alt='service Image' /></figure>";
            } else {
                echo '<p>No image available.</p>';
            }

            echo "</div>";
            echo "<div class='services_room'>";
            echo "<h3>" . htmlspecialchars($service['ServiceName']) . "</h3>";
            echo "<span>The standard chunk </span>";
            echo "<p>" . htmlspecialchars($service['Description']) . "</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No services data found.";
    }
}

function output_culinary_services() {

    // Check if the session variable exists
    if (isset($_SESSION['culinary'])) {
        $culinary = $_SESSION['culinary'];

        // Process or display the services data as needed
        foreach ($culinary as $service) {
            echo "<div class='col-md-4'>";
            echo "<div class='services_box'>";
            echo "<div class='services_img'>";

            // Display image
            if (!empty($service['Image'])) {
                // Use the relative path stored in the database
                $imageSrc = htmlspecialchars($service['Image']);
                echo "<figure><img src='" . $imageSrc . "' alt='service Image' /></figure>";
            } else {
                echo '<p>No image available.</p>';
            }

            echo "</div>";
            echo "<div class='services_room'>";
            echo "<h3>" . htmlspecialchars($service['ServiceName']) . "</h3>";
            echo "<span>The standard chunk </span>";
            echo "<p>" . htmlspecialchars($service['Description']) . "</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No services data found.";
    }
}

function output_all_activities() {
    // Check if the session variable exists
    if (isset($_SESSION['services'])) {
        $activities = $_SESSION['services'];

        echo "<div class='col-md-12'>";

        // Process or display the services data as needed
        foreach ($activities as $activity) {
            echo "<div class='our_room'>";
            echo "<div class='container'>";
            echo "<div class='row'>";

            echo '<div class="activity-details" style="display: flex; align-items: flex-start; margin-bottom: 20px;">'; // Flexbox container

            // Display image
            if (!empty($activity['Image'])) {
                // Use the relative path stored in the database
                $imageSrc = htmlspecialchars($activity['Image']);
                echo "<figure style='margin-right: 20px;'><img src='" . $imageSrc . "' alt='Activity Image' width='500' height='400' style='border-radius: 10px;'/></figure>";
            } else {
                echo '<p>No image available.</p>';
            }

            // Textual information
            echo '<div class="activity-info" style="flex: 1;">';
            echo "<h2>" . htmlspecialchars($activity['ServiceName']) . "</h2>";
            echo '<h3>' . "Description: " . htmlspecialchars($activity['Description']) . '</h3>';
            echo '<h3>' . "Difficulty Level: " . htmlspecialchars($activity['DifficultyLevel']) . '</h3>';
            echo '<h3>' . "Minimum Age: " . htmlspecialchars($activity['MinimumAge']) . '</h3>';
            echo '<h3>' . "Guide Required: " . htmlspecialchars($activity['GuideRequired']) . '</h3>';
            echo '<h3>' . "Duration: " . htmlspecialchars($activity['Duration']) . '</h3>';
            echo '<h3>' . "Price: " . htmlspecialchars($activity['Price']) . '</h3>';
            echo '<h3>' . "Availability Hours: " . htmlspecialchars($activity['AvailabilityHours']) . '</h3>';

            if ($activity['BookingRequired'] == 1) {
                // Start form                
                echo "<form action='book_service.php' method='POST'>";
                echo "<input type='hidden' name='service_id' value='" . htmlspecialchars($activity['ServiceID']) . "' />";
                echo "<input type='hidden' name='type' value='" . htmlspecialchars($_SESSION['type']) . "' />";

                echo "<label for='num_people'>Number of people: </label>";
                echo "<select name='num_people' id='num_people'>";
                echo "<option value='1'>1</option>";
                echo "<option value='2'>2</option>";
                echo "<option value='3'>3</option>";
                echo "<option value='4'>4</option>";
                echo "<option value='5'>5</option>";
                echo "<option value='6'>6</option>";
                echo "<option value='7'>7</option>";
                echo "<option value='8'>8</option>";
                echo "<option value='9'>9</option>";
                echo "<option value='10'>10</option>";
                echo "</select>";
                
                echo "<br>";
                echo "Select time of booking: ";
                echo "<input type='time' name='appointed_time' step='1800' />";
                
                echo "<div style='text-align: left; margin-top: 10px;'>";
                echo "<button type='submit' class='btn btn-primary' style='padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none;'>";
                echo "Book Now";
                echo "</button>";
                echo "</div>";

                echo "</form>"; // End form
            } else {
                echo '<h3>' . "No booking required" . '</h3>';
            }

            echo '</div>'; // Close .activity-info
            echo '</div>'; // Close .activity-details
            echo "<hr>";

            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo '</div>'; // Close .col-md-12
    } else {
        echo "No services data found.";
    }  
}

function output_all_wellness() {
    // Check if the session variable exists
    if (isset($_SESSION['services'])) {
        $services = $_SESSION['services'];

        echo "<div class='col-md-12'>";

        // Process or display the services data as needed
        foreach ($services as $service) {
            echo "<div class='our_room'>";
            echo "<div class='container'>";
            echo "<div class='row'>";

            echo '<div class="activity-details" style="display: flex; align-items: flex-start; margin-bottom: 20px;">'; // Flexbox container

            // Display image
            if (!empty($service['Image'])) {
                // Use the relative path stored in the database
                $imageSrc = htmlspecialchars($service['Image']);
                echo "<figure style='margin-right: 20px;'><img src='" . $imageSrc . "' alt='Service Image' width='500' height='400' style='border-radius: 10px;'/></figure>";
            } else {
                echo '<p>No image available.</p>';
            }

            // Textual information
            echo '<div class="activity-info" style="flex: 1;">';
            echo "<h2>" . htmlspecialchars($service['ServiceName']) . "</h2>";
            echo '<h3>' . "Description: " . htmlspecialchars($service['Description']) . '</h3>';
            echo '<h3>' . "Room Type: " . htmlspecialchars($service['RoomType']) . '</h3>';

            if ($service['TherapistRequired'] == 1) {
                echo '<h3>' . "Therapist Required" . '</h3>';
            }
            else {
                echo '<h3>' . "Therapist not required" . '</h3>';
            }
            echo '<h3>' . "Treatment type: " . htmlspecialchars($service['TreatmentType']) . '</h3>';
            echo '<h3>' . "Duration: " . htmlspecialchars($service['Duration']) . '</h3>';
            echo '<h3>' . "Price: " . htmlspecialchars($service['Price']) . '</h3>';
            echo '<h3>' . "Availability Hours: " . htmlspecialchars($service['AvailabilityHours']) . '</h3>';

            if ($service['BookingRequired'] == 1) {
                // Start form                
                echo "<form action='book_service.php' method='POST'>";
                echo "<input type='hidden' name='service_id' value='" . htmlspecialchars($service['ServiceID']) . "' />";
                echo "<input type='hidden' name='type' value='" . htmlspecialchars($_SESSION['type']) . "' />";

                echo "<label for='num_people'>Number of people: </label>";
                echo "<select name='num_people' id='num_people'>";
                echo "<option value='1'>1</option>";
                echo "<option value='2'>2</option>";
                echo "<option value='3'>3</option>";
                echo "<option value='4'>4</option>";
                echo "<option value='5'>5</option>";
                echo "<option value='6'>6</option>";
                echo "<option value='7'>7</option>";
                echo "<option value='8'>8</option>";
                echo "<option value='9'>9</option>";
                echo "<option value='10'>10</option>";
                echo "</select>";
                
                echo "<br>";
                echo "Select time of booking: ";
                echo "<input type='time' name='appointed_time' step='1800' />";
                
                echo "<div style='text-align: left; margin-top: 10px;'>";
                echo "<button type='submit' class='btn btn-primary' style='padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none;'>";
                echo "Book Now";
                echo "</button>";
                echo "</div>";

                echo "</form>"; // End form
            } else {
                echo '<h3>' . "No booking required" . '</h3>';
            }

            echo '</div>'; // Close .service-info
            echo '</div>'; // Close .service-details
            echo "<hr>";

            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo '</div>'; // Close .col-md-12
    } else {
        echo "No services data found.";
    }  
}

function output_all_culinary() {
    // Check if the session variable exists
    if (isset($_SESSION['services'])) {
        $services = $_SESSION['services'];

        echo "<div class='col-md-12'>";

        // Process or display the services data as needed
        foreach ($services as $service) {
            echo "<div class='our_room'>";
            echo "<div class='container'>";
            echo "<div class='row'>";

            echo '<div class="activity-details" style="display: flex; align-items: flex-start; margin-bottom: 20px;">'; // Flexbox container

            // Display image
            if (!empty($service['Image'])) {
                // Use the relative path stored in the database
                $imageSrc = htmlspecialchars($service['Image']);
                echo "<figure style='margin-right: 20px;'><img src='" . $imageSrc . "' alt='Service Image' width='500' height='400' style='border-radius: 10px;'/></figure>";
            } else {
                echo '<p>No image available.</p>';
            }

            // Textual information
            echo '<div class="activity-info" style="flex: 1;">';
            echo "<h2>" . htmlspecialchars($service['ServiceName']) . "</h2>";
            echo '<h3>' . "Description: " . htmlspecialchars($service['Description']) . '</h3>';
            echo '<h3>' . "Meal Type: " . htmlspecialchars($service['MealType']) . '</h3>';            
            echo '<h3>' . "Special Dietary: " . htmlspecialchars($service['SpecialDietary']) . '</h3>';
            echo '<h3>' . "Menu Options: " . htmlspecialchars($service['MenuOptions']) . '</h3>';
            echo '<h3>' . "Dress Code: " . htmlspecialchars($service['DressCode']) . '</h3>';            
            echo '<h3>' . "Price: " . htmlspecialchars($service['Price']) . '</h3>';
            echo '<h3>' . "Availability Hours: " . htmlspecialchars($service['AvailabilityHours']) . '</h3>';

            if ($service['BookingRequired'] == 1) {
                // Start form                
                echo "<form action='book_service.php' method='POST'>";
                echo "<input type='hidden' name='service_id' value='" . htmlspecialchars($service['ServiceID']) . "' />";
                echo "<input type='hidden' name='type' value='" . htmlspecialchars($_SESSION['type']) . "' />";

                echo "<label for='num_people'>Number of people: </label>";
                echo "<select name='num_people' id='num_people'>";
                echo "<option value='1'>1</option>";
                echo "<option value='2'>2</option>";
                echo "<option value='3'>3</option>";
                echo "<option value='4'>4</option>";
                echo "<option value='5'>5</option>";
                echo "<option value='6'>6</option>";
                echo "<option value='7'>7</option>";
                echo "<option value='8'>8</option>";
                echo "<option value='9'>9</option>";
                echo "<option value='10'>10</option>";
                echo "</select>";
                
                echo "<br>";
                echo "Select time of booking: ";
                echo "<input type='time' name='appointed_time' step='1800' />";
                
                echo "<div style='text-align: left; margin-top: 10px;'>";
                echo "<button type='submit' class='btn btn-primary' style='padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none;'>";
                echo "Book Now";
                echo "</button>";
                echo "</div>";

                echo "</form>"; // End form
            } else {
                echo '<h3>' . "No booking required" . '</h3>';
            }

            echo '</div>'; // Close .service-info
            echo '</div>'; // Close .service-details
            echo "<hr>";

            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo '</div>'; // Close .col-md-12
    } else {
        echo "No services data found.";
    }  

}

function output_booking_service() {
    if (isset($_SESSION['service_id']) && isset($_SESSION['type']) &&
        isset($_SESSION['num_people']) && isset($_SESSION['appointed_time']) && isset($_SESSION['curr_service'])) {

        $service_id = $_SESSION['service_id'];
        $type = $_SESSION['type'];
        $num_people = $_SESSION['num_people'];
        $appointed_time = $_SESSION['appointed_time'];
        $curr_service = $_SESSION['curr_service'];

        echo '<div class="room-details">';

        // Display the room image using the file path stored in the database
        if (!empty($curr_service['Image'])) {
            $imageSrc = htmlspecialchars($curr_service['Image']); // Sanitize the image path
            echo '<div class="room-image-container">';
            echo '<img class="room-image" src="' . $imageSrc . '" alt="Room Image" />';
            echo '</div>';
        } else {
            echo '<div class="room-image-container">';
            echo '<img class="room-image" src="images/placeholder.jpg" alt="No Image Available" />';
            echo '</div>';
        }
    
        echo '<div class="room-info">';
        echo '<h2>' . htmlspecialchars($curr_service['ServiceName']) . '</h3>';
        echo '<h3>' . "Appointed Time: " . htmlspecialchars($appointed_time) . '</h3>';

        echo '<h3 class="price-per-night">Price Per Person: $' . htmlspecialchars($curr_service['Price']) . '</h3>';    
        echo '<h3 class="price-per-night">Number of People: ' . $num_people . '</h3>';     
        echo '<h3 class="price-per-night">Total cost: $' . ($num_people * $curr_service['Price']) . '</h3>';

        echo '<form action="includes/services/book_service.inc.php" method="POST">';
        echo '<input type="hidden" name="full_price" value="' . ($num_people * $curr_service['Price']) . '">';           
        echo '<button type="submit" class="btn btn-primary">Book Now</button>';
        echo '</form>';

        echo '</div>'; // Close .room-info
        echo '</div>'; // Close .room-details

        echo "<br>";
    }
    else {
        echo "Something went wrong - Try later";
    }
}

