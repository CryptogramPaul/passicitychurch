$(document).ready(function() {
    $.ajax({
        url: 'dashboard/action/action.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var bookedEvents = new Array();
            var result = response.data;
            // console.log(result);
            $.each(result, function(i, sched) {
                // var randomColor = getRandomColor();
                bookedEvents.push({
                    event_id: result[i].event_id,
                    title: result[i].title,
                    start: new Date(result[i].start),
                    // end: new Date(result[i].end),
                    customer: result[i].customer,
                    backgroundColor: result[i].color,
                    borderColor: result[i].color
                    // backgroundColor: randomColor,
                    // borderColor: randomColor,

                });
            });

            var Calendar = FullCalendar.Calendar;
            var calendarEl = document.getElementById('calendar');

            var calendar = new Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                timeZone: 'local',
                editable: true,
                selectable: true,
                headerToolbar: {
                    left: 'today prev,next',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                buttonText: {
                    dayGridMonth: 'Month',
                    timeGridWeek: 'Week',
                    timeGridDay: 'Day',
                    listWeek: 'List'
                },
                eventTimeFormat: { // like '14:30'
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: true
                },

                themeSystem: 'cerulean',
                // themeSystem: 'simplex',
                events: bookedEvents,
                editable: false,
                droppable: false,

                eventClick: function(info) {

                    // ShowBookingFullEntry(2, info.event.extendedProps.event_id);
                    // console.log(info);
                    // alert(info.event.event_id);
                    // console.log(bookedEvents);
                    // $("#myModal").modal("show");
                    // $("#eventTitle").html(info.event.title);
                    // $("#customerName").html(info.event.extendedProps.customer);
                    // $("#startTime").html(info.event.start.toLocaleTimeString([], {
                    //     hour: '2-digit',
                    //     minute: '2-digit'
                    // }));
                    // $("#endTime").html(info.event.end.toLocaleTimeString([], {
                    //     hour: '2-digit',
                    //     minute: '2-digit'
                    // }));
                }
            });
            calendar.render();
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
            // console.error("Error fetching data:", status, error);
            // console.error("Response:", xhr.responseText);
            // if (xhr.responseText.indexOf('<') === 0) {
            // // Handle HTML response
            // console.error("Received HTML instead of JSON");
            // }
            //  if (xhr.responseText.startsWith('<')) {
            //     console.error("Received HTML instead of JSON. This is likely an error page.");
            //     // Optionally display the error message to the user or take other actions
            //     } else {
            //     try {
            //         // Try to parse the response as JSON
            //         const jsonResponse = JSON.parse(xhr.responseText);
            //         console.log("Parsed JSON response:", jsonResponse);
            //     } catch (e) {
            //         console.error("Failed to parse response as JSON:", e);
            //     }
            // }
        }
    });
});

// ShowCalendar();

function getRandomColor() {
  // Generate random hex digits for each component of the color
  var color = "#" + Math.floor(Math.random() * 16777215).toString(16);
  return color;
}

// Example usage
// var randomColor = getRandomColor();
// console.log(randomColor);

function ShowTransactionCanvas() {
  $.post("dashboard/components/transaction.php", {}, function (data) {
    $("#TranscationBody").html(data);
  });
}
