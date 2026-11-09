@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
    @php $p = config('profile'); @endphp

    @if (session('success'))
        <div id="toast" class="fixed top-24 right-6 z-[70] max-w-sm card border-emerald-500/40 px-5 py-4 shadow-2xl text-sm text-emerald-500 transition-all duration-500">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="reveal max-w-2xl">
        <p class="eyebrow">Kontak</p>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mt-2">Mari <span class="text-gradient">berbincang</span></h1>
        <p class="text-muted mt-4 text-lg">Punya pertanyaan atau tawaran kerja sama? Kirim pesan, saya balas secepatnya.</p>
    </div>

    <div class="grid md:grid-cols-5 gap-8 mt-12">
        <form action="{{ route('contact.store') }}" method="POST" id="contact-form" class="reveal card md:col-span-3 p-6 md:p-8 space-y-5">
            @csrf

            @foreach (['name' => 'Nama', 'email' => 'Email'] as $field => $label)
                <div>
                    <label class="block text-sm font-medium mb-2">{{ $label }}</label>
                    <input type="{{ $field === 'email' ? 'email' : 'text' }}" name="{{ $field }}" value="{{ old($field) }}"
                           class="w-full bg-bg border border-line rounded-xl px-4 py-3 outline-none focus:border-accent focus:ring-4 focus:ring-accent/15 transition">
                    @error($field) <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>
            @endforeach

            <div>
                <label class="block text-sm font-medium mb-2">Pesan</label>
                <textarea name="message" rows="5"
                          class="w-full bg-bg border border-line rounded-xl px-4 py-3 outline-none focus:border-accent focus:ring-4 focus:ring-accent/15 transition">{{ old('message') }}</textarea>
                @error('message') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
            </div>

            <button type="submit" id="send-btn" class="btn btn-primary w-full disabled:opacity-60">Kirim Pesan</button>
        </form>

        <aside class="reveal md:col-span-2 space-y-4" style="transition-delay:120ms">
            @if (!empty($p['email']))
                <a href="mailto:{{ $p['email'] }}" class="card card-hover flex items-center gap-4 p-5">
                    <span class="w-11 h-11 shrink-0 grid place-items-center rounded-xl bg-accent/10 text-xl">✉️</span>
                    <span class="min-w-0"><span class="block text-xs text-muted">Email</span><span class="block text-sm font-medium break-all">{{ $p['email'] }}</span></span>
                </a>
            @endif

            @foreach (['github' => ['GitHub', '💻'], 'linkedin' => ['LinkedIn', '💼'], 'instagram' => ['Instagram', '📸'], 'whatsapp' => ['WhatsApp', '💬']] as $key => [$label, $icon])
                @if (!empty($p[$key]))
                    <a href="{{ $p[$key] }}" target="_blank" rel="noopener" class="card card-hover flex items-center gap-4 p-5">
                        <span class="w-11 h-11 shrink-0 grid place-items-center rounded-xl bg-accent/10 text-xl">{{ $icon }}</span>
                        <span><span class="block text-xs text-muted">{{ $label }}</span><span class="block text-sm font-medium">Kunjungi profil ↗</span></span>
                    </a>
                @endif
            @endforeach

            <div class="card flex items-center gap-4 p-5">
                <span class="w-11 h-11 shrink-0 grid place-items-center rounded-xl bg-accent/10 text-xl">📍</span>
                <span><span class="block text-xs text-muted">Lokasi</span><span class="block text-sm font-medium">{{ $p['location'] }}</span></span>
            </div>
        </aside>
    </div>
@endsection

@push('scripts')
<script>
    document.getElementById('contact-form').addEventListener('submit', () => {
        const b = document.getElementById('send-btn');
        b.disabled = true; b.textContent = 'Mengirim...';
    });
</script>
@endpush