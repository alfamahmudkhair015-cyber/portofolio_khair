(() => {
    const $ = (s, r = document) => r.querySelector(s);
    const $$ = (s, r = document) => [...r.querySelectorAll(s)];

    // Theme system: Dark Mode / Light Mode
    const root = document.documentElement;
    const themeToggle = $("#theme-toggle");

    const getSavedTheme = () => {
        try {
            return localStorage.getItem("alfa-portfolio-theme");
        } catch (error) {
            return null;
        }
    };

    const applyTheme = (theme) => {
        const selectedTheme = theme === "light" ? "light" : "dark";

        root.setAttribute("data-theme", selectedTheme);

        if (themeToggle) {
            const isLight = selectedTheme === "light";

            themeToggle.setAttribute(
                "aria-label",
                isLight ? "Aktifkan mode gelap" : "Aktifkan mode terang"
            );

            themeToggle.setAttribute("aria-pressed", String(isLight));

            themeToggle.setAttribute(
                "title",
                isLight ? "Ganti ke Dark Mode" : "Ganti ke Light Mode"
            );
        }

        try {
            localStorage.setItem("alfa-portfolio-theme", selectedTheme);
        } catch (error) {
            // Tema tetap bisa digunakan meskipun penyimpanan tidak tersedia.
        }

        const themeColor = document.querySelector('meta[name="theme-color"]');

        if (themeColor) {
            themeColor.setAttribute(
                "content",
                selectedTheme === "light" ? "#f3f8ff" : "#050b18"
            );
        }
    };

    // Terapkan tema tersimpan
    applyTheme(getSavedTheme() || "dark");

    // Tombol pergantian tema
    if (themeToggle) {
        themeToggle.addEventListener("click", () => {
            const currentTheme = root.getAttribute("data-theme");
            applyTheme(currentTheme === "dark" ? "light" : "dark");
        });
    }


    // Loader
    const loader = $("#loader");
    window.addEventListener("load", () =>
        setTimeout(() => {
            if (loader)
                loader.style.cssText =
                    "opacity:0;visibility:hidden;transition:opacity .4s";
        }, 200),
    );

    // Reveal saat masuk viewport
    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach((e) => {
                if (e.isIntersecting) {
                    e.target.classList.add("show");
                    io.unobserve(e.target);
                }
            });
        },
        { threshold: 0.1, rootMargin: "0px 0px -4% 0px" },
    );
    $$(".reveal").forEach((el) => io.observe(el));

    // Navbar + progress bar
    const nav = $("#nav"),
        bar = $("#progress");
    let ticking = false;
    const onScroll = () => {
        const y = window.scrollY;
        const max = document.documentElement.scrollHeight - innerHeight;
        bar.style.width = (max > 0 ? (y / max) * 100 : 0) + "%";
        nav.classList.toggle("is-scrolled", y > 16);
        ticking = false;
    };
    addEventListener(
        "scroll",
        () => {
            if (!ticking) {
                ticking = true;
                requestAnimationFrame(onScroll);
            }
        },
        { passive: true },
    );
    onScroll();

    // Menu mobile
    const burger = $("#burger"),
        menu = $("#menu");
    const setMenu = (open) => {
        burger.setAttribute("aria-expanded", open);
        burger.setAttribute("aria-label", open ? "Tutup menu" : "Buka menu");
        menu.classList.toggle("open", open);
        document.body.style.overflow = open ? "hidden" : "";
    };
    burger.addEventListener("click", () =>
        setMenu(burger.getAttribute("aria-expanded") !== "true"),
    );
    $$("a", menu).forEach((a) =>
        a.addEventListener("click", () => setMenu(false)),
    );
    addEventListener("keydown", (e) => {
        if (e.key === "Escape") setMenu(false);
    });
    addEventListener("resize", () => {
        if (innerWidth > 820) setMenu(false);
    });

    // Navigasi aktif
    const links = $$("[data-nav]");
    const sections = links
        .map((a) => $(a.getAttribute("href")))
        .filter(Boolean);
    const spy = new IntersectionObserver(
        (entries) => {
            entries.forEach((e) => {
                if (!e.isIntersecting) return;
                links.forEach((a) =>
                    a.classList.toggle(
                        "active",
                        a.getAttribute("href") === "#" + e.target.id,
                    ),
                );
            });
        },
        { rootMargin: "-45% 0px -50% 0px" },
    );
    sections.forEach((s) => spy.observe(s));

    // Copy email
    const btn = $("#copy-email");
    if (btn) {
        const use = $("use", btn),
            status = $("#copy-status");
        const done = (ok) => {
            use.setAttribute("href", ok ? "#i-check" : "#i-copy");
            btn.classList.toggle("done", ok);
            status.textContent = ok
                ? "Email berhasil disalin"
                : "Email gagal disalin";
            setTimeout(() => {
                use.setAttribute("href", "#i-copy");
                btn.classList.remove("done");
                status.textContent = "";
            }, 2200);
        };
        btn.addEventListener("click", async () => {
            const text = btn.dataset.email;
            try {
                await navigator.clipboard.writeText(text);
                done(true);
            } catch (e) {
                const t = document.createElement("textarea");
                t.value = text;
                t.style.cssText = "position:fixed;opacity:0";
                document.body.appendChild(t);
                t.select();
                let ok = false;
                try {
                    ok = document.execCommand("copy");
                } catch (_) { }
                t.remove();
                done(ok);
            }
        });
    }

    // Form: status kirim + kembali ke bagian Contact setelah submit/error
    const form = $("#contact-form");
    if (form) {
        form.addEventListener("submit", () => {
            const b = $("#send-btn");
            b.disabled = true;
            b.firstChild.textContent = "Sending... ";
        });
    }
    const contact = $("#contact");
    if (contact && contact.dataset.focus === "1") {
        contact.scrollIntoView({ block: "start" });
    }
})();
