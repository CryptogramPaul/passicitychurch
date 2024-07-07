<?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    require_once "../database/connection.php";
    require_once "../functions.php";
    
    $id   = sanitize_input($_POST['id']);
    $type = sanitize_input($_POST['type']);

    try {
        $conn->beginTransaction();
        
        if ($type  == 'Burial') {
            # code...
            $delete_booking = $conn->prepare("DELETE FROM booking WHERE burial_id = ?");
            $delete_booking->execute([$id]);
    
            $delete_burial = $conn->prepare("DELETE FROM burial WHERE burial_id = ?");
            $delete_burial->execute([$id]);

        }else if($type == 'Baptism'){

            $delete_booking = $conn->prepare("DELETE FROM booking WHERE baptism_id = ?");
            $delete_booking->execute([$id]);
    
            $delete_baptism = $conn->prepare("DELETE FROM baptism WHERE id = ?");
            $delete_baptism->execute([$id]);

            $delete_sponsor = $conn->prepare("DELETE FROM sponsors WHERE sacrament_id = ?");
            $delete_sponsor->execute([$id]);

        }else if($type == 'Wedding'){

            $delete_booking = $conn->prepare("DELETE FROM booking WHERE wedding_id = ?");
            $delete_booking->execute([$id]);
    
            $delete_wedding = $conn->prepare("DELETE FROM wedding WHERE wedding_id = ?");
            $delete_wedding->execute([$id]);

            $delete_sponsor = $conn->prepare("DELETE FROM sponsors WHERE sacrament_id = ?");
            $delete_sponsor->execute([$id]);

        }
    
        $conn->commit();
        echo "success";
    
    } catch (PDOException $e) {
        echo "Error!<br>Please Contact Our Management" . $e->getMessage();
    }
?>