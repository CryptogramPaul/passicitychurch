<?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    require_once "../database/connection.php";
    require_once "../functions.php";
    
    $id           = sanitize_input($_POST['id']);
    $sacrament_id = sanitize_input($_POST['sacrament_id']);
    $sacrament_type = sanitize_input($_POST['sacrament_type']);

    try {
        $conn->beginTransaction();
        
        $delete_sponsor = $conn->prepare("DELETE FROM sponsors WHERE sponsor_id = ?");
        $delete_sponsor->execute([$id]);
        
        $sql_getrates = $conn->prepare("SELECT total_rate,sponsor_rate FROM rates WHERE sacrament_type = ? ");
        $sql_getrates->execute([$sacrament_type]);
        $rate = $sql_getrates->fetch();

        $sql_sponsors = $conn->prepare("SELECT * FROM sponsors WHERE sacrament_id = ? ");
        $sql_sponsors->execute([$sacrament_id]);  
        $count_sponsors = $sql_sponsors->rowCount();
      
        // foreach ($Sponsors as $key => $value) {
        //     $id = $value['id'];
        //     $lastname = $value['lastname'];
        //     $firstname   = $value['firstname'];
        //     $middlename     = $value['middlename'];

        //     if (!empty($id)) {
        //         $count_sponsors++;
        //     }
        // }

        $total_sponsor = $rate['sponsor_rate'] * $count_sponsors;
        $total_amount_to_pay = $rate['total_rate'] + $total_sponsor;

        if ($sacrament_type == "Wedding") {
            $update_booking = $conn->prepare("UPDATE booking SET amount_to_pay = ? WHERE wedding_id = ?");
            $update_booking->execute([$total_amount_to_pay, $sacrament_id]); 
        }else{
            $update_booking = $conn->prepare("UPDATE booking SET amount_to_pay = ? WHERE baptism_id = ?");
            $update_booking->execute([$total_amount_to_pay, $sacrament_id]); 
        }
       

        $conn->commit();
        echo "success";
    
    } catch (PDOException $e) {
        echo "Error!<br>Please Contact Our Management" . $e->getMessage();
    }
?>  