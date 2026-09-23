(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        initScrollReveal();
        initAccordions();
        init3DCarousel();
        initTrainers();
        initDevelopmentCalendar();
        initEnrollmentForm();
        initLearnPath();
        initDirectionCards();
        initDevTree();
        initInscriereFilters();
    });

    function initInscriereFilters() {
        var section = document.querySelector('.devpage-inscriere');
        if (!section) return;

        var items = Array.prototype.slice.call(section.querySelectorAll('.devpage-ins-item'));
        var quests = Array.prototype.slice.call(section.querySelectorAll('.devpage-ins-quest'));
        var select = section.querySelector('.devpage-ins-select');
        var empty = section.querySelector('.devpage-ins-empty');
        var reset = section.querySelector('.devpage-ins-reset');
        var count = section.querySelector('.devpage-ins-count');
        var list = section.querySelector('.devpage-ins-list');

        if (!items.length) return;

        var quest = 'all';
        var city = 'all';

        function apply() {
            var shown = 0;

            items.forEach(function (item) {
                var okQuest = (quest === 'all') || (item.getAttribute('data-quest') === quest);
                var okCity = (city === 'all') || (item.getAttribute('data-city') === city);
                var show = okQuest && okCity;

                item.hidden = !show;
                if (show) shown++;
            });

            if (empty) empty.hidden = (shown !== 0);
            if (list) list.hidden = (shown === 0);
            if (count) count.textContent = (shown === 1) ? '1 SESIUNE' : shown + ' SESIUNI';
        }

        quests.forEach(function (btn) {
            btn.addEventListener('click', function () {
                quest = btn.getAttribute('data-quest-filter');
                quests.forEach(function (b) {
                    b.setAttribute('aria-pressed', b === btn ? 'true' : 'false');
                });
                apply();
            });
        });

        if (select) {
            select.addEventListener('change', function () {
                city = select.value;
                apply();
            });
        }

        if (reset) {
            reset.addEventListener('click', function () {
                quest = 'all';
                city = 'all';
                quests.forEach(function (b) {
                    b.setAttribute('aria-pressed', b.getAttribute('data-quest-filter') === 'all' ? 'true' : 'false');
                });
                if (select) select.value = 'all';
                apply();
            });
        }

        apply();
    }

    function initScrollReveal() {
        document.documentElement.setAttribute('data-rv', '');

        var sections = document.querySelectorAll(
            '.dev-obiective, .dev-galerie, .dev-about, .dev-principii, .dev-traineri, .dev-pentru-tine, .dev-detalii, .dev-inscriere, .devpage-learn, .devpage-dirs, .devpage-tree, .devpage-book, .devpage-sidequests, .devpage-inscriere'
        );

        var elements = document.querySelectorAll('[data-reveal]');

        if ('IntersectionObserver' in window) {
            var sectionObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting || entry.boundingClientRect.top < window.innerHeight) {
                        entry.target.classList.add('in-view');
                        sectionObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.05,
                rootMargin: '0px 0px -40px 0px'
            });

            sections.forEach(function (sec) {
                sectionObserver.observe(sec);
            });

            var elementObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting || entry.boundingClientRect.top < window.innerHeight) {
                        entry.target.setAttribute('data-inview', '1');
                        elementObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0,
                rootMargin: '0px 0px -8% 0px'
            });

            elements.forEach(function (el) {
                elementObserver.observe(el);
            });
        } else {
            sections.forEach(function (sec) { sec.classList.add('in-view'); });
            elements.forEach(function (el) { el.setAttribute('data-inview', '1'); });
        }
    }

    function initLearnPath() {
        var path = document.querySelector('.devpage-learn-path');
        if (!path) return;

        var easing = 'cubic-bezier(.22, .61, .36, 1)';
        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

        function measure(card) {
            var cs = window.getComputedStyle(card);
            var h = card.offsetHeight + 'px';
            return {
                height: h,
                minHeight: h,
                marginLeft: cs.marginLeft,
                marginRight: cs.marginRight,
                paddingTop: cs.paddingTop
            };
        }

        function setState(card, state) {
            var from = measure(card);
            if (card._devpageMorph) {
                card._devpageMorph.cancel();
                card._devpageMorph = null;
            }

            card.setAttribute('data-state', state);
            var toggle = card.querySelector('.devpage-learn-card-toggle');
            if (toggle) toggle.setAttribute('aria-expanded', state === 'open' ? 'true' : 'false');

            if (reduceMotion.matches || typeof card.animate !== 'function') {
                if (state === 'closing') card.setAttribute('data-state', 'closed');
                return;
            }

            var morph = card.animate([from, measure(card)], { duration: 400, easing: easing });
            card._devpageMorph = morph;
            morph.onfinish = function () {
                card._devpageMorph = null;
                if (card.getAttribute('data-state') === 'closing') card.setAttribute('data-state', 'closed');
            };

            if (state === 'open') {
                card.querySelectorAll('.devpage-learn-card-title, .devpage-learn-card-desc').forEach(function (el) {
                    el.animate([{ opacity: 0 }, { opacity: 1 }], { duration: 250, delay: 80, easing: 'ease-out', fill: 'backwards' });
                });
            }
        }

        path.addEventListener('click', function (e) {
            var card = e.target.closest('.devpage-learn-card');
            if (!card) return;

            var isOpen = card.getAttribute('data-state') === 'open';
            if (!isOpen) {
                path.querySelectorAll('.devpage-learn-card[data-state="open"]').forEach(function (other) {
                    if (other !== card) setState(other, 'closing');
                });
            }
            setState(card, isOpen ? 'closing' : 'open');
        });
    }

    function initDirectionCards() {
        var track = document.querySelector('.devpage-dirs-track');
        if (!track) return;

        function setExpanded(card, expanded) {
            card.setAttribute('data-expanded', expanded ? 'true' : 'false');
            var more = card.querySelector('.devpage-dir-card-more');
            if (more) more.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        }

        track.addEventListener('click', function (e) {
            var more = e.target.closest('.devpage-dir-card-more');
            var close = e.target.closest('.devpage-dir-card-close');
            if (!more && !close) return;

            var card = e.target.closest('.devpage-dir-card');
            if (!card) return;

            if (more) {
                track.querySelectorAll('.devpage-dir-card[data-expanded="true"]').forEach(function (other) {
                    if (other !== card) setExpanded(other, false);
                });
                setExpanded(card, true);
                var closeBtn = card.querySelector('.devpage-dir-card-close');
                if (closeBtn) closeBtn.focus();
            } else {
                setExpanded(card, false);
                var moreBtn = card.querySelector('.devpage-dir-card-more');
                if (moreBtn) moreBtn.focus();
            }
        });
    }

    function initDevTree() {
        var diagram = document.querySelector('.devpage-tree-diagram');
        if (!diagram) return;

        var svg = diagram.querySelector('.devpage-tree-lines');
        var root = diagram.querySelector('.devpage-tree-root');
        var branches = diagram.querySelectorAll('.devpage-tree-branch');
        if (!svg || !root || !branches.length) return;

        var lines = svg.querySelectorAll('line');

        function position(el) {
            var x = 0;
            var y = 0;
            var node = el;
            while (node && node !== diagram) {
                x += node.offsetLeft;
                y += node.offsetTop;
                node = node.offsetParent;
            }
            return { x: x, y: y, w: el.offsetWidth, h: el.offsetHeight };
        }

        function draw() {
            var vertical = window.getComputedStyle(diagram).flexDirection === 'column';
            var r = position(root);
            var x1 = vertical ? r.x + r.w / 2 : r.x + r.w;
            var y1 = vertical ? r.y + r.h : r.y + r.h / 2;

            svg.setAttribute('viewBox', '0 0 ' + diagram.offsetWidth + ' ' + diagram.offsetHeight);

            branches.forEach(function (branch, i) {
                var track = branch.querySelector('.devpage-tree-nodes');
                if (track) {
                    if (track.scrollWidth > track.clientWidth) {
                        var label = branch.querySelector('.devpage-tree-branch-title');
                        track.setAttribute('tabindex', '0');
                        if (label) track.setAttribute('aria-label', label.textContent);
                    } else {
                        track.removeAttribute('tabindex');
                        track.removeAttribute('aria-label');
                    }
                }

                var line = lines[i];
                if (!line) return;

                var target = vertical ? branch.querySelector('.devpage-tree-branch-title') : branch.querySelector('.devpage-tree-node');
                if (!target) return;

                var t = position(target);
                line.setAttribute('x1', x1);
                line.setAttribute('y1', y1);
                line.setAttribute('x2', vertical ? t.x + t.w / 2 : t.x);
                line.setAttribute('y2', vertical ? t.y : t.y + t.h / 2);
            });
        }

        draw();

        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(draw);
        }

        if ('ResizeObserver' in window) {
            var observer = new ResizeObserver(draw);
            observer.observe(diagram);
            branches.forEach(function (branch) {
                observer.observe(branch);
            });
        } else {
            window.addEventListener('resize', draw);
        }
    }

    function initAccordions() {
        var tiles = document.querySelectorAll('.dev-tile');
        if (!tiles.length) return;

        tiles.forEach(function (tile) {
            tile.addEventListener('click', function () {
                var isOpen = tile.getAttribute('data-open') === 'true';
                tile.setAttribute('data-open', isOpen ? 'false' : 'true');
            });
        });
    }

    function init3DCarousel() {
        var carousel = document.querySelector('.dev-carousel');
        if (!carousel) return;

        var slides = Array.from(carousel.querySelectorAll('.dev-slide'));
        var dots = Array.from(carousel.querySelectorAll('.dev-dot'));
        var prevBtn = carousel.querySelector('.dev-arrow-prev');
        var nextBtn = carousel.querySelector('.dev-arrow-next');
        if (!slides.length) return;

        var currentIndex = 0;
        var totalSlides = slides.length;
        var positions = ['c', 'mr', 'fr', 'fl', 'ml'];
        var autoplayTimer = null;

        function updateSlidePositions() {
            slides.forEach(function (slide, i) {
                slide.className = 'dev-slide';
                var posIndex = (i - currentIndex + totalSlides) % totalSlides;
                var posName = positions[posIndex] || 'fr';
                slide.setAttribute('data-pos', posName);
                if (dots[i]) dots[i].setAttribute('data-state', 'off');
            });

            slides[currentIndex].classList.add('active');
            slides[currentIndex].setAttribute('data-pos', 'c');
            if (dots[currentIndex]) dots[currentIndex].setAttribute('data-state', 'on');

            var prevIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            var nextIndex = (currentIndex + 1) % totalSlides;
            var prev2Index = (currentIndex - 2 + totalSlides) % totalSlides;
            var next2Index = (currentIndex + 2) % totalSlides;

            if (totalSlides > 1) {
                slides[prevIndex].classList.add('prev');
                slides[prevIndex].setAttribute('data-pos', 'ml');
                slides[nextIndex].classList.add('next');
                slides[nextIndex].setAttribute('data-pos', 'mr');
            }
            if (totalSlides > 3) {
                slides[prev2Index].classList.add('prev-2');
                slides[prev2Index].setAttribute('data-pos', 'fl');
                slides[next2Index].classList.add('next-2');
                slides[next2Index].setAttribute('data-pos', 'fr');
            }
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlidePositions();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateSlidePositions();
        }

        function startAutoplay() {
            stopAutoplay();
            autoplayTimer = setInterval(nextSlide, 3500);
        }

        function stopAutoplay() {
            if (autoplayTimer) {
                clearInterval(autoplayTimer);
                autoplayTimer = null;
            }
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                nextSlide();
                startAutoplay();
            });
        }
        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                prevSlide();
                startAutoplay();
            });
        }

        dots.forEach(function (dot, idx) {
            dot.addEventListener('click', function () {
                currentIndex = idx;
                updateSlidePositions();
                startAutoplay();
            });
        });

        slides.forEach(function (slide, idx) {
            slide.addEventListener('click', function () {
                if (slide.classList.contains('prev') || slide.classList.contains('next')) {
                    currentIndex = idx;
                    updateSlidePositions();
                    startAutoplay();
                }
            });
        });

        var touchStartX = 0;
        var touchEndX = 0;
        carousel.addEventListener('touchstart', function (e) {
            stopAutoplay();
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        carousel.addEventListener('touchend', function (e) {
            touchEndX = e.changedTouches[0].screenX;
            if (touchStartX - touchEndX > 45) {
                nextSlide();
            } else if (touchEndX - touchStartX > 45) {
                prevSlide();
            }
            startAutoplay();
        }, { passive: true });

        carousel.addEventListener('mouseenter', stopAutoplay);
        carousel.addEventListener('mouseleave', startAutoplay);

        updateSlidePositions();
        startAutoplay();
    }

    function initTrainers() {
        var trainers = document.querySelectorAll('.dev-trainer');
        if (!trainers.length) return;

        trainers.forEach(function (card) {
            card.setAttribute('data-exp', '0');

            card.addEventListener('click', function (e) {
                if (window.innerWidth <= 1024) {
                    var isExp = card.getAttribute('data-exp') === '1';
                    trainers.forEach(function (other) {
                        if (other !== card) other.setAttribute('data-exp', '0');
                    });
                    card.setAttribute('data-exp', isExp ? '0' : '1');
                }
            });
        });
    }

    function initDevelopmentCalendar() {
        var calEl = document.querySelector('.dev-cal');
        if (!calEl) return;
        if (calEl.closest('.dev-inscriere[data-empty="1"]')) return;
        var sessionsPayload = {
            locations: ['Constanta', 'Bucuresti'],
            sessions: {
                'Constanta': [
                    { year: 2026, month: 11, days: [10, 11], time: '9:00 - 17:00', title: 'Modul 1 Dezvoltare' },
                    { year: 2026, month: 11, days: [17, 18], time: '9:00 - 17:00', title: 'Modul 1 Dezvoltare' }
                ],
                'Bucuresti': [
                    { year: 2026, month: 11, days: [3, 4], time: '9:00 - 17:00', title: 'Modul 1 Dezvoltare' },
                    { year: 2026, month: 11, days: [10, 11], time: '9:00 - 17:00', title: 'Modul 1 Dezvoltare' }
                ]
            }
        };

        var dataScript = document.getElementById('dev-sessions-data');
        if (dataScript) {
            try {
                var parsed = JSON.parse(dataScript.textContent || '{}');
                if (parsed && parsed.locations && parsed.sessions) {
                    sessionsPayload = parsed;
                }
            } catch (err) {
                console.warn('Could not parse dev sessions data, using default schedule.', err);
            }
        }

        var locations = sessionsPayload.locations || Object.keys(sessionsPayload.sessions || {});
        if (!locations.length) locations = ['Constanta'];

        var activeCity = locations[0];
        var now = new Date();
        var currentYear = now.getFullYear();
        var currentMonth = now.getMonth();
        var selectedDay = null;
        var pendingTime = null;

        try {
            var msParams = new URLSearchParams(window.location.search);
            var wantCity = msParams.get('ms_city');
            var wantDate = msParams.get('ms_date');
            var wantTime = msParams.get('ms_time');

            if (wantCity && wantDate && /^\d{4}-\d{2}-\d{2}$/.test(wantDate)) {
                var dParts = wantDate.split('-');
                var wantY = parseInt(dParts[0], 10);
                var wantM = parseInt(dParts[1], 10) - 1;
                var wantD = parseInt(dParts[2], 10);

                var pool = (sessionsPayload.sessions && sessionsPayload.sessions[wantCity]) || [];
                var hit = pool.some(function (sess) {
                    return sess.year === wantY && sess.month === wantM && sess.days && sess.days.indexOf(wantD) !== -1;
                });

                if (hit) {
                    activeCity = wantCity;
                    currentYear = wantY;
                    currentMonth = wantM;
                    selectedDay = wantD;
                    pendingTime = wantTime;
                }
            }
        } catch (err) {
        }

        var monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        var monthShortNames = ['Ian', 'Feb', 'Mar', 'Apr', 'Mai', 'Iun', 'Iul', 'Aug', 'Sep', 'Oct', 'Noi', 'Dec'];

        var citiesWrap = calEl.querySelector('.dev-cal-cities');
        var monthLabel = calEl.querySelector('.dev-cal-month-label');
        var daysGrid = calEl.querySelector('.dev-cal-days-grid');
        var eventBars = calEl.querySelector('.dev-cal-event-bars');
        var eventTpl = calEl.querySelector('.dev-cal-event-tpl');
        var prevMonthBtn = calEl.querySelector('.dev-cal-prev-btn');
        var nextMonthBtn = calEl.querySelector('.dev-cal-next-btn');
        var formDateDisplay = document.querySelector('.dev-in-date-display');

        function renderLocations() {
            if (!citiesWrap) return;
            citiesWrap.innerHTML = '';

            locations.forEach(function (city) {
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'dev-city-btn';
                btn.setAttribute('data-city', city);
                btn.setAttribute('data-state', city === activeCity ? 'on' : 'off');
                btn.textContent = city;

                btn.addEventListener('click', function () {
                    activeCity = city;
                    selectedDay = null;

                    var form = document.querySelector('.dev-in-form');
                    if (form) {
                        var nIn = form.querySelector('#dev-in-name');
                        var pIn = form.querySelector('#dev-in-phone');
                        var eIn = form.querySelector('#dev-in-email');
                        var cIn = form.querySelector('#dev-in-city');
                        if (nIn) { nIn.value = ''; nIn.classList.remove('error'); }
                        if (pIn) { pIn.value = ''; pIn.classList.remove('error'); }
                        if (eIn) { eIn.value = ''; eIn.classList.remove('error'); }
                        if (cIn) { cIn.value = ''; }
                    }

                    if (formDateDisplay) {
                        formDateDisplay.textContent = 'Selecteaza o data din calendar';
                        formDateDisplay.removeAttribute('data-selected-date');
                        formDateDisplay.removeAttribute('data-selected-time');
                        formDateDisplay.classList.remove('error');
                    }

                    updateLocationPills();
                    renderGrid();
                });

                citiesWrap.appendChild(btn);
            });
        }

        function updateLocationPills() {
            if (!citiesWrap) return;
            var btns = citiesWrap.querySelectorAll('.dev-city-btn');
            btns.forEach(function (btn) {
                var c = btn.getAttribute('data-city');
                var isActive = (c === activeCity);
                btn.setAttribute('data-state', isActive ? 'on' : 'off');
                if (isActive && typeof btn.scrollIntoView === 'function') {
                    try {
                        btn.scrollIntoView({ behavior: 'smooth', inline: 'nearest', block: 'nearest' });
                    } catch (e) { }
                }
            });
        }

        function getSessionsForActiveCityAndMonth() {
            var citySessions = (sessionsPayload.sessions && sessionsPayload.sessions[activeCity]) || [];
            return citySessions.filter(function (s) {
                return s.year === currentYear && s.month === currentMonth;
            });
        }

        function formatSessionDateRange(s) {
            var firstDay = s.days[0];
            var lastDay = s.days[s.days.length - 1];
            var dayPart = (s.days.length === 1) ? String(firstDay) : (firstDay + '–' + lastDay);
            var mName = monthShortNames[s.month] || '';
            return dayPart + ' ' + mName + ' ' + s.year;
        }

        function renderGrid() {
            if (monthLabel) {
                monthLabel.textContent = monthNames[currentMonth] + ' ' + currentYear;
            }

            if (!daysGrid) return;
            daysGrid.innerHTML = '';

            var firstDayDate = new Date(currentYear, currentMonth, 1);
            var startOffset = (firstDayDate.getDay() + 6) % 7;
            var daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            var totalCells = Math.ceil((startOffset + daysInMonth) / 7) * 7;

            var activeSessions = getSessionsForActiveCityAndMonth();

            var selectedRunDays = {};
            if (selectedDay !== null) {
                var selectedDayMatches = activeSessions.filter(function (s) {
                    return s.days && s.days.indexOf(selectedDay) !== -1;
                });
                if (selectedDayMatches.length) {
                    selectedDayMatches[0].days.forEach(function (d) { selectedRunDays[d] = true; });
                }
            }

            for (var i = 0; i < totalCells; i++) {
                var dayNum = i - startOffset + 1;
                var cell = document.createElement('div');
                cell.setAttribute('data-day', '');

                if (dayNum < 1 || dayNum > daysInMonth) {
                    cell.setAttribute('data-mark', 'off');
                    cell.setAttribute('data-edge', 'n');
                    cell.textContent = '';
                } else {
                    cell.textContent = String(dayNum);

                    var matches = [];
                    activeSessions.forEach(function (s) {
                        if (s.days && s.days.indexOf(dayNum) !== -1) {
                            matches.push(s);
                        }
                    });

                    if (matches.length) {
                        var session = matches[0];
                        var posInSession = session.days.indexOf(dayNum);
                        var edge = 'm';

                        if (session.days.length === 1) {
                            edge = 's';
                        } else if (posInSession === 0) {
                            edge = 'l';
                        } else if (posInSession === session.days.length - 1) {
                            edge = 'r';
                        }

                        var isSelected = !!selectedRunDays[dayNum];
                        cell.setAttribute('data-mark', isSelected ? 'sel' : 'on');
                        cell.setAttribute('data-edge', edge);

                        (function (clickedDay) {
                            cell.addEventListener('click', function () {
                                selectedDay = clickedDay;
                                pendingTime = null;
                                clearFormFields();
                                renderGrid();
                            });
                        })(dayNum);
                    } else {
                        cell.setAttribute('data-mark', 'off');
                        cell.setAttribute('data-edge', 'n');
                    }
                }

                daysGrid.appendChild(cell);
            }

            renderEventBars(activeSessions);
        }

        function renderEventBars(activeSessions) {
            if (!eventBars || !eventTpl) return;

            eventBars.innerHTML = '';

            var daySessions = (selectedDay === null) ? [] : activeSessions.filter(function (s) {
                return s.days && s.days.indexOf(selectedDay) !== -1;
            });

            if (!daySessions.length) {
                eventBars.style.display = 'none';
                return;
            }

            eventBars.style.display = 'flex';

            daySessions.forEach(function (sess) {
                var node = eventTpl.content.firstElementChild.cloneNode(true);
                var time = sess.time || '9:00 - 17:00';
                var timeEl = node.querySelector('.dev-cal-event-time');
                var titleEl = node.querySelector('.dev-cal-event-title');
                var btn = node.querySelector('.dev-cal-signup-btn');

                node.setAttribute('data-time', time);
                if (timeEl) timeEl.textContent = time;
                if (titleEl && sess.title) titleEl.textContent = sess.title;

                if (btn) {
                    btn.addEventListener('click', function () {
                        applySessionToForm(sess);
                    });
                }

                if (pendingTime && pendingTime === time) {
                    node.setAttribute('data-preselected', '1');
                    applySessionToForm(sess, true);
                    pendingTime = null;
                }

                eventBars.appendChild(node);
            });
        }

        function clearFormFields() {
            var form = document.querySelector('.dev-in-form');
            if (form) {
                var nIn = form.querySelector('#dev-in-name');
                var pIn = form.querySelector('#dev-in-phone');
                var eIn = form.querySelector('#dev-in-email');
                var cIn = form.querySelector('#dev-in-city');
                if (nIn) { nIn.value = ''; nIn.classList.remove('error'); }
                if (pIn) { pIn.value = ''; pIn.classList.remove('error'); }
                if (eIn) { eIn.value = ''; eIn.classList.remove('error'); }
                if (cIn) { cIn.value = ''; }
            }

            if (formDateDisplay) {
                formDateDisplay.textContent = 'Selecteaza o data din calendar';
                formDateDisplay.removeAttribute('data-selected-date');
                formDateDisplay.removeAttribute('data-selected-time');
                formDateDisplay.classList.remove('error');
            }
        }

        function applySessionToForm(sess, skipScroll) {
            var formattedDate = formatSessionDateRange(sess);
            var formattedTime = sess.time || '9:00 - 17:00';

            if (formDateDisplay) {
                formDateDisplay.textContent = formattedDate;
                formDateDisplay.setAttribute('data-selected-date', formattedDate);
                formDateDisplay.setAttribute('data-selected-time', formattedTime);
                formDateDisplay.classList.remove('error');
            }

            var form = document.querySelector('.dev-in-form');
            if (form) {
                var submitBtn = form.querySelector('.dev-in-submit');
                if (submitBtn) {
                    var probe = form.querySelector('#dev-in-name');
                    if (probe) probe.dispatchEvent(new Event('input', { bubbles: true }));
                }
            }

            if (skipScroll) return;

            var formSection = document.getElementById('dev-inscriere-form') || document.getElementById('dev-inscriere');
            if (formSection) {
                formSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        if (prevMonthBtn) {
            prevMonthBtn.addEventListener('click', function () {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                selectedDay = null;
                renderGrid();
            });
        }

        if (nextMonthBtn) {
            nextMonthBtn.addEventListener('click', function () {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                selectedDay = null;
                renderGrid();
            });
        }

        renderLocations();
        renderGrid();
    }

    function initEnrollmentForm() {
        var form = document.querySelector('.dev-in-form');
        var successCard = document.querySelector('.dev-in-done');
        if (!form) return;

        var nameInput = form.querySelector('#dev-in-name');
        var phoneInput = form.querySelector('#dev-in-phone');
        var emailInput = form.querySelector('#dev-in-email');
        var cityInput = form.querySelector('#dev-in-city');
        var dateDisplay = form.querySelector('.dev-in-date-display');
        var submitBtn = form.querySelector('.dev-in-submit');
        var resetBtn = document.querySelector('.dev-in-reset-btn');

        var doneDatePill = document.querySelector('.dev-in-done-pill.date-pill');
        var doneTimePill = document.querySelector('.dev-in-done-pill.time-pill');

        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        function checkFormValidity() {
            if (!submitBtn) return;
            var nameOk = !!(nameInput && nameInput.value.trim());
            var digits = phoneInput ? phoneInput.value.replace(/[^0-9]/g, '') : '';
            var phoneOk = digits.length >= 10;
            var emailOk = !!(emailInput && emailRegex.test(emailInput.value.trim()));
            var dateOk = !!(dateDisplay && dateDisplay.hasAttribute('data-selected-date'));

            submitBtn.disabled = !(nameOk && phoneOk && emailOk && dateOk);
        }

        if (nameInput) {
            nameInput.addEventListener('input', function () {
                if (nameInput.value.trim()) nameInput.classList.remove('error');
                checkFormValidity();
            });
        }
        if (phoneInput) {
            phoneInput.addEventListener('input', function () {
                var digits = phoneInput.value.replace(/[^0-9]/g, '');
                if (digits.length >= 10) phoneInput.classList.remove('error');
                checkFormValidity();
            });
        }
        if (emailInput) {
            emailInput.addEventListener('input', function () {
                if (emailRegex.test(emailInput.value.trim())) emailInput.classList.remove('error');
                checkFormValidity();
            });
        }

        if (dateDisplay && window.MutationObserver) {
            var dateObserver = new MutationObserver(function () {
                checkFormValidity();
            });
            dateObserver.observe(dateDisplay, {
                attributes: true,
                attributeFilter: ['data-selected-date']
            });
        }

        checkFormValidity();

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            handleSubmit();
        });

        if (submitBtn) {
            submitBtn.addEventListener('click', function (e) {
                e.preventDefault();
                handleSubmit();
            });
        }

        function handleSubmit() {
            var name = nameInput ? nameInput.value.trim() : '';
            var phone = phoneInput ? phoneInput.value.trim() : '';
            var email = emailInput ? emailInput.value.trim() : '';
            var city = cityInput ? cityInput.value.trim() : '';
            var date = dateDisplay ? (dateDisplay.getAttribute('data-selected-date') || '') : '';
            var time = dateDisplay ? (dateDisplay.getAttribute('data-selected-time') || '9:00 - 17:00') : '9:00 - 17:00';

            var hasError = false;

            if (!name && nameInput) {
                nameInput.classList.add('error');
                hasError = true;
            } else if (nameInput) {
                nameInput.classList.remove('error');
            }

            var phoneDigits = phone.replace(/[^0-9]/g, '');
            if ((!phone || phoneDigits.length < 10) && phoneInput) {
                phoneInput.classList.add('error');
                hasError = true;
            } else if (phoneInput) {
                phoneInput.classList.remove('error');
            }

            if ((!email || !emailRegex.test(email)) && emailInput) {
                emailInput.classList.add('error');
                hasError = true;
            } else if (emailInput) {
                emailInput.classList.remove('error');
            }

            if (!date && dateDisplay) {
                dateDisplay.classList.add('error');
                hasError = true;
            } else if (dateDisplay) {
                dateDisplay.classList.remove('error');
            }

            if (hasError) {
                return;
            }

            var postId = form.getAttribute('data-post-id') || 0;
            var ajaxUrl = window.devAjax ? window.devAjax.url : '/wp-admin/admin-ajax.php';
            var nonce = window.devAjax ? window.devAjax.nonce : '';

            var formData = new FormData();
            formData.append('action', 'dev_submit_enrollment');
            formData.append('nonce', nonce);
            formData.append('post_id', postId);
            formData.append('name', name);
            formData.append('phone', phone);
            formData.append('email', email);
            formData.append('city', city);
            formData.append('date', date);
            formData.append('time', time);

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Se trimite...';
            }

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    if (data && data.success) {
                        form.setAttribute('data-hidden', 'true');
                        if (successCard) {
                            successCard.setAttribute('data-visible', 'true');
                        }
                        if (doneDatePill) doneDatePill.textContent = date || 'Data confirmată';
                        if (doneTimePill) doneTimePill.textContent = time;
                    } else {
                        alert(data && data.data && data.data.message ? data.data.message : 'A apărut o eroare. Te rugăm să încerci din nou.');
                    }
                })
                .catch(function (err) {
                    console.error('Submission error', err);
                    alert('A apărut o eroare de rețea. Te rugăm să încerci din nou.');
                })
                .finally(function () {
                    if (submitBtn) {
                        submitBtn.textContent = 'Start Now';
                        checkFormValidity();
                    }
                });
        }

        if (resetBtn) {
            resetBtn.addEventListener('click', function () {
                if (nameInput) {
                    nameInput.value = '';
                    nameInput.classList.remove('error');
                }
                if (phoneInput) {
                    phoneInput.value = '';
                    phoneInput.classList.remove('error');
                }
                if (emailInput) {
                    emailInput.value = '';
                    emailInput.classList.remove('error');
                }
                if (cityInput) {
                    cityInput.value = '';
                }
                if (dateDisplay) {
                    dateDisplay.textContent = 'Selecteaza o data din calendar';
                    dateDisplay.removeAttribute('data-selected-date');
                    dateDisplay.removeAttribute('data-selected-time');
                    dateDisplay.classList.remove('error');
                }

                if (successCard) successCard.setAttribute('data-visible', 'false');
                form.removeAttribute('data-hidden');
                checkFormValidity();
            });
        }
    }
})();
