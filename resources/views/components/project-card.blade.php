@props(['project'])

@php
    $tones = [
        'from-indigo-500/25 to-sky-500/10',
        'from-emerald-500/25 to-teal-500/10',
        'from-rose-500/25 to-orange-500/10',
        'from-violet-500/25 to-fuchsia-500/10',
    ];
    $tone = $tones[$project->id % 4];
    $initials = collect(explode(' ', $project->title))->take(2)->map(fn ($w) => mb_substr($w, 0, 1))->join('');
@endphp

<article {{ $attributes->merge(['class' => 'card card-hover group flex flex-col overflow-hidden']) }}
         data-tech="{{ strtolower($project->tech_stack) }}">

    <a href="{{ route('projects.show', $project) }}" class="block bg-gradient-to-br {{ $tone }} p-5">
        <div class="rounded-lg border border-line bg-bg/90 shadow-lg overflow-hidden">
            <div class="flex items-center gap-1.5 px-3 py-2 border-b border-line">
                <i class="w-2 h-2 rounded-full bg-red-400/80"></i><i class="w-2 h-2 rounded-full bg-amber-400/80"></i><i class="w-2 h-2 rounded-full bg-emerald-400/80"></i>
            </div>
            <div class="relative h-28 p-4 space-y-2">
                <div class="h-2 w-2/5 rounded bg-line"></div>
                <div class="h-2 w-3/5 rounded bg-line"></div>
                <div class="h-2 w-1/3 rounded bg-line"></div>
                <span class="absolute right-4 bottom-3 text-4xl font-extrabold text-accent/80 group-hover:scale-110 transition duration-300">{{ $initials }}</span>
            </div>
        </div>
    </a>

    <div class="p-6 flex flex-col flex-1">
        <h3 class="font-bold text-lg leading-snug">
            <a href="{{ route('projects.show', $project) }}" class="hover:text-link transition">{{ $project->title }}</a>
        </h3>
        <p class="text-muted text-sm mt-2 flex-1 leading-relaxed">{{ \Illuminate\Support\Str::limit($project->description, 105) }}</p>

        <div class="flex flex-wrap gap-1.5 mt-4">
            @foreach (explode(',', $project->tech_stack) as $tech)
                <span class="chip">{{ trim($tech) }}</span>
            @endforeach
        </div>

        <div class="flex items-center gap-4 mt-5 pt-4 border-t border-line text-sm">
            <a href="{{ route('projects.show', $project) }}" class="font-semibold text-link">Lihat detail →</a>
            @if ($project->demo_url) <a href="{{ $project->demo_url }}" target="_blank" class="text-muted hover:text-ink ml-auto">Demo</a> @endif
            @if ($project->github_url) <a href="{{ $project->github_url }}" target="_blank" class="text-muted hover:text-ink {{ $project->demo_url ? '' : 'ml-auto' }}">GitHub</a> @endif
        </div>
    </div>
</article>