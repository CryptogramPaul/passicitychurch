<?php
if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    header('HTTP/1.1 403 Forbidden');
    die();
}
?>

<style>
#calendar {
    height: 100vh !important; */
}

._card {
    height: 100% !important;
    height: 81vh !important;
    /* Ensure the card takes the full height */
}

._card-body {
     max-height: calc(100vh - 150px) !important;
        overflow: auto; 
    /* Adjusting for padding/margin if any */
}

@media (max-width: 768px) {

    .fc-today-button {
        display: none !important;
    }

    .fc-prev-button,
    .fc-next-button {

        font-size: 10px;
    }

    .fc-header-toolbar {
        font-size: 10px;
    }

    .fc-toolbar-title {
        font-size: 30px !important;
        margin: 5px !important;
    }

    .fc-dayGridMonth-button,
    .fc-timeGridWeek-button,
    .fc-timeGridDay-button,
    .fc-listWeek-button {
        font-size: 10px;
    }
}
</style>
<!-- <div class="card card-primary">
    <div class="card-body p-0">
        <div id="calendar" class="p-1 pb-2">

        </div>
    </div>
</div> -->

<section class="content" style="overflow: auto;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card _card">
                    <div class="card-body _card-body p-2" id="calendar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // $(document).ready(function() {
//     $.ajax({
//         url: 'dashboard/action/action.php',
//         type: 'GET',
//         dataType: 'json',
//         success: function(response) {
//             var bookedEvents = new Array();
//             var result = response.data;
//             // console.log(result);
//             $.each(result, function(i, sched) {
//                 // var randomColor = getRandomColor();
//                 bookedEvents.push({
//                     event_id: result[i].event_id,
//                     title: result[i].title,
//                     start: new Date(result[i].start),
//                     // end: new Date(result[i].end),
//                     customer: result[i].customer,
//                     backgroundColor: result[i].color,
//                     borderColor: result[i].color
//                     // backgroundColor: randomColor,
//                     // borderColor: randomColor,

//                 });
//             });

//             var Calendar = FullCalendar.Calendar;
//             var calendarEl = document.getElementById('calendar');

//             var calendar = new Calendar(calendarEl, {
//                 initialView: 'dayGridMonth',
//                 timeZone: 'local',
//                 editable: true,
//                 selectable: true,
//                 headerToolbar: {
//                     left: 'today prev,next',
//                     center: 'title',
//                     right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
//                 },
//                 buttonText: {
//                     dayGridMonth: 'Month',
//                     timeGridWeek: 'Week',
//                     timeGridDay: 'Day',
//                     listWeek: 'List'
//                 },
//                 eventTimeFormat: { // like '14:30'
//                     hour: '2-digit',
//                     minute: '2-digit',
//                     meridiem: true
//                 },

//                 themeSystem: 'bootstrap',
//                 events: bookedEvents,
//                 editable: false,
//                 droppable: false,

//                 eventClick: function(info) {

//                     // ShowBookingFullEntry(2, info.event.extendedProps.event_id);
//                     // console.log(info);
//                     // alert(info.event.event_id);
//                     // console.log(bookedEvents);
//                     // $("#myModal").modal("show");
//                     // $("#eventTitle").html(info.event.title);
//                     // $("#customerName").html(info.event.extendedProps.customer);
//                     // $("#startTime").html(info.event.start.toLocaleTimeString([], {
//                     //     hour: '2-digit',
//                     //     minute: '2-digit'
//                     // }));
//                     // $("#endTime").html(info.event.end.toLocaleTimeString([], {
//                     //     hour: '2-digit',
//                     //     minute: '2-digit'
//                     // }));
//                 }
//             });
//             calendar.render();
//         },
//         error: function(xhr, status, error) {
//             console.error('Error fetching data:', error);
//             // console.error("Error fetching data:", status, error);
//             // console.error("Response:", xhr.responseText);
//             // if (xhr.responseText.indexOf('<') === 0) {
//             // // Handle HTML response
//             // console.error("Received HTML instead of JSON");
//             // }
//             //  if (xhr.responseText.startsWith('<')) {
//             //     console.error("Received HTML instead of JSON. This is likely an error page.");
//             //     // Optionally display the error message to the user or take other actions
//             //     } else {
//             //     try {
//             //         // Try to parse the response as JSON
//             //         const jsonResponse = JSON.parse(xhr.responseText);
//             //         console.log("Parsed JSON response:", jsonResponse);
//             //     } catch (e) {
//             //         console.error("Failed to parse response as JSON:", e);
//             //     }
//             // }
//         }
//     });
// });
</script>






<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Event Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            </div>
            <div class="modal-body">
                <h4 id="eventTitle">Title: Sample Event</h4>
                <h5 id="customerName">Customer: John Doe</h5>
                <p id="eventDate"></p>
                <p id="startTime"></p>
                <p id="endTime"></p>
                <p id="status"></p>
                <div class="table-responsive">
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th scope="col">Amenity</th>
                                <th scope="col">Description</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Projector</td>
                                <td>HD Projector</td>
                                <td>Piece</td>
                                <td>1</td>
                                <td>Good Condition</td>
                            </tr>
                            <tr>
                                <td>Chairs</td>
                                <td>Plastic Chairs</td>
                                <td>Piece</td>
                                <td>50</td>
                                <td>Delivered</td>
                            </tr>
                            <tr>
                                <td>Tables</td>
                                <td>Round Tables</td>
                                <td>Piece</td>
                                <td>10</td>
                                <td>Set Up</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<script src="view/transaction/booking/script/booking.js"></script>