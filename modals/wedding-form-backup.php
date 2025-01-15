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
    $booking_id = sanitize_input($_POST['booking_id']);
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
<div class="modal-content" id="WeddingModal" operation="<?php echo $operation ?>"
    wedding_id="<?php echo $wedding_id ?>">
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
                    <label for="wedding_date">Exact Date of Wedding</label>
                    <input type="date" class="form-control-plaintext" id="wedding_date"
                        value="<?php echo $operation == 0 ? date('Y-m-d'):$result['wedding_date'] ?>"
                        min="<?php echo date('Y-m-d')  ?>" required>
                </div>
                <div class="form-group col-lg-6 col-12">
                    <label for="timeOfWedding">Time of Wedding</label>
                    <input type="time" class="form-control-plaintext" id="timeOfWedding"
                        value="<?php echo $operation == 0 ? date('H:i'):$result['wedding_time'] ?>" required>
                </div>
            </div>

            <div class="row">
                <label for="">Groom’s Name:</label>
                <div class="form-group col-lg-4 col-12">
                    <label for="groom_firstname"></label>
                    <input type="text" class="form-control-plaintext" id="groom_firstname"
                        value="<?php echo $operation == 0 ? '':$result['groom_firstname'] ?>" placeholder="Firstname"
                        required>
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="groom_middlename"></label>
                    <input type="text" class="form-control-plaintext" id="groom_middlename"
                        value="<?php echo $operation == 0 ? '':$result['groom_middlename'] ?>" placeholder="Middlename">
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="groom_lastname"></label>
                    <input type="text" class="form-control-plaintext" id="groom_lastname"
                        value="<?php echo $operation == 0 ? '':$result['groom_lastname'] ?>" placeholder="Lastname"
                        required>
                </div>
            </div>

            <div class="row">
                <label for="">Brides’s Name:</label>
                <div class="form-group col-lg-4 col-12">
                    <label for="bride_firstname"></label>
                    <input type="text" class="form-control-plaintext" id="bride_firstname"
                        value="<?php echo $operation == 0 ? '':$result['bride_firstname'] ?>" placeholder="Firstname"
                        required>
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="bride_middlename"></label>
                    <input type="text" class="form-control-plaintext" id="bride_middlename"
                        value="<?php echo $operation == 0 ? '':$result['bride_middlename'] ?>" placeholder="Middlename">
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="bride_lastname"></label>
                    <input type="text" class="form-control-plaintext" id="bride_lastname"
                        value="<?php echo $operation == 0 ? '':$result['bride_lastname'] ?>" placeholder="Lastname"
                        required>
                </div>
            </div>
            <?php
                $sql_getrates = $conn->prepare("SELECT amount_rate FROM rates WHERE sacrament_type = 'Wedding' AND rate_name = 'Sponsors' GROUP BY sacrament_type ");
                $sql_getrates->execute();
                $rate = $sql_getrates->fetch();
            ?>
            <div class="row d-flex justify-content-between">
                <div class="col-8">
                    <label for="">Sponsors: (Must be a Catholic) &nbsp;
                        <b><?php echo formatCurrency($rate['amount_rate']) ?> per sponsor.</b></label>
                </div>
                <div class="col-2 text-end">
                    <a class="badge bg-primary text-white text-decoration-none badge-primary "
                        onclick="AddSponsors('Wedding')" title="Add Sponsors">
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
                        onclick="RemoveSponsor(`Wedding`,`<?php echo $result['wedding_id']?>`,`<?php echo $sponsor['sponsor_id']?>`, 1)"
                        title="Delete">
                        <i class="fa fa-trash p-1"></i>
                    </a>
                </div>
            </div>
            <?php
                } }
            ?>
            <div class="row" id="wedding_sponsor_row"></div>
        </div>

            <div class="text-center py-3">
                <h4>REQUIREMENTS FOR MARRIAGE</h4>
            </div>
            <div class="row px-3">
                <ul class="list-group list-group-numbered">
                    <?php
                        $requirements = $conn->prepare("SELECT a.requirement_name, a.filename FROM requirements a WHERE a.wedding_id = ? ");
                        $requirements->execute([$wedding_id]);

                        $baptismal = null;
                        $confirmation_cert = null;
                        $marriage_license = null;
                        $marriage_contract = null;
                        while ($requirement = $requirements->fetch(PDO::FETCH_ASSOC)) {
                            $filename = $requirement['filename'];
                            $requirement_name = $requirement['requirement_name'];


                            if($requirement_name == 'Baptismal Certificate') {
                                $baptismal = $filename;
                            }else if($requirement_name == 'Confirmation Certification'){
                                $confirmation_cert = $filename;
                            }else if($requirement_name == 'Marriage License'){
                                $marriage_license = $filename;
                            }else if($requirement_name == 'Marriage Contract'){
                                $marriage_contract = $filename;
                            }
                        }
                    ?>

                    <li class="list-group-item">BAPTISMAL CERTIFICATE &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="file" name="baptismal" id="baptismal">
                        <br>
                        <?php if ($baptismal): ?>
                        <span class="ml-4">Current File: <?php echo htmlspecialchars($baptismal); ?></span>
                        <br>
                        <a href="uploads/<?php echo htmlspecialchars($baptismal); ?>" target="_blank">View Current File</a>
                        <?php endif; ?>
                        <br><span class="ml-4">* FOR MARRIAGE PURPOSES *</span>

                    </li>
                    <li class="list-group-item">CONFIRMATION CERT. &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="file" value="<?php echo $confirmation_cert ?>" name="confirmation_cert"
                            id="confirmation_cert">
                        <br>
                        <?php if ($confirmation_cert): ?>
                        <span class="ml-4">Current File: <?php echo htmlspecialchars($confirmation_cert); ?></span>
                        <br>
                        <a href="uploads/<?php echo htmlspecialchars($confirmation_cert); ?>" target="_blank">View Current
                            File</a>
                        <?php endif; ?>
                        <br><span class="ml-4">FOR MARRIAGE PURPOSES</span>
                    </li>
                    <li class="list-group-item">MARRIAGE LICENSE &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="file" value="<?php echo $marriage_license ?>" name="marriage_license"
                            id="marriage_license">
                        <br>
                        <?php if ($marriage_license): ?>
                        <span class="ml-4">Current File: <?php echo htmlspecialchars($marriage_license); ?></span>
                        <br>
                        <a href="uploads/<?php echo htmlspecialchars($marriage_license); ?>" target="_blank">View Current
                            File</a>
                        <?php endif; ?>
                        <br><span class="ml-4">REGISTRAL W/ RECEIPT</span>
                    </li>
                    <li class="list-group-item">MARRIAGE CONTRACT &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="file" value="<?php echo $marriage_contract ?>" name="marriage_contract"
                            id="marriage_contract">
                        <br>
                        <?php if ($marriage_contract): ?>
                        <span class="ml-4">Current File: <?php echo htmlspecialchars($marriage_contract); ?></span>
                        <br>
                        <a href="uploads/<?php echo htmlspecialchars($marriage_contract); ?>" target="_blank">View Current
                            File</a>
                        <?php endif; ?>
                        <span class="ml-4">(if civil married)</span>
                    </li>
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
            <!-- <div class="col-2 text-end">
                    <a class="badge bg-primary text-white text-decoration-none badge-primary " onclick="AddSponsors('Wedding')"
                        title="Add Sponsors">
                        <i class="fa fa-plus p-1"></i> Add Sponsors
                    </a>
                </div> -->
            <a class="btn btn-success" onclick="AddSponsors('Wedding')" title="Add Sponsors">
                <i class="fa fa-plus p-1"></i> Add Sponsors
            </a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Confirm Booking</button>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

});

