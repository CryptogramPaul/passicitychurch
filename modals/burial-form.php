<?php 
     if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    require_once "../database/connection.php";
    require_once "../functions.php";

    date_default_timezone_set('Asia/Manila');

    $id = $_COOKIE['userid'];
    
    $burial_id = sanitize_input($_POST['id']);
    $operation = sanitize_input($_POST['operation']);

    $sql_user = $conn->prepare("SELECT CONCAT_WS(' ', a.firstname, a.middlename, a.lastname) as name, a.customer_id
            FROM customer a
            WHERE a.customer_id = ?");
    $sql_user->execute([$id]);
    $user = $sql_user->fetch();
?>
<!-- <script src="../js/custom.js"></script> -->
<style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
    }
    .form-group {
        margin-bottom: 10px;
    }
    .form-group label {
        font-weight: bold;
    }
    .form-control-plaintext {
        border-bottom: 1px solid black;
    }
    .section-title {
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }
</style>

<div class="modal-content" id="BurialModal" operation="<?php echo $operation ?>"
    burial_id="<?php echo $burial_id ?>">
     <!-- <div class="modal-header">
         <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div> -->
    <div class="modal-body">
        <div class="">
            <div class="text-center mb-4 form-container">
                <h2>St. William Parish</h2>
                <h4>Passi City</h4>
            </div>
        
            <div class="section-title">BURIAL FORM</div>

            <div class="row">
                <div class="form-group col-lg-6 col-12">
                    <label for="dateApplied">Date Applied</label>
                    <input value="<?php echo $operation == 0 ? date('Y-m-d'):$result['date_applied']?>" type="date" class="form-control-plaintext" id="dateApplied" autocomplete="off" required>
                </div>
                <div class="form-group col-lg-6 col-12">
                    <label for="contactNo">Contact No.</label>
                    <input type="number" value="<?php echo $operation == 0 ? '':$result['contact_no']?>" class="form-control-plaintext" id="contactNo" autocomplete="off" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-4 col-12">
                    <label for="burial_firstname">Name:</label>
                    <input type="text" class="form-control-plaintext" value="<?php echo $operation == 0 ? '':$result['firstname']?>" id="burial_firstname" placeholder="Firstname" autocomplete="off" required>
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="burial_middlename">&nbsp;</label>
                    <input type="text" class="form-control-plaintext" value="<?php echo $operation == 0 ? '':$result['middlename']?>" id="burial_middlename" placeholder="Middlename" autocomplete="off">
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="burial_lastname">&nbsp;</label>
                    <input type="text" class="form-control-plaintext" value="<?php echo $operation == 0 ? '':$result['lastname']?>" id="burial_lastname" placeholder="Lastname" autocomplete="off" required>
                </div>
            </div>

            <!-- <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control-plaintext" id="name" autocomplete="off" required>
            </div> -->
            
            <div class="row">
                <div class="form-group col-lg-6 col-12">
                    <label for="dateOfBirth">Date of Birth</label>
                    <input value="<?php echo $operation == 0 ? date('2000'.'-m-d'):$result['date_applied']?>" max="<?php echo date('Y-m-d')  ?>" type="date" class="form-control-plaintext" id="dateOfBirth" min="15" autocomplete="off" required>
                </div>
                <div class="form-group col-lg-3 col-12">
                    <label for="age">Age</label>
                    <input type="number" value="<?php echo $operation == 0 ? '':$result['age']?>" class="form-control-plaintext text-end" id="age" autocomplete="off" required>
                </div>
                <div class="form-group col-lg-3 col-12">
                    <label for="">Gender</label>
                    <?php 
                        $male = "";
                        $female = "";
                        if ($operation == 0) {
                            $male = "checked";
                        }else{
                            if ($result['gender'] == 'Male') {
                                $male = "checked";
                            }else{
                                $female = "checked";
                            }
                        }
                    ?>
                    <div class="pt-3 ">
                        <label class="mr-3"><input type="radio" value="Male" name="gender" <?php echo $male ?> > Male</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="mr-3"><input type="radio" value="Female" name="gender" <?php echo $female ?>> Female</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="address">Address <small>(Brgy, Municipality, Provice) </small></label>
                <input type="text" class="form-control-plaintext" value="<?php echo $operation == 0 ? '':$result['address']?>" id="address" autocomplete="off" required>
            </div>
            
            <div class="form-group ">
                <label>Marital Status</label>
                <?php 
                        $single = "";
                        $married = "";
                        $widow = "";
                        $widower = "";
                        if ($operation == 0) {
                            $single = "checked"; 
                        }else{
                            switch ($result['marital_status']) {
                                case 'Single':
                                    $single = "checked";
                                    break;
                                case 'Married':
                                     $married = "checked";
                                    break;
                                case 'Widow':
                                    $widow = "checked";
                                    break;
                                case 'Widower':
                                     $widower = "checked";
                                    break;
                            }
                        }
                    ?>
                <div class="pt-3">
                    <label class="mr-3"><input type="radio" name="maritalStatus" <?php echo $single ?> value="Single" checked> Single</label>
                    <label class="mr-3"><input type="radio" name="maritalStatus" <?php echo $married ?> value="Married" > Married</label>
                    <label class="mr-3"><input type="radio" name="maritalStatus" <?php echo $widow ?> value="Widow" > Widow</label>
                    <label class="mr-3"><input type="radio" name="maritalStatus" <?php echo $widower ?> value="Widower" > Widower</label>
                </div>
                <hr>
            </div>
            
            <div class="row">
                <div class="form-group col-lg-6 col-12">
                    <label for="father">Father <small> (firstname, middlename,lastname) </small></label>
                    <input type="text" value="<?php echo $operation == 0 ? '':$result['father_name']?>" class="form-control-plaintext" id="father" autocomplete="off">
                </div>
                <div class="form-group col-lg-6 col-12">
                    <label for="mother">Mother <small> (firstname, middlename,lastname) </small></label>
                    <input type="text" value="<?php echo $operation == 0 ? '':$result['mother_name']?>" class="form-control-plaintext" id="mother" autocomplete="off" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-8 col-12">
                    <label for="spouse">Spouse <small> (firstname, middlename,lastname) </small></label>
                    <input type="text" value="<?php echo $operation == 0 ? '':$result['spouse_name']?>" class="form-control-plaintext" id="spouse" autocomplete="off" >
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="noOfChildren">No. of Children</label>
                    <input type="number" value="<?php echo $operation == 0 ? '':$result['no_of_children']?>" class="form-control-plaintext" min="0"  id="noOfChildren" autocomplete="off">
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-lg-3 col-12">
                    <label for="childrenAlive">No. of Alive</label>
                    <input type="number" class="form-control-plaintext" min="0" value="<?php echo $operation == 0 ? '':$result['no_alive']?>" id="childrenAlive" autocomplete="off">
                </div>
                <div class="form-group col-lg-3 col-12">
                    <label for="childrenDead">No. of Dead</label>
                    <input type="number" class="form-control-plaintext" min="0" value="<?php echo $operation == 0 ? '':$result['no_dead']?>" id="childrenDead" autocomplete="off">
                </div>
            </div>
            
            <div class="form-group">
                <label for="personResponsible">Person Responsible <small> (firstname, middlename,lastname) </small></label>
                <input type="text" class="form-control-plaintext" id="personResponsible" value="<?php echo $operation == 0 ? $user['name']:$result['person_responsible']?>" customer_id ="<?php echo $result['customer_id'] ?>" required disabled>
            </div>

            <div class="row">
                <div class="form-group col-lg-5 col-12">
                    <label for="relationship">Relationship</label>
                    <input type="text" class="form-control-plaintext" id="relationship" value="<?php echo $operation == 0 ? '':$result['relationship']?>" autocomplete="off" required>
                </div>
                <div class="form-group col-lg-5 col-12">
                    <label for="membership">Membership in Church Organization</label>
                    <input type="text" class="form-control-plaintext" id="membership" value="<?php echo $operation == 0 ? '':$result['member_in_church_org']?>" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-5 col-12">
                    <label for="lastRites">Date of Last Rites</label>
                    <input  type="date" class="form-control-plaintext" value="<?php echo $operation == 0 ? date('Y-m-d'):$result['date_of_last_rites']?>"  max="<?php echo date('Y-m-d') ?>" id="lastRites">
                </div>
            </div>

            <div class="form-group">
                <label for="causeOfDeath">Cause of Death</label>
                <input type="text" value="<?php echo $operation == 0 ? '':$result['cause_of_death']?>" class="form-control-plaintext" id="causeOfDeath" autocomplete="off" required>
            </div>

            <div class="row">
                <div class="form-group col-lg-6 col-12">
                    <label for="dateOfDeath">Date of Death</label>
                    <input value="<?php echo $operation == 0 ? date('Y-m-d'):$result['date_of_death']?>" max="<?php echo date('Y-m-d')  ?>" type="date" class="form-control-plaintext" id="dateOfDeath" autocomplete="off" required>
                </div>
                <div class="form-group col-lg-6 col-12">
                    <label for="deathCertNo">Death Cert. No.</label>
                    <input type="text" value="<?php echo $operation == 0 ? date('Y-m-d'):$result['date_of_death']?>" class="form-control-plaintext" id="deathCertNo" autocomplete="off">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-6 col-12">
                    <label for="burialPermitNo">Burial Permit No.</label>
                    <input type="text" value="<?php echo $operation == 0 ? '':$result['burial_permit_no']?>" class="form-control-plaintext" id="burialPermitNo" autocomplete="off">
                </div>
                <div class="form-group col-lg-6 col-12">
                    <label for="cemetery">Cemetery</label>
                    <input type="text" value="<?php echo $operation == 0 ? '':$result['cemetery']?>" class="form-control-plaintext" id="cemetery" autocomplete="off">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-6 col-12">
                    <label for="dateOfBurial">Date of Burial</label>
                    <input value="<?php echo $operation == 0 ? date('Y-m-d'):$result['date_of_burial']?>" min="<?php echo date('Y-m-d')  ?>" type="date" class="form-control-plaintext" id="dateOfBurial">
                </div>
                <div class="form-group col-lg-6 col-12">
                    <label for="timeOfBurial">Time of Burial</label>
                    <input type="time" value="<?php echo $operation == 0 ? date('H:i'):$result['time_of_burial']?>" class="form-control-plaintext" id="timeOfBurial">
                </div>
            </div>

            <!-- <div class="form-group">
                <label for="bacCoordinator">BAC Coordinator</label>
                <input type="text" class="form-control-plaintext" id="bacCoordinator">
            </div>

            <div class="form-group">
                <label for="bacSignature">Signature of BACC</label>
                <input type="text" class="form-control-plaintext" id="bacSignature">
            </div>

            <p>(For Guest Celebrant Must be signed accordingly before burial can be scheduled)</p>

            <div class="form-group">
                <label for="celebrant">Celebrant at Funeral</label>
                <input type="text" class="form-control-plaintext" id="celebrant">
            </div>

            <div class="form-group">
                <label for="celebrantSignature">Signature</label>
                <input type="text" class="form-control-plaintext" id="celebrantSignature">
            </div> -->
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Confirm Booking</button>
    </div>
 </div>
<script>
    $(document).ready(function () {
        $("#SacramentsForm").on("submit", function(e) {
            e.preventDefault();

            if ($("BurialModal").attr('operation') == 0) {
                SaveBurialForm();
            } else {
                let burial_id = $("#BurialModal").attr('burial_id');
                UpdateBurialForm(burial_id);
            }
            return false
        });
      // $("#SacramentsForm").on("submit", function (e) {
      //   e.preventDefault();
      //   SaveBurialForm();
      // });
      return false;
    });
</script>   
