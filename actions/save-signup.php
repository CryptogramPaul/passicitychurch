<?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }

    session_start();
    require_once "../database/connection.php";
    require_once "../functions.php";
    
    include('../smtp/PHPMailerAutoload.php');

    // use PHPMailer\PHPMailer\Exception;
    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\SMTP;
    
    // // require 'email-config.php';

    // require '../actions/PHPMailer/src/Exception.php';
    // require '../actions/PHPMailer/src/PHPMailer.php';
    // require '../actions/PHPMailer/src/SMTP.php';

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

    $fullname = $firstname . ' ' . $middlename . ' ' . $lastname;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Invalid email format!";
      exit();
    }

    if (stristr($email, '@gmail.com') === false) {
        echo 'Only Gmail is allowed!';
        exit();
    }
    
    try {
        $conn->beginTransaction();

        $checkemail = $conn->prepare("SELECT count(email_address) FROM customer WHERE email_address = ?  ");
        $checkemail->execute([$email]);
        $email_count = $checkemail->fetchColumn(0);
        if ( $email_count > 0) {
            echo "Email Address is Already Registered!";
            exit();
        }

        $check_credentials = $conn->prepare("SELECT username, password FROM customer WHERE username = ?  ");
        $check_credentials->execute([$username]);

        if ($check_credentials->rowCount() > 0) {
            echo "Username is already taken!";
            exit();
        }

        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        $mail = new PHPMailer;
        
        // $mail->isSMTP();
        // $mail->Host='smtp.hostinger.com';
        // $mail->SMTPAuth=true;
        // $mail->Port=587;
        // $mail->SMTPSecure='TLS';

        // $mail->Username='churchadmin@passicitychurch.org';
        // $mail->Password='Passicitychurch_123';

        // $mail->setFrom('email account', 'OTP Verification');
        // $mail->addAddress($_POST["email"]);

        // $mail->isHTML(true);
        // $mail->Subject="Saint William Parish Church Booking System";

        // $mail->SMTPDebug = 3;

        //$mail->SMTPDebug = 2; 
        // $mail->Username = "email";
        // $mail->Password = "password";
        $mail->IsSMTP(); 
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; 
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Username='passicitychurch@gmail.com';
        $mail->Password='nhqc ftql rcmb kxad';
        // $mail->setFrom('email account', 'OTP Verification');
        $mail->SetFrom("passicitychurch@gmail.com",'OTP Verification');
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));
        $mail->addAddress($_POST["email"]);
        $mail->isHTML(true);
        $mail->Subject="Saint William Parish Church Booking System";

        $mail->Body='
        <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        padding: 20px;
                        margin: 0;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        background-color: #e9eff4;
                        padding: 20px;
                        text-align: center;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    }
                    .card {
                        background-color: #ffffff;
                        padding: 20px;
                        border-radius: 8px;
                        text-align: left;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        margin-bottom: 20px;
                        font-size: 18px;
                        font-weight: bold;
                    }
                    .content {
                        font-size: 16px;
                        line-height: 1.6;
                        color: #333;
                    }
                    
                    .footer {
                        margin-top: 20px;
                        font-size: 12px;
                        color: #888;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="card">
                        <div class="header">Hi, '. $fullname  .'!</div>
                        <div class="content">
                            <p>Your One-Time PIN <span class="otp">(OTP)</span> is <span class="otp">'. $otp  .'</span></p>
                            <p>Do not share your <span class="otp">OTP</span> to anyone.</p>
                            <p>Please disregard if you did not initiate this request.</p>
                        </div>
                    </div>
                    <div class="footer">
                        This is a system generated email. Please do not reply.
                    </div>
                </div>
            </body>
            </html>
        ';

        // $mail->AltBody = 'Thank you for signing up for our service. We hope you enjoy your experience.';

        if(!$mail->send()){
            echo "Register Failed, Invalid Email ";
            // echo $mail->ErrorInfo;
        }else{
            $insert_customer = $conn->prepare("INSERT INTO customer (lastname,firstname,middlename,contact_no,address,barangay,municipality,province,email_address,username, password, OneTimePin, is_active)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $insert_customer->execute([$lastname, $firstname, $middlename, $contact_no, $complete_address, $barangay, $municipality, $province,$email,$username,$password,$otp,0]);
           
            $customer_id = $conn->lastInsertId();
            // echo "Register Successfully, OTP sent to " . $email;
        }


        
        // $insert_accounts = $conn->prepare("INSERT INTO customer_accounts (username,password,is_active,customer_id)VALUES(?,?,?,?)");
        // $insert_accounts->execute([$username, $password, 1, $customer_id]);
        
        // $login = $conn->prepare("SELECT username, password, customer_id FROM customer WHERE customer_id = ? ");
        // $login->execute([$customer_id]);
        // $fetch_login = $login->fetch();
        
        // $user_id = $fetch_login['customer_id'];
        // setcookie('userid', $user_id, strtotime('+2 days'), "/");

        $conn->commit();
        echo "success";
    
    } catch (PDOException $e) {
        echo "Error!<br>Please Contact Our Management" . $e->getMessage();
    }
?>