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
    $login = $conn->prepare("SELECT * from customer where username = ? and password = ? and is_active = 1");
    $login->execute([$username, $password]);
    $fetch_login = $login->fetch();

    $conn->commit();
    if ($login->rowCount() > 0) {
        $user_id = $fetch_login['customer_id'];

        setcookie('userid', $user_id, strtotime('+30 days'), "/");
        echo "success";
    } else {
        echo "Invalid Credentials!";
    }

} catch (PDOException $e) {
    echo "Error!<br>Please Contact Our System Developer" . $e->getMessage();
}