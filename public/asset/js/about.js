(function () {
  const reduceMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
  ).matches;

  /* Mobile nav */
  const toggle = document.getElementById("menuToggle");
  const nav = document.getElementById("mainNav");
  if (toggle && nav) {
    toggle.addEventListener("click", () => {
      const open = nav.classList.toggle("open");
      toggle.classList.toggle("open", open);
      toggle.setAttribute("aria-expanded", open ? "true" : "false");
    });
    nav.querySelectorAll("a").forEach((a) =>
      a.addEventListener("click", () => {
        nav.classList.remove("open");
        toggle.classList.remove("open");
        toggle.setAttribute("aria-expanded", "false");
      }),
    );
  }

  /* Portfolio: 3D tilt + category filters */
  const workCards = document.querySelectorAll(".work-card");
  if (!reduceMotion && window.matchMedia("(pointer:fine)").matches) {
    workCards.forEach((card) => {
      const inner = card.querySelector(".work-card-inner");
      if (!inner) return;
      card.addEventListener("mousemove", (e) => {
        const r = card.getBoundingClientRect();
        const x = (e.clientX - r.left) / r.width - 0.5;
        const y = (e.clientY - r.top) / r.height - 0.5;
        inner.style.transform = `rotateY(${x * 10}deg) rotateX(${-y * 10}deg) translateY(-4px)`;
      });
      card.addEventListener("mouseleave", () => {
        inner.style.transform = "rotateY(0deg) rotateX(0deg) translateY(0)";
      });
    });
  }

  const filterBtns = document.querySelectorAll(".filter-btn");
  if (filterBtns.length) {
    filterBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        filterBtns.forEach((b) => b.classList.remove("active"));
        btn.classList.add("active");
        const f = btn.dataset.filter;
        workCards.forEach((card) => {
          const match = f === "all" || card.dataset.cat === f;
          card.classList.remove("just-shown");
          if (match) {
            card.classList.remove("filtered-out");
            void card.offsetWidth;
            card.classList.add("just-shown");
          } else {
            card.classList.add("filtered-out");
          }
        });
      });
    });
  }
  
  /* Services dropdown / mobile accordion */
  const svcTrigger = document.getElementById("servicesTrigger");
  const svcPanel = document.getElementById("servicesDropdown");

  function closeAllCategories() {
    svcPanel
      .querySelectorAll(".dd-submenu.open")
      .forEach((sm) => sm.classList.remove("open"));
    svcPanel
      .querySelectorAll('.dd-cat-trigger[aria-expanded="true"]')
      .forEach((b) => b.setAttribute("aria-expanded", "false"));
  }

  if (svcTrigger && svcPanel) {
    svcTrigger.addEventListener("click", (e) => {
      e.stopPropagation();
      const isOpen = svcPanel.classList.toggle("open");
      svcTrigger.setAttribute("aria-expanded", isOpen ? "true" : "false");
      if (!isOpen) closeAllCategories();
    });
    document.addEventListener("click", (e) => {
      if (!svcPanel.contains(e.target) && !svcTrigger.contains(e.target)) {
        svcPanel.classList.remove("open");
        svcTrigger.setAttribute("aria-expanded", "false");
        closeAllCategories();
      }
    });
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        svcPanel.classList.remove("open");
        svcTrigger.setAttribute("aria-expanded", "false");
        closeAllCategories();
      }
    });

    /* second-level category accordion (accordion-within-accordion) */
    svcPanel.querySelectorAll(".dd-cat-trigger").forEach((catBtn) => {
      const submenu = catBtn.nextElementSibling;
      catBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        const willOpen = !submenu.classList.contains("open");
        closeAllCategories();
        if (willOpen) {
          submenu.classList.add("open");
          catBtn.setAttribute("aria-expanded", "true");
        }
      });
    });

    svcPanel.querySelectorAll(".dropdown-item").forEach((a) =>
      a.addEventListener("click", () => {
        svcPanel.classList.remove("open");
        svcTrigger.setAttribute("aria-expanded", "false");
        closeAllCategories();
        if (nav && nav.classList.contains("open")) {
          nav.classList.remove("open");
          toggle.classList.remove("open");
          toggle.setAttribute("aria-expanded", "false");
        }
      }),
    );
  }

  /* Header shadow + scroll progress + back to top */
  const header = document.getElementById("siteHeader");
  const progress = document.getElementById("scrollProgress");
  const toTop = document.getElementById("toTop");

  function onScroll() {
    const y = window.scrollY;
    if (header) header.classList.toggle("scrolled", y > 8);
    if (toTop) toTop.classList.toggle("show", y > 600);
    if (progress) {
      const doc = document.documentElement;
      const max = doc.scrollHeight - doc.clientHeight;
      const ratio = max > 0 ? y / max : 0;
      progress.style.transform = `scaleX(${ratio})`;
    }
  }
  document.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  if (toTop) {
    toTop.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: reduceMotion ? "auto" : "smooth" });
    });
  }

  /* Reveal on scroll */
  const revealEls = document.querySelectorAll(".reveal");
  if (reduceMotion) {
    revealEls.forEach((el) => el.classList.add("in-view"));
  } else if ("IntersectionObserver" in window) {
    const io = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("in-view");
            io.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.15, rootMargin: "0px 0px -60px 0px" },
    );
    revealEls.forEach((el) => io.observe(el));
  } else {
    revealEls.forEach((el) => el.classList.add("in-view"));
  }

  /* Process connector line */
  const connector = document.querySelector(".process-connector");
  if (connector) {
    if (reduceMotion) {
      connector.classList.add("in-view");
    } else if ("IntersectionObserver" in window) {
      const io2 = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              connector.classList.add("in-view");
              io2.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.4 },
      );
      io2.observe(connector);
    }
  }

  /* Animated counters */
  const stats = document.querySelectorAll(".stat .num");
  function animateCount(el) {
    const target = parseInt(el.dataset.count, 10) || 0;
    const suffix = el.querySelector(".suffix");
    const suffixText = suffix ? suffix.textContent : "";
    if (reduceMotion) {
      el.textContent = target.toLocaleString("fa-IR") + suffixText;
      return;
    }
    const duration = 1400;
    const start = performance.now();
    function tick(now) {
      const p = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - p, 3);
      const value = Math.round(target * eased);
      el.textContent = value.toLocaleString("fa-IR") + suffixText;
      if (p < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }
  if (stats.length) {
    if ("IntersectionObserver" in window) {
      const io3 = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              animateCount(entry.target);
              io3.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.6 },
      );
      stats.forEach((el) => io3.observe(el));
    } else {
      stats.forEach(animateCount);
    }
  }

  /* Cursor spotlight (desktop, fine pointer only) */
  const spotlight = document.getElementById("cursorSpotlight");
  if (
    spotlight &&
    !reduceMotion &&
    window.matchMedia("(pointer:fine)").matches
  ) {
    let raf = null;
    window.addEventListener(
      "mousemove",
      (e) => {
        spotlight.classList.add("active");
        if (raf) return;
        raf = requestAnimationFrame(() => {
          document.documentElement.style.setProperty("--mx", e.clientX + "px");
          document.documentElement.style.setProperty("--my", e.clientY + "px");
          raf = null;
        });
      },
      { passive: true },
    );
    document.addEventListener("mouseleave", () =>
      spotlight.classList.remove("active"),
    ); 
  }

  /* Subtle parallax on hero visual (desktop, fine pointer only) */
  const heroVisual = document.querySelector(".hero-visual");
  if (
    heroVisual &&
    !reduceMotion &&
    window.matchMedia("(pointer:fine)").matches
  ) {
    const hero = document.querySelector(".hero");
    hero.addEventListener("mousemove", (e) => {
      const rect = hero.getBoundingClientRect();
      const x = (e.clientX - rect.left) / rect.width - 0.5;
      const y = (e.clientY - rect.top) / rect.height - 0.5;
      heroVisual.style.transform = `translate(${x * -14}px, ${y * -14}px)`;
    });
    hero.addEventListener("mouseleave", () => {
      heroVisual.style.transform = "translate(0,0)";
    });
  }

  /* About: animated counters */
  const abNums = document.querySelectorAll(".ab-stat b[data-count]");
  function abCount(el) {
    const target = parseInt(el.dataset.count, 10) || 0;
    const suffix = el.dataset.suffix || "";
    if (reduceMotion) {
      el.textContent = target.toLocaleString("fa-IR") + suffix;
      return;
    }
    const start = performance.now();
    const dur = 1400;
    function tick(now) {
      const p = Math.min((now - start) / dur, 1);
      const eased = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.round(target * eased).toLocaleString("fa-IR") + suffix;
      if (p < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }
  if (abNums.length) {
    if ("IntersectionObserver" in window) {
      const abIo = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              abCount(entry.target);
              abIo.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.6 },
      );
      abNums.forEach((el) => abIo.observe(el));
    } else {
      abNums.forEach(abCount);
    }
  }

})();
