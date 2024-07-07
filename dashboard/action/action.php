<?php
    if ( !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ) { 
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    
    require_once '../../database/connection.php';
    $data = array();
    try {
        $conn->beginTransaction();
        header('Content-Type: application/json');
        $sql = $conn->prepare("SELECT a.booking_status, a.booking_id, CONCAT(c.lastname, ', ', c.firstname) AS fullname, a.sacrament_type as title, a.church_event,
                concat_ws(' ', a.booking_date, a.start_time) as start
        FROM booking a
        LEFT JOIN customer c ON c.customer_id = a.customer_id 
        WHERE a.posted = 1 and a.booking_status = 'Booked' ");
        $sql->execute();
        $count = $sql->rowCount();
        if ($count > 0) {
            $data_arr = array();
            $i=1;
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                if ($row['booking_status'] == 'Booked') {
                    $color = '#0000FF'; #BLUE
                }else{
                    $color = '#008000'; #GREEN
                }
                $title = "";
                if ($row['church_event'] == '') {
                    $title = $row['title'];
                }else{
                    $title = $row['church_event'];
                }


                $data_arr[$i]['event_id'] = $row['booking_id'];
                $data_arr[$i]['title'] = $title;
                $data_arr[$i]['start'] = date("Y-m-d H:i:s", strtotime($row['start']));
                // $data_arr[$i]['end'] = date("Y-m-d H:i:s", strtotime($row['end']));
                $data_arr[$i]['color'] = $color;
                $data_arr[$i]['customer'] = $row['fullname'];
                $i++;
            }
            // $data_arr[$i]['color'] = '#'.substr(uniqid(),-6);
            
            // $response = array('status' => 'success', 'data' => $data);
            $data = array(
                'status' => true,
                'msg' => 'successfully!',
				'data' => $data_arr
            );

        } else {
            $data = array(
                'status' => false,
                'msg' => 'Error!'				
            );
        }
        
        $conn->commit();
        $jsonSchedule = json_encode($data);
        echo $jsonSchedule;
        // $schedule_date = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        
    } catch (PDOException $e) {
        $conn->rollBack();
        // echo "Please Contact System Administrator" . $e->getMessage();
        $data = array(
            'status' => false,
            'msg' => 'Please Contact System Administrator'				
        );
    }
    
   
?>