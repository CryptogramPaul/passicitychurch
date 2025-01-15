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
    $baptism_id         = sanitize_input($_POST['id']);

    $sql_booking = $conn->prepare("SELECT booking_id FROM booking WHERE baptism_id = ? ");
    $sql_booking->execute([$baptism_id]);
    $result = $sql_booking->fetch();
    $booking_id = $result['booking_id'];

    // if (isWeekend($baptism_date)) {
    //     $caledar_day = "Weekends"; 
    // } else {
    //     $caledar_day = "Weekdays"; 
    // }
  
    
    try {
        $conn->beginTransaction();
        
        $update_baptism = $conn->prepare("UPDATE baptism SET 
                        child_lastname = ?,
                        child_firstname = ?,
                        child_middlename = ?,
                        place_of_birth = ?,
                        date_of_birth = ?,
                        baptism_date = ?,
                        baptism_time = ?,
                        father_lastname = ?,
                        father_firstname = ?,
                        father_middlename = ?,
                        mother_lastname = ?,
                        mother_firstname = ?,
                        mother_middlename = ?,
                        customer_id = ?
                    WHERE id = ? ");
        $update_baptism->execute([$child_lastname,
            $child_firstname,
            $child_middlename,
            $placeOfBirth,
            $dateOfBirth,
            $baptism_date,
            $timeOfBaptism,
            $father_lastname,
            $father_firstname,
            $father_middlename,
            $mother_lastname,
            $mother_firstname,
            $mother_middlename
            ,$_COOKIE['customer_id'], 
            $baptism_id]);
        
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
        
        $update_booking = $conn->prepare("UPDATE booking SET booking_date = ?, start_time = ?, booking_status = ?, customer_id = ?, baptism_id = ?, sacrament_type = ?, amount_to_pay = ? WHERE booking_id = ?");
        $update_booking->execute([$baptism_date, $timeOfBaptism, 'Pending', $_COOKIE['customer_id'], $baptism_id, 'Baptism', $total_amount_to_pay, $booking_id]);	

        
        // INSERT SPONSORS
        foreach ($Sponsors as $key => $value) {
            $id = $value['id'];
            $lastname = $value['lastname'];
            $firstname   = $value['firstname'];
            $middlename     = $value['middlename'];
            
            $sql_sponsors = $conn->prepare("SELECT count(sponsor_id) FROM sponsors WHERE sponsor_id = ? ");
            $sql_sponsors->execute([$id]);	
            // $sponsor = $sql_sponsors->fetch();

            // if($sponsor['sponsor_id'] != $id ){
            //     // $update_sponsors = $conn->prepare("UPDATE sponsors SET sacrament_id = ?, sacrament_type = ?, lastname = ?, firstname = ?, middlename = ?, booking_id = ?, customer_id = ?, amount = ? WHERE sponsor_id = ?");
            //     // $update_sponsors->execute([$baptism_id, "Baptism", $lastname, $firstname, $middlename, $booking_id, $_COOKIE['customer_id'], $sponsor_rate, $id]);
            //     echo 'insert';
            // }else{
            //     echo 'update';
            //     // $insert_sponsors = $conn->prepare("INSERT INTO sponsors (sacrament_id, sacrament_type, lastname, firstname, middlename, booking_id, customer_id, amount)VALUES(?,?,?,?,?,?,?,?)");
            //     // $insert_sponsors->execute([$baptism_id, "Baptism", $lastname, $firstname, $middlename, $booking_id, $_COOKIE['customer_id'], $sponsor_rate]);
            // }
            

            if($sql_sponsors->fetchColumn(0) == 0){
                // echo 'insert';
                $insert_sponsors = $conn->prepare("INSERT INTO sponsors (sacrament_id, sacrament_type, lastname, firstname, middlename, booking_id, customer_id, amount)VALUES(?,?,?,?,?,?,?,?)");
                $insert_sponsors->execute([$baptism_id, "Baptism", $lastname, $firstname, $middlename, $booking_id, $_COOKIE['customer_id'], $sponsor_rate]);
            }else{
                $update_sponsors = $conn->prepare("UPDATE sponsors SET sacrament_id = ?, sacrament_type = ?, lastname = ?, firstname = ?, middlename = ?, booking_id = ?, customer_id = ?, amount = ? WHERE sponsor_id = ?");
                $update_sponsors->execute([$baptism_id, "Baptism", $lastname, $firstname, $middlename, $booking_id, $_COOKIE['customer_id'], $sponsor_rate, $id]);
                // echo 'update';
            }
        }
                // exit();

        $conn->commit();
        echo "success";
    
    } catch (PDOException $e) {
        echo "Error!<br>Please Contact Our Management" . $e->getMessage();
    }
?>