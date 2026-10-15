@php
    $c = config('portfolio');
    $hasCv = !empty($c['cv']) && file_exists(public_path($c['cv']));
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $c['full_name'] . ' | Informatics Student & Developer')</title>
    <meta name="description" content="Portofolio {{ $c['full_name'] }}, mahasiswa Informatika {{ $c['campus'] }}. Membangun aplikasi mobile, website, dan game.">
    <meta name="theme-color" content="#070908">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $c['full_name'] }} | Developer Portofolio">
    <meta property="og:description" content="Curious by nature. Built through code.">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ asset($c['photo']) }}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&family=Caveat:wght@600&family=Unbounded:wght@600;700&display=swap" rel="stylesheet">
    <script>document.documentElement.classList.add('js');</script>
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/effects.css') }}">
</head>
<body>
    <canvas id="bg" aria-hidden="true"></canvas>
    <div class="aurora" aria-hidden="true"><i></i><i></i><i></i></div>

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
    <symbol id="i-arrow" viewBox="0 0 24 24"><path d="M7 17L17 7M7 7h10v10"/></symbol>
    <symbol id="i-arrow-r" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></symbol>
    <symbol id="i-up" viewBox="0 0 24 24"><path d="M12 19V5M5 12l7-7 7 7"/></symbol>
    <symbol id="i-down" viewBox="0 0 24 24"><path d="M12 5v14M19 12l-7 7-7-7"/></symbol>
    <symbol id="i-copy" viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></symbol>
    <symbol id="i-check" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></symbol>
    <symbol id="i-mail" viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22 6 12 13 2 6"/></symbol>
    <symbol id="i-pin" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></symbol>
    <symbol id="i-phone" viewBox="0 0 24 24"><path d="M21 11.5a8.4 8.4 0 0 1-12.4 7.4L3 20.5l1.6-5.4A8.4 8.4 0 1 1 21 11.5z"/></symbol>
    <symbol id="i-send" viewBox="0 0 24 24"><path d="M22 2 11 13M22 2l-7 20-4-9-9-4 20-7z"/></symbol>
    <symbol id="i-download" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></symbol>
    <symbol id="i-github" viewBox="0 0 24 24"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></symbol>
    <symbol id="i-linkedin" viewBox="0 0 24 24"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></symbol>
    <symbol id="i-instagram" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></symbol>
    <symbol id="i-youtube" viewBox="0 0 24 24"><path d="M22.5 6.4a2.5 2.5 0 0 0-1.8-1.8C19.1 4.2 12 4.2 12 4.2s-7.1 0-8.7.4A2.5 2.5 0 0 0 1.5 6.4 26 26 0 0 0 1.1 12c0 1.9.1 3.800.4 5.600a2.500 2.500 0 0 0 1.800 1.800c1.600.4 8.700.4 8.700.4s7.100 0 8.700-.4a2.500 2.500 0 0 0 1.800-1.800c.3-1.800.4-3.700.4-5.600s-.1-3.800-.4-5.600z"/><polygon points="9.8 15 15.2 12 9.8 9"/></symbol>
    <symbol id="i-spark" viewBox="0 0 24 24"><path d="M12 2c.6 5.400 4.600 9.400 10 10-5.400.6-9.400 4.600-10 10-.6-5.400-4.600-9.400-10-10 5.400-.6 9.400-4.600 10-10z"/></symbol>
</svg>

<div id="loader" aria-hidden="true"><span>{{ $c['name'] }}</span></div>
<div id="progress" aria-hidden="true"></div>
<a href="#main" class="skip">Lewati ke konten</a>

<header class="nav" id="nav">
    <div class="wrap nav__in">
        <a href="#home" class="logo" aria-label="{{ $c['name'] }} - kembali ke atas">{{ $c['name'] }}</a>

        <nav class="nav__links" id="menu" aria-label="Navigasi utama">
            <a href="#home" data-nav>Home</a>
            <a href="#about" data-nav>About</a>
            <a href="#projects" data-nav>Projects</a>
            <a href="#skills" data-nav>Skills</a>
            <a href="#experience" data-nav>Experience</a>
            <a href="#contact" data-nav>Contact</a>
            @if ($hasCv)
                <a href="{{ asset($c['cv']) }}" download class="nav__cv-m">Download CV</a>
            @endif
        </nav>

        <div class="nav__right">
            @if (!empty($c['github']))
                <a href="{{ $c['github'] }}" target="_blank" rel="noopener" class="round" aria-label="GitHub"><svg class="ico"><use href="#i-github"/></svg></a>
            @endif
            @if ($hasCv)
                <a href="{{ asset($c['cv']) }}" download class="btn btn--line btn--sm nav__cv">Download CV <svg class="ico"><use href="#i-download"/></svg></a>
            @endif
            <button class="burger" id="burger" aria-label="Buka menu" aria-expanded="false" aria-controls="menu"><span></span><span></span></button>
        </div>
    </div>
</header>

<main id="main">
    @yield('content')
</main>

<footer class="footer">
    <div class="wrap footer__in">
        <a href="#home" class="logo">{{ $c['name'] }}</a>
        <p>Designed with passion. Built with code. &copy; {{ date('Y') }} {{ $c['full_name'] }}</p>
        <div class="footer__social">
            @foreach (['github' => 'GitHub', 'instagram' => 'Instagram', 'linkedin' => 'LinkedIn', 'youtube' => 'YouTube'] as $k => $label)
                @if (!empty($c[$k]))
                    <a href="{{ $c[$k] }}" target="_blank" rel="noopener" class="round" aria-label="{{ $label }}"><svg class="ico"><use href="#i-{{ $k }}"/></svg></a>
                @endif
            @endforeach
            <a href="#home" class="round round--lime" aria-label="Ke atas"><svg class="ico"><use href="#i-up"/></svg></a>
        </div>
    </div>
</footer>

<script src="{{ asset('js/portfolio.js') }}" defer></script>
<script src="{{ asset('js/effects.js') }}" defer></script>
</body>
</html>