@php $p = config('profile'); @endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $p['role']) | {{ $p['name'] }}</title>
    <meta name="description" content="@yield('description', $p['tagline'])">
    <meta property="og:title" content="{{ $p['name'] }} - {{ $p['role'] }}">
    <meta property="og:description" content="{{ $p['tagline'] }}">
    <meta property="og:image" content="{{ asset($p['photo']) }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        try { if (localStorage.getItem('theme') === 'light') document.documentElement.classList.add('light'); } catch (e) {}
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                fontFamily: { sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'] },
                colors: {
                    bg:      'rgb(var(--bg) / <alpha-value>)',
                    surface: 'rgb(var(--surface) / <alpha-value>)',
                    line:    'rgb(var(--line) / <alpha-value>)',
                    ink:     'rgb(var(--text) / <alpha-value>)',
                    muted:   'rgb(var(--muted) / <alpha-value>)',
                    accent:  'rgb(var(--accent) / <alpha-value>)',
                    link:    'rgb(var(--link) / <alpha-value>)',
                },
            } },
        };
    </script>

    <style>
        /* Ganti 2 baris --accent dan --link untuk mengubah warna utama.
           Contoh hijau: dark  --accent: 16 185 129; --link: 110 231 183;
                         light --accent: 5 150 105;  --link: 4 120 87; */
        :root {
            --bg: 10 12 18; --surface: 17 20 29; --line: 36 41 56;
            --text: 236 238 244; --muted: 139 147 165;
            --accent: 99 102 241; --link: 165 180 252;
        }
        html.light {
            --bg: 247 248 251; --surface: 255 255 255; --line: 226 229 238;
            --text: 15 18 28; --muted: 96 104 122;
            --accent: 79 70 229; --link: 67 56 202;
        }
        body { transition: background-color .3s, color .3s; }
        ::selection { background: rgb(var(--accent) / .3); }

        /* Komponen dasar */
        .eyebrow { font-size: .75rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; color: rgb(var(--link)); }
        .h2 { font-size: clamp(1.75rem, 3vw, 2.25rem); font-weight: 800; letter-spacing: -.02em; margin-top: .5rem; line-height: 1.2; }
        .section { margin-top: 6.5rem; }
        .card { background: rgb(var(--surface)); border: 1px solid rgb(var(--line)); border-radius: 1rem; }
        .chip { font-size: .75rem; font-weight: 500; border: 1px solid rgb(var(--line)); color: rgb(var(--muted)); padding: .25rem .625rem; border-radius: 9999px; background: rgb(var(--bg) / .5); }

        .btn { display: inline-flex; align-items: center; justify-content: center; gap: .5rem; padding: .7rem 1.25rem; border-radius: .75rem; font-size: .875rem; font-weight: 600; transition: transform .2s, box-shadow .2s, border-color .2s, background-color .2s; }
        .btn-primary { background: rgb(var(--accent)); color: #fff; box-shadow: 0 10px 25px -12px rgb(var(--accent) / .8); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 14px 28px -12px rgb(var(--accent) / .9); }
        .btn-ghost { border: 1px solid rgb(var(--line)); background: rgb(var(--surface)); }
        .btn-ghost:hover { border-color: rgb(var(--accent)); }

        /* Hover kartu + reveal digabung supaya tidak bentrok */
        .reveal, .card-hover { transition: opacity .7s ease, translate .7s ease, transform .25s ease, border-color .25s, box-shadow .25s; }
        .reveal { opacity: 0; translate: 0 24px; }
        .reveal.show { opacity: 1; translate: 0 0; }
        .card-hover:hover { transform: translateY(-4px); border-color: rgb(var(--accent) / .55); box-shadow: 0 18px 40px -22px rgb(var(--accent) / .55); }

        /* Latar */
        .grid-bg {
            background-image:
                linear-gradient(rgb(var(--line) / .7) 1px, transparent 1px),
                linear-gradient(90deg, rgb(var(--line) / .7) 1px, transparent 1px);
            background-size: 44px 44px;
            -webkit-mask-image: radial-gradient(ellipse at top, #000 20%, transparent 70%);
                    mask-image: radial-gradient(ellipse at top, #000 20%, transparent 70%);
        }
        .text-gradient { background-image: linear-gradient(90deg, rgb(var(--link)), #38bdf8); -webkit-background-clip: text; background-clip: text; color: transparent; }

        /* Navbar */
        #nav.is-scrolled { background: rgb(var(--bg) / .82); backdrop-filter: blur(14px); border-bottom: 1px solid rgb(var(--line)); }
        .nav-link { position: relative; padding: .5rem 0; color: rgb(var(--muted)); transition: color .2s; }
        .nav-link:hover, .nav-link.active { color: rgb(var(--text)); }
        .nav-link.active::after { content: ''; position: absolute; left: 0; right: 0; bottom: -2px; height: 2px; border-radius: 2px; background: rgb(var(--accent)); }
        .light .i-sun { display: none; } html:not(.light) .i-moon { display: none; }

        /* Efek ketik & skill bar */
        .caret { display: inline-block; width: 2px; height: 1.05em; background: rgb(var(--link)); margin-left: 2px; vertical-align: -0.15em; animation: blink 1s steps(1) infinite; }
        @keyframes blink { 50% { opacity: 0; } }
        .bar { width: 0; transition: width 1.1s cubic-bezier(.2,.8,.2,1); }
        .float { animation: float 5s ease-in-out infinite; }
        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; transition: none !important; }
            .reveal { opacity: 1; translate: 0 0; }
            .bar { width: var(--w) !important; }
        }
    </style>
</head>
<body class="bg-bg text-ink font-sans antialiased">

    <div id="progress" class="fixed top-0 left-0 h-0.5 bg-accent z-[60]" style="width:0"></div>

    <header id="nav" class="fixed top-0 inset-x-0 z-50 transition-all duration-300">
        <nav class="max-w-6xl mx-auto px-6 h-[4.5rem] flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 font-bold">
                <span class="w-9 h-9 grid place-items-center rounded-lg bg-accent text-white text-sm">{{ mb_substr($p['short'], 0, 1) }}</span>
                <span class="hidden sm:block">{{ $p['name'] }}</span>
            </a>

            @php $links = ['home' => 'Beranda', 'about' => 'Tentang', 'projects' => 'Proyek', 'contact' => 'Kontak']; @endphp

            <ul class="hidden md:flex items-center gap-8 text-sm font-medium">
                @foreach ($links as $route => $label)
                    <li><a href="{{ route($route) }}" class="nav-link {{ request()->routeIs($route.'*') ? 'active' : '' }}">{{ $label }}</a></li>
                @endforeach
            </ul>

            <div class="flex items-center gap-2">
                <button id="theme-btn" aria-label="Ganti tema" class="w-10 h-10 grid place-items-center rounded-lg border border-line bg-surface hover:border-accent transition">
                    <svg class="i-sun w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
                    <svg class="i-moon w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 12.8A9 9 0 1111.2 3a7 7 0 009.8 9.8z"/></svg>
                </button>
                <a href="{{ route('contact') }}" class="btn btn-primary !py-2.5 hidden md:inline-flex">Hubungi Saya</a>
                <button id="menu-btn" aria-label="Menu" class="md:hidden w-10 h-10 grid place-items-center rounded-lg border border-line bg-surface">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </nav>

        <ul id="mobile-menu" class="hidden md:hidden mx-6 mb-3 card p-2 text-sm font-medium shadow-xl">
            @foreach ($links as $route => $label)
                <li><a href="{{ route($route) }}" class="block px-4 py-3 rounded-lg {{ request()->routeIs($route.'*') ? 'bg-accent/10 text-link' : 'text-muted' }}">{{ $label }}</a></li>
            @endforeach
        </ul>
    </header>

    <main class="relative z-10 max-w-6xl mx-auto px-6 pt-32 pb-20">
        @yield('content')
    </main>

    <footer class="relative z-10 border-t border-line">
        <div class="max-w-6xl mx-auto px-6 py-12 grid md:grid-cols-3 gap-8 text-sm">
            <div>
                <div class="flex items-center gap-2.5 font-bold">
                    <span class="w-8 h-8 grid place-items-center rounded-lg bg-accent text-white text-sm">{{ mb_substr($p['short'], 0, 1) }}</span>
                    {{ $p['name'] }}
                </div>
                <p class="text-muted mt-3 max-w-xs leading-relaxed">{{ $p['role'] }}. {{ $p['location'] }}.</p>
            </div>
            <div>
                <p class="font-semibold mb-3">Navigasi</p>
                <ul class="space-y-2 text-muted">
                    @foreach ($links as $route => $label)
                        <li><a href="{{ route($route) }}" class="hover:text-ink transition">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <p class="font-semibold mb-3">Terhubung</p>
                <ul class="space-y-2 text-muted">
                    @if (!empty($p['email'])) <li><a href="mailto:{{ $p['email'] }}" class="hover:text-ink transition">{{ $p['email'] }}</a></li> @endif
                    @foreach (['github' => 'GitHub', 'linkedin' => 'LinkedIn', 'instagram' => 'Instagram', 'whatsapp' => 'WhatsApp'] as $key => $label)
                        @if (!empty($p[$key]))
                            <li><a href="{{ $p[$key] }}" target="_blank" rel="noopener" class="hover:text-ink transition">{{ $label }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="border-t border-line">
            <p class="max-w-6xl mx-auto px-6 py-5 text-xs text-muted">&copy; {{ date('Y') }} {{ $p['name'] }}. Dibuat dengan Laravel.</p>
        </div>
    </footer>

    <button id="to-top" aria-label="Ke atas"
            class="fixed bottom-6 right-6 z-50 w-11 h-11 rounded-full bg-accent text-white grid place-items-center shadow-lg opacity-0 pointer-events-none translate-y-4 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
    </button>

    <script>
    (() => {
        const $ = (s) => document.querySelector(s);
        const $$ = (s) => [...document.querySelectorAll(s)];

        // Tema
        $('#theme-btn').addEventListener('click', () => {
            const light = document.documentElement.classList.toggle('light');
            try { localStorage.setItem('theme', light ? 'light' : 'dark'); } catch (e) {}
        });
        $('#menu-btn').addEventListener('click', () => $('#mobile-menu').classList.toggle('hidden'));

        // Scroll
        const nav = $('#nav'), prog = $('#progress'), top = $('#to-top');
        const onScroll = () => {
            const y = scrollY, h = document.documentElement.scrollHeight - innerHeight;
            prog.style.width = (h > 0 ? (y / h) * 100 : 0) + '%';
            nav.classList.toggle('is-scrolled', y > 16);
            const show = y > 500;
            top.classList.toggle('opacity-0', !show);
            top.classList.toggle('pointer-events-none', !show);
            top.classList.toggle('translate-y-4', !show);
        };
        addEventListener('scroll', onScroll, { passive: true }); onScroll();
        top.addEventListener('click', () => scrollTo({ top: 0, behavior: 'smooth' }));

        // Reveal, counter, skill bar
        const count = (el) => {
            const end = +el.dataset.count, t0 = performance.now();
            const tick = (t) => {
                const k = Math.min((t - t0) / 1400, 1);
                el.textContent = Math.round(end * (1 - Math.pow(1 - k, 3)));
                if (k < 1) requestAnimationFrame(tick);
            };
            requestAnimationFrame(tick);
        };
        const io = new IntersectionObserver((entries) => {
            entries.forEach(({ target, isIntersecting }) => {
                if (!isIntersecting) return;
                target.classList.add('show');
                if (target.dataset.count) count(target);
                if (target.dataset.bar) target.style.width = target.dataset.bar + '%';
                setTimeout(() => target.style.transitionDelay = '', 1000);
                io.unobserve(target);
            });
        }, { threshold: .12 });
        $$('.reveal, [data-count], [data-bar]').forEach(el => io.observe(el));

        // Efek ketik
        const typed = $('#typed');
        if (typed) {
            const words = JSON.parse(typed.dataset.words || '[]');
            let w = 0, c = 0, del = false;
            const loop = () => {
                const word = words[w];
                typed.textContent = word.slice(0, c);
                if (!del && c === word.length) { del = true; return setTimeout(loop, 1500); }
                if (del && c === 0) { del = false; w = (w + 1) % words.length; }
                c += del ? -1 : 1;
                setTimeout(loop, del ? 40 : 80);
            };
            if (words.length) loop();
        }

        // Toast
        const toast = $('#toast');
        if (toast) setTimeout(() => { toast.style.opacity = 0; toast.style.transform = 'translateY(-8px)'; }, 5000);
    })();
    </script>

    @stack('scripts')
</body>
</html>