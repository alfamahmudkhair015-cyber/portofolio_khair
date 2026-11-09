<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Home') | {{ config('app.name') }}</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 0; background: #0f172a; color: #e2e8f0; }
        nav { display: flex; gap: 1rem; padding: 1rem 2rem; border-bottom: 1px solid #1e293b; }
        nav a { color: #94a3b8; text-decoration: none; }
        nav a.active { color: #38bdf8; font-weight: 600; }
        main { max-width: 42rem; margin: 3rem auto; padding: 0 1.5rem; }
        h1 { margin-top: 0; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a>
        <a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>About</a>
        <a href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>Contact</a>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>
