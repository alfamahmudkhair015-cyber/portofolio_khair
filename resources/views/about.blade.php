@extends('layouts.app')

@section('title', 'Tentang')

@section('content')
    @php $p = config('profile'); @endphp

    <div class="reveal max-w-2xl">
        <p class="eyebrow">Tentang</p>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mt-2">Mengenal <span class="text-gradient">saya</span></h1>
    </div>

    <section class="grid md:grid-cols-12 gap-12 mt-12 items-start">
        <div class="reveal md:col-span-7">
            <p class="text-lg text-muted leading-relaxed">{{ $p['intro'] }}</p>
            <p class="text-sm text-muted mt-5">📍 {{ $p['location'] }}</p>

            <div class="grid sm:grid-cols-3 gap-4 mt-10">
                @foreach ($p['values'] as $v)
                    <div class="card p-5">
                        <p class="font-bold text-link">{{ $v['title'] }}</p>
                        <p class="text-xs text-muted mt-2 leading-relaxed">{{ $v['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="reveal md:col-span-5" style="transition-delay:120ms">
            <div class="relative max-w-sm mx-auto">
                <div class="absolute inset-0 translate-x-3 translate-y-3 rounded-3xl border-2 border-accent/40"></div>
                <img src="{{ asset($p['photo']) }}" alt="{{ $p['name'] }}"
                     class="relative w-full aspect-[4/5] object-cover object-top rounded-3xl border border-line shadow-xl">
            </div>
        </div>
    </section>

    {{-- SKILL --}}
    <section class="section">
        <div class="reveal max-w-xl">
            <p class="eyebrow">Keahlian</p>
            <h2 class="h2">Teknologi yang saya pakai</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mt-10">
            @foreach ($p['skills'] as $group => $items)
                <div class="reveal card p-6" style="transition-delay: {{ $loop->index * 100 }}ms">
                    <h3 class="font-bold mb-6">{{ $group }}</h3>
                    <div class="space-y-5">
                        @foreach ($items as $s)
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="font-medium">{{ $s['name'] }}</span>
                                    <span class="text-muted">{{ $s['level'] }}%</span>
                                </div>
                                <div class="h-1.5 bg-line rounded-full overflow-hidden">
                                    <div class="bar h-full rounded-full bg-gradient-to-r from-accent to-sky-400"
                                         style="--w: {{ $s['level'] }}%" data-bar="{{ $s['level'] }}"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- PENDIDIKAN --}}
    <section class="section">
        <div class="reveal max-w-xl">
            <p class="eyebrow">Pendidikan</p>
            <h2 class="h2">Perjalanan akademik</h2>
        </div>

        <ul class="mt-10 space-y-6 border-l border-line pl-8 ml-2">
            @foreach ($p['education'] as $edu)
                <li class="reveal relative">
                    <span class="absolute -left-[41px] top-7 w-4 h-4 rounded-full bg-accent ring-4 ring-bg"></span>
                    <div class="card p-6">
                        <p class="text-xs font-semibold text-link">{{ $edu['period'] }}</p>
                        <p class="font-bold text-lg mt-1">{{ $edu['title'] }}</p>
                        <p class="text-sm text-muted">{{ $edu['place'] }}</p>
                        <p class="text-muted text-sm mt-3 leading-relaxed">{{ $edu['desc'] }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </section>
@endsection