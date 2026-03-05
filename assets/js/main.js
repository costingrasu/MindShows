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

  const initScrollAnimations = () => {
    const animatedElements = document.querySelectorAll(
      ".hero-title-component, .hero-image-component, .keypoints-container, .keypoint-card, .obiective-section, .unic-section, .info-section, .oferta-section, .dispo-section",
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

  initMobileMenu();
  initScrollAnimations();
  initHoverAccordions(".obiectiv-card");
  initHoverAccordions(".oferta-card");
  initTabs();
  initFormAndPackages();
});
