<?php
    function sanitize_input($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlentities($input); 
        $input = strip_tags($input);  
        $input = htmlspecialchars($input); 

        return $input;
    }

    function formatCurrency($number) {
        return '₱ ' . number_format($number, 2);
    }

    function isWeekend($date) {
        // Create a DateTime object from the provided date
        $dateTime = new DateTime($date);
        
        // Get the day of the week as a number (0 for Sunday, 6 for Saturday)
        $dayOfWeek = $dateTime->format('w');
        
        // Check if the day is Saturday (6) or Sunday (0)
        return ($dayOfWeek == 0 || $dayOfWeek == 6);
    }
?>