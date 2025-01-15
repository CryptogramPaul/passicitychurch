<?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    session_start();
    require_once "../database/connection.php";
    require_once "../functions.php";
    

    $verification_code = sanitize_input($_POST['verification_code']);
    $otp = $_SESSION['otp'];
    $email = $_SESSION['email'];
    try {
        $conn->beginTransaction();

        if($verification_code == $otp){
            $setActive = $conn->prepare("UPDATE customer SET  is_active = ? WHERE email_address = ? " );
            $setActive->execute([1,$email]);
        }else{
            echo "Your OTP is invalid!";
            exit();
        }
        
        $conn->commit();
        echo "success";
    
    } catch (PDOException $e) {
        echo "Error!<br>Please Contact Our Management" . $e->getMessage();
    }
?>