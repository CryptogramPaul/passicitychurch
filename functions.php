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
?>