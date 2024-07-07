<?php
    try {

    	// session_destroy();
    	// setcookie(cookiename, value, expire/options, path, domain, secure, httponly, options)
        setcookie('userid', "",time() - 3600,"/");
        // setcookie('employeetype', "",time() - 3600,"/","", true, true);
		// setcookie('employeeid', "",time() - 3600,"/","", true, true);
        // setcookie('employeename', "",time() - 3600,"/","", true, true);
        // setcookie('locationcode', "",time() - 3600,"/","", true, true);
		// setcookie('token', "",time() - 3600,"/","", true, true);

		echo "success";
    } catch (\Throwable $e) {
    	echo $e->getMessage();
    }
?>