<?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    require_once "../database/connection.php";
    require_once "../functions.php";
    
    $child_firstname    = sanitize_input($_POST['child_firstname']);
    $child_middlename   = sanitize_input($_POST['child_middlename']);
    $child_lastname     = sanitize_input($_POST['child_lastname']);
    $dateOfBirth        = sanitize_input($_POST['dateOfBirth']);
    $placeOfBirth       = sanitize_input($_POST['placeOfBirth']);
    $father_firstname   = sanitize_input($_POST['father_firstname']);
    $father_middlename  = sanitize_input($_POST['father_middlename']);
    $father_lastname    = sanitize_input($_POST['father_lastname']);
    $mother_firstname   = sanitize_input($_POST['mother_firstname']);
    $mother_middlename  = sanitize_input($_POST['mother_middlename']);
    $mother_lastname    = sanitize_input($_POST['mother_lastname']);
    $baptism_date       = sanitize_input($_POST['baptism_date']);
    $timeOfBaptism      = sanitize_input($_POST['timeOfBaptism']);
    $SponsorJson        = $_POST['SponsorJson'];
    $Sponsors           = json_decode($SponsorJson, true);
    
    // if (isWeekend($baptism_date)) {
    //     $caledar_day = "Weekends"; 
    // } else {
    //     $caledar_day = "Weekdays"; 
    // }
   
    try {
        $conn->beginTransaction();
        
        $insert_baptism = $conn->prepare("INSERT INTO baptism (
                        child_lastname,
                        child_firstname,
                        child_middlename,
                        place_of_birth,
                        date_of_birth,
                        baptism_date,
                        baptism_time,
                        father_lastname,
                        father_firstname,
                        father_middlename,
                        mother_lastname,
                        mother_firstname,
                        mother_middlename,
                        customer_id
                    )VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
        $insert_baptism->execute([$child_lastname,$child_firstname,$child_middlename,$placeOfBirth,$dateOfBirth,$baptism_date,$timeOfBaptism,
        $father_lastname,$father_firstname,$father_middlename,$mother_lastname,$mother_firstname,$mother_middlename,$_COOKIE['customer_id']]);
       
        $baptism_id = $conn->lastInsertId();

        $sql_getrates = $conn->prepare("SELECT * FROM rates WHERE sacrament_type = 'Baptism' AND calendar_day = 'All' ");
        $sql_getrates->execute([]);
        $fetch_rate = $sql_getrates->fetchAll();

        $count_sponsors = 0;
        foreach ($Sponsors as $key => $value) {
            $id = $value['id'];
            $lastname = $value['lastname'];
            $firstname   = $value['firstname'];
            $middlename     = $value['middlename'];

            // if (!empty($id)) {
            // }
            $count_sponsors++;
        }
        
        $total_amount = 0;
        $total_sponsor = 0;
        $sponsor_rate = 0;
        foreach($fetch_rate as $key => $value) {
            if ($value['rate_name'] == 'Sponsors') {
                $total_sponsor = $value['amount_rate'] * $count_sponsors;
                $sponsor_rate = $value['amount_rate'];
            }else{
                $total_amount += $value['amount_rate'];
            }
            
        }
        $total_amount_to_pay = $total_amount + $total_sponsor;

        // $total_sponsor = $rate['sponsor_rate'] * $count_sponsors;
        // $total_amount_to_pay = $rate['total_rate'] + $total_sponsor;

        $insert_booking = $conn->prepare("INSERT INTO booking (booking_date, start_time, booking_status, customer_id, baptism_id, sacrament_type, amount_to_pay) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert_booking->execute([$baptism_date,$timeOfBaptism,'Pending',$_COOKIE['customer_id'],$baptism_id,'Baptism', $total_amount_to_pay ]);	
        
        $booking_id = $conn->lastInsertId();

        $insert_sponsors = $conn->prepare("INSERT INTO sponsors (sacrament_id, sacrament_type, lastname, firstname, middlename, booking_id, customer_id,amount)VALUES(?,?,?,?,?,?,?,?)");
        
        // INSERT SPONSORS
        foreach ($Sponsors as $key => $value) {
            $lastname = $value['lastname'];
            $firstname   = $value['firstname'];
            $middlename     = $value['middlename'];
            
            $insert_sponsors->execute([$baptism_id, "Baptism", $lastname, $firstname, $middlename, $booking_id, $_COOKIE['customer_id'],$sponsor_rate]);
        }
    
        $conn->commit();
        echo "success";
    
    } catch (PDOException $e) {
        echo "Error!<br>Please Contact Our Management" . $e->getMessage();
    }
?>