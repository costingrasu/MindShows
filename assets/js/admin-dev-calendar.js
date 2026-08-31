(function ($) {
    'use strict';

    $(document).ready(function () {
        var $wrap = $('#dev-sessions-meta-app');
        if (!$wrap.length) return;

        var postId = $wrap.data('post-id');
        var initialData = window.devSessionsAdminData || {};
        var sessionsByCity = initialData.sessions || {
            'Constanta': [],
            'Bucuresti': []
        };
        var cities = initialData.locations || Object.keys(sessionsByCity);
        if (!cities.length) {
            cities = ['Constanta', 'Bucuresti'];
            sessionsByCity['Constanta'] = [];
            sessionsByCity['Bucuresti'] = [];
        }

        var activeCity = cities[0];
        var now = new Date();
        var currentYear = now.getFullYear();
        var currentMonth = now.getMonth();
        var selectedStartDay = null;
        var selectedEndDay = null;

        var monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        function renderLocations() {
            var $bar = $wrap.find('.dev-locations-bar');
            $bar.empty();

            cities.forEach(function (city) {
                var $tab = $('<div class="dev-loc-tab' + (city === activeCity ? ' active' : '') + '" data-city="' + city + '">' +
                    '<span>' + city + '</span>' +
                    '<span class="dev-del-loc-btn" title="Delete Location">&times;</span>' +
                    '</div>');
                $bar.append($tab);
            });

            var $addWrap = $('<div class="dev-add-loc-wrap">' +
                '<input type="text" class="dev-add-loc-input" placeholder="New location...">' +
                '<button type="button" class="button button-secondary dev-add-loc-btn">+ Add</button>' +
                '</div>');
            $bar.append($addWrap);
        }

        function renderCalendar() {
            $wrap.find('.dev-cal-month-title').text(monthNames[currentMonth] + ' ' + currentYear);

            var firstDayIndex = (new Date(currentYear, currentMonth, 1).getDay() + 6) % 7; // Monday = 0
            var daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            var $grid = $wrap.find('.dev-cal-days-grid');
            $grid.empty();

            var citySessions = (sessionsByCity[activeCity] || []).filter(function (s) {
                return s.year === currentYear && s.month === currentMonth;
            });

            for (var i = 0; i < firstDayIndex; i++) {
                $grid.append('<div class="dev-cal-day empty"></div>');
            }

            for (var d = 1; d <= daysInMonth; d++) {
                var hasSession = citySessions.some(function (s) {
                    return s.days.indexOf(d) !== -1;
                });

                var isSelected = false;
                if (selectedStartDay !== null) {
                    if (selectedEndDay !== null) {
                        var minD = Math.min(selectedStartDay, selectedEndDay);
                        var maxD = Math.max(selectedStartDay, selectedEndDay);
                        isSelected = (d >= minD && d <= maxD);
                    } else {
                        isSelected = (d === selectedStartDay);
                    }
                }

                var classes = 'dev-cal-day';
                if (hasSession) classes += ' has-session';
                if (isSelected) classes += ' selected';

                var $cell = $('<div class="' + classes + '" data-day="' + d + '">' + d + '</div>');
                $grid.append($cell);
            }
        }

        function renderSessionsList() {
            var $list = $wrap.find('.dev-sessions-list-items');
            $list.empty();

            var citySessions = sessionsByCity[activeCity] || [];
            if (!citySessions.length) {
                $list.html('<p style="color:#777; font-style:italic;">No scheduled sessions for ' + activeCity + ' yet.</p>');
                return;
            }

            citySessions.sort(function (a, b) {
                if (a.year !== b.year) return a.year - b.year;
                if (a.month !== b.month) return a.month - b.month;
                return a.days[0] - b.days[0];
            });

            citySessions.forEach(function (s, idx) {
                var dayStr = (s.days.length === 1) ? s.days[0] : (s.days[0] + '–' + s.days[s.days.length - 1]);
                var monthStr = monthNames[s.month] || '';
                var $item = $('<div class="dev-session-item">' +
                    '<div class="dev-session-item-info">' +
                    '<div class="dev-session-item-dates">' + dayStr + ' ' + monthStr + ' ' + s.year + ' (' + (s.title || 'Session') + ')</div>' +
                    '<div class="dev-session-item-time">' + (s.time || '9:00 - 17:00') + '</div>' +
                    '</div>' +
                    '<button type="button" class="dev-del-session-btn" data-index="' + idx + '">Delete</button>' +
                    '</div>');
                $list.append($item);
            });
        }

        function saveAllSessions(cb) {
            $.ajax({
                url: devAdminAjax.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'dev_save_all_sessions',
                    nonce: devAdminAjax.nonce,
                    post_id: postId,
                    locations: cities,
                    sessions: JSON.stringify(sessionsByCity)
                },
                success: function (res) {
                    if (cb) cb(res);
                }
            });
        }

        $wrap.on('click', '.dev-loc-tab', function (e) {
            if ($(e.target).hasClass('dev-del-loc-btn')) return;
            activeCity = $(this).data('city');
            selectedStartDay = null;
            selectedEndDay = null;
            renderLocations();
            renderCalendar();
            renderSessionsList();
        });

        $wrap.on('click', '.dev-add-loc-btn', function () {
            var newLoc = $wrap.find('.dev-add-loc-input').val().trim();
            if (!newLoc) return;
            if (cities.indexOf(newLoc) === -1) {
                cities.push(newLoc);
                sessionsByCity[newLoc] = [];
                activeCity = newLoc;
                renderLocations();
                renderCalendar();
                renderSessionsList();
                saveAllSessions();
            }
            $wrap.find('.dev-add-loc-input').val('');
        });

        $wrap.on('click', '.dev-del-loc-btn', function (e) {
            e.stopPropagation();
            var loc = $(this).closest('.dev-loc-tab').data('city');
            if (confirm('Delete location "' + loc + '" and all its sessions?')) {
                cities = cities.filter(function (c) { return c !== loc; });
                delete sessionsByCity[loc];
                if (cities.length) {
                    activeCity = cities[0];
                } else {
                    cities = ['Constanta'];
                    sessionsByCity['Constanta'] = [];
                    activeCity = 'Constanta';
                }
                renderLocations();
                renderCalendar();
                renderSessionsList();
                saveAllSessions();
            }
        });

        $wrap.on('click', '.dev-cal-prev-month', function () {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            selectedStartDay = null;
            selectedEndDay = null;
            renderCalendar();
        });

        $wrap.on('click', '.dev-cal-next-month', function () {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            selectedStartDay = null;
            selectedEndDay = null;
            renderCalendar();
        });

        $wrap.on('click', '.dev-cal-day:not(.empty)', function () {
            var d = parseInt($(this).data('day'), 10);
            if (selectedStartDay === null) {
                selectedStartDay = d;
                selectedEndDay = null;
            } else if (selectedEndDay === null) {
                selectedEndDay = d;
            } else {
                selectedStartDay = d;
                selectedEndDay = null;
            }
            renderCalendar();
        });

        $wrap.on('click', '.dev-add-session-btn', function () {
            if (selectedStartDay === null) {
                alert('Please click on a start date (and optional end date) in the calendar.');
                return;
            }

            var startD = selectedStartDay;
            var endD = selectedEndDay !== null ? selectedEndDay : selectedStartDay;
            var minD = Math.min(startD, endD);
            var maxD = Math.max(startD, endD);

            var days = [];
            for (var d = minD; d <= maxD; d++) {
                days.push(d);
            }

            var startH = $wrap.find('#dev-start-hour').val().trim() || '09:00';
            var endH = $wrap.find('#dev-end-hour').val().trim() || '17:00';
            var title = $wrap.find('#dev-session-title').val().trim() || 'Modul 1 Dezvoltare';

            if (!sessionsByCity[activeCity]) {
                sessionsByCity[activeCity] = [];
            }

            sessionsByCity[activeCity].push({
                year: currentYear,
                month: currentMonth,
                days: days,
                time: startH + ' - ' + endH,
                title: title
            });

            selectedStartDay = null;
            selectedEndDay = null;

            renderCalendar();
            renderSessionsList();
            saveAllSessions();
        });

        $wrap.on('click', '.dev-del-session-btn', function () {
            var idx = parseInt($(this).data('index'), 10);
            if (!isNaN(idx) && sessionsByCity[activeCity]) {
                sessionsByCity[activeCity].splice(idx, 1);
                renderCalendar();
                renderSessionsList();
                saveAllSessions();
            }
        });

        renderLocations();
        renderCalendar();
        renderSessionsList();
    });
})(jQuery);
