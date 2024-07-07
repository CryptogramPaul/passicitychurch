<?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    require_once "../database/connection.php";
    require_once "../functions.php";
    
    $dateApplied        = sanitize_input($_POST['dateApplied']);
    $contactNo          = sanitize_input($_POST['contactNo']);
    $burial_firstname   = sanitize_input($_POST['burial_firstname']);
    $burial_middlename  = sanitize_input($_POST['burial_middlename']);
    $burial_lastname    = sanitize_input($_POST['burial_lastname']);
    $dateOfBirth        = sanitize_input($_POST['dateOfBirth']);
    $age                = sanitize_input($_POST['age']);
    $gender             = sanitize_input($_POST['gender']);
    $address            = sanitize_input($_POST['address']);
    $maritalStatus      = sanitize_input($_POST['maritalStatus']);
    $father             = sanitize_input($_POST['father']);
    $mother             = sanitize_input($_POST['mother']);
    $spouse             = sanitize_input($_POST['spouse']);
    $noOfChildren       = sanitize_input($_POST['noOfChildren']);
    $childrenAlive      = sanitize_input($_POST['childrenAlive']);
    $childrenDead       = sanitize_input($_POST['childrenDead']);
    $personResponsible  = sanitize_input($_POST['personResponsible']);
    $relationship       = sanitize_input($_POST['relationship']);
    $membership         = sanitize_input($_POST['membership']);
    $lastRites          = sanitize_input($_POST['lastRites']);
    $causeOfDeath       = sanitize_input($_POST['causeOfDeath']);
    $dateOfDeath        = sanitize_input($_POST['dateOfDeath']);
    $deathCertNo        = sanitize_input($_POST['deathCertNo']);
    $burialPermitNo     = sanitize_input($_POST['burialPermitNo']);
    $cemetery           = sanitize_input($_POST['cemetery']);
    $dateOfBurial       = sanitize_input($_POST['dateOfBurial']);
    $timeOfBurial       = sanitize_input($_POST['timeOfBurial']);
    // $complete_address = $barangay . ' ' . $municipality . ', ' . $province;
    try {
        $conn->beginTransaction();
        
       
        $insert_burial = $conn->prepare("INSERT INTO burial (
                        lastname, 
                        firstname, 
                        middlename, 
                        contact_no, 
                        date_applied,
                        date_of_birth,
                        age,
                        gender,
                        address,
                        marital_status,
                        father_name,
                        mother_name,
                        spouse_name,
                        no_of_children,
                        no_alive,
                        no_dead,
                        person_responsible,
                        relationship,
                        member_in_church_org,
                        date_of_last_rites,
                        cause_of_death,
                        date_of_death,
                        death_cert_no,
                        burial_permit_no,
                        cemetery,
                        date_of_burial,
                        time_of_burial,
                        customer_id
                    )VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
        $insert_burial->execute([$burial_lastname,$burial_firstname,$burial_middlename,$contactNo,
                        $dateApplied,$dateOfBirth,$age,$gender,$address,$maritalStatus,$father,$mother,
                        $spouse,$noOfChildren,$childrenAlive,$childrenDead,$personResponsible,$relationship,
                        $membership,$lastRites,$causeOfDeath,$dateOfDeath,$deathCertNo,$burialPermitNo,$cemetery,$dateOfBurial,$timeOfBurial,$_COOKIE['userid']]);
       
        $burial_id = $conn->lastInsertId();

        $sql_getrates = $conn->prepare("SELECT total_rate FROM rates WHERE sacrament_type = 'Burial' ");
        $sql_getrates->execute();
        $rate = $sql_getrates->fetch();

        $insert_booking = $conn->prepare("INSERT INTO booking (booking_date, start_time, booking_status, customer_id, burial_id, sacrament_type, amount_to_pay) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert_booking->execute([$dateOfBurial, $timeOfBurial, 'Pending', $_COOKIE['userid'], $burial_id, 'Burial', $rate['total_rate'] ]);	
    
        $conn->commit();
        echo "success";
    
    } catch (PDOException $e) {
        echo "Error!<br>Please Contact Our Management" . $e->getMessage();
    }
?>  