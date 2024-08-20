<?php

function valid_dates($given_arrival, $given_departure) { 
    
    // ------------ Check if the format is valid -------------------
    // Create DateTime objects to check if we got the correct format.
    $arrival = DateTime::createFromFormat('Y-m-d', $given_arrival);
    $departure = DateTime::createFromFormat('Y-m-d', $given_departure);
    
    // Check if the date is valid and matches the format
    if (!$arrival || $arrival->format('Y-m-d') !== $given_arrival) {
        return false;
    }
    if (!$departure || $departure->format('Y-m-d') !== $given_departure) {
        return false;
    }

    // ------------ Check if arrival date is not in the past -------------------
    // Create a DateTime object for today's date (set to the start of the day)
    $today = new DateTime('today');
    
    // Compare the arrival date with today's date
    if ($arrival < $today) {
        return false;
    }

    // ------------ Check if arrival date is not before the departure date ---------------
    if ($arrival >= $departure) {
        return false;
    }
    
    // If all checks passed
    return true;
}


function empty_dates($arrival, $departure) {
    if(empty($arrival) || empty($departure)) {
        return true;
    }
    else {
        return false;
    }
}