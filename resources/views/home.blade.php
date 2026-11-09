@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    @php $p = config('profile'); @endphp

    {{-- HERO --}}
    <section class="relative">
        <div class="absolute inset-x-0 -top-32 -z-10 h-[36rem] overflow-hidden">
            <div class="grid-bg absolute inset-0 opacity-60"></div>
            <div class="absolute left-1/2 top-0 -translate-x-1/2 w-[52rem] h-72 rounded-full bg-accent/25 blur-3xl"></div>
        </div>

        <div class="grid lg:grid-cols-12 gap-14 items-center">
            <div class="lg:col-span-7 order-2 lg:order-1">
                <span class="reveal inline-flex items-center gap-2 text-xs font-medium border border-line bg-surface px-3.5 py-1.5 rounded-full">
                    <span class="relative flex w-2 h-2">
                        <span class="absolute inline-flex w-full h-full rounded-full bg-emerald-400 opacity-75 animate-ping"></span>
                        <span class="relative inline-flex w-2 h-2 rounded-full bg-emerald-500"></span>
                    </span>
                    {{ $p['status'] }}
                </span>

                <p class="reveal mt-7 text-lg text-muted" style="transition-delay:80ms">Halo, saya</p>
                <h1 class="reveal mt-1 text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.08]" style="transition-delay:140ms">
                    <span class="text-gradient">{{ $p['name'] }}</span>
                </h1>

                <p class="reveal mt-4 text-xl sm:text-2xl font-semibold" style="transition-delay:200ms">
                    <span id="typed" data-words="{{ json_encode($p['roles']) }}"></span><span class="caret"></span>
                </p>

                <p class="reveal mt-5 text-muted text-lg max-w-xl leading-relaxed" style="transition-delay:260ms">{{ $p['tagline'] }}</p>

                <div class="reveal flex flex-wrap items-center gap-3 mt-9" style="transition-delay:320ms">
                    <a href="{{ route('projects') }}" class="btn btn-primary">Lihat Proyek →</a>
                    <a href="{{ route('contact') }}" class="btn btn-ghost">Hubungi Saya</a>
                    @if (!empty($p['cv']))
                        <a href="{{ asset($p['cv']) }}" download class="btn btn-ghost">Unduh CV ↓</a>
                    @endif
                </div>

                <p class="reveal mt-8 text-sm text-muted" style="transition-delay:380ms">📍 {{ $p['location'] }}</p>
            </div>

            <div class="lg:col-span-5 order-1 lg:order-2 flex justify-center reveal" style="transition-delay:160ms">
                <div class="relative w-64 sm:w-72">
                    <div class="absolute inset-0 translate-x-3 translate-y-3 rounded-3xl border-2 border-accent/40"></div>
                    <img src="{{ asset($p['photo']) }}" alt="Foto {{ $p['name'] }}"
                         class="relative w-full aspect-[4/5] object-cover object-top rounded-3xl border border-line shadow-2xl">
                    <div class="float absolute -bottom-6 -left-6 card px-4 py-3 shadow-xl backdrop-blur">
                        <p class="text-xs text-muted">Mahasiswa</p>
                        <p class="text-sm font-bold">{{ $p['education'][0]['title'] }}</p>
                        <p class="text-xs text-link">{{ $p['education'][0]['place'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STATISTIK --}}
    <section class="reveal section">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-px bg-line border border-line rounded-2xl overflow-hidden">
            @foreach ($p['stats'] as $s)
                <div class="bg-surface px-6 py-8 text-center">
                    <p class="text-4xl font-extrabold tracking-tight"><span data-count="{{ $s['value'] }}">0</span><span class="text-link">{{ $s['suffix'] }}</span></p>
                    <p class="text-sm text-muted mt-1.5">{{ $s['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- LAYANAN --}}
    <section class="section">
        <div class="reveal max-w-xl">
            <p class="eyebrow">Layanan</p>
            <h2 class="h2">Apa yang bisa saya bantu</h2>
            <p class="text-muted mt-3">Dari merancang database sampai tampilan akhir yang nyaman dipakai.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mt-10">
            @foreach ($p['services'] as $i => $s)
                <div class="reveal card card-hover p-6" style="transition-delay: {{ $i * 90 }}ms">
                    <div class="w-12 h-12 grid place-items-center rounded-xl bg-accent/10 text-2xl">{{ $s['icon'] }}</div>
                    <h3 class="font-bold mt-5">{{ $s['title'] }}</h3>
                    <p class="text-sm text-muted mt-2 leading-relaxed">{{ $s['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- PROYEK --}}
    <section class="section">
        <div class="reveal flex items-end justify-between gap-4">
            <div>
                <p class="eyebrow">Portofolio</p>
                <h2 class="h2">Proyek terbaru</h2>
            </div>
            <a href="{{ route('projects') }}" class="text-sm font-semibold text-link hover:underline whitespace-nowrap">Semua proyek →</a>
        </div>
        <div class="grid md:grid-cols-3 gap-6 mt-10">
            @forelse ($projects as $i => $project)
                <x-project-card :project="$project" class="reveal" style="transition-delay: {{ $i * 110 }}ms" />
            @empty
                <p class="text-muted">Belum ada proyek.</p>
            @endforelse
        </div>
    </section>

    {{-- CTA --}}
    <section class="reveal section relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 to-violet-600 px-8 py-16 text-center text-white">
        <div class="absolute -top-24 -right-16 w-72 h-72 rounded-full bg-white/10"></div>
        <div class="absolute -bottom-28 -left-10 w-72 h-72 rounded-full bg-white/10"></div>
        <h2 class="relative text-3xl md:text-4xl font-extrabold tracking-tight">Punya ide? Ayo wujudkan bersama.</h2>
        <p class="relative mt-3 text-white/80 max-w-md mx-auto">Terbuka untuk magang, proyek freelance, dan kolaborasi.</p>
        <a href="{{ route('contact') }}" class="relative inline-block mt-8 bg-white text-indigo-700 font-semibold px-7 py-3 rounded-xl text-sm hover:-translate-y-0.5 hover:shadow-xl transition">Kirim Pesan</a>
    </section>
@endsection