@extends('layouts.portfolio')

@section('content')
@php
    $c = config('portfolio');
    $projectCount = count($c['projects']);
@endphp

{{-- HERO --}}
@include('portofolio.partials.hero')

{{-- MARQUEE --}}
<div class="marquee" aria-hidden="true">
    <div class="marquee__track">
        @for ($i = 0; $i < 2; $i++)
            @foreach ($c['skills'] as $s)
                <span><svg class="ico"><use href="#i-spark"/></svg>{{ $s['name'] }}</span>
            @endforeach
        @endfor
    </div>
</div>

{{-- ABOUT --}}
<section class="section" id="about" aria-labelledby="about-title">
    <div class="wrap">
        <div class="panel about reveal grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="about__text">
                <p class="tag"><i></i> 01 &nbsp;ABOUT ME</p>
                <h2 id="about-title" class="h2">A bit about me</h2>
                <p class="about__p">
                    Saya {{ $c['full_name'] }}, mahasiswa semester {{ $c['semester'] }} Program Studi {{ $c['study'] }} {{ $c['campus'] }}. Saya senang membangun sesuatu yang bermanfaat, mulai dari aplikasi, website, hingga ide-ide digital yang bisa memberikan dampak positif.
                </p>

                <dl class="stats">
                    @foreach ($c['stats'] as $s)
                        <div>
                            <dt>{{ $s['value'] ?? $projectCount . '+' }}</dt>
                            <dd>{{ $s['label'] }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>

            <div class="about__visual" aria-hidden="true">
                <div class="code-card">
                    <div class="code-card__bar"><i></i><i></i><i></i></div>
                    <pre><code><span class="k">class</span> <span class="f">Alfa</span> {
  <span class="k">learn</span>() { <span class="k">return</span> <span class="s">'curious'</span>; }
  <span class="k">build</span>() { <span class="k">return</span> <span class="s">'with code'</span>; }
  <span class="k">iterate</span>(); <span class="c">// repeat</span>
}</code></pre>
                    <p class="code-card__foot">CODE &middot; DESIGN &middot; IMPACT</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PROJECTS --}}
<section class="section section--tight" id="projects" aria-labelledby="projects-title">
    <div class="wrap">
        <header class="sec-head reveal">
            <div>
                <p class="tag"><i></i> 02 &nbsp;SELECTED PROJECTS</p>
                <h2 id="projects-title" class="h2">My Projects</h2>
                <p class="sec-sub">Beberapa project yang pernah saya kerjakan, mulai dari aplikasi mobile, web, hingga eksperimen desain dan game.</p>
            </div>
            @if (!empty($c['github']))
                <a href="{{ $c['github'] }}" target="_blank" rel="noopener" class="link">View All Projects <svg class="ico"><use href="#i-arrow"/></svg></a>
            @endif
        </header>

        <div class="projects grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($c['projects'] as $p)
                <article class="pcard reveal" style="--d: {{ $loop->index * .08 }}s">
                    <div class="pcard__visual">
                        @include('portofolio.partials.mockup', ['key' => $p['key']])
                    </div>
                    <div class="pcard__body">
                        <div>
                            <h3>{{ $p['title'] }}</h3>
                            <p>{{ $p['desc'] }}</p>
                        </div>
                        <ul class="tags">
                            @foreach ($p['stack'] as $t) <li>{{ $t }}</li> @endforeach
                        </ul>
                    </div>
                    @if (!empty($p['url']))
                        <a href="{{ $p['url'] }}" target="_blank" rel="noopener" class="pcard__go" aria-label="Buka {{ $p['title'] }}"><svg class="ico"><use href="#i-arrow"/></svg></a>
                    @else
                        <span class="pcard__go is-off" title="Link belum diisi" aria-hidden="true"><svg class="ico"><use href="#i-arrow"/></svg></span>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- SKILLS --}}
