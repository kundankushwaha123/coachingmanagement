<?php
function calculate_expiry_date($startingdate, $duration) {
    // Check if the starting date is a valid date format
    if (!$startDate = DateTime::createFromFormat('d F, Y', $startingdate)) {
        // Handle error if the date format is invalid
        return "Invalid start date format. Please provide a valid date.";
    }

    // Extract numeric value from the $duration string
    preg_match('/\d+/', $duration, $matches);  // This will extract the number

    // Check if a number was found and add it to the start date as months
    if (isset($matches[0])) {
        $startDate->add(new DateInterval('P' . $matches[0] . 'M'));
    } else {
        // Handle error if no valid duration is found
        return "Invalid duration format";
    }

    // Return the expiry date in a format (e.g., d F, Y)
    return $startDate->format('d F, Y');
}


    ?>