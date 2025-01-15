<?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    require_once "../database/connection.php";
    require_once "../functions.php";

    $date           = sanitize_input($_POST['date']);
    $time           = sanitize_input($_POST['time']);
    $offered_for    = sanitize_input($_POST['offered_for']);
    $offered_by     = sanitize_input($_POST['offered_by']);
    $amount         = sanitize_input($_POST['amount']);
    $intentions_id  = sanitize_input($_POST['intentions_id']);
    $IntentionsJSON = $_POST['IntentionsJSON'];
    $Intentions     = json_decode($IntentionsJSON, true);

    try {
        $conn->beginTransaction();
        
        $update_intentions = $conn->prepare("UPDATE intentions SET 
                        date = ?,
                        time = ?,
                        offered_by = ?,
                        offered_for = ?,
                        amount = ?,
                        customer_id = ?
                        WHERE id = ?
                  ");
        $update_intentions->execute([$date, $time, $offered_by, $offered_for, $amount, $_COOKIE['customer_id'], $intentions_id]);
       
        // DELETE INTENTIONS_SUB_DETAILS
        $delete_intentions_sub = $conn->prepare("DELETE FROM intentions_sub_details WHERE intentions_id = ?");
        $delete_intentions_sub->execute([$intentions_id]);

        // $update_details = $conn->prepare("UPDATE intentions_sub_details SET intentions_type = ?, intentions_name = ?, remarks = ? WHERE detail_id = ?");
        
        $insert_intentions_sub = $conn->prepare("INSERT INTO intentions_sub_details (intentions_id, intentions_type, intentions_name, remarks)VALUES(?,?,?,?)");
        
        // UPDATE INTENTIONS
        foreach ($Intentions as $key => $value) {
            $id      = $value['id'];
            $type    = $value['type'];
            $name    = $value['name'];
            $remarks = $value['remarks'];
            
            $insert_intentions_sub->execute([$intentions_id, $type, $name, $remarks ]);
            // if ($id == '') {
            // }else if($id != ''){
            //     $update_details->execute([$type, $name, $remarks, $id ]);
            // }    
        }
        
        $update_booking = $conn->prepare("UPDATE booking SET booking_date = ?, start_time = ?, booking_status = ?, customer_id = ?, sacrament_type = ?, amount_to_pay = ? WHERE intentions_id = ? ");
        $update_booking->execute([$date, $time, 'Pending', $_COOKIE['customer_id'], 'Intentions', $amount, $intentions_id]);	
        
        $conn->commit();
        echo "success";
    
    } catch (PDOException $e) {
        echo "Error!<br>Please Contact Our Management" . $e->getMessage();
    }
?>