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

  /* ---------- BLOG LISTING PAGE ---------- */
  const blogIcons = {
    box: '<svg viewBox="0 0 34 34"><rect x="6" y="6" width="22" height="22" fill="none" stroke="#fffdf8" stroke-width="1.4"/><line x1="6" y1="16" x2="28" y2="16" stroke="#cdb18e" stroke-width="1.4"/></svg>',
    layers:
      '<svg viewBox="0 0 34 34"><path d="M17 4 L30 12 L17 20 L4 12 Z" fill="none" stroke="#fffdf8" stroke-width="1.4"/><path d="M4 20 L17 28 L30 20" fill="none" stroke="#cdb18e" stroke-width="1.4"/></svg>',
    diamond:
      '<svg viewBox="0 0 34 34"><path d="M17 4 L30 12 L17 30 L4 12 Z" fill="none" stroke="#fffdf8" stroke-width="1.4"/><line x1="4" y1="12" x2="30" y2="12" stroke="#cdb18e" stroke-width="1.4"/></svg>',
    clock:
      '<svg viewBox="0 0 34 34"><circle cx="17" cy="17" r="12" fill="none" stroke="#fffdf8" stroke-width="1.4"/><path d="M17 10 v7 l5 3" stroke="#cdb18e" stroke-width="1.6" fill="none"/></svg>',
    globe:
      '<svg viewBox="0 0 34 34"><circle cx="17" cy="17" r="12" fill="none" stroke="#fffdf8" stroke-width="1.4"/><ellipse cx="17" cy="17" rx="5" ry="12" fill="none" stroke="#cdb18e" stroke-width="1.2"/><line x1="5" y1="17" x2="29" y2="17" stroke="#cdb18e" stroke-width="1.2"/></svg>',
  };

  const blogGridRoot = document.getElementById("blogListing");
  const blogFeaturedRoot = document.getElementById("blogFeatured");
  if (blogGridRoot && window.SADRA_BLOG) {
    const posts = window.SADRA_BLOG;
    const groups = {};
    const order = [];
    posts.forEach((p) => {
      if (!groups[p.category]) {
        groups[p.category] = { label: p.categoryLabel, items: [] };
        order.push(p.category);
      }
      groups[p.category].items.push(p);
    });

    const arrowChar = '<span class="arrow">‹</span>';

    // quick-jump chips
    const chipNav = document.getElementById("blogChipNav");
    if (chipNav) {
      chipNav.innerHTML = order
        .map(
          (cat, i) =>
            '<a class="blog-chip" href="#cat-' +
            cat +
            '"><b>' +
            String(i + 1).toLocaleString("fa-IR").padStart(2, "۰") +
            "</b> " +
            groups[cat].label +
            "</a>",
        )
        .join("");
    }

    // featured post (first post flagged as featured, else the newest one)
    const featured = posts.find((p) => p.featured) || posts[0];
    if (blogFeaturedRoot && featured) {
      blogFeaturedRoot.innerHTML =
        '<a href="blog-post.html?id=' +
        encodeURIComponent(featured.id) +
        '" class="blog-featured reveal">' +
        '<div class="blog-featured-visual">' +
        '<span class="blog-featured-badge">تازه‌ترین یادداشت</span>' +
        (blogIcons[featured.icon] || blogIcons.box) +
        "</div>" +
        '<div class="blog-featured-body">' +
        '<p class="blog-featured-cat">' +
        featured.categoryLabel +
        "</p>" +
        "<h3>" +
        featured.title +
        "</h3>" +
        "<p>" +
        featured.excerpt +
        "</p>" +
        '<div class="blog-meta">' +
        "<span>" +
        featured.date +
        " · " +
        featured.readTime +
        " مطالعه</span>" +
        '<span class="blog-read">ادامه مطلب ' +
        arrowChar +
        "</span>" +
        "</div>" +
        "</div>" +
        "</a>";
    }

    const cardHTML = (p, index) =>
      '<a href="blog-post.html?id=' +
      encodeURIComponent(p.id) +
      '" class="blog-card reveal" style="--d:' +
      (index * 0.07).toFixed(2) +
      's" data-cat="' +
      p.category +
      '">' +
      '<div class="blog-thumb">' +
      (blogIcons[p.icon] || blogIcons.box) +
      "</div>" +
      '<div class="blog-body">' +
      '<p class="blog-cat">' +
      p.categoryLabel +
      "</p>" +
      "<h3>" +
      p.title +
      "</h3>" +
      "<p>" +
      p.excerpt +
      "</p>" +
      '<div class="blog-meta">' +
      "<span>" +
      p.date +
      "</span>" +
      '<span class="blog-read">ادامه مطلب ' +
      arrowChar +
      "</span>" +
      "</div>" +
      "</div>" +
      "</a>";

    let html = "";
    order.forEach((cat) => {
      const g = groups[cat];
      html += '<div class="blog-group" id="cat-' + cat + '">';
      html +=
        '<div class="blog-group-head reveal"><h2>' +
        g.label +
        '</h2><span class="count">' +
        g.items.length.toLocaleString("fa-IR") +
        " مطلب</span></div>";
      html += '<div class="blog-grid">';
      g.items.forEach((p, i) => {
        html += cardHTML(p, i);
      });
      html += "</div></div>";
    });
    blogGridRoot.innerHTML = html;

    const freshReveals = document.querySelectorAll(
      "#blogFeatured .reveal, #blogListing .reveal",
    );
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
