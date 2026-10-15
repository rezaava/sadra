(function () {
    "use strict";

    const toggleBtn = document.getElementById("loginTogglePass");
    const passInput = document.getElementById("loginPassword");
    const eyeOpen = document.getElementById("eyeOpen");
    const eyeClosed = document.getElementById("eyeClosed");

    if (toggleBtn && passInput) {
        toggleBtn.addEventListener("click", function () {
            const isPassword = passInput.type === "password";

            passInput.type = isPassword ? "text" : "password";

            toggleBtn.setAttribute(
                "aria-label",
                isPassword
                    ? "پنهان کردن رمز عبور"
                    : "نمایش رمز عبور"
            );

            if (eyeOpen && eyeClosed) {
                eyeOpen.style.display = isPassword ? "none" : "block";
                eyeClosed.style.display = isPassword ? "block" : "none";
            }
        });
    }

    const form = document.getElementById("loginForm");

    if (!form) {
        return;
    }

    const gmailInput = document.getElementById("loginGmail");
    const passwordInput = document.getElementById("loginPassword");
    const errorBanner = document.getElementById("loginErrorBanner");

    const requiredFields = form.querySelectorAll("[required]");

    function validateField(field) {
        const wrap = field.closest(".login-field");

        if (!wrap) {
            return true;
        }

        const valid = field.checkValidity();

        wrap.classList.toggle("invalid", !valid);

        return valid;
    }

    requiredFields.forEach(function (field) {
        field.addEventListener("blur", function () {
            validateField(field);
        });

        field.addEventListener("input", function () {
            if (
                field.closest(".login-field") &&
                field.closest(".login-field").classList.contains("invalid")
            ) {
                validateField(field);
            }

            if (errorBanner) {
                errorBanner.classList.remove("show");
            }
        });
    });

    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        let allValid = true;

        requiredFields.forEach(function (field) {
            if (!validateField(field)) {
                allValid = false;
            }
        });

        if (!allValid) {
            return;
        }

        const button = form.querySelector(".login-submit-btn");
        const label = button ? button.querySelector(".label") : null;
        const spinner = button ? button.querySelector(".spinner") : null;

        const gmail = gmailInput.value.trim();
        const password = passwordInput.value;
        const remember = form.querySelector('[name="remember"]')?.checked || false;

        if (button) {
            button.disabled = true;
            button.classList.add("loading");
        }

        if (label) {
            label.textContent = "در حال ورود...";
        }

        if (spinner) {
            spinner.style.display = "inline-block";
        }

        if (errorBanner) {
            errorBanner.classList.remove("show");
        }

        try {
          const response = await fetch("/login", {
              method: "POST",
              headers: {
                  "Content-Type": "application/json",
                  "Accept": "application/json",
                  "X-CSRF-TOKEN": document
                      .querySelector('meta[name="csrf-token"]')
                      .getAttribute("content")
              },
              body: JSON.stringify({
                  gmail: gmail,
                  password: password,
                  remember: remember
              })
          });

            const data = await response.json();

            if (!response.ok) {
                if (errorBanner) {
                    const errorText = errorBanner.querySelector("span");

                    if (errorText) {
                        errorText.textContent =
                            data.message ||
                            "جیمیل یا رمز عبور اشتباه است.";
                    }

                    errorBanner.classList.add("show");
                }

                return;
            }

            if (data.redirect) {
                window.location.href = data.redirect;
                return;
            }

            window.location.href = "{{ route('admin.dashboard') }}";

        } catch (error) {
            console.error("Login error:", error);

            if (errorBanner) {
                const errorText = errorBanner.querySelector("span");

                if (errorText) {
                    errorText.textContent =
                        "خطایی در ارتباط با سرور رخ داد.";
                }

                errorBanner.classList.add("show");
            }

        } finally {
            if (button) {
                button.disabled = false;
                button.classList.remove("loading");
            }

            if (label) {
                label.textContent = "ورود";
            }

            if (spinner) {
                spinner.style.display = "none";
            }
        }
    });
})();