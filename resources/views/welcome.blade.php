<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} | Tailwind Setup</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 flex items-center justify-center p-6">
    <main class="max-w-xl w-full rounded-2xl border border-slate-800 bg-slate-900 p-8 shadow-xl">
        <p class="text-sm font-medium uppercase tracking-widest text-sky-400">Laravel + Tailwind CSS 4</p>
        <h1 class="mt-2 text-3xl font-bold">Tailwind sudah aktif</h1>
        <p class="mt-4 text-slate-400">
            Kalau halaman ini tampil dengan kartu gelap dan teks berwarna, berarti Vite dan Tailwind sudah terpasang dengan benar.
        </p>
        <a href="https://tailwindcss.com/docs" target="_blank" rel="noopener"
           class="mt-6 inline-block rounded-lg bg-sky-500 px-5 py-2.5 font-semibold text-slate-950 transition hover:bg-sky-400">
            Dokumentasi Tailwind
        </a>
    </main>
</body>
</html>
