<?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    require_once "../database/connection.php";
    require_once "../functions.php";

    $id = sanitize_input($_POST['id']);
    $operation = sanitize_input($_POST['operation']);

    $sql_user = $conn->prepare("SELECT a.* 
            FROM customer a
            WHERE a.customer_id = ?");
    $sql_user->execute([$id]);
    $user = $sql_user->fetch();

?>
<div class="modal-content" id="UserModal" operation="<?php echo $operation?>">
    <div class="modal-body">
        <div class="row text-center">
            <div class="col-md-12">
                <h3>SIGN UP</h3>
            </div>
        </div>
        <hr>
        <div class="row pt-3">
            <div class="col">
                <label class="fw-bold" for="firstname">Firstname</label>
                <input type="text" class="form-control" id="firstname" placeholder="Firstname"
                    value="<?php echo $operation == 0 ?  '':$user['firstname']?>" required>
            </div>
            <div class="col">
                <label class="fw-bold" for="middlename">Middlename</label>
                <input type="text" class="form-control" id="middlename" placeholder="Middlename"
                    value="<?php echo $operation == 0 ?  '':$user['middlename']?>">
            </div>
            <div class="col">
                <label class="fw-bold" for="lastname">Lastname</label>
                <input type="text" class="form-control" id="lastname" placeholder="Lastname"
                    value="<?php echo $operation == 0 ?  '':$user['lastname']?>" required>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col">
                <label class="fw-bold" for="contact_no">Contact No.</label>
                <input type="text" class="form-control" id="contact_no" placeholder="Contact No."
                    value="<?php echo $operation == 0 ?  '':$user['contact_no']?>" required>
            </div>
            <div class="col">
                <label class="fw-bold" for="email_add">Email Address</label>
                <input type="email" class="form-control" placeholder="Email Address"
                    value="<?php echo $operation == 0 ?  '':$user['email_address']?>" id="email_add">
            </div>
        </div>
        <div class="row pt-3">
            <div class="col">
                <label class="fw-bold" for="barangay">Barangay</label>
                <input type="text" class="form-control" placeholder="Barangay"
                    value="<?php echo $operation == 0 ?  '':$user['barangay']?>" required id="barangay">
            </div>
            <div class="col">
                <label class="fw-bold" for="municipality">Municipality/City</label>
                <input type="text" class="form-control" placeholder="Municipality/City"
                    value="<?php echo $operation == 0 ?  '':$user['municipality']?>" required id="municipality">
            </div>
            <div class="col">
                <label class="fw-bold" for="province">Province</label>
                <input type="text" class="form-control" placeholder="Province"
                    value="<?php echo $operation == 0 ?  '':$user['province']?>" required id="province">
            </div>
        </div>
        <div class="row pt-3">
            <div class="col">
                <label class="fw-bold" for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Username"
                    value="<?php echo $operation == 0 ?  '':$user['username']?>" required>
            </div>
            <div class="col">
                <label class="fw-bold" for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password"
                    value="<?php echo $operation == 0 ?  '':$user['password']?>" required>
            </div>
        </div>
        <hr>
        <div class="row ">
            <div class="col-12 d-flex justify-content-end">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary" id="signUpBtn" type="submit">
                    <span id="btnText"><?php echo $operation == 0 ? 'Sign Up':'Update' ?></span>
                    <div id="spinner" class="spinner-border spinner-border-sm text-light" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
                <!-- <button type="submit"
                    class="btn btn-primary"><?php echo $operation == 0 ? 'Sign Up':'Update' ?></button> -->
            </div>
        </div>
    </div>
    <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Confirm Booking</button>
            </div>
        </div> -->
</div>