(function () {
  "use strict";

  const reduceMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
  ).matches;

  /* ---------- generate floating particles ---------- */
  const particleField = document.getElementById("introParticles");
  if (particleField && !reduceMotion) {
    const count = window.innerWidth < 640 ? 16 : 30;
    for (let i = 0; i < count; i++) {
      const p = document.createElement("span");
      p.className = "intro-particle";
      const size = 2 + Math.random() * 3;
      p.style.width = size + "px";
      p.style.height = size + "px";
      p.style.left = Math.random() * 100 + "%";
      p.style.bottom = "-5%";
      p.style.animationDuration = 9 + Math.random() * 10 + "s";
      p.style.animationDelay = Math.random() * 10 + "s";
      particleField.appendChild(p);
    }
  }

  /* ---------- preloader progress ---------- */
  const loader = document.getElementById("introLoader");
  const loaderBar = document.getElementById("introLoaderBar");
  const loaderPct = document.getElementById("introLoaderPct");
  const stage = document.getElementById("introStage");
  const CIRCUMFERENCE = 226; // matches stroke-dasharray in CSS

  function revealContent() {
    if (loader) loader.classList.add("hidden");
    if (stage) stage.classList.add("is-in");
  }

  if (loader && loaderBar && loaderPct) {
    let progress = 0;
    const duration = reduceMotion ? 200 : 1500;
    const start = performance.now();

    function tick(now) {
      const elapsed = now - start;
      progress = Math.min(1, elapsed / duration);
      const eased = 1 - Math.pow(1 - progress, 3);
      loaderBar.style.strokeDashoffset = String(
        CIRCUMFERENCE * (1 - eased),
      );
      loaderPct.textContent =
        Math.round(eased * 100).toLocaleString("fa-IR") + "%";
      if (progress < 1) {
        requestAnimationFrame(tick);
      } else {
        setTimeout(revealContent, 150);
      }
    }
    requestAnimationFrame(tick);
  } else {
    revealContent();
  }

  /* ---------- mouse parallax on floating shapes ---------- */
  const shapes = document.querySelectorAll(".intro-shape");
  const bg = document.getElementById("introBg");
  if (shapes.length && !reduceMotion && window.matchMedia("(hover: hover)").matches) {
    window.addEventListener("mousemove", (e) => {
      const px = e.clientX / window.innerWidth - 0.5;
      const py = e.clientY / window.innerHeight - 0.5;
      shapes.forEach((shape, i) => {
        const depth = ((i % 3) + 1) * 10;
        shape.style.transform =
          "translate(" + px * depth + "px," + py * depth + "px)";
      });
      if (bg) {
        bg.style.transform =
          "translate(" + px * 12 + "px," + py * 12 + "px)";
      }
    });
  }

  /* ---------- enter site ---------- */
  const enterBtn = document.getElementById("introEnterBtn");
  const wash = document.getElementById("introWash");
  if (enterBtn) {
    enterBtn.addEventListener("click", () => {
      const dest = enterBtn.getAttribute("data-href") || "index.html";
      if (stage) stage.classList.add("is-leaving");
      if (wash) wash.classList.add("show");
      window.setTimeout(
        () => {
          window.location.href = dest;
        },
        reduceMotion ? 80 : 750,
      );
    });
  }
})();
