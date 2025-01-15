<?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    require_once "../database/connection.php";
    require_once "../functions.php";
    
    // $groom_firstname    = sanitize_input($_POST['groom_firstname']);
    // $groom_middlename   = sanitize_input($_POST['groom_middlename']);
    // $groom_lastname     = sanitize_input($_POST['groom_lastname']);
    // $bride_firstname    = sanitize_input($_POST['bride_firstname']);
    // $bride_middlename   = sanitize_input($_POST['bride_firstname']);
    // $bride_lastname     = sanitize_input($_POST['bride_firstname']);
    // $wedding_date       = sanitize_input($_POST['wedding_date']);
    // $timeOfWedding      = sanitize_input($_POST['timeOfWedding']);


    $groom_firstname               = sanitize_input($_POST['groom_firstname']);
    $groom_middlename              = sanitize_input($_POST['groom_middlename']);
    $groom_lastname                = sanitize_input($_POST['groom_lastname']);
    $groom_place_of_birth          = sanitize_input($_POST['groom_place_of_birth']);
    $groom_date_of_birth           = sanitize_input($_POST['groom_date_of_birth']);
    $groom_citizenship             = sanitize_input($_POST['groom_citizenship']);
    $groom_religion                = sanitize_input($_POST['groom_religion']);
    $groom_residence               = sanitize_input($_POST['groom_residence']);
    $groom_civil_status            = sanitize_input($_POST['groom_civil_status']);
    $groom_father_name             = sanitize_input($_POST['groom_father_name']);
    $groom_father_citizenship      = sanitize_input($_POST['groom_father_citizenship']);
    $groom_maiden_name_of_mother   = sanitize_input($_POST['groom_maiden_name_of_mother']);
    $groom_mother_citizenship      = sanitize_input($_POST['groom_mother_citizenship']);
    $groom_name_of_person_consent  = sanitize_input($_POST['groom_name_of_person_consent']);
    $groom_person_relationship     = sanitize_input($_POST['groom_person_relationship']);
    $groom_person_residence        = sanitize_input($_POST['groom_person_residence']);
    $bride_firstname               = sanitize_input($_POST['bride_firstname']);
    $bride_middlename              = sanitize_input($_POST['bride_middlename']);
    $bride_lastname                = sanitize_input($_POST['bride_lastname']);
    $bride_place_of_birth          = sanitize_input($_POST['bride_place_of_birth']);
    $bride_date_of_birth           = sanitize_input($_POST['bride_date_of_birth']);
    $bride_citizenship             = sanitize_input($_POST['bride_citizenship']);
    $bride_religion                = sanitize_input($_POST['bride_religion']);
    $bride_residence               = sanitize_input($_POST['bride_residence']);
    $bride_civil_status            = sanitize_input($_POST['bride_civil_status']);
    $bride_father_name             = sanitize_input($_POST['bride_father_name']);
    $bride_father_citizenship      = sanitize_input($_POST['bride_father_citizenship']);
    $bride_maiden_name_of_mother   = sanitize_input($_POST['bride_maiden_name_of_mother']);
    $bride_mother_citizenship      = sanitize_input($_POST['bride_mother_citizenship']);
    $bride_name_of_person_consent  = sanitize_input($_POST['bride_name_of_person_consent']);
    $bride_person_relationship     = sanitize_input($_POST['bride_person_relationship']);
    $bride_person_residence        = sanitize_input($_POST['bride_person_residence']);
    $wedding_date                  = sanitize_input($_POST['wedding_date']);
    $timeOfWedding                 = sanitize_input($_POST['timeOfWedding']);
    $groom_age                     = (date('Y') - date('Y', strtotime($groom_date_of_birth)));
    $bride_age                     = (date('Y') - date('Y', strtotime($bride_date_of_birth)));
    $wedding_id                    = sanitize_input($_POST['wedding_id']);

    $SponsorJson        = $_POST['SponsorJson'];
    $Sponsors           = json_decode($SponsorJson, true);

    $sql_booking = $conn->prepare("SELECT booking_id FROM booking WHERE wedding_id = ? ");
    $sql_booking->execute([$wedding_id]);
    $result = $sql_booking->fetch();
    $booking_id = $result['booking_id'];

    if (isWeekend($wedding_date)) {
        $caledar_day = "Weekends"; 
    } else {
        $caledar_day = "Weekdays"; 
    }
    
    try {
        $conn->beginTransaction();
        
        $update_wedding = $conn->prepare("UPDATE wedding SET 
            wedding_date = ?, 
            wedding_time = ?, 
            groom_lastname = ?, 
            groom_firstname = ?, 
            groom_middlename = ?, 
            groom_place_of_birth = ?,
            groom_date_of_birth = ?,
            groom_age = ?,
            groom_citizenship = ?,
            groom_religion = ?,
            groom_residence = ?,
            groom_civil_status = ?,
            groom_sex = ?,
            groom_name_of_father = ?,
            groom_father_citizenship = ?,
            groom_maiden_name_of_mother = ?,
            groom_mother_citizenship = ?,
            groom_name_of_person_consent = ?,
            groom_person_relationship = ?,
            groom_person_residence = ?,
            bride_lastname = ?, 
            bride_firstname = ?, 
            bride_middlename = ?,
            bride_place_of_birth = ?,
            bride_date_of_birth = ?,
            bride_age = ?,
            bride_citizenship = ?,
            bride_religion = ?,
            bride_residence = ?,
            bride_civil_status = ?,
            bride_sex = ?, 
            bride_name_of_father = ?,
            bride_father_citizenship = ?,
            bride_maiden_name_of_mother = ?,
            bride_mother_citizenship = ?,
            bride_name_of_person_consent = ?,
            bride_person_relationship = ?,
            bride_person_residence = ?, 
            customer_id = ?
            WHERE wedding_id = ? ");
        $update_wedding->execute([
            $wedding_date,
            $timeOfWedding,
            $groom_lastname,
            $groom_firstname,
            $groom_middlename,
            $groom_place_of_birth,
            $groom_date_of_birth,
            $groom_age,
            $groom_citizenship,
            $groom_religion,
            $groom_residence,
            $groom_civil_status,
            'Male',
            $groom_father_name,
            $groom_father_citizenship,
            $groom_maiden_name_of_mother,
            $groom_mother_citizenship,
            $groom_name_of_person_consent,
            $groom_person_relationship,
            $groom_person_residence,
            $bride_lastname,
            $bride_firstname,
            $bride_middlename,
            $bride_place_of_birth,
            $bride_date_of_birth,
            $bride_age,
            $bride_citizenship,
            $bride_religion,
            $bride_residence,
            $bride_civil_status,
            'Female',
            $bride_father_name,
            $bride_father_citizenship,
            $bride_maiden_name_of_mother,
            $bride_mother_citizenship,
            $bride_name_of_person_consent,
            $bride_person_relationship,
            $bride_person_residence,
            $_COOKIE['customer_id'],
            $wedding_id
        ]);
        
        $sql_getrates = $conn->prepare("SELECT * FROM rates WHERE sacrament_type = 'Wedding' AND calendar_day = ? ");
        $sql_getrates->execute([$caledar_day]);
        $fetch_rate = $sql_getrates->fetchAll();

        $count_sponsors = 0;
        foreach ($Sponsors as $key => $value) {
            $id = $value['id'];
            $lastname = $value['lastname'];
            $firstname   = $value['firstname'];
            $middlename     = $value['middlename'];

            $count_sponsors++;
            // if (!empty($id)) {
            // }
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


        $update_booking = $conn->prepare("UPDATE booking SET booking_date = ?, start_time = ?, booking_status = ?, customer_id = ?, wedding_id = ?, sacrament_type = ?, amount_to_pay = ? WHERE booking_id = ?");
        $update_booking->execute([$wedding_date,$timeOfWedding,'Pending',$_COOKIE['customer_id'],$wedding_id,'Wedding', $total_amount_to_pay, $booking_id]);	
        
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
                $update_sponsors->execute([$wedding_id, "Wedding", $lastname, $firstname, $middlename, $booking_id, $_COOKIE['customer_id'], $sponsor_rate, $id]);
            }else{
                $insert_sponsors->execute([$wedding_id, "Wedding", $lastname, $firstname, $middlename, $booking_id, $_COOKIE['customer_id'], $sponsor_rate ]);
            }
        }

        $_baptismal = isset($_FILES['baptismal']) ? $_FILES['baptismal'] : null;
        $_confirmation_cert = isset($_FILES['confirmation_cert']) ? $_FILES['confirmation_cert'] : null;
        $_marriage_license = isset($_FILES['marriage_license']) ? $_FILES['marriage_license'] : null;
        $_marriage_contract = isset($_FILES['marriage_contract']) ? $_FILES['marriage_contract'] : null;
        $_freedom_to_marry = isset($_FILES['freedom_to_marry']) ? $_FILES['freedom_to_marry'] : null;
        $_permit_to_marry = isset($_FILES['permit_to_marry']) ? $_FILES['permit_to_marry'] : null;
        
        $data = array(
            'Baptismal Certificate' => $_baptismal,
            'Confirmation Certification' => $_confirmation_cert,
            'Marriage License' => $_marriage_license,
            'Marriage Contract' => $_marriage_contract,
            'Freedom to Marry' => $_freedom_to_marry,
            'Permit to Marry' => $_permit_to_marry,
        );

         function processFileUpload($file) {
            if (is_array($file) && $file['error'] == 0) {
                $targetDir = "../uploads/";
                $targetFile = $targetDir . basename($file["name"]);
                if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                    return $targetFile;
                } else {
                    throw new Exception("Failed to upload file: " . $file["name"]);
                }
            }
            // Return null if the file is not provided or has an error
            return null;
        }

        foreach ($data as $event_name => $file) {
            if (is_array($file)) {
                $filename = processFileUpload($file);
                
                if ($filename) {
                    $insert_requirement = $conn->prepare("INSERT INTO requirements (event_name, requirement_name, filename, wedding_id) VALUES (?, ?, ?, ?)");
                    $insert_requirement->execute(['Wedding', $event_name, $file['name'], $wedding_id]);
                } 
            
            } 
        }

    
        $conn->commit();
        echo "success";
    
    } catch (PDOException $e) {
        echo "Error!<br>Please Contact Our Management" . $e->getMessage();
    }
?>