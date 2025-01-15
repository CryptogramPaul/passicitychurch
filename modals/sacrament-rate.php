<?php 
     if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        // header("location:../../../error.html");
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    require_once "../database/connection.php";
    require_once "../functions.php";

    $sacramenttype = $_POST['SacramentRate']; 

   
       
?>
<div class="modal-content" id="SacramentRate" >
    <div class="modal-body">
        <div class="form-container">
            <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
        
            <div class="text-start mb-4 ">
                <h4><?php echo $sacramenttype; ?> Rates</h4>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-bordered border-dark mb-0 align-middle text-center">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <!-- <th>Sacrament Type</th> -->
                            <th>Name</th>
                            <th>Calendar Day</th>
                            <th>Amount Rate</th>
                        </tr>
                    </thead>
                    <tbody id="">
                    <?php 
                        try {
                            $sql = $conn->prepare("SELECT * FROM rates WHERE sacrament_type = ? ORDER BY rate_id ASC");
                            $sql->execute([$sacramenttype]);
                        } catch (PDOException $e) {
                            echo "Please Contact System Administrator" . $e->getMessage();
                        }
                        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <!-- <td><?php echo $row['rate_id'] ?></td> -->
                        <!-- <td><?php echo $row['sacrament_type'] ?></td> -->
                        <td><?php echo $row['rate_name'] ?></td>
                        <td><?php echo $row['calendar_day'] ?></td>
                        <td><?php echo $row['amount_rate'] ?></td>
                        
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div> -->
</div>