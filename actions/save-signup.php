<?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    require_once "../database/connection.php";
    require_once "../functions.php";
    
    $firstname = sanitize_input($_POST['firstname']);
    $middlename = sanitize_input($_POST['middlename']);
    $lastname = sanitize_input($_POST['lastname']);
    $contact_no = sanitize_input($_POST['contact_no']);
    $email = sanitize_input($_POST['email']);
    $barangay = sanitize_input($_POST['barangay']);
    $municipality = sanitize_input($_POST['municipality']);
    $province = sanitize_input($_POST['province']);
    $username = sanitize_input($_POST['username']);
    $password = sanitize_input($_POST['password']);
    $complete_address = $barangay . ' ' . $municipality . ', ' . $province;
    try {
        $conn->beginTransaction();

        $check_credentials = $conn->prepare("SELECT username, password FROM customer WHERE username = ? and password = ? ");
        $check_credentials->execute([$username,$password]);

        if ($check_credentials->rowCount() > 0) {
            echo "Username and password is already taken!";
            exit();
        }

        $insert_customer = $conn->prepare("INSERT INTO customer (lastname,firstname,middlename,contact_no,address,barangay,municipality,province,email_address,username, password,is_active)VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
        $insert_customer->execute([$lastname, $firstname, $middlename, $contact_no, $complete_address, $barangay, $municipality, $province,$email,$username,$password,1]);
       
        $customer_id = $conn->lastInsertId();
        // $insert_accounts = $conn->prepare("INSERT INTO customer_accounts (username,password,is_active,customer_id)VALUES(?,?,?,?)");
        // $insert_accounts->execute([$username, $password, 1, $customer_id]);
        
        $login = $conn->prepare("SELECT username, password, customer_id FROM customer WHERE customer_id = ? ");
        $login->execute([$customer_id]);
        $fetch_login = $login->fetch();
        
        $user_id = $fetch_login['customer_id'];
        setcookie('userid', $user_id, strtotime('+2 days'), "/");

        $conn->commit();
        echo "success";
    
    } catch (PDOException $e) {
        echo "Error!<br>Please Contact Our Management" . $e->getMessage();
    }
?>  