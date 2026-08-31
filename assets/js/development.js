(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        initScrollReveal();
        initAccordions();
        init3DCarousel();
        initTrainers();
        initDevelopmentCalendar();
        initEnrollmentForm();
    });

    function initScrollReveal() {
        document.documentElement.setAttribute('data-rv', '');

        var sections = document.querySelectorAll(
            '.dev-obiective, .dev-galerie, .dev-principii, .dev-traineri, .dev-pentru-tine, .dev-detalii, .dev-inscriere'
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
        var selectedSessionIndex = null;
        var selectedSessionData = null;

        var monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        var monthShortNames = ['Ian', 'Feb', 'Mar', 'Apr', 'Mai', 'Iun', 'Iul', 'Aug', 'Sep', 'Oct', 'Noi', 'Dec'];

        var citiesWrap = calEl.querySelector('.dev-cal-cities');
        var monthLabel = calEl.querySelector('.dev-cal-month-label');
        var daysGrid = calEl.querySelector('.dev-cal-days-grid');
        var eventBar = calEl.querySelector('.dev-cal-event-bar');
        var eventTime = calEl.querySelector('.dev-cal-event-time');
        var eventTitle = calEl.querySelector('.dev-cal-event-title');
        var eventSignUpBtn = calEl.querySelector('.dev-cal-signup-btn');
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
                    selectedSessionIndex = null;
                    selectedSessionData = null;

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
                btn.setAttribute('data-state', c === activeCity ? 'on' : 'off');
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

                    var matchedSessionIdx = -1;
                    activeSessions.forEach(function (s, sIdx) {
                        if (s.days && s.days.indexOf(dayNum) !== -1) {
                            matchedSessionIdx = sIdx;
                        }
                    });

                    if (matchedSessionIdx !== -1) {
                        var session = activeSessions[matchedSessionIdx];
                        var posInSession = session.days.indexOf(dayNum);
                        var edge = 'm';

                        if (session.days.length === 1) {
                            edge = 's';
                        } else if (posInSession === 0) {
                            edge = 'l';
                        } else if (posInSession === session.days.length - 1) {
                            edge = 'r';
                        }

                        var isSelected = (selectedSessionIndex === matchedSessionIdx);
                        cell.setAttribute('data-mark', isSelected ? 'sel' : 'on');
                        cell.setAttribute('data-edge', edge);

                        (function (sIndex, sObj) {
                            cell.addEventListener('click', function () {
                                selectedSessionIndex = sIndex;
                                selectedSessionData = sObj;

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

                                renderGrid();
                            });
                        })(matchedSessionIdx, session);
                    } else {
                        cell.setAttribute('data-mark', 'off');
                        cell.setAttribute('data-edge', 'n');
                    }
                }

                daysGrid.appendChild(cell);
            }

            if (eventBar) {
                if (selectedSessionData) {
                    eventBar.style.display = 'flex';
                    if (eventTime) eventTime.textContent = selectedSessionData.time || '9:00 - 17:00';
                    if (eventTitle) eventTitle.textContent = selectedSessionData.title || 'Modul 1 Dezvoltare';
                } else {
                    eventBar.style.display = 'none';
                }
            }
        }

        if (prevMonthBtn) {
            prevMonthBtn.addEventListener('click', function () {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                selectedSessionIndex = null;
                selectedSessionData = null;
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
                selectedSessionIndex = null;
                selectedSessionData = null;
                renderGrid();
            });
        }

        if (eventSignUpBtn) {
            eventSignUpBtn.addEventListener('click', function () {
                if (selectedSessionData) {
                    var formattedDate = formatSessionDateRange(selectedSessionData);
                    var formattedTime = selectedSessionData.time || '9:00 - 17:00';

                    if (formDateDisplay) {
                        formDateDisplay.textContent = formattedDate;
                        formDateDisplay.setAttribute('data-selected-date', formattedDate);
                        formDateDisplay.setAttribute('data-selected-time', formattedTime);
                        formDateDisplay.classList.remove('error');
                    }

                    var formSection = document.getElementById('dev-inscriere-form') || document.getElementById('dev-inscriere');
                    if (formSection) {
                        formSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }
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

        if (nameInput) {
            nameInput.addEventListener('input', function () {
                if (nameInput.value.trim()) nameInput.classList.remove('error');
            });
        }
        if (phoneInput) {
            phoneInput.addEventListener('input', function () {
                var digits = phoneInput.value.replace(/[^0-9]/g, '');
                if (digits.length >= 10) phoneInput.classList.remove('error');
            });
        }
        if (emailInput) {
            emailInput.addEventListener('input', function () {
                if (emailRegex.test(emailInput.value.trim())) emailInput.classList.remove('error');
            });
        }

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
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Start Now';
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
            });
        }
    }
})();
