@extends('layouts.app')

@section('title', 'Proyek')

@section('content')
    @php
        $allTech = $projects->flatMap(fn ($pr) => array_map('trim', explode(',', $pr->tech_stack)))->unique()->values();
    @endphp

    <div class="reveal max-w-2xl">
        <p class="eyebrow">Portofolio</p>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mt-2">Proyek <span class="text-gradient">saya</span></h1>
        <p class="text-muted mt-4 text-lg">Beberapa proyek yang pernah saya kerjakan. Klik kartu untuk melihat detailnya.</p>
    </div>

    <div class="reveal flex flex-wrap gap-2 mt-10" id="filters">
        <button data-filter="all" class="filter-btn is-on px-4 py-2 rounded-lg text-sm font-medium border transition">Semua</button>
        @foreach ($allTech as $t)
            <button data-filter="{{ strtolower($t) }}" class="filter-btn px-4 py-2 rounded-lg text-sm font-medium border transition">{{ $t }}</button>
        @endforeach
    </div>

    <div id="grid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        @forelse ($projects as $i => $project)
            <x-project-card :project="$project" class="reveal" style="transition-delay: {{ ($i % 3) * 90 }}ms" />
        @empty
            <p class="text-muted">Belum ada proyek.</p>
        @endforelse
    </div>

    <p id="empty" class="hidden text-muted mt-8">Tidak ada proyek dengan teknologi itu.</p>
@endsection

@push('scripts')
<style>
    .filter-btn { border-color: rgb(var(--line)); color: rgb(var(--muted)); background: rgb(var(--surface)); }
    .filter-btn:hover { border-color: rgb(var(--accent)); color: rgb(var(--text)); }
    .filter-btn.is-on { background: rgb(var(--accent)); border-color: rgb(var(--accent)); color: #fff; }
</style>
<script>
    const btns = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('#grid [data-tech]');
    btns.forEach(btn => btn.addEventListener('click', () => {
        const f = btn.dataset.filter;
        btns.forEach(b => b.classList.toggle('is-on', b === btn));
        let shown = 0;
        cards.forEach(c => {
            const ok = f === 'all' || c.dataset.tech.includes(f);
            c.style.display = ok ? '' : 'none';
            if (ok) shown++;
        });
        document.getElementById('empty').classList.toggle('hidden', shown > 0);
    }));
</script>
@endpush