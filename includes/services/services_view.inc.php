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
            echo '<div class="room-details">';
            echo "<div class='services_img'>";

            echo '<div class="room-info">';
            echo "<h2>" . htmlspecialchars($activity['ServiceName']) . "</h2>";
            echo '</div>';
            

            // Display image
            if (!empty($activity['Image'])) {
                // Use the relative path stored in the database
                $imageSrc = htmlspecialchars($activity['Image']);
                echo "<figure><img src='" . $imageSrc . "' alt='Activity Image' /></figure>";
            } else {
                echo '<p>No image available.</p>';
            }

            echo '<div class="room-info">';
            echo '<h3>' . "Description: " . htmlspecialchars($activity['Description']) . '</h3>';
            echo '<h3>' . "Difficulty Level: " . htmlspecialchars($activity['DifficultyLevel']) . '</h3>';
            echo '<h3>' . "Minimum Age: " . htmlspecialchars($activity['MinimumAge']) . '</h3>';
            echo '<h3>' . "Guide Required: " . htmlspecialchars($activity['GuideRequired']) . '</h3>';
            echo '<h3>' . "Duration: " . htmlspecialchars($activity['Duration']) . '</h3>';
            echo '<h3>' . "Price: " . htmlspecialchars($activity['Price']) . '</h3>';
            echo '<h3>' . "Availability Hours: " . htmlspecialchars($activity['AvailabilityHours']) . '</h3>';
                        
            if ($activity['BookingRequired'] == 1) {
                echo "<div style='text-align: right; margin-right: 20px;'>";
                echo "<a href='includes/services/services.inc.php?services=Activities' class='btn btn-primary' style='padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none;'>";
                echo "Book Now";
                echo "</a>";
                echo "</div>";
            }
            else {
                echo '<h3>' . "No booking required" . '</h3>';
            }
            
            
            
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo "<hr>";
            echo "<hr>";
        }
    } else {
        echo "No services data found.";
    }
    


}
