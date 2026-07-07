document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('lt-admin-calendar');
    if (!calendarEl) return;

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        timeZone: 'local',
        events: function(info, successCallback, failureCallback) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', ltAdminCalendar.ajax_url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 400) {
                    try {
                        var data = JSON.parse(xhr.responseText);
                        successCallback(data);
                    } catch (e) {
                        failureCallback();
                    }
                } else {
                    failureCallback();
                }
            };
            xhr.onerror = function() {
                failureCallback();
            };
            xhr.send('action=lt_get_calendar_bookings');
        },
        eventClick: function(info) {
            if (info.event.url) {
                window.open(info.event.url, '_blank');
                info.jsEvent.preventDefault();
            }
        }
    });

    calendar.render();
});
