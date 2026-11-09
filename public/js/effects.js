(() => {
    const $ = (s, r = document) => r.querySelector(s);
    const $$ = (s, r = document) => [...r.querySelectorAll(s)];
    const reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;
    const hover = matchMedia("(hover: hover)").matches;

    // ---------- Efek ketik ----------
    const typed = $("#typed");
    if (typed && !reduce) {
        let words = [];
        try {
            words = JSON.parse(typed.dataset.words || "[]");
        } catch (e) {}
        let w = 0,
            c = 0,
            del = false;
        const loop = () => {
            const word = words[w];
            typed.textContent = word.slice(0, c);
            if (!del && c === word.length) {
                del = true;
                return setTimeout(loop, 1600);
            }
            if (del && c === 0) {
                del = false;
                w = (w + 1) % words.length;
            }
            c += del ? -1 : 1;
            setTimeout(loop, del ? 35 : 75);
        };
        if (words.length) loop();
    } else if (typed) {
        try {
            typed.textContent = JSON.parse(typed.dataset.words)[0] || "";
        } catch (e) {}
    }

    // ---------- Angka statistik menghitung naik ----------
    const counters = $$(".stats dt").filter((el) =>
        /^\d+/.test(el.textContent.trim()),
    );
    const cio = new IntersectionObserver(
        (entries) => {
            entries.forEach((e) => {
                if (!e.isIntersecting) return;
                const el = e.target,
                    m = el.textContent.trim().match(/^(\d+)(.*)$/);
                cio.unobserve(el);
                if (reduce || !m) return;
                const end = +m[1],
                    suffix = m[2],
                    t0 = performance.now();
                const tick = (t) => {
                    const k = Math.min((t - t0) / 1400, 1);
                    el.textContent =
                        Math.round(end * (1 - Math.pow(1 - k, 3))) + suffix;
                    if (k < 1) requestAnimationFrame(tick);
                };
                requestAnimationFrame(tick);
            });
        },
        { threshold: 0.6 },
    );
    counters.forEach((el) => cio.observe(el));

    // ---------- Ikon skill muncul bergantian ----------
    $$(".skills li").forEach((li, i) => li.style.setProperty("--i", i));

    // ---------- Cahaya sorot + tilt (perangkat dengan mouse) ----------
    if (hover) {
        document.addEventListener(
            "pointermove",
            (e) => {
                const t =
                    e.target.closest &&
                    e.target.closest(".panel, .pcard, .skills li");
                if (!t) return;
                const r = t.getBoundingClientRect();
                t.style.setProperty("--mx", e.clientX - r.left + "px");
                t.style.setProperty("--my", e.clientY - r.top + "px");
            },
            { passive: true },
        );

        if (!reduce) {
            $$(".avatar").forEach((el) => {
                el.addEventListener("pointermove", (e) => {
                    const r = el.getBoundingClientRect();
                    const x = (e.clientX - r.left) / r.width - 0.5,
                        y = (e.clientY - r.top) / r.height - 0.5;
                    el.style.transform = `perspective(800px) rotateY(${x * 10}deg) rotateX(${-y * 10}deg) scale(1.02)`;
                });
                el.addEventListener("pointerleave", () => {
                    el.style.transform = "";
                });
            });
        }
    }

    // ---------- Partikel jaringan ----------
    const cv = $("#bg");
    if (!cv || reduce) return;
    const ctx = cv.getContext("2d");
    let W = 0,
        H = 0,
        dpr = 1,
        pts = [],
        raf = 0;
    const mouse = { x: -9999, y: -9999 };

    const resize = () => {
        dpr = Math.min(window.devicePixelRatio || 1, 2);
        W = innerWidth;
        H = innerHeight;
        cv.width = W * dpr;
        cv.height = H * dpr;
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        const n = Math.min(
            innerWidth < 700 ? 28 : 65,
            Math.floor((W * H) / 22000),
        );
        pts = Array.from({ length: n }, () => ({
            x: Math.random() * W,
            y: Math.random() * H,
            vx: (Math.random() - 0.5) * 0.3,
            vy: (Math.random() - 0.5) * 0.3,
            r: Math.random() * 1.2 + 0.6,
        }));
    };

    const frame = () => {
        ctx.clearRect(0, 0, W, H);
        for (const p of pts) {
            p.x += p.vx;
            p.y += p.vy;
            if (p.x < 0 || p.x > W) p.vx *= -1;
            if (p.y < 0 || p.y > H) p.vy *= -1;
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.r, 0, 6.2832);
            ctx.fillStyle = "rgba(198,255,77,.55)";
            ctx.fill();
        }
        const max = 130;
        for (let i = 0; i < pts.length; i++) {
            for (let j = i + 1; j < pts.length; j++) {
                const dx = pts[i].x - pts[j].x,
                    dy = pts[i].y - pts[j].y,
                    d = Math.hypot(dx, dy);
                if (d < max) {
                    ctx.strokeStyle = `rgba(198,255,77,${(1 - d / max) * 0.16})`;
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    ctx.moveTo(pts[i].x, pts[i].y);
                    ctx.lineTo(pts[j].x, pts[j].y);
                    ctx.stroke();
                }
            }
            const mx = pts[i].x - mouse.x,
                my = pts[i].y - mouse.y,
                md = Math.hypot(mx, my);
            if (md < 170) {
                ctx.strokeStyle = `rgba(198,255,77,${(1 - md / 170) * 0.4})`;
                ctx.beginPath();
                ctx.moveTo(pts[i].x, pts[i].y);
                ctx.lineTo(mouse.x, mouse.y);
                ctx.stroke();
                pts[i].x += mx * 0.0009;
                pts[i].y += my * 0.0009;
            }
        }
        raf = requestAnimationFrame(frame);
    };

    resize();
    frame();
    let rt;
    addEventListener("resize", () => {
        clearTimeout(rt);
        rt = setTimeout(resize, 200);
    });
    addEventListener(
        "pointermove",
        (e) => {
            mouse.x = e.clientX;
            mouse.y = e.clientY;
        },
        { passive: true },
    );
    addEventListener("pointerleave", () => {
        mouse.x = mouse.y = -9999;
    });
    // Hemat baterai: berhenti saat tab tidak aktif
    document.addEventListener("visibilitychange", () => {
        if (document.hidden) cancelAnimationFrame(raf);
        else frame();
    });
})();
