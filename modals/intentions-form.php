<?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    require_once "../database/connection.php";
    require_once "../functions.php";

    $intentions_id = sanitize_input($_POST['intention_id']);
    $operation = sanitize_input($_POST['operation']);

    $sql_intentions = $conn->prepare("SELECT * FROM intentions WHERE id = ? ");
    $sql_intentions->execute([$intentions_id]);
    $result = $sql_intentions->fetch();


    $sql_intentions_details = $conn->prepare("SELECT * FROM intentions_sub_details WHERE intentions_id = ? ");
    $sql_intentions_details->execute([$intentions_id]);
    $sub_result = $sql_intentions_details->fetchAll();

    $birthday = '';
    $birthday_id = '';
    $wedding_annv = '';
    $wedding_annv_id = '';
    $blessings_received = '';
    $blessings_received_id = '';
    $blessings_remarks = '';
    $tg_others = '';
    $tg_others_id = '';
    
    $soul = '';
    $soul_id = '';
    
    $good_health = '';
    $good_health_id = '';
    $fast_recovery = '';
    $fast_recovery_id = '';
    $guidance_for_the_exam = '';
    $guidance_for_the_exam_id = '';
    $guidance_for_the_exam_remarks = '';
    $petition_others = '';
    $petition_id = '';
    $p_others_remarks = '';
    
    $others = '';
    $others_id = '';


    foreach ($sub_result as $key => $value) {
        if ($value['intentions_type'] == 'Thanksgiving') {
            if ($value['intentions_name'] == 'Birthday') {
                $birthday = 1;
                $birthday_id = $value['detail_id'];
            }
            if ($value['intentions_name'] == 'Wedding Anniversary') {
                $wedding_annv = 1;
                $wedding_annv_id = $value['detail_id'];
            }
            
            if ($value['intentions_name'] == 'Blessings received') {
                $blessings_received = 1;
                $blessings_received_id = $value['detail_id'];
                $blessings_remarks = $value['remarks'];
            }
            
            if ($value['intentions_name'] == 'Others') {
                $tg_others = 1;
                $tg_others_id = $value['detail_id'];
                $tg_others_remarks = $value['remarks'];
            }
        }
        
        if ($value['intentions_type'] == 'Soul') {
            $soul_id = $value['detail_id'];
            $soul = $value['remarks'];
        }
        
        if ($value['intentions_type'] == 'Petition') {
            if ($value['intentions_name'] == 'Good Health') {
                $good_health_id = $value['detail_id'];
                $good_health = 1;
            }
            
            if ($value['intentions_name'] == 'Fast Recovery') {
                $fast_recovery_id = $value['detail_id'];
                $fast_recovery = 1;
            }
            
            if ($value['intentions_name'] == 'Guidance for the Exam') {
                $guidance_for_the_exam = 1;
                $good_health_id = $value['detail_id'];
                $guidance_for_the_exam_remarks = $value['remarks'];
            }
            
            if ($value['intentions_name'] == 'Others') {
                $petition_others = 1;
                $petition_others_id = $value['detail_id'];
                $p_others_remarks = $value['remarks'];
            }
        }
        
        if ($value['intentions_type'] == 'Other') {
            $others_id = $value['detail_id'];
            $others = $value['remarks'];
        }
    }
    
    $sql_customer = $conn->prepare("SELECT concat_ws(' ', firstname, middlename, lastname) as customer_name FROM customer WHERE customer_id = ? ");
    $sql_customer->execute([$_COOKIE['customer_id']]);	
    $customer = $sql_customer->fetch()

