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
      ".hero-title-component, .hero-image-component, .keypoints-container, .keypoint-card, .obiective-section, .unic-section, .gallery-section, .program-section, .info-section, .oferta-section, .dispo-section, .excursii-section, .journeys-about, .journeys-list, .home-carousel-section, .home-services-section, .home-development-section, .home-irlgaming-section, .home-team-section",
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
          if (window.innerWidth <= 799) {
            e.preventDefault();
            card.classList.add('is-expanded');
          }
        });
      }

      if (closeBtn) {
        closeBtn.addEventListener('click', (e) => {
          if (window.innerWidth <= 799) {
            e.preventDefault();
            e.stopPropagation();
            card.classList.remove('is-expanded');
          }
        });
      }
    });
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
});
