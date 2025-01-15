<?php
if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
    // header("location:../../../error.html");
    header('HTTP/1.1 403 Forbidden');
    die();
}
require_once "../database/connection.php";
require_once "../functions.php";

$username = sanitize_input($_POST['username']);
$password = sanitize_input($_POST['password']);

try {
    $conn->beginTransaction();
    
    $login = $conn->prepare("SELECT * from customer where username = ? and password = ?");
    $login->execute([$username, $password]);
    $fetch_login = $login->fetch();

    $conn->commit();
    if ($login->rowCount() > 0) {
        $user_id = $fetch_login['customer_id'];

        $isactive = $fetch_login['is_active'];

        if ($isactive == 0) {
            echo "Account is not active. Please contact your administrator.";
            exit();
        }else{
            setcookie('customer_id', $user_id, strtotime('+30 days'), "/");
            setcookie('user_type', 'Client', strtotime('+30 days'), "/");
            echo "success";
        }
        
    } else {
        echo "Invalid Credentials!";
        exit();
    }

} catch (PDOException $e) {
    $conn->rollBack();
    echo "Error!<br>Please Contact Our System Developer" . $e->getMessage();
}