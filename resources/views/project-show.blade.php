@extends('layouts.app')

@section('title', $project->title)
@section('description', \Illuminate\Support\Str::limit($project->description, 150))

@section('content')
    @php
        $tones = ['from-indigo-500/25 to-sky-500/10', 'from-emerald-500/25 to-teal-500/10', 'from-rose-500/25 to-orange-500/10', 'from-violet-500/25 to-fuchsia-500/10'];
        $tone = $tones[$project->id % 4];
        $initials = collect(explode(' ', $project->title))->take(2)->map(fn ($w) => mb_substr($w, 0, 1))->join('');
    @endphp

    <a href="{{ route('projects') }}" class="reveal inline-block text-sm text-muted hover:text-link transition">← Semua proyek</a>

    <div class="reveal mt-6 rounded-3xl border border-line bg-gradient-to-br {{ $tone }} p-6 md:p-10">
        <div class="max-w-2xl mx-auto rounded-xl border border-line bg-bg/90 shadow-2xl overflow-hidden">
            <div class="flex items-center gap-1.5 px-4 py-3 border-b border-line">
                <i class="w-2.5 h-2.5 rounded-full bg-red-400/80"></i><i class="w-2.5 h-2.5 rounded-full bg-amber-400/80"></i><i class="w-2.5 h-2.5 rounded-full bg-emerald-400/80"></i>
            </div>
            <div class="relative h-44 md:h-60 p-6 space-y-3">
                <div class="h-3 w-2/5 rounded bg-line"></div>
                <div class="h-3 w-3/5 rounded bg-line"></div>
                <div class="h-3 w-1/3 rounded bg-line"></div>
                <span class="absolute right-6 bottom-4 text-6xl md:text-7xl font-extrabold text-accent/80">{{ $initials }}</span>
            </div>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-10 mt-12">
        <div class="reveal md:col-span-2">
            <p class="eyebrow">Studi proyek</p>
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mt-2">{{ $project->title }}</h1>
            <p class="text-muted leading-relaxed mt-5 text-lg">{{ $project->description }}</p>
        </div>

        <aside class="reveal card h-fit p-6 space-y-6" style="transition-delay:120ms">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-muted mb-3">Teknologi</p>
                <div class="flex flex-wrap gap-1.5">
                    @foreach (explode(',', $project->tech_stack) as $tech)
                        <span class="chip">{{ trim($tech) }}</span>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col gap-3">
                @if ($project->demo_url)
                    <a href="{{ $project->demo_url }}" target="_blank" class="btn btn-primary">Lihat Demo ↗</a>
                @endif
                @if ($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" class="btn btn-ghost">Kode di GitHub ↗</a>
                @endif
                @if (!$project->demo_url && !$project->github_url)
                    <p class="text-sm text-muted">Link demo dan kode belum tersedia.</p>
                @endif
            </div>
        </aside>
    </div>

    @if ($others->isNotEmpty())
        <section class="section">
            <h2 class="reveal h2 !mt-0">Proyek lainnya</h2>
            <div class="grid md:grid-cols-2 gap-6 mt-8">
                @foreach ($others as $o)
                    <x-project-card :project="$o" class="reveal" />
                @endforeach
            </div>
        </section>
    @endif
@endsection