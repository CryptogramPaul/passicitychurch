<?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    require_once "../database/connection.php";
    require_once "../functions.php";
    
    $groom_firstname    = sanitize_input($_POST['groom_firstname']);
    $groom_middlename   = sanitize_input($_POST['groom_middlename']);
    $groom_lastname     = sanitize_input($_POST['groom_lastname']);
    $bride_firstname   = sanitize_input($_POST['bride_firstname']);
    $bride_middlename  = sanitize_input($_POST['bride_firstname']);
    $bride_lastname    = sanitize_input($_POST['bride_firstname']);
    $wedding_date       = sanitize_input($_POST['wedding_date']);
    $timeOfWedding      = sanitize_input($_POST['timeOfWedding']);
    $SponsorJson        = $_POST['SponsorJson'];
    $Sponsors           = json_decode($SponsorJson, true);

     

    try {
        $conn->beginTransaction();
        
       
        $insert_wedding = $conn->prepare("INSERT INTO wedding (wedding_date, wedding_time, groom_lastname, groom_firstname, groom_middlename, bride_lastname, bride_firstname, bride_middlename, customer_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_wedding->execute([$wedding_date,$timeOfWedding,$groom_lastname,$groom_firstname,$groom_middlename,$bride_lastname,$bride_firstname,$bride_middlename,$_COOKIE['userid']]);
       
        $wedding_id = $conn->lastInsertId();

        $sql_getrates = $conn->prepare("SELECT total_rate,sponsor_rate FROM rates WHERE sacrament_type = 'Wedding' ");
        $sql_getrates->execute();
        $rate = $sql_getrates->fetch();

        $count_sponsors = 0;
        foreach ($Sponsors as $key => $value) {
            $id = $value['id'];
            $lastname = $value['lastname'];
            $firstname   = $value['firstname'];
            $middlename     = $value['middlename'];

            if (!empty($id)) {
                $count_sponsors++;
            }
        }

        $total_sponsor = $rate['sponsor_rate'] * $count_sponsors;
        $total_amount_to_pay = $rate['total_rate'] + $total_sponsor;
      

        $insert_booking = $conn->prepare("INSERT INTO booking (booking_date, start_time, booking_status, customer_id, wedding_id, sacrament_type, amount_to_pay) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert_booking->execute([$wedding_date,$timeOfWedding,'Pending',$_COOKIE['userid'],$wedding_id,'Wedding', $total_amount_to_pay]);	
        
        $booking_id = $conn->lastInsertId();

        $insert_sponsors = $conn->prepare("INSERT INTO sponsors (sacrament_id, sacrament_type, lastname, firstname, middlename, booking_id, customer_id,amount)VALUES(?,?,?,?,?,?,?,?)");
        
        // INSERT SPONSORS
        foreach ($Sponsors as $key => $value) {
            $lastname = $value['lastname'];
            $firstname   = $value['firstname'];
            $middlename     = $value['middlename'];
            
            $insert_sponsors->execute([$wedding_id, "Wedding", $lastname, $firstname, $middlename, $booking_id, $_COOKIE['userid'],$rate['sponsor_rate']]);
        }

        $conn->commit();
        echo "success";
    
    } catch (PDOException $e) {
        echo "Error!<br>Please Contact Our Management" . $e->getMessage();
    }
?>  