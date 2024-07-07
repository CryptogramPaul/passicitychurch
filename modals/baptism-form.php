<?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    require_once "../database/connection.php";
    require_once "../functions.php";

    date_default_timezone_set('Asia/Manila');

    $baptism_id = sanitize_input($_POST['baptism_id']);
    $operation = sanitize_input($_POST['operation']);

    $sql_baptism = $conn->prepare("SELECT * FROM baptism WHERE id = ? ");
    $sql_baptism->execute([$baptism_id]);
    $result = $sql_baptism->fetch();

    $sql_sponsors = $conn->prepare("SELECT * FROM sponsors WHERE sacrament_id = ? ");
    $sql_sponsors->execute([$baptism_id]);	

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

.form-text {
    font-size: 0.9rem;
}

.line {
    border-bottom: 1px solid black;
    display: inline-block;
    width: 100%;
}
</style>
<div class="modal-content" id="BaptismModal" operation="<?php echo $operation ?>"
    baptism_id="<?php echo $baptism_id ?>">
    <div class="modal-body">
        <div class="form-container">
            <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="row d-flex mb-4 align-items-center">
                <div class="col-lg-2 col-12 text-center">
                    <img src="images/passi-logo.png" alt="Parish Logo" class="img-fluid mb-2"
                        style="max-width: 150px;">
                </div>
                <div class="col-lg-10 col-12 text-center ">
                    <h2>St. William Parish</h2>
                    <p>5037 Passi City, Iloilo<br>Tel. No. (033)-331 5432 / 09468487235</p>
                </div>

            </div>
            <hr>
            <div class="text-center mb-4 ">
                <h4>BAPTISMAL SERVICE FORM</h4>
            </div>

            <div class="row">
                <label for="">Name of Child:</label>
                <div class="form-group col-lg-4 col-12">
                    <label for="child_firstname"></label>
                    <input type="text" class="form-control-plaintext" id="child_firstname" placeholder="Firstname"
                        value="<?php echo $operation == 0 ?  '':$result['child_firstname']?>" required>
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="child_middlename"></label>
                    <input type="text" class="form-control-plaintext" id="child_middlename" placeholder="Middlename"
                        value="<?php echo $operation == 0 ?  '':$result['child_middlename']?>">
                </div>
                <div class="form-group col-lg-4 col-12">
                    <label for="child_lastname"></label>
                    <input type="text" class="form-control-plaintext" id="child_lastname" placeholder="Lastname"
                        value="<?php echo $operation == 0 ?  '':$result['child_lastname']?>" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6 col-12">
                    <label for="placeOfBirth">Place of Birth:</label>
                    <input type="text" class="form-control-plaintext"
                        value="<?php echo $operation == 0 ? '':$result['place_of_birth']?>" id="placeOfBirth">
                </div>
                <div class="form-group col-lg-6 col-12">
                    <label for="dateOfBirth">Date of Birth:</label>
                    <input type="date" value="<?php echo $operation == 0 ? date('Y-m-d'):$result['date_of_birth']?>"
                        max="<?php echo date('Y-m-d')  ?>" class="form-control-plaintext" id="dateOfBirth">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label for="baptism_date">Tentative Date of Baptism</label>
                    <input type="date" class="form-control-plaintext" id="baptism_date"
                        value="<?php echo $operation == 0 ? date('Y-m-d'):$result['baptism_date']?>"
                        min="<?php echo date('Y-m-d')  ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="timeOfBaptism">Time of Baptism</label>
                    <input type="time" class="form-control-plaintext" id="timeOfBaptism"
                        value="<?php echo $operation == 0 ? date('H:i'):$result['baptism_time']  ?>" required>
                </div>
            </div>

            <div class="row">
                <label for="">Father’s Name:</label>
                <div class="form-group col-4">
                    <label for="father_firstname"></label>
                    <input type="text" class="form-control-plaintext" id="father_firstname" placeholder="Firstname"
                        value="<?php echo $operation == 0 ?  '':$result['father_firstname']?>" required>
                </div>
                <div class="form-group col-4">
                    <label for="father_middlename"></label>
                    <input type="text" class="form-control-plaintext" id="father_middlename" placeholder="Middlename"
                        value="<?php echo $operation == 0 ?  '':$result['father_middlename']?>">
                </div>
                <div class="form-group col-4">
                    <label for="father_lastname"></label>
                    <input type="text" class="form-control-plaintext" id="father_lastname" placeholder="Lastname"
                        value="<?php echo $operation == 0 ?  '':$result['father_lastname']?>" required>
                </div>
            </div>

            <div class="row">
                <label for="">Mother’s Name:</label>
                <div class="form-group col-4">
                    <label for="mother_firstname"></label>
                    <input type="text" class="form-control-plaintext" id="mother_firstname" placeholder="Firstname"
                        value="<?php echo $operation == 0 ?  '':$result['mother_firstname']?>" required>
                </div>
                <div class="form-group col-4">
                    <label for="mother_middlename"></label>
                    <input type="text" class="form-control-plaintext" id="mother_middlename" placeholder="Middlename"
                        value="<?php echo $operation == 0 ?  '':$result['mother_middlename']?>">
                </div>
                <div class="form-group col-4">
                    <label for="mother_lastname"></label>
                    <input type="text" class="form-control-plaintext" id="mother_lastname" placeholder="Lastname"
                        value="<?php echo $operation == 0 ?  '':$result['mother_lastname']?>" required>
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
                        onclick="RemoveSponsor(`Baptism`,`<?php echo $result['id']?>`,`<?php echo $sponsor['sponsor_id']?>`, 1)" title="Delete">
                        <i class="fa fa-trash p-1"></i>
                    </a>
                </div>
            </div>
            <?php
                } }
            ?>
            <div class="row" id="sponsor_row"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Confirm Booking</button>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#BaptismForm").on("submit", function(e) {
        e.preventDefault();

        if ($("#BaptismModal").attr('operation') == 0) {
            SaveBaptismForm();
        } else {
            let baptism_id = $("#BaptismModal").attr('baptism_id');
            UpdateBaptismForm(baptism_id);
        }
        return false
    });
    let operation = `<?php echo $operation ?>`;
    if (operation == 0) {
        AddSponsors();
    }
})
</script>