?>
<style>
.form-container {
    max-width: 500px;
    margin: 0 auto;
    /* padding: 20px; */
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
<div class="modal-content" id="IntentionsModal" operation="<?php echo $operation ?>"
    intentions_id="<?php echo $intentions_id ?>">
    <div class="modal-body">
        <div class="form-container">
            <h4 class="text-center mb-2">Intentions Form</h4>
            <div class="row mb-1">
                <div class="col-12 col-xl-6 form-group">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control form-control-sm" id="date" value="<?php echo $operation == 1 ? $result['date']:date('Y-m-d')  ?>" min="<?php echo date('Y-m-d') ?>" >
                </div>
                <div class="col-12 col-xl-6 form-group">
                    <label for="time">Time:</label>
                    <input type="time" class="form-control form-control-sm" value="<?php echo $operation == 1 ? $result['time']:date('H:i') ?>" id="time" >
                </div>
            </div>
            <hr>
            <div class="row mb-1">
                <h5>Thanksgiving</h5>
                <div class="form-check col-12 px-5">
                    <input type="checkbox" class="form-check-input" id="birthday" name="birthday" type="thanksgiving" value="Birthday" detail_id = '<?php echo $operation == 1 ? $birthday_id:'' ?>' <?php echo $birthday == 1 ? 'checked':'' ?> >
                    <label class="form-check-label" for="birthday">Birthday</label>
                </div>
                <div class="form-check col-12 px-5">
                    <input type="checkbox" class="form-check-input" id="wedding_anniversary" name="wedding_anniversary" type="thanksgiving" value="Wedding Anniversary" detail_id = '<?php echo $operation == 1 ? $wedding_annv_id:'' ?>' <?php echo $wedding_annv == 1 ? 'checked':'' ?>>
                    <label class="form-check-label" for="wedding_anniversary">Wedding Anniversary</label>
                </div>
                <div class="form-check col-12 px-5">
                    <input type="checkbox" class="form-check-input" id="blessings_received" name="blessings_received" type="thanksgiving" value="Blessings received" detail_id = '<?php echo $operation == 1 ? $blessings_received_id:'' ?>' <?php echo $blessings_received == 1 ? 'checked':'' ?>  onchange="BlessingsReceived()">
                    <label class="form-check-label" for="blessings_received">Blessings received</label>
                    <div id="BlessingsRemarksDiv">
                        <?php
                            if ($blessings_received == 1) {
                                echo '<div class="form-group col-12">
                                        <textarea class="form-control form-control-sm" name="blessings_remarks" id="blessings_remarks" cols="30" rows="3" placeholder="Remarks">'.$blessings_remarks.'</textarea>
                                    </div>';
                            }
                        ?>
                    </div>
                </div>
                <div class="form-check col-12 px-5">
                    <input type="checkbox" class="form-check-input" id="t_others" name="t_others" type="thanksgiving" value="Others" detail_id = '<?php echo $operation == 1 ? $tg_others_id:'' ?>' <?php echo $tg_others == 1 ? 'checked':'' ?> onchange="ThanksGivingOther()">
                    <label class="form-check-label" for="t_others">Others</label>
                    <div id="ThanksGivingRemarksDiv">
                        <?php
                            if ($tg_others == 1) {
                                echo '<div class="form-group col-12">
                                        <textarea class="form-control form-control-sm" name="blessings_remarks" id="tg_remarks" cols="30" rows="3" placeholder="Remarks">'.$tg_others_remarks.'</textarea>
                                    </div>';
                            }
                        ?>
                    </div>
                </div>
                
            </div>
            <hr>
            <div class="row mb-1">
                <h5>Soul</h5>
                <div class="form-group col-12">
                    <textarea class="form-control form-control-sm" id="soul" detail_id = '<?php echo $operation == 1 ? $soul_id:'' ?>' cols="30" rows="3"  placeholder="Remarks"><?php echo $soul ?></textarea>
                </div>
            </div>
            <hr>
            <div class="row mb-1">
                <h5>Petition</h5>
                <div class="form-check px-5">
                    <input type="checkbox" class="form-check-input" id="good_health" detail_id = '<?php echo $operation == 1 ? $petition_id:'' ?>' <?php echo $good_health == 1 ? 'checked':'' ?> value="Good health">
                    <label class="form-check-label" for="good_health">Good health</label>
                </div>
                <div class="form-check px-5">
                    <input type="checkbox" class="form-check-input" id="fast_recovery" detail_id = '<?php echo $operation == 1 ? $fast_recovery_id:'' ?>' <?php echo $fast_recovery == 1 ? 'checked':'' ?> value="Fast recovery">
                    <label class="form-check-label" for="fast_recovery">Fast recovery</label>
                </div>
                <div class="form-check px-5">
                    <input type="checkbox" class="form-check-input" id="exam_guidance" detail_id = '<?php echo $operation == 1 ? $guidance_for_the_exam_id:'' ?>' <?php echo $guidance_for_the_exam == 1 ? 'checked':'' ?> value="Guidance for the exam" onchange="GuidanceForTheExam()">
                    <label class="form-check-label" for="exam_guidance">Guidance for the Exam</label>
                    <div id="ExamRemarksDiv">
                        <?php
                            if ($guidance_for_the_exam == 1) {
                                echo '<div class="form-group col-12">
                                        <textarea class="form-control form-control-sm" name="" id="exam_guidance_remarks" cols="30" rows="3" placeholder="Remarks">'.$guidance_for_the_exam_remarks.'</textarea>
                                    </div>';
                            }
                        ?>
                    </div>
                </div>
                <div class="form-check px-5">
                    <input type="checkbox" class="form-check-input" id="p_others" detail_id = '<?php echo $operation == 1 ? $petition_others_id:'' ?>' <?php echo $petition_others == 1 ? 'checked':'' ?> value="Others" onchange="PetitionOther()">
                    <label class="form-check-label" for="p_others">Others</label>
                    <div id="PetitionGivingRemarksDiv">
                    <?php
                        if ($petition_others == 1) {
                                echo '<div class="form-group col-12">
                                        <textarea class="form-control form-control-sm" id="petition_remarks" cols="30" rows="3" placeholder="Remarks">'.$p_others_remarks.'</textarea>
                                    </div>';
                            }
                        ?>
                    </div>
                </div>
        
            </div>
            <hr>
            <div class="row mb-1">
                <h5>Others</h5>
                <div class="form-group col-12">
                    <textarea class="form-control form-control-sm" id="others" detail_id = '<?php echo $operation == 1 ? $others_id:'' ?>' cols="30" rows="3" placeholder="Remarks"><?php echo $others ?></textarea>
                </div>
            </div>
            <hr>
            <div class="row mb-1">
                <div class="form-group col-12">
                    <label for="offered_for">Offered for:</label>
                    <input type="text" class="form-control form-control-sm" id="offered_for" placeholder="Offered For" value="<?php echo $operation == 0 ? '': $result['offered_for'] ?>" name="offered-for">
                </div>
                <div class="form-group col-12">
                    <label for="offered_by">Offered by:</label>
                    <input type="text" class="form-control form-control-sm" id="offered_by" placeholder="Offered By" value="<?php echo $operation == 0 ? $customer['customer_name']: $result['offered_by'] ?>" name="offered-by">
                </div>
            </div>
            <hr>
            <div class="row mb-1 form-group px-2">
                <div class="form-check col-4 col-xl-4">
                    <input type="radio" required class="form-check-input form-check-sm"  id="daily" <?php echo $result['amount'] == 100 ? 'checked':'' ?> name="amount" value="100">
                    <label class="form-check-label" for="daily">P100 - Daily</label>
                </div>
                <div class="form-check col-4 col-xl-4">
                    <input type="radio" required class="form-check-input form-check-sm"  id="sunday" <?php echo $result['amount'] == 200 ? 'checked':'' ?> name="amount" value="200">
                    <label class="form-check-label" for="sunday">200 - Sunday</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary"><?php echo $operation == 1 ? 'Update':'Save' ?></button>
    </div>
</div>
