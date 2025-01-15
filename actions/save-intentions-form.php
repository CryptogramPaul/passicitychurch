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
    $IntentionsJSON = $_POST['IntentionsJSON'];
    $Intentions     = json_decode($IntentionsJSON, true);
   
    try {
        $conn->beginTransaction();
        
        $insert_intentions = $conn->prepare("INSERT INTO intentions (
                        date,
                        time,
                        offered_by,
                        offered_for,
                        amount,
                        customer_id
                    )VALUES(?,?,?,?,?,?) ");
        $insert_intentions->execute([$date,$time,$offered_by,$offered_for,$amount,$_COOKIE['customer_id']]);
       
        $intentions_id = $conn->lastInsertId();

        $insert_intentions_sub = $conn->prepare("INSERT INTO intentions_sub_details (intentions_id, intentions_type, intentions_name, remarks)VALUES(?,?,?,?)");
        
        // INSERT INTENTIONS
        foreach ($Intentions as $key => $value) {
            $type = $value['type'];
            $name   = $value['name'];
            $remarks     = $value['remarks'];
            
            $insert_intentions_sub->execute([$intentions_id, $type, $name, $remarks ]);
        }
    
        $insert_booking = $conn->prepare("INSERT INTO booking (booking_date, start_time, booking_status, customer_id, intentions_id, sacrament_type, amount_to_pay) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert_booking->execute([$date,$time,'Pending',$_COOKIE['customer_id'],$intentions_id,'Intentions', $amount ]);	
        
        $booking_id = $conn->lastInsertId();

    
        $conn->commit();
        echo "success";
    
    } catch (PDOException $e) {
        echo "Error!<br>Please Contact Our Management" . $e->getMessage();
    }
?>