<section class="section section--tight" id="skills" aria-labelledby="skills-title">
    <div class="wrap">
        <div class="panel reveal">
            <p class="tag"><i></i> 03 &nbsp;SKILLS &amp; TOOLS</p>
            <h2 id="skills-title" class="h2">My Skills</h2>
            <p class="sec-sub">Tools dan teknologi yang biasa saya gunakan dalam mengembangkan project.</p>

             <ul class="skills grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5"> 
                @foreach ($c['skills'] as $s)
                    <li>
                        <img src="https://cdn.simpleicons.org/{{ $s['slug'] }}/{{ $s['color'] }}" alt="" width="34" height="34" loading="lazy" onerror="this.style.visibility='hidden'">
                        <span>{{ $s['name'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

{{-- EXPERIENCE --}}
<section class="section section--tight" id="experience" aria-labelledby="exp-title">
    <div class="wrap">
        <div class="panel journey reveal">
            <div>
                <p class="tag"><i></i> 04 &nbsp;EXPERIENCE</p>
                <h2 id="exp-title" class="h2">My Journey</h2>
                <p class="sec-sub">Pengalaman dan kegiatan yang membentuk saya menjadi pribadi yang lebih baik.</p>

                <ol class="timeline grid grid-cols-1 gap-6 md:grid-cols-2">
                    @foreach ($c['journey'] as $j)
                        <li>
                            <span class="timeline__dot"></span>
                            <p class="timeline__year">{{ $j['year'] }}</p>
                            <h3>{{ $j['title'] }}</h3>
                            <p>{{ $j['desc'] }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>

            <figure class="quote">
                <svg class="quote__art" viewBox="0 0 320 220" aria-hidden="true" preserveAspectRatio="xMidYMax slice">
                    <g fill="none" stroke="currentColor" stroke-width="1">
                        <path d="M10 220V120h40v100M50 220V80h44v140M94 220V140h36v140M130 220V50h50v170M180 220V100h40v120M220 220V130h42v90M262 220V70h48v150"/>
                        <path d="M60 100h24M60 120h24M60 140h24M140 70h30M140 90h30M140 110h30M272 90h26M272 110h26M272 130h26"/>
                    </g>
                </svg>
                <blockquote>
                    <span class="quote__mark" aria-hidden="true">&ldquo;</span>
                    <p>{{ $c['quote']['text'] }}</p>
                    <footer>&mdash; {{ $c['quote']['by'] }}</footer>
                </blockquote>
            </figure>
        </div>
    </div>
</section>

{{-- CONTACT --}}
<section class="section section--tight" id="contact" aria-labelledby="contact-title"
         data-focus="{{ ($errors->any() || session('success')) ? '1' : '0' }}">
    <div class="wrap">
       <div class="panel contact reveal grid grid-cols-1 gap-8 lg:grid-cols-2">
            <div class="contact__info">
                <p class="tag"><i></i> 05 &nbsp;GET IN TOUCH</p>
                <h2 id="contact-title" class="h2">Let's Work Together</h2>
                <p class="sec-sub">Punya project, ide, atau sekadar ingin ngobrol? Saya terbuka untuk kesempatan baru.</p>

                <ul class="info">
                    <li>
                        <span class="info__ico"><svg class="ico"><use href="#i-mail"/></svg></span>
                        <div><small>Email</small><a href="mailto:{{ $c['email'] }}">{{ $c['email'] }}</a></div>
                        <button type="button" class="info__copy" id="copy-email" data-email="{{ $c['email'] }}" aria-label="Salin email">
                            <svg class="ico"><use href="#i-copy"/></svg>
                        </button>
                    </li>
                    @if (!empty($c['whatsapp']))
                        <li>
                            <span class="info__ico"><svg class="ico"><use href="#i-phone"/></svg></span>
                            <div><small>WhatsApp</small><a href="{{ $c['whatsapp'] }}" target="_blank" rel="noopener">{{ $c['whatsapp_label'] }}</a></div>
                        </li>
                    @endif
                    <li>
                        <span class="info__ico"><svg class="ico"><use href="#i-pin"/></svg></span>
                        <div><small>Location</small><span>{{ $c['location'] }}</span></div>
                    </li>
                </ul>
                <span class="sr-only" id="copy-status" role="status" aria-live="polite"></span>
            </div>

            <form action="{{ route('contact.store') }}" method="POST" class="form grid grid-cols-1 gap-4" id="contact-form" novalidate>
                @csrf

                @if (session('success'))
                    <p class="form__ok" role="status"><svg class="ico"><use href="#i-check"/></svg> {{ session('success') }}</p>
                @endif

                <div class="field">
                    <label for="f-name">Name</label>
                    <input id="f-name" type="text" name="name" value="{{ old('name') }}" placeholder="Your name" required maxlength="100" autocomplete="name">
                    @error('name') <p class="field__err">{{ $message }}</p> @enderror
                </div>
                <div class="field">
                    <label for="f-email">Email</label>
                    <input id="f-email" type="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" required maxlength="150" autocomplete="email">
                    @error('email') <p class="field__err">{{ $message }}</p> @enderror
                </div>
                <div class="field">
                    <label for="f-msg">Message</label>
                    <textarea id="f-msg" name="message" rows="4" placeholder="Tell me about your project..." required maxlength="2000">{{ old('message') }}</textarea>
                    @error('message') <p class="field__err">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn btn--lime btn--block" id="send-btn">Send Message <svg class="ico"><use href="#i-send"/></svg></button>
            </form>
        </div>
    </div>
</section>
@endsection