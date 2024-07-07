<?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    require_once "../database/connection.php";
    require_once "../functions.php";

    date_default_timezone_set('Asia/Manila');

    $wedding_id = sanitize_input($_POST['wedding_id']);
    $operation = sanitize_input($_POST['operation']);

    $sql_wedding = $conn->prepare("SELECT * FROM wedding WHERE wedding_id = ? ");
    $sql_wedding->execute([$wedding_id]);
    $result = $sql_wedding->fetch();

    $sql_sponsors = $conn->prepare("SELECT * FROM sponsors WHERE sacrament_id = ? ");
    $sql_sponsors->execute([$wedding_id]);  

?>
<style>
   .form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    .form-group {
        margin-bottom: 0.5rem;
    }
    .form-group label {
        font-weight: bold;
    }
    .form-control-plaintext {
        border-bottom: 1px solid black;
    }
    .list-group-item {
        border: none;
        padding-left: 0;
    }
    .list-group-numbered .list-group-item {
        /*display: list-item;*/
        list-style-position: inside;
        /*list-style-type: decimal;*/
    }
    </style>
<div class="modal-content" id="WeddingModal" operation="<?php echo $operation ?>" wedding_id="<?php echo $wedding_id ?>">
    <div class="modal-body">
        <div class="form-container">
            <div class="text-center mb-4">
                <h2>PARISH OF ST. WILLIAM</h2>
                <h5>Passi City, Iloilo</h5>
            </div>
            <div class="text-center mb-4">
                <h4>MARRIAGE FORM</h4>
            </div>
            
            <div class="row">
                <div class="form-group col-lg-6 col-12">
                    <label for="wedding_date">Tentative Date of Wedding</label>
                    <input type="date" class="form-control-plaintext" id="wedding_date" value="<?php echo $operation == 0 ? date('Y-m-d'):$result['wedding_date'] ?>" min="<?php echo date('Y-m-d')  ?>" required>
                </div>
                <div class="form-group col-lg-6 col-12">
                    <label for="timeOfWedding">Time of Wedding</label>
                    <input type="time" class="form-control-plaintext" id="timeOfWedding" value="<?php echo $operation == 0 ? date('H:i'):$result['wedding_time'] ?>" required>
                </div>
            </div>
            
            <div class="row">
                <label for="">Groom’s Name:</label>
                <div class="form-group col-lg-4 col-12">
                    <label for="groom_firstname"></label>
                    <input type="text" class="form-control-plaintext" id="groom_firstname" value="<?php echo $operation == 0 ? '':$result['groom_firstname'] ?>" placeholder="Firstname" required>
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="groom_middlename"></label>
                    <input type="text" class="form-control-plaintext" id="groom_middlename" value="<?php echo $operation == 0 ? '':$result['groom_middlename'] ?>" placeholder="Middlename">
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="groom_lastname"></label>
                    <input type="text" class="form-control-plaintext" id="groom_lastname" value="<?php echo $operation == 0 ? '':$result['groom_lastname'] ?>" placeholder="Lastname" required>
                </div>
            </div>
            
            <div class="row">
                <label for="">Brides’s Name:</label>
                <div class="form-group col-lg-4 col-12">
                    <label for="bride_firstname"></label>
                    <input type="text" class="form-control-plaintext" id="bride_firstname" value="<?php echo $operation == 0 ? '':$result['bride_firstname'] ?>" placeholder="Firstname" required>
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="bride_middlename"></label>
                    <input type="text" class="form-control-plaintext" id="bride_middlename" value="<?php echo $operation == 0 ? '':$result['bride_middlename'] ?>" placeholder="Middlename">
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="bride_lastname"></label>
                    <input type="text" class="form-control-plaintext" id="bride_lastname" value="<?php echo $operation == 0 ? '':$result['bride_lastname'] ?>" placeholder="Lastname" required>
                </div>
            </div>

            <div class="row d-flex justify-content-between">
                <div class="col-6">
                    <label for="">Sponsors: (Must be a Catholic)</label>

                </div>
                <div class="col-6 text-end">
                    <a class="badge bg-primary text-white text-decoration-none badge-primary " onclick="AddSponsors()"
                        title="Add Sponsors">
                        <i class="fa fa-plus p-1"></i> Add Sponsors
                    </a>
                </div>
            </div>
            <?php
                if ($operation == 1) {
                while ($sponsor = $sql_sponsors->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="row sponsor" id="Sponsor<?php echo $sponsor['sponsor_id']?>"
                counter="<?php echo $sponsor['sponsor_id']?>">
                <div class="form-group col-4">
                    <label for="sponsors_firstname"></label>
                    <input type="text" class="form-control-plaintext"
                        id="sponsors_firstname<?php echo $sponsor['sponsor_id']?>"
                        value="<?php echo $sponsor['firstname']?>" placeholder="Firstname" required>
                </div>
                <div class="form-group col-4">
                    <label for="sponsors_middlename"></label>
                    <input type="text" class="form-control-plaintext"
                        id="sponsors_middlename<?php echo $sponsor['sponsor_id']?>"
                        value="<?php echo $sponsor['middlename']?>" placeholder="Middlename">
                </div>
                <div class="form-group col-4 d-flex justify-content-between align-items-end">
                    <label for="sponsors_lastname"></label>
                    <input type="text" class="form-control-plaintext"
                        id="sponsors_lastname<?php echo $sponsor['sponsor_id']?>"
                        value="<?php echo $sponsor['lastname']?>" placeholder="Lastname" required>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="badge bg-danger text-white text-decoration-none badge-danger "
                        onclick="RemoveSponsor(`Wedding`,`<?php echo $result['wedding_id']?>`,`<?php echo $sponsor['sponsor_id']?>`, 1)" title="Delete">
                        <i class="fa fa-trash p-1"></i>
                    </a>
                </div>
            </div>
            <?php
                } }
            ?>
            <div class="row" id="sponsor_row"></div>
        </div>

        

        <div class="text-center py-3">
            <h4>REQUIREMENTS FOR MARRIAGE</h4>
        </div>
        <div class="row px-3" >
            <ul class="list-group list-group-numbered">
                <input type="hidden" readonly id="baptismal_file" class="form-control-custom border-none pl-2" placeholder="file here...">
                <input type="hidden" readonly id="confirmation_cert_file" class="form-control-custom border-none pl-2" placeholder="file here...">
                <input type="hidden" readonly id="marriage_license_file" class="form-control-custom border-none pl-2" placeholder="file here...">
                <input type="hidden" readonly id="marriage_cont_file" class="form-control-custom border-none pl-2" placeholder="file here...">


                <li class="list-group-item">BAPTISMAL CERTIFICATE &nbsp;&nbsp;&nbsp;&nbsp; 
                    <input type="file" name="baptismal" id="baptismal" > 
                    <br><span class="ml-4">* FOR MARRIAGE PURPOSES *</span></li>
                <li class="list-group-item">CONFIRMATION CERT. &nbsp;&nbsp;&nbsp;&nbsp; 
                    <input type="file" name="confirmation_cert" id="confirmation_cert" > 
                    <br><span class="ml-4">FOR MARRIAGE PURPOSES</span></li>
                <li class="list-group-item">MARRIAGE LICENSE &nbsp;&nbsp;&nbsp;&nbsp; 
                    <input type="file" name="marriage_license" id="marriage_license" >
                    <br><span class="ml-4">REGISTRAL W/ RECEIPT</span></li>
                <li class="list-group-item">MARRIAGE CONTRACT &nbsp;&nbsp;&nbsp;&nbsp; 
                    <input type="file" name="marriage_cont" id="marriage_cont" >
                    <br><span class="ml-4">(if civil married)</span></li>
                <li class="list-group-item">BANNS (TAWAG) 3 SUNDAYS</li>
                <li class="list-group-item">FREEDOM TO MARRY (Groom)</li>
                <li class="list-group-item">PERMIT TO MARRY (Bride)</li>
                <li class="list-group-item">3 CONSECUTIVE SUNDAYS<br><span class="ml-4">SEMINAR CHURCH - 9AM</span></li>
            </ul>
        </div>
            
        <div class="mt-2">
            <p>Note:</p>
            <!-- <p>Please bring photocopies</p> -->
        </div>

        <div class="mt-4">
            <p>Flower girls, Ring and Coin Bearer must be 7 years old and above</p>
        </div>


        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Confirm Booking</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#WeddingForm").on("submit", function(e) {
            e.preventDefault();

            if ($("#WeddingModal").attr('operation') == 0) {
                SaveWeddingForm();
            } else {
                let wedding_id = $("#WeddingModal").attr('wedding_id');
                UpdateWeddingForm(wedding_id);
            }
            return false
        });

    });

