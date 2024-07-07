 <?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    
    require_once '../../database/connection.php';
    require_once '../../functions.php';

    $sql = $conn->prepare("SELECT booking_id, sacrament_type, booking_date, start_time , booking_status, amount_to_pay, wedding_id, burial_id, baptism_id, total_payment, (amount_to_pay - total_payment) as balance
        FROM booking 
        WHERE customer_id = ? ORDER BY posted ASC
       ");
    $sql->execute([$_COOKIE['userid']]);
?>
<div class="row">
    <div class="col-12">
        <div class="table">
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <th>ID No.</th>
                    <th>Sacrament</th>
                    <th>Schedule Date</th>
                    <th>Time</th>
                    <th class="text-end">Amount To Pay</th>
                    <th class="text-end">Total Payment</th>
                    <th class="text-end">Balance</th>
                    <th>Booking Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $row['booking_id']; ?></td>
                        <td><?php echo $row['sacrament_type']?></td>
                        <td><?php echo date_format(date_create($row['booking_date']), "F j, Y") ?></td>
                        <td><?php echo date("h:i A", strtotime($row['start_time']) )?></td>
                        <td class="text-end"><?php echo formatCurrency($row['amount_to_pay'])?></td>
                        <td class="text-end"><?php echo formatCurrency($row['total_payment'])?></td>
                        <td class="text-end"><?php echo formatCurrency($row['balance'])?></td>
                        <td>
                            <?php echo $row['booking_status']?>
                            <!-- <?php 
                                if($row['booking_status'] == 'Booked'){
                                    echo '<span class="badge badge-success">Approved</span>';
                                }else if ($row['booking_status'] == 'Pending'){
                                    echo '<span class="badge badge-secondary">Pending</span>';
                                }else if ($row['booking_status'] == 'Cancelled'){
                                    echo '<span class="badge badge-danger">Cancelled</span>';
                                }else{
                                    echo '<span class="badge badge-primary">'.$row['booking_status'].'</span>';
                                }
                            ?> -->
                        </td>
                        <td>
                            <div class="d-flex ">
                                <?php 
                                    if ($row['sacrament_type'] == 'Baptism') {
                                        $target = 'show_baptism';
                                        $id = $row['baptism_id'];
                                    }else if($row['sacrament_type'] == 'Burial'){
                                        $target = 'show_burial';
                                         $id = $row['burial_id'];
                                        }else if($row['sacrament_type'] == 'Wedding'){
                                        $target = 'show_wedding';
                                        $id = $row['wedding_id'];
                                    }
                                ?>
                                <?php if($row['booking_status'] == 'Pending'){ ?>
                                <!-- data-bs-toggle="modal" data-bs-target="#<?php echo $target ?>" -->
                                <a class="badge bg-info text-white text-decoration-none badge-info" onclick="EditTransaction(`<?php echo $id ?>`,`<?php echo $target ?>`)" 
                                  title="Edit">
                                    <i class="fa fa-pencil p-1"></i>
                                </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a class="badge bg-danger text-white text-decoration-none badge-danger "
                                    onclick="DeleteTransaction(`<?php echo $id ?>`,`<?php echo $row['sacrament_type'] ?>`)" title="Delete">
                                    <i class="fa fa-trash p-1"></i>
                                </a>
                                <?php } ?>
                            </div>
                        </td>   
                    </tr>
                   <?php $no++;} ?>
                </tbody>
            </table>
        </div>
    </div>
</div>