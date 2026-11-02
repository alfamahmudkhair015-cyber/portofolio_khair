(() => {
    const hero = document.querySelector(".hx");
    if (!hero) return;
    const reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;
    const fine = matchMedia("(hover: hover) and (pointer: fine)").matches;
    const $$ = (s, r = hero) => [...r.querySelectorAll(s)];
    const g = window.gsap;

    // ---------- Animasi masuk (GSAP) ----------
    const intro = () => {
        if (!g || reduce) return;
        if (window.ScrollTrigger) g.registerPlugin(ScrollTrigger);
        const tl = g.timeline({ defaults: { ease: "power3.out" } });
        tl.from(".nav", { y: -28, opacity: 0, duration: 0.8 })
            .from(
                ".hx-chip, .hx .hello",
                { y: 14, opacity: 0, stagger: 0.1, duration: 0.6 },
                0.15,
            )
            .from(
                ".hx-line",
                {
                    y: 26,
                    opacity: 0,
                    filter: "blur(14px)",
                    stagger: 0.15,
                    duration: 1,
                },
                0.25,
            )
            .from(
                ".hx-in",
                { y: 18, opacity: 0, stagger: 0.12, duration: 0.7 },
                0.8,
            )
            .from(".hx .avatar", { opacity: 0, scale: 1.1, duration: 1.3 }, 0.3)
            .from(
                ".hx-pos",
                {
                    y: 36,
                    opacity: 0,
                    scale: 0.92,
                    stagger: 0.18,
                    duration: 0.9,
                },
                0.9,
            );
        if (window.ScrollTrigger)
            g.to(".hx-orb", {
                yPercent: 18,
                ease: "none",
                scrollTrigger: {
                    trigger: hero,
                    start: "top top",
                    end: "bottom top",
                    scrub: true,
                },
            });
    };
    window.addEventListener("load", intro);

    // ---------- Partikel latar ----------
    const cv = document.getElementById("hx-particles");
    const ctx = cv && cv.getContext("2d");
    let pts = [],
        W = 0,
        H = 0,
        run = true,
        px = 0,
        py = 0;
    const size = () => {
        const d = Math.min(devicePixelRatio || 1, 2);
        W = cv.clientWidth;
        H = cv.clientHeight;
        cv.width = W * d;
        cv.height = H * d;
        ctx.setTransform(d, 0, 0, d, 0, 0);
        pts = Array.from({ length: Math.round(Math.min(70, W / 22)) }, () => {
            const z = 0.3 + Math.random() * 0.9;
            return {
                x: Math.random() * W,
                y: Math.random() * H,
                z,
                r: z * 1.6,
                vx: (Math.random() - 0.5) * 0.2 * z,
                vy: -0.08 - Math.random() * 0.25 * z,
            };
        });
    };
    const draw = () => {
        if (run) {
            ctx.clearRect(0, 0, W, H);
            for (const p of pts) {
                if (!reduce) {
                    p.x += p.vx;
                    p.y += p.vy;
                }
                if (p.y < -5) {
                    p.y = H + 5;
                    p.x = Math.random() * W;
                }
                const x = p.x + px * p.z * 30,
                    y = p.y + py * p.z * 30;
                ctx.beginPath();
                ctx.arc(x, y, p.r, 0, 6.283);
                ctx.fillStyle = `rgba(110,190,255,${0.25 + p.z * 0.45})`;
                ctx.shadowColor = "#3b9eff";
                ctx.shadowBlur = 8;
                ctx.fill();
            }
        }
        if (!reduce) requestAnimationFrame(draw);
    };
    if (ctx) {
        size();
        draw();
        addEventListener("resize", size);
        new IntersectionObserver(([e]) => (run = e.isIntersecting)).observe(
            hero,
        );
        document.addEventListener(
            "visibilitychange",
            () => (run = !document.hidden),
        );
    }

    // ---------- Ripple klik (semua perangkat) ----------
    $$(".hx-mag", document).forEach((b) =>
        b.addEventListener("pointerdown", (e) => {
            const r = b.getBoundingClientRect(),
                s = Math.max(r.width, r.height) * 2;
            const i = document.createElement("i");
            i.className = "hx-ripple";
            i.style.cssText = `width:${s}px;height:${s}px;left:${e.clientX - r.left - s / 2}px;top:${e.clientY - r.top - s / 2}px`;
            b.appendChild(i);
            setTimeout(() => i.remove(), 700);
        }),
    );

    if (!fine || reduce) return; // efek kursor: hanya mouse & tanpa reduced-motion

    // ---------- Spotlight + parallax ----------
    const layers = $$("[data-depth]");
    hero.addEventListener("pointermove", (e) => {
        const r = hero.getBoundingClientRect();
        hero.style.setProperty("--mx", e.clientX - r.left + "px");
        hero.style.setProperty("--my", e.clientY - r.top + "px");
        px = (e.clientX - r.left) / r.width - 0.5;
        py = (e.clientY - r.top) / r.height - 0.5;
        layers.forEach((l) => {
            const d = +l.dataset.depth;
            l.style.translate = `${-px * d}px ${-py * d}px`;
        });
    });

    // ---------- Tilt 3D ----------
    $$("[data-tilt]").forEach((c) => {
        c.addEventListener("pointermove", (e) => {
            const r = c.getBoundingClientRect();
            c.style.setProperty(
                "--ry",
                ((e.clientX - r.left) / r.width - 0.5) * 18 + "deg",
            );
            c.style.setProperty(
                "--rx",
                (0.5 - (e.clientY - r.top) / r.height) * 18 + "deg",
            );
        });
        c.addEventListener("pointerleave", () => {
            c.style.setProperty("--rx", "0deg");
            c.style.setProperty("--ry", "0deg");
        });
    });

    // ---------- Tombol magnetik ----------
    $$(".hx-mag", document).forEach((b) => {
        b.addEventListener("pointermove", (e) => {
            const r = b.getBoundingClientRect();
            b.style.transform = `translate(${(e.clientX - r.left - r.width / 2) * 0.25}px,${(e.clientY - r.top - r.height / 2) * 0.35}px)`;
        });
        b.addEventListener("pointerleave", () => (b.style.transform = ""));
    });

    // ---------- Jejak kursor ----------
    const t = document.createElement("canvas");
    t.id = "hx-trail";
    t.style.cssText = "position:fixed;inset:0;pointer-events:none;z-index:60";
    document.body.appendChild(t);
    const tc = t.getContext("2d");
    let trail = [];
    const ts = () => {
        t.width = innerWidth;
        t.height = innerHeight;
    };
    ts();
    addEventListener("resize", ts);
    addEventListener(
        "pointermove",
        (e) => {
            for (let i = 0; i < 2; i++)
                trail.push({
                    x: e.clientX,
                    y: e.clientY,
                    vx: (Math.random() - 0.5) * 0.8,
                    vy: (Math.random() - 0.5) * 0.8,
                    l: 1,
                });
            if (trail.length > 120) trail.splice(0, trail.length - 120);
        },
        { passive: true },
    );
    (function loop() {
        tc.clearRect(0, 0, t.width, t.height);
        trail = trail.filter((p) => p.l > 0.02);
        for (const p of trail) {
            p.x += p.vx;
            p.y += p.vy;
            p.l *= 0.92;
            tc.beginPath();
            tc.arc(p.x, p.y, 3.2 * p.l + 0.4, 0, 6.283);
            tc.fillStyle = `rgba(90,185,255,${p.l * 0.7})`;
            tc.shadowColor = "#22e0ff";
            tc.shadowBlur = 12;
            tc.fill();
        }
        requestAnimationFrame(loop);
    })();
})();