//     id="confirmation_cert_file"
// id="marriage_license_file"
// id="marriage_cont_file"
    function BaptismalFile(input) {
        var FileSize = input.files[0].size / 1024 / 1024;
        if (FileSize > 3) {
          modal_alert2("Please adjust your attached document size! - Max 3MB", "warning", 0, 0);
          $("#baptismal_file").val("");
          return;
        }
        $("#baptismal_file").val("");
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            // reader.onload = function (e) {
            //     $('#image').css('background-image', 'url("'+e.target.result+'")');
            //     $("#checkingimage").val('having');
            // }
            reader.readAsDataURL(input.files[0]);
            $("#baptismal_file").val(input.files[0].name);

            // setTimeout(function(){ actionSaveImage(); }, 100);
        }
    }

    function ConfirmationCertFile(input) {
        var FileSize = input.files[0].size / 1024 / 1024;
        if (FileSize > 3) {
          modal_alert2("Please adjust your attached document size! - Max 3MB", "warning", 0, 0);
          $("#confirmation_cert_file").val("");
          return;
        }
        $("#confirmation_cert_file").val("");
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            // reader.onload = function (e) {
            //     $('#image').css('background-image', 'url("'+e.target.result+'")');
            //     $("#checkingimage").val('having');
            // }
            reader.readAsDataURL(input.files[0]);
            $("#confirmation_cert_file").val(input.files[0].name);

            // setTimeout(function(){ actionSaveImage(); }, 100);
        }
    }

    function MarriageLicenseFile(input) {
        var FileSize = input.files[0].size / 1024 / 1024;
        if (FileSize > 3) {
          modal_alert2("Please adjust your attached document size! - Max 3MB", "warning", 0, 0);
          $("#marriage_license_file").val("");
          return;
        }
        $("#marriage_license_file").val("");
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            // reader.onload = function (e) {
            //     $('#image').css('background-image', 'url("'+e.target.result+'")');
            //     $("#checkingimage").val('having');
            // }
            reader.readAsDataURL(input.files[0]);
            $("#marriage_license_file").val(input.files[0].name);

            // setTimeout(function(){ actionSaveImage(); }, 100);
        }
    }

     function MarriageContractFile(input) {
        var FileSize = input.files[0].size / 1024 / 1024;
        if (FileSize > 3) {
          modal_alert2("Please adjust your attached document size! - Max 3MB", "warning", 0, 0);
          $("#marriage_cont_file").val("");
          return;
        }
        $("#marriage_cont_file").val("");
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            // reader.onload = function (e) {
            //     $('#image').css('background-image', 'url("'+e.target.result+'")');
            //     $("#checkingimage").val('having');
            // }
            reader.readAsDataURL(input.files[0]);
            $("#marriage_cont_file").val(input.files[0].name);

            // setTimeout(function(){ actionSaveImage(); }, 100);
        }
    }
 </script>