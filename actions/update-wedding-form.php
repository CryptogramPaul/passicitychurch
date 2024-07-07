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
    $bride_firstname    = sanitize_input($_POST['bride_firstname']);
    $bride_middlename   = sanitize_input($_POST['bride_firstname']);
    $bride_lastname     = sanitize_input($_POST['bride_firstname']);
    $wedding_date       = sanitize_input($_POST['wedding_date']);
    $timeOfWedding      = sanitize_input($_POST['timeOfWedding']);
    $wedding_id         = sanitize_input($_POST['wedding_id']);
    $SponsorJson        = $_POST['SponsorJson'];
    $Sponsors           = json_decode($SponsorJson, true);

    // echo $baptismal          = $_FILES['baptismal'];
    // echo $confirmation_cert  = $_FILES['confirmation_cert'];
    // echo $marriage_license   = $_FILES['marriage_license'];
    // echo $marriage_license   = $_FILES['marriage_license'];

    // Process the uploaded files
    function processFileUpload($file) {
        $targetDir = "../uploads/";
        $targetFile = $targetDir . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            throw new Exception("Failed to upload file: " . $file["name"]);
        }
    }

    try {
        $baptismal = processFileUpload($_FILES['baptismal']);
        $confirmation_cert = processFileUpload($_FILES['confirmation_cert']);
        $marriage_license = processFileUpload($_FILES['marriage_license']);
        $marriage_cont = processFileUpload($_FILES['marriage_cont']);

        $requirements = json_encode([
            'baptismal' => $baptismal,
            'confirmation_cert' => $confirmation_cert,
            'marriage_license' => $marriage_license,
            'marriage_cont' => $marriage_cont,
        ]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }


    $sql_booking = $conn->prepare("SELECT booking_id FROM booking WHERE wedding_id = ? ");
    $sql_booking->execute([$wedding_id]);
    $result = $sql_booking->fetch();
    $booking_id = $result['booking_id'];


    try {
        $conn->beginTransaction();
        
        $update_wedding = $conn->prepare("UPDATE wedding SET wedding_date = ?, wedding_time = ?, groom_lastname = ?, groom_firstname = ?, groom_middlename = ?, bride_lastname = ?, bride_firstname = ?, bride_middlename = ?, customer_id = ? WHERE wedding_id = ? ");
        $update_wedding->execute([$wedding_date,$timeOfWedding,$groom_lastname,$groom_firstname,$groom_middlename,$bride_lastname,$bride_firstname,$bride_middlename,$_COOKIE['userid'],$wedding_id]);
        
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

        $update_booking = $conn->prepare("UPDATE booking SET booking_date = ?, start_time = ?, booking_status = ?, customer_id = ?, wedding_id = ?, sacrament_type = ?, amount_to_pay = ? WHERE booking_id = ?");
        $update_booking->execute([$wedding_date,$timeOfWedding,'Pending',$_COOKIE['userid'],$wedding_id,'Wedding', $total_amount_to_pay, $booking_id]);	
        
        $insert_sponsors = $conn->prepare("INSERT INTO sponsors (sacrament_id, sacrament_type, lastname, firstname, middlename, booking_id, customer_id, amount)VALUES(?,?,?,?,?,?,?,?)");

        $update_sponsors = $conn->prepare("UPDATE sponsors SET sacrament_id = ?, sacrament_type = ?, lastname = ?, firstname = ?, middlename = ?, booking_id = ?, customer_id = ?, amount = ? WHERE sponsor_id = ?");
        
        // INSERT SPONSORS
        foreach ($Sponsors as $key => $value) {
            $id = $value['id'];
            $lastname = $value['lastname'];
            $firstname   = $value['firstname'];
            $middlename     = $value['middlename'];
            
            $sql_sponsors = $conn->prepare("SELECT count(sponsor_id) FROM sponsors WHERE sponsor_id = ? ");
            $sql_sponsors->execute([$id]);	

            if($sql_sponsors->fetchColumn(0) > 0){
                $update_sponsors->execute([$wedding_id, "Wedding", $lastname, $firstname, $middlename, $booking_id, $_COOKIE['userid'], $rate['sponsor_rate'], $id]);
            }else{
                $insert_sponsors->execute([$wedding_id, "Wedding", $lastname, $firstname, $middlename, $booking_id, $_COOKIE['userid'], $rate['sponsor_rate'] ]);
            }
            // $insert_sponsors->execute([$baptism_id, "Baptism", $lastname, $firstname, $middlename, $booking_id, $_COOKIE['userid']]);
        }


        if (is_array($requirements)) {
            foreach ($requirements as $requirement_name => $filename) {
                $insert_requirement = $conn->prepare("INSERT INTO requirements (event_name, requirement_name, filename, wedding_id) VALUES (?, ?, ?, ?)");
                $insert_requirement->execute(['Wedding', $requirement_name, $filename, $wedding_id]);
            }
        } else {
            throw new Exception("Requirements are not in array format");
        }


        $conn->commit();
        echo "success";
    
    } catch (PDOException $e) {
        echo "Error!<br>Please Contact Our Management" . $e->getMessage();
    }
?>  