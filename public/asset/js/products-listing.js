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

  /* ---------- PRODUCTS LISTING PAGE ---------- */
  const prodGridRoot = document.getElementById("prodListing");
  if (prodGridRoot && window.SADRA_PRODUCTS) {
    const products = window.SADRA_PRODUCTS;
    const groups = {};
    const order = [];
    products.forEach((p) => {
      if (!groups[p.category]) {
        groups[p.category] = { label: p.categoryLabel, items: [] };
        order.push(p.category);
      }
      groups[p.category].items.push(p);
    });

    const arrowSvg =
      '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 6l-6 6 6 6"/></svg>';

    const cardHTML = (p, catLabel, index) =>
      '<a class="pcard reveal" style="--d:' +
      (index * 0.07).toFixed(2) +
      's" data-cat="' +
      p.category +
      '" href="product.html?id=' +
      encodeURIComponent(p.id) +
      '">' +
      '<div class="pcard-visual">' +
      '<span class="pcard-badge">' +
      catLabel +
      "</span>" +
      '<img src="' +
      p.image +
      '" alt="' +
      p.title +
      '" loading="lazy">' +
      "</div>" +
      '<div class="pcard-body">' +
      "<h3>" +
      p.title +
      "</h3>" +
      "<p>" +
      p.short +
      "</p>" +
      '<div class="pcard-foot">' +
      "<span>مشاهده محصول</span>" +
      '<span class="pcard-arrow">' +
      arrowSvg +
      "</span>" +
      "</div>" +
      "</div>" +
      "</a>";

    // quick-jump chips
    const chipNav = document.getElementById("prodChipNav");
    if (chipNav) {
      chipNav.innerHTML = order
        .map(
          (cat, i) =>
            '<a class="prod-chip" href="#cat-' +
            cat +
            '"><b>' +
            String(i + 1).toLocaleString("fa-IR").padStart(2, "۰") +
            "</b> " +
            groups[cat].label +
            "</a>",
        )
        .join("");
    }

    let html = "";
    order.forEach((cat) => {
      const g = groups[cat];
      html += '<div class="prod-group" id="cat-' + cat + '">';
      html +=
        '<div class="prod-group-head reveal"><h2>' +
        g.label +
        '</h2><span class="count">' +
        g.items.length.toLocaleString("fa-IR") +
        " محصول</span></div>";
      html += '<div class="prod-grid">';
      g.items.forEach((p, i) => {
        html += cardHTML(p, g.label, i);
      });
      html += "</div></div>";
    });
    prodGridRoot.innerHTML = html;

    const freshReveals = prodGridRoot.querySelectorAll(".reveal");
    if ("IntersectionObserver" in window && freshReveals.length) {
      const io5 = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              entry.target.classList.add("in-view");
              io5.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.12 },
      );
      freshReveals.forEach((el) => io5.observe(el));
    } else {
      freshReveals.forEach((el) => el.classList.add("in-view"));
    }
  }
})();
