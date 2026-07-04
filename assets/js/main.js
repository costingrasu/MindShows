document.addEventListener("DOMContentLoaded", () => {
  const initMobileMenu = () => {
    const toggleBtn = document.querySelector(".mobile-toggle");
    const overlay = document.querySelector(".mobile-menu-overlay");
    const body = document.body;

    if (!toggleBtn || !overlay) return;

    const toggleMenu = () => {
      const isExpanded = toggleBtn.getAttribute("aria-expanded") === "true";
      toggleBtn.setAttribute("aria-expanded", !isExpanded);
      overlay.classList.toggle("active");
      body.classList.toggle("menu-open");
    };

    toggleBtn.addEventListener("click", toggleMenu);

    overlay.addEventListener("click", (e) => {
      if (e.target === overlay || e.target.tagName === "A") {
        overlay.classList.remove("active");
        body.classList.remove("menu-open");
        toggleBtn.setAttribute("aria-expanded", "false");
      }
    });
  };

  const initGalleryCarousel = () => {
    const track = document.querySelector(".gallery-track");
    if (!track) return;

    const slides = Array.from(document.querySelectorAll(".gallery-slide"));
    const dots = Array.from(document.querySelectorAll(".gallery-dot"));
    const prevBtn = document.querySelector(".gallery-controls .prev-btn");
    const nextBtn = document.querySelector(".gallery-controls .next-btn");

    if (slides.length === 0) return;

    let currentIndex = 0;
    let autoPlayInterval;

    const updateGallery = () => {
      slides.forEach((slide, index) => {
        slide.className = "gallery-slide";
        if (dots[index]) dots[index].classList.remove("active");
      });

      slides[currentIndex].classList.add("active");
      if (dots[currentIndex]) dots[currentIndex].classList.add("active");

      const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
      const nextIndex = (currentIndex + 1) % slides.length;
      const prev2Index = (currentIndex - 2 + slides.length) % slides.length;
      const next2Index = (currentIndex + 2) % slides.length;

      if (slides.length > 1) {
        slides[prevIndex].classList.add("prev");
        slides[nextIndex].classList.add("next");
      }
      if (slides.length > 3) {
        slides[prev2Index].classList.add("prev-2");
        slides[next2Index].classList.add("next-2");
      }
    };

    const nextSlide = () => {
      currentIndex = (currentIndex + 1) % slides.length;
      updateGallery();
    };

    const prevSlide = () => {
      currentIndex = (currentIndex - 1 + slides.length) % slides.length;
      updateGallery();
    };

    const startAutoPlay = () => {
      autoPlayInterval = setInterval(nextSlide, 3000);
    };

    const resetAutoPlay = () => {
      clearInterval(autoPlayInterval);
      startAutoPlay();
    };

    if (nextBtn)
      nextBtn.addEventListener("click", () => {
        nextSlide();
        resetAutoPlay();
      });
    if (prevBtn)
      prevBtn.addEventListener("click", () => {
        prevSlide();
        resetAutoPlay();
      });

    dots.forEach((dot, index) => {
      dot.addEventListener("click", () => {
        currentIndex = index;
        updateGallery();
        resetAutoPlay();
      });
    });

    slides.forEach((slide, index) => {
      slide.addEventListener("click", () => {
        if (
          slide.classList.contains("prev") ||
          slide.classList.contains("next")
        ) {
          currentIndex = index;
          updateGallery();
          resetAutoPlay();
        }
      });
    });

    updateGallery();
    startAutoPlay();
  };

  const initProgramCarousel = () => {
    const track = document.querySelector(".program-track");
    if (!track) return;

    const slides = Array.from(document.querySelectorAll(".program-slide"));
    const dots = Array.from(document.querySelectorAll(".program-dot"));
    const prevBtn = document.querySelector(".program-controls .prev-btn");
    const nextBtn = document.querySelector(".program-controls .next-btn");

    if (slides.length === 0) return;

    let currentIndex = 0;
    let autoPlayInterval;

    const updateGallery = () => {
      slides.forEach((slide, index) => {
        slide.className = "program-slide";
        if (dots[index]) dots[index].classList.remove("active");
      });

      slides[currentIndex].classList.add("active");
      if (dots[currentIndex]) dots[currentIndex].classList.add("active");

      const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
      const nextIndex = (currentIndex + 1) % slides.length;
      const prev2Index = (currentIndex - 2 + slides.length) % slides.length;
      const next2Index = (currentIndex + 2) % slides.length;

      if (slides.length > 1) {
        slides[prevIndex].classList.add("prev");
        slides[nextIndex].classList.add("next");
      }
      if (slides.length > 3) {
        slides[prev2Index].classList.add("prev-2");
        slides[next2Index].classList.add("next-2");
      }
    };

    const nextSlide = () => {
      currentIndex = (currentIndex + 1) % slides.length;
      updateGallery();
    };

    const prevSlide = () => {
      currentIndex = (currentIndex - 1 + slides.length) % slides.length;
      updateGallery();
    };

    const startAutoPlay = () => {
      autoPlayInterval = setInterval(nextSlide, 3000);
    };

    const resetAutoPlay = () => {
      clearInterval(autoPlayInterval);
      startAutoPlay();
    };

    if (nextBtn)
      nextBtn.addEventListener("click", () => {
        nextSlide();
        resetAutoPlay();
      });
    if (prevBtn)
      prevBtn.addEventListener("click", () => {
        prevSlide();
        resetAutoPlay();
      });

    dots.forEach((dot, index) => {
      dot.addEventListener("click", () => {
        currentIndex = index;
        updateGallery();
        resetAutoPlay();
      });
    });

    slides.forEach((slide, index) => {
      slide.addEventListener("click", () => {
        if (
          slide.classList.contains("prev") ||
          slide.classList.contains("next")
        ) {
          currentIndex = index;
          updateGallery();
          resetAutoPlay();
        }
      });
    });

    updateGallery();
    startAutoPlay();
  };

  const initMobileJourneyCards = () => {
    const cards = document.querySelectorAll(".journey-card");
    if (cards.length === 0) return;

    const observerOptions = {
      root: null,
      rootMargin: "-5% 0px",
      threshold: 0.6,
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (window.innerWidth <= 799) {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-active");
          } else {
            entry.target.classList.remove("is-active");
          }
        } else {
          entry.target.classList.remove("is-active");
        }
      });
    }, observerOptions);

    cards.forEach((card) => observer.observe(card));
  };

  const initScrollAnimations = () => {
    const animatedElements = document.querySelectorAll(
      ".hero-title-component, .hero-image-component, .keypoints-container, .keypoint-card, .obiective-section, .unic-section, .gallery-section, .program-section, .info-section, .oferta-section, .dispo-section, .excursii-section, .journeys-about, .journeys-list, .home-carousel-section, .home-value-section, .home-services-section, .home-development-section, .home-irlgaming-section, .home-journeys-section, .home-team-section",
    );

    if (animatedElements.length === 0) return;

    if ("IntersectionObserver" in window) {
      const observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              entry.target.classList.add("in-view");
            } else {
              entry.target.classList.remove("in-view");
            }
          });
        },
        { root: null, threshold: 0.1, rootMargin: "0px" },
      );

      animatedElements.forEach((el) => observer.observe(el));
    } else {
      animatedElements.forEach((el) => el.classList.add("in-view"));
    }
  };

  const initHoverAccordions = (selector) => {
    const cards = document.querySelectorAll(selector);
    cards.forEach((card) => {
      card.addEventListener("click", () => card.classList.toggle("expanded"));
    });
  };

  const initTabs = () => {
    const tabPills = document.querySelectorAll(".tab-pill");
    if (tabPills.length === 0) return;

    tabPills.forEach((pill) => {
      pill.addEventListener("click", () => {
        tabPills.forEach((p) => p.classList.remove("active"));
        pill.classList.add("active");

        const contents = document.querySelectorAll(".bucuram-content-state");
        contents.forEach((c) => c.classList.remove("active"));

        const targetId = pill.getAttribute("data-target");
        const targetContent = document.getElementById(targetId);
        if (targetContent) {
          targetContent.classList.add("active");
        }
      });
    });
  };

  const initFormAndPackages = () => {
    const pills = document.querySelectorAll(".pkg-pill");

    if (pills.length > 0) {
      pills.forEach((pill) => {
        pill.addEventListener("click", () => {
          pills.forEach((p) => p.classList.remove("active"));

          const targetId = pill.getAttribute("data-target");
          const cards = document.querySelectorAll(".package-info-card");
          cards.forEach((c) => c.classList.remove("active"));

          const targetCard = document.getElementById(targetId);
          if (targetCard) targetCard.classList.add("active");

          pill.classList.add("active");
        });
      });
    }

    const packageDataEl = document.getElementById("acf-package-data");
    const uiPackageSelect = document.getElementById("ui-package-select");
    const hiddenPackageInput = document.getElementById("selected-package");

    if (packageDataEl && uiPackageSelect && hiddenPackageInput) {
      const packagesList = JSON.parse(
        packageDataEl.getAttribute("data-packages") || "[]",
      );

      packagesList.forEach((pkgText) => {
        const opt = document.createElement("option");
        opt.value = pkgText;
        opt.textContent = pkgText;
        uiPackageSelect.appendChild(opt);
      });

      uiPackageSelect.addEventListener("change", (e) => {
        hiddenPackageInput.value = e.target.value;
      });
    }

    const seriesDataEl = document.getElementById("acf-camp-series-data");
    const uiSelect = document.getElementById("ui-camp-series");
    const cf7Input = document.getElementById("cf7-camp-series");

    if (seriesDataEl && uiSelect && cf7Input) {
      const series = JSON.parse(
        seriesDataEl.getAttribute("data-series") || "[]",
      );

      series.forEach((serieText) => {
        const opt = document.createElement("option");
        opt.value = serieText;
        opt.textContent = serieText;
        uiSelect.appendChild(opt);
      });

      uiSelect.addEventListener("change", (e) => {
        cf7Input.value = e.target.value;
      });
    }

    document.addEventListener(
      "wpcf7mailsent",
      () => {
        if (uiPackageSelect) {
          uiPackageSelect.value = "";
        }
        if (uiSelect) {
          uiSelect.value = "";
        }
      },
      false,
    );
  };

  const initHomeCarousel = () => {
    const slides = Array.from(document.querySelectorAll(".home-carousel-slide"));
    if (slides.length === 0) return;

    const nextBtn = document.querySelector(".home-carousel-nav-next");
    let currentIndex = 0;
    let autoPlayInterval;

    const updateHomeCarousel = () => {
      slides.forEach((slide) => {
        slide.classList.remove("active", "prev", "next");
      });

      slides[currentIndex].classList.add("active");

      if (slides.length > 1) {
        const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
        const nextIndex = (currentIndex + 1) % slides.length;
        slides[prevIndex].classList.add("prev");
        slides[nextIndex].classList.add("next");
      }
    };

    const nextSlide = () => {
      currentIndex = (currentIndex + 1) % slides.length;
      updateHomeCarousel();
    };

    const startAutoPlay = () => {
      autoPlayInterval = setInterval(nextSlide, 3500);
    };

    const resetAutoPlay = () => {
      clearInterval(autoPlayInterval);
      startAutoPlay();
    };

    if (nextBtn) {
      nextBtn.addEventListener("click", () => {
        nextSlide();
        resetAutoPlay();
      });
    }

    updateHomeCarousel();
    startAutoPlay();
  };

  const initMobileServices = () => {
    const serviceCards = document.querySelectorAll('.service-card');
    if (serviceCards.length === 0) return;

    serviceCards.forEach(card => {
      const viewMoreBtn = card.querySelector('.service-btn');
      const closeBtn = card.querySelector('.service-close-btn');

      if (viewMoreBtn) {
        viewMoreBtn.addEventListener('click', (e) => {
          if (window.innerWidth <= 1024) {
            e.preventDefault();
            card.classList.add('is-expanded');
          }
        });
      }

      if (closeBtn) {
        closeBtn.addEventListener('click', (e) => {
          if (window.innerWidth <= 1024) {
            e.preventDefault();
            e.stopPropagation();
            card.classList.remove('is-expanded');
          }
        });
      }
    });
  };

  const initLaserTagBooking = () => {
    if (!document.getElementById("lt-booking")) return;
    if (typeof ltAjax === "undefined") return;

    const ltState = {
      viewYear: new Date().getFullYear(),
      viewMonth: new Date().getMonth(),
      selectedRounds: null,
      selectedDate: null,
      selectedSlot: null,
      name: "",
      email: "",
      phone: "",
      city: "",
      players: 2,
      gameMode: "Battle Royale",
      step: "build",
      mobileStep: 1,
      slots: [],
      checkedDates: {},
      isMobile: window.innerWidth <= 1024,
      loadingSlots: false,
    };

    const packages = [
      { n: 1, name: "1 ROUND", price: 39, dur: "30 min total" },
      { n: 2, name: "2 ROUNDS", price: 69, dur: "60 min total" },
      { n: 3, name: "3 ROUNDS", price: 99, dur: "90 min total" },
    ];

    const monthNames = [
      "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
    ];

    const ROUND_MINUTES = 30;

    const addMinutes = (t, min) => {
      let parts = t.split(":").map(Number);
      let tot = parts[0] * 60 + parts[1] + min;
      let h = Math.floor(tot / 60);
      let m = tot % 60;
      return `${String(h).padStart(2, "0")}:${String(m).padStart(2, "0")}`;
    };

    const fmtLong = (dateKey) => {
      const [y, m, d] = dateKey.split("-").map(Number);
      const dt = new Date(y, m - 1, d);
      const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
      return `${days[dt.getDay()]}, ${String(d).padStart(2, "0")} ${monthNames[m - 1]} ${y}`;
    };

    const renderPackageChoices = () => {
      const container = document.getElementById("lt-pkg-choices");
      if (!container) return;
      container.innerHTML = packages.map(p => {
        const active = ltState.selectedRounds === p.n;
        return `
          <div class="lt-pkg-choice ${active ? "lt-pkg-choice-active" : ""}" data-rounds="${p.n}">
            <span class="lt-pkg-choice-title">${p.name}</span>
            <span class="lt-pkg-choice-dur">${p.dur}</span>
            <span class="lt-pkg-choice-price">${p.price} LEI / player</span>
          </div>
        `;
      }).join("");
    };

    const renderCalendar = () => {
      const gridContainer = document.getElementById("lt-calendar-grid");
      const monthLabel = document.getElementById("lt-month-label");
      const dateLock = document.getElementById("lt-date-lock");
      if (!gridContainer || !monthLabel) return;

      monthLabel.textContent = `${monthNames[ltState.viewMonth]} ${ltState.viewYear}`;

      if (dateLock) {
        dateLock.style.display = ltState.selectedRounds ? "none" : "flex";
      }

      const firstDay = new Date(ltState.viewYear, ltState.viewMonth, 1);
      let startDow = (firstDay.getDay() + 6) % 7;
      const daysInMonth = new Date(ltState.viewYear, ltState.viewMonth + 1, 0).getDate();

      let html = "";
      for (let i = 0; i < startDow; i++) {
        html += '<div class="lt-cal-cell lt-cal-empty"></div>';
      }

      const today = new Date();
      today.setHours(0, 0, 0, 0);

      for (let d = 1; d <= daysInMonth; d++) {
        const dateKey = `${ltState.viewYear}-${String(ltState.viewMonth + 1).padStart(2, "0")}-${String(d).padStart(2, "0")}`;
        const cellDate = new Date(ltState.viewYear, ltState.viewMonth, d);
        const isPast = cellDate < today;

        let statusClass = "lt-cal-unavail";
        let clickAttr = "";

        if (!ltState.selectedRounds) {
          statusClass = "lt-cal-unavail";
        } else if (isPast) {
          statusClass = "lt-cal-unavail";
        } else if (dateKey === ltState.selectedDate) {
          statusClass = "lt-cal-selected";
          clickAttr = `data-date="${dateKey}"`;
        } else {
          const cache = ltState.checkedDates[dateKey];
          if (cache && (cache.closed || cache.slots.length === 0)) {
            statusClass = "lt-cal-unavail";
          } else {
            statusClass = "lt-cal-available";
            clickAttr = `data-date="${dateKey}"`;
          }
        }

        html += `<div class="lt-cal-cell ${statusClass}" ${clickAttr}>${d}</div>`;
      }

      gridContainer.innerHTML = html;
    };

    const fetchSlots = () => {
      if (!ltState.selectedDate || !ltState.selectedRounds) return;

      ltState.loadingSlots = true;
      renderSlots();

      const fd = new FormData();
      fd.append("action", "lt_get_slots");
      fd.append("nonce", ltAjax.nonce);
      fd.append("date", ltState.selectedDate);
      fd.append("rounds", ltState.selectedRounds);

      fetch(ltAjax.url, {
        method: "POST",
        body: fd
      })
        .then(r => r.json())
        .then(data => {
          ltState.loadingSlots = false;
          ltState.slots = data.slots || [];

          ltState.checkedDates[ltState.selectedDate] = {
            slots: data.slots || [],
            closed: data.closed || false
          };

          if (ltState.selectedSlot && !ltState.slots.includes(ltState.selectedSlot)) {
            ltState.selectedSlot = null;
          }

          updateUI();
        })
        .catch(err => {
          console.error(err);
          ltState.loadingSlots = false;
          ltState.slots = [];
          updateUI();
        });
    };

    const fetchMonthAvailability = () => {
      if (!ltState.selectedRounds) return;

      const fd = new FormData();
      fd.append("action", "lt_get_month_availability");
      fd.append("nonce", ltAjax.nonce);
      fd.append("year", ltState.viewYear);
      fd.append("month", ltState.viewMonth + 1);
      fd.append("rounds", ltState.selectedRounds);

      fetch(ltAjax.url, {
        method: "POST",
        body: fd
      })
        .then(r => r.json())
        .then(data => {
          Object.assign(ltState.checkedDates, data);
          renderCalendar();
        })
        .catch(err => {
          console.error("Error fetching month availability:", err);
        });
    };

    const renderSlots = () => {
      const container = document.getElementById("lt-slots-container");
      const timeSection = document.getElementById("lt-time-section");
      const timeDivider = document.getElementById("lt-time-divider");
      if (!container) return;

      if (!ltState.selectedDate) {
        if (timeSection) timeSection.style.display = "none";
        if (timeDivider) timeDivider.style.display = "none";
        container.innerHTML = '<p class="lt-slots-msg">Pick a date to see available time slots.</p>';
        return;
      }

      if (timeSection) timeSection.style.display = "block";
      if (timeDivider) timeDivider.style.display = "block";

      if (ltState.loadingSlots) {
        container.innerHTML = '<p class="lt-slots-msg">Loading slots...</p>';
        return;
      }

      const slots = ltState.slots || [];
      if (slots.length === 0) {
        container.innerHTML = '<p class="lt-slots-msg">No back-to-back slots left for this package on this date. Try another date.</p>';
        return;
      }

      container.innerHTML = `
        <div class="lt-slots-date-label">${fmtLong(ltState.selectedDate)}</div>
        <div class="lt-slots-grid">
          ${slots.map(t => {
        const selected = ltState.selectedSlot === t;
        const end = addMinutes(t, ltState.selectedRounds * ROUND_MINUTES);
        const range = `${t} – ${end}`;
        return `
              <div class="lt-slot-chip ${selected ? "lt-slot-selected" : ""}" data-slot="${t}">
                <span class="lt-slot-time">${t}</span>
                <span class="lt-slot-range">${range}</span>
              </div>
            `;
      }).join("")}
        </div>
      `;
    };

    const renderReview = () => {
      const container = document.getElementById("lt-review-table");
      if (!container) return;

      const pkg = packages.find(p => p.n === ltState.selectedRounds);
      const pkgName = pkg ? pkg.name : "";
      const pkgPrice = pkg ? pkg.price : 0;
      const end = addMinutes(ltState.selectedSlot, ltState.selectedRounds * ROUND_MINUTES);
      const range = `${ltState.selectedSlot} – ${end}`;

      container.innerHTML = `
        <div class="lt-review-row">
          <span class="lt-review-label">Package</span>
          <span class="lt-review-val">${pkgName} · ${pkgPrice} LEI / player</span>
        </div>
        <div class="lt-review-row">
          <span class="lt-review-label">Date</span>
          <span class="lt-review-val">${fmtLong(ltState.selectedDate)}</span>
        </div>
        <div class="lt-review-row">
          <span class="lt-review-label">Time</span>
          <span class="lt-review-val">${range}</span>
        </div>
        <div class="lt-review-row">
          <span class="lt-review-label">Players</span>
          <span class="lt-review-val">${ltState.players}</span>
        </div>
        <div class="lt-review-row">
          <span class="lt-review-label">Game mode</span>
          <span class="lt-review-val">${ltState.gameMode}</span>
        </div>
        <div class="lt-review-row">
          <span class="lt-review-label">Name</span>
          <span class="lt-review-val">${ltState.name}</span>
        </div>
        <div class="lt-review-row">
          <span class="lt-review-label">Phone</span>
          <span class="lt-review-val">${ltState.phone}</span>
        </div>
        <div class="lt-review-row">
          <span class="lt-review-label">Email</span>
          <span class="lt-review-val">${ltState.email}</span>
        </div>
        <div class="lt-review-row">
          <span class="lt-review-label">City</span>
          <span class="lt-review-val">${ltState.city || "—"}</span>
        </div>
      `;
    };

    const updateUI = () => {
      renderPackageChoices();
      renderCalendar();
      renderSlots();

      const reviewBtn = document.getElementById("lt-review-btn");
      const formStatus = document.getElementById("lt-form-status");
      const canReview = !!(ltState.name && ltState.email && ltState.phone && ltState.selectedRounds && ltState.selectedDate && ltState.selectedSlot);

      if (reviewBtn) {
        reviewBtn.disabled = !canReview;
      }

      if (formStatus) {
        if (canReview) {
          const end = addMinutes(ltState.selectedSlot, ltState.selectedRounds * ROUND_MINUTES);
          formStatus.textContent = `${fmtLong(ltState.selectedDate)} · ${ltState.selectedSlot} – ${end}`;
          formStatus.classList.add("lt-status-ready");
        } else {
          formStatus.textContent = "Complete the steps to review";
          formStatus.classList.remove("lt-status-ready");
        }
      }

      const stageBuild = document.getElementById("lt-stage-build");
      const stageReview = document.getElementById("lt-stage-review");
      const stageSuccess = document.getElementById("lt-stage-success");

      if (ltState.step === "build") {
        if (stageBuild) stageBuild.style.display = "block";
        if (stageReview) stageReview.style.display = "none";
        if (stageSuccess) stageSuccess.style.display = "none";
      } else if (ltState.step === "review") {
        if (stageBuild) stageBuild.style.display = "none";
        if (stageReview) stageReview.style.display = "block";
        if (stageSuccess) stageSuccess.style.display = "none";
        renderReview();
      } else if (ltState.step === "success") {
        if (stageBuild) stageBuild.style.display = "none";
        if (stageReview) stageReview.style.display = "none";
        if (stageSuccess) stageSuccess.style.display = "block";

        const successTitle = document.getElementById("lt-success-title");
        if (successTitle) {
          successTitle.textContent = `You're in, ${ltState.name}!`;
        }
      }

      if (ltState.isMobile && ltState.step === "build") {
        const pkgSummary = document.getElementById("lt-pkg-summary");
        const dateSummary = document.getElementById("lt-date-summary");
        const timeSummary = document.getElementById("lt-time-summary");

        const stepPkg = document.querySelector('[data-lt-step="1"]');
        const calCard = document.getElementById("lt-cal-card");
        const formCard = document.getElementById("lt-form-card");
        const timeSection = document.getElementById("lt-time-section");
        const slotsContainer = document.getElementById("lt-slots-container");

        if (pkgSummary) {
          if (ltState.mobileStep > 1 && ltState.selectedRounds) {
            const pkgObj = packages.find(p => p.n === ltState.selectedRounds);
            pkgSummary.innerHTML = `
              <div class="lt-summary-bar-content">
                <span class="lt-summary-check">✓</span>
                <span class="lt-summary-label">Package:</span>
                <span class="lt-summary-value">${pkgObj ? pkgObj.name : ""}</span>
              </div>
              <span class="lt-summary-edit">Edit</span>
            `;
            pkgSummary.style.display = "flex";
          } else {
            pkgSummary.style.display = "none";
          }
        }

        if (dateSummary) {
          if (ltState.mobileStep > 2 && ltState.selectedDate) {
            dateSummary.innerHTML = `
              <div class="lt-summary-bar-content">
                <span class="lt-summary-check">✓</span>
                <span class="lt-summary-label">Date:</span>
                <span class="lt-summary-value">${fmtLong(ltState.selectedDate)}</span>
              </div>
              <span class="lt-summary-edit">Edit</span>
            `;
            dateSummary.style.display = "flex";
          } else {
            dateSummary.style.display = "none";
          }
        }

        if (timeSummary) {
          if (ltState.mobileStep > 3 && ltState.selectedSlot) {
            const end = addMinutes(ltState.selectedSlot, ltState.selectedRounds * ROUND_MINUTES);
            timeSummary.innerHTML = `
              <div class="lt-summary-bar-content">
                <span class="lt-summary-check">✓</span>
                <span class="lt-summary-label">Time:</span>
                <span class="lt-summary-value">${ltState.selectedSlot} – ${end}</span>
              </div>
              <span class="lt-summary-edit">Edit</span>
            `;
            timeSummary.style.display = "flex";
          } else {
            timeSummary.style.display = "none";
          }
        }

        if (stepPkg) stepPkg.style.display = ltState.mobileStep === 1 ? "block" : "none";
        if (calCard) calCard.style.display = ltState.mobileStep >= 2 ? "block" : "none";

        const calendarBody = document.getElementById("lt-calendar-body");
        const stepDateHeader = document.querySelector('[data-lt-step="2"]');

        if (calendarBody && stepDateHeader) {
          calendarBody.style.display = ltState.mobileStep === 2 ? "block" : "none";
          stepDateHeader.style.display = ltState.mobileStep === 2 ? "block" : "none";
        }

        if (timeSection && slotsContainer) {
          timeSection.style.display = ltState.mobileStep === 3 ? "block" : "none";
          slotsContainer.style.display = ltState.mobileStep === 3 ? "block" : "none";
        }

        if (formCard) formCard.style.display = ltState.mobileStep === 4 ? "block" : "none";
      } else if (ltState.step === "build") {
        const stepPkg = document.querySelector('[data-lt-step="1"]');
        const calCard = document.getElementById("lt-cal-card");
        const formCard = document.getElementById("lt-form-card");
        const calendarBody = document.getElementById("lt-calendar-body");
        const stepDateHeader = document.querySelector('[data-lt-step="2"]');
        const timeSection = document.getElementById("lt-time-section");
        const slotsContainer = document.getElementById("lt-slots-container");

        if (stepPkg) stepPkg.style.display = "block";
        if (calCard) calCard.style.display = "block";
        if (formCard) formCard.style.display = "block";
        if (calendarBody) calendarBody.style.display = "block";
        if (stepDateHeader) stepDateHeader.style.display = "block";

        if (timeSection) timeSection.style.display = ltState.selectedDate ? "block" : "none";
        if (slotsContainer) slotsContainer.style.display = ltState.selectedDate ? "block" : "none";

        const pkgSummary = document.getElementById("lt-pkg-summary");
        const dateSummary = document.getElementById("lt-date-summary");
        const timeSummary = document.getElementById("lt-time-summary");
        if (pkgSummary) pkgSummary.style.display = "none";
        if (dateSummary) dateSummary.style.display = "none";
        if (timeSummary) timeSummary.style.display = "none";
      }
    };

    const submitBooking = () => {
      const confirmBtn = document.getElementById("lt-confirm-btn");
      const errorContainer = document.getElementById("lt-error-container");
      if (confirmBtn) {
        confirmBtn.disabled = true;
        confirmBtn.textContent = "Booking...";
      }
      if (errorContainer) {
        errorContainer.style.display = "none";
        errorContainer.textContent = "";
      }

      const fd = new FormData();
      fd.append("action", "lt_submit_booking");
      fd.append("nonce", ltAjax.nonce);
      fd.append("name", ltState.name);
      fd.append("email", ltState.email);
      fd.append("phone", ltState.phone);
      fd.append("city", ltState.city);
      fd.append("players", ltState.players);
      fd.append("gameMode", ltState.gameMode);
      fd.append("date", ltState.selectedDate);
      fd.append("rounds", ltState.selectedRounds);
      fd.append("startTime", ltState.selectedSlot);

      fetch(ltAjax.url, {
        method: "POST",
        body: fd
      })
        .then(r => r.json())
        .then(data => {
          if (confirmBtn) {
            confirmBtn.disabled = false;
            confirmBtn.textContent = "Confirm booking";
          }
          if (data.success) {
            ltState.step = "success";
            updateUI();
          } else {
            if (errorContainer) {
              errorContainer.textContent = data.message || "An error occurred. Please try again.";
              errorContainer.style.display = "block";
            }
          }
        })
        .catch(err => {
          console.error(err);
          if (confirmBtn) {
            confirmBtn.disabled = false;
            confirmBtn.textContent = "Confirm booking";
          }
          if (errorContainer) {
            errorContainer.textContent = "A connection error occurred. Please check your internet connection and try again.";
            errorContainer.style.display = "block";
          }
        });
    };

    const changeMonth = (delta) => {
      let m = ltState.viewMonth + delta;
      let y = ltState.viewYear;
      if (m < 0) {
        m = 11;
        y--;
      }
      if (m > 11) {
        m = 0;
        y++;
      }

      const today = new Date();
      const minMonth = today.getMonth();
      const minYear = today.getFullYear();

      if (y < minYear || (y === minYear && m < minMonth)) {
        return;
      }

      ltState.viewMonth = m;
      ltState.viewYear = y;
      fetchMonthAvailability();
      updateUI();
    };

    const pkgChoices = document.getElementById("lt-pkg-choices");
    if (pkgChoices) {
      pkgChoices.addEventListener("click", (e) => {
        const choice = e.target.closest(".lt-pkg-choice");
        if (choice) {
          const rounds = parseInt(choice.getAttribute("data-rounds"), 10);
          ltState.selectedRounds = rounds;
          ltState.selectedDate = null;
          ltState.selectedSlot = null;
          ltState.mobileStep = 2;
          fetchMonthAvailability();
          updateUI();
        }
      });
    }

    const calendarGrid = document.getElementById("lt-calendar-grid");
    if (calendarGrid) {
      calendarGrid.addEventListener("click", (e) => {
        const cell = e.target.closest(".lt-cal-available");
        if (cell) {
          const date = cell.getAttribute("data-date");
          ltState.selectedDate = date;
          ltState.selectedSlot = null;
          ltState.mobileStep = 3;
          if (ltState.checkedDates[date]) {
            ltState.slots = ltState.checkedDates[date].slots || [];
            updateUI();
          } else {
            fetchSlots();
          }
        }
      });
    }

    const slotsContainer = document.getElementById("lt-slots-container");
    if (slotsContainer) {
      slotsContainer.addEventListener("click", (e) => {
        const chip = e.target.closest(".lt-slot-chip");
        if (chip) {
          const slot = chip.getAttribute("data-slot");
          ltState.selectedSlot = slot;
          ltState.mobileStep = 4;
          updateUI();
        }
      });
    }

    const prevMonthBtn = document.getElementById("lt-prev-month");
    const nextMonthBtn = document.getElementById("lt-next-month");
    if (prevMonthBtn) prevMonthBtn.addEventListener("click", () => changeMonth(-1));
    if (nextMonthBtn) nextMonthBtn.addEventListener("click", () => changeMonth(1));

    const nameInput = document.getElementById("lt-name");
    const phoneInput = document.getElementById("lt-phone");
    const emailInput = document.getElementById("lt-email");
    const cityInput = document.getElementById("lt-city");
    const gamemodeSelect = document.getElementById("lt-gamemode");

    if (nameInput) nameInput.addEventListener("input", (e) => { ltState.name = e.target.value; updateUI(); });
    if (phoneInput) phoneInput.addEventListener("input", (e) => { ltState.phone = e.target.value; updateUI(); });
    if (emailInput) emailInput.addEventListener("input", (e) => { ltState.email = e.target.value; updateUI(); });
    if (cityInput) cityInput.addEventListener("input", (e) => { ltState.city = e.target.value; updateUI(); });
    if (gamemodeSelect) gamemodeSelect.addEventListener("change", (e) => { ltState.gameMode = e.target.value; updateUI(); });

    const decPlayersBtn = document.getElementById("lt-dec-players");
    const incPlayersBtn = document.getElementById("lt-inc-players");
    const playersInput = document.getElementById("lt-players");

    if (decPlayersBtn) decPlayersBtn.addEventListener("click", () => {
      ltState.players = Math.max(1, ltState.players - 1);
      if (playersInput) playersInput.value = ltState.players;
      updateUI();
    });
    if (incPlayersBtn) incPlayersBtn.addEventListener("click", () => {
      ltState.players = Math.min(14, ltState.players + 1);
      if (playersInput) playersInput.value = ltState.players;
      updateUI();
    });

    if (playersInput) {
      playersInput.addEventListener("change", (e) => {
        let val = parseInt(e.target.value, 10);
        if (isNaN(val) || val < 1) val = 1;
        if (val > 14) val = 14;
        ltState.players = val;
        playersInput.value = val;
        updateUI();
      });
      playersInput.addEventListener("input", (e) => {
        let val = parseInt(e.target.value, 10);
        if (!isNaN(val)) {
          if (val >= 1 && val <= 14) {
            ltState.players = val;
            updateUI();
          }
        }
      });
    }

    const reviewBtn = document.getElementById("lt-review-btn");
    const backBtn = document.getElementById("lt-back-btn");
    const confirmBtn = document.getElementById("lt-confirm-btn");
    const resetBtn = document.getElementById("lt-reset-btn");

    if (reviewBtn) reviewBtn.addEventListener("click", () => {
      const canReview = !!(ltState.name && ltState.email && ltState.phone && ltState.selectedRounds && ltState.selectedDate && ltState.selectedSlot);
      if (canReview) {
        ltState.step = "review";
        updateUI();
      }
    });

    if (backBtn) backBtn.addEventListener("click", () => {
      ltState.step = "build";
      updateUI();
    });

    if (confirmBtn) confirmBtn.addEventListener("click", submitBooking);

    if (resetBtn) resetBtn.addEventListener("click", () => {
      ltState.step = "build";
      ltState.mobileStep = 1;
      ltState.selectedRounds = null;
      ltState.selectedDate = null;
      ltState.selectedSlot = null;
      ltState.name = "";
      ltState.email = "";
      ltState.phone = "";
      ltState.city = "";
      ltState.players = 2;
      ltState.gameMode = "Battle Royale";
      ltState.slots = [];

      if (nameInput) nameInput.value = "";
      if (phoneInput) phoneInput.value = "";
      if (emailInput) emailInput.value = "";
      if (cityInput) cityInput.value = "";
      if (playersInput) playersInput.value = 2;
      if (gamemodeSelect) gamemodeSelect.value = "Battle Royale";

      updateUI();
    });

    const pkgSummary = document.getElementById("lt-pkg-summary");
    const dateSummary = document.getElementById("lt-date-summary");
    const timeSummary = document.getElementById("lt-time-summary");

    if (pkgSummary) pkgSummary.addEventListener("click", () => { ltState.mobileStep = 1; updateUI(); });
    if (dateSummary) dateSummary.addEventListener("click", () => { ltState.mobileStep = 2; updateUI(); });
    if (timeSummary) timeSummary.addEventListener("click", () => { ltState.mobileStep = 3; updateUI(); });

    let resizeTimeout;
    window.addEventListener("resize", () => {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(() => {
        const isMobileNow = window.innerWidth <= 1024;
        if (isMobileNow !== ltState.isMobile) {
          ltState.isMobile = isMobileNow;
          updateUI();
        }
      }, 150);
    });

    if (playersInput) playersInput.value = ltState.players;
    if (gamemodeSelect) gamemodeSelect.value = ltState.gameMode;

    updateUI();
  };

  initMobileMenu();
  initHomeCarousel();
  initMobileJourneyCards();
  initScrollAnimations();
  initHoverAccordions(".obiectiv-card");
  initHoverAccordions(".oferta-card");
  initTabs();
  initFormAndPackages();
  initGalleryCarousel();
  initProgramCarousel();
  initMobileServices();
  initLaserTagBooking();
});
