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
            ,$_COOKIE['userid'], 
            $baptism_id]);
        
        $update_booking = $conn->prepare("UPDATE booking SET booking_date = ?, start_time = ?, booking_status = ?, customer_id = ?, baptism_id = ?, sacrament_type = ? WHERE booking_id = ?");
        $update_booking->execute([$baptism_date,$timeOfBaptism,'Pending',$_COOKIE['userid'],$baptism_id,'Baptism',$booking_id]);	

        $insert_sponsors = $conn->prepare("INSERT INTO sponsors (sacrament_id, sacrament_type, lastname, firstname, middlename, booking_id, customer_id)VALUES(?,?,?,?,?,?,?)");
        $update_sponsors = $conn->prepare("UPDATE sponsors SET sacrament_id = ?, sacrament_type = ?, lastname = ?, firstname = ?, middlename = ?, booking_id = ?, customer_id = ? WHERE sponsor_id = ?");
        
        // INSERT SPONSORS
        foreach ($Sponsors as $key => $value) {
            $id = $value['id'];
            $lastname = $value['lastname'];
            $firstname   = $value['firstname'];
            $middlename     = $value['middlename'];
            
            $sql_sponsors = $conn->prepare("SELECT count(sponsor_id) FROM sponsors WHERE sponsor_id = ? ");
            $sql_sponsors->execute([$id]);	

            if($sql_sponsors->fetchColumn(0) > 0){
                $update_sponsors->execute([$baptism_id, "Baptism", $lastname, $firstname, $middlename, $booking_id, $_COOKIE['userid'], $id]);
            }else{
                $insert_sponsors->execute([$baptism_id, "Baptism", $lastname, $firstname, $middlename, $booking_id, $_COOKIE['userid']]);
            }
            // $insert_sponsors->execute([$baptism_id, "Baptism", $lastname, $firstname, $middlename, $booking_id, $_COOKIE['userid']]);
        }
    
        $conn->commit();
        echo "success";
    
    } catch (PDOException $e) {
        echo "Error!<br>Please Contact Our Management" . $e->getMessage();
    }
?>