function SaveWeddingForm() {
    var formData = new FormData();
    // var formData = new FormData($('#WeddingForm')[0]);

    formData.append("groom_firstname", $("#groom_firstname").val());
    formData.append("groom_middlename", $("#groom_middlename").val());
    formData.append("groom_lastname", $("#groom_lastname").val());
    formData.append("bride_firstname", $("#bride_firstname").val());
    formData.append("bride_middlename", $("#bride_middlename").val());
    formData.append("bride_lastname", $("#bride_lastname").val());
    formData.append("wedding_date", $("#wedding_date").val());
    formData.append("timeOfWedding", $("#timeOfWedding").val());


    let sponsor_arr = [];

    $(".sponsor").each(function() {
        let id = $(this).attr("counter");
        let lastname = $("#sponsors_lastname" + id).val();
        let firstname = $("#sponsors_firstname" + id).val();
        let middlename = $("#sponsors_middlename" + id).val();

        sponsor_arr.push({
            id: id,
            lastname: lastname,
            firstname: firstname,
            middlename: middlename,
        });
    });

    let SponsorJson = JSON.stringify(sponsor_arr);
    formData.append("SponsorJson", SponsorJson);

    formData.append("baptismal", $("#baptismal")[0].files[0]);
    formData.append("confirmation_cert", $("#confirmation_cert")[0].files[0]);
    formData.append("marriage_license", $("#marriage_license")[0].files[0]);
    formData.append("marriage_contract", $("#marriage_contract")[0].files[0]);

    $.ajax({
        url: 'actions/save-wedding-form.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (jQuery.trim(response) == "success") {
                $("#show_wedding").modal("hide");
                toastAlert("success", "Appointment created successfully.");
                ShowTransactionCanvas();
            } else {
                toastAlert("warning", response);
            }
        }
    });
}

function UpdateWedding(wedding_id) {
    var formData = new FormData();
    // var formData = new FormData($('#WeddingForm')[0]);

    formData.append("groom_firstname", $("#groom_firstname").val());
    formData.append("groom_middlename", $("#groom_middlename").val());
    formData.append("groom_lastname", $("#groom_lastname").val());
    formData.append("bride_firstname", $("#bride_firstname").val());
    formData.append("bride_middlename", $("#bride_middlename").val());
    formData.append("bride_lastname", $("#bride_lastname").val());
    formData.append("wedding_date", $("#wedding_date").val());
    formData.append("timeOfWedding", $("#timeOfWedding").val());


    let sponsor_arr = [];

    $(".sponsor").each(function() {
        let id = $(this).attr("counter");
        let lastname = $("#sponsors_lastname" + id).val();
        let firstname = $("#sponsors_firstname" + id).val();
        let middlename = $("#sponsors_middlename" + id).val();

        sponsor_arr.push({
            id: id,
            lastname: lastname,
            firstname: firstname,
            middlename: middlename,
        });
    });

    let SponsorJson = JSON.stringify(sponsor_arr);
    formData.append("SponsorJson", SponsorJson);
    formData.append("wedding_id", wedding_id);

    formData.append("baptismal", $("#baptismal")[0].files[0]);
    formData.append("confirmation_cert", $("#confirmation_cert")[0].files[0]);
    formData.append("marriage_license", $("#marriage_license")[0].files[0]);
    formData.append("marriage_contract", $("#marriage_contract")[0].files[0]);

    $.ajax({
        url: 'actions/update-wedding-form.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (jQuery.trim(response) == "success") {
                $("#show_wedding").modal("hide");
                toastAlert("success", "Appointment updated successfully.");
                ShowTransactionCanvas();
            } else {
                toastAlert("warning", response);
            }
        }
    });
}
</script>