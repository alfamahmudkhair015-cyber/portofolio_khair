@php
    $c = config('portfolio');
    $hasCv = !empty($c['cv']) && file_exists(public_path($c['cv']));
    $proj = $c['projects'][0] ?? null;
    $techs = array_slice($c['skills'], 0, 5);
    $socials = ['github' => 'GitHub', 'linkedin' => 'LinkedIn', 'instagram' => 'Instagram'];
@endphp
<section class="hero hx" id="home">
    <div class="hx-bg" aria-hidden="true">
        <canvas id="hx-particles"></canvas>
        <i class="hx-orb"></i><i class="hx-sweep"></i>
    </div>

    <div class="wrap hero__grid grid grid-cols-1 items-center gap-8 lg:grid-cols-2">
        <div class="hero__text">
            <span class="hx-chip"><svg class="ico"><use href="#i-spark"/></svg> FRONT-END DEVELOPER</span>
            <p class="hello">Hi, I'm <b>{{ $c['full_name'] }}</b></p>

            <h1 class="hx-title">
                <span class="hx-line">I Build</span>
                <span class="hx-line g">Fast, Modern &amp;</span>
                <span class="hx-line g">Scalable Web Apps</span>
            </h1>

            <p class="hero__lead hx-in">Saya membangun website yang responsif, cepat, dan rapi dengan teknologi modern, mengubah ide menjadi pengalaman digital nyata.</p>

            <div class="cta hx-in">
                <a href="#projects" class="btn btn--lime hx-mag">View My Work <svg class="ico"><use href="#i-arrow-r"/></svg></a>
                <a href="{{ $hasCv ? asset($c['cv']) : '#contact' }}" @if($hasCv) download @endif class="btn btn--line hx-mag">
                    <svg class="ico"><use href="#i-download"/></svg> Download Resume
                </a>
            </div>

            <div class="hx-meta hx-in">
                <div class="hx-social">
                    @foreach ($socials as $k => $label)
                        @if (!empty($c[$k]))
                            <a href="{{ $c[$k] }}" target="_blank" rel="noopener" class="round hx-mag" aria-label="{{ $label }}"><svg class="ico"><use href="#i-{{ $k }}"/></svg></a>
                        @endif
                    @endforeach
                </div>
                <a href="#about" class="scroll-down" aria-label="Scroll ke bawah"><i></i> Scroll Down</a>
            </div>
        </div>

        <div class="hero__art hx-art">
            <i class="hx-orbit hx-orbit--1" aria-hidden="true"></i>
            <i class="hx-orbit hx-orbit--2" aria-hidden="true"></i>
            <span class="note" aria-hidden="true">Better<br>Code<br>Better<br>Tomorrow</span>

            <figure class="avatar" data-depth="14">
                <img src="{{ asset($c['photo']) }}" alt="Foto {{ $c['full_name'] }}" width="640" height="800" fetchpriority="high">
            </figure>

            <div class="hx-pos hx-pos--code" data-depth="26">
                <div class="hx-card" data-tilt aria-hidden="true">
<pre><code><b class="d">main.js</b>
<span class="k">const</span> developer = {
  name: <span class="s">'{{ $c['name'] }}'</span>,
  role: <span class="s">'Front-End Dev'</span>,
  skills: [<span class="s">'Laravel'</span>, <span class="s">'Flutter'</span>],
  passion: <span class="s">'Build amazing things'</span>
}</code></pre>
                </div>
            </div>

            <div class="hx-pos hx-pos--tech" data-depth="34">
                <div class="hx-card" data-tilt>
                    <ul class="hx-tech">
                        @foreach ($techs as $t)
                            <li><img src="https://cdn.simpleicons.org/{{ $t['slug'] }}/{{ $t['color'] }}" alt="" width="20" height="20" loading="lazy" onerror="this.style.visibility='hidden'">{{ $t['name'] }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            @if ($proj)
                <div class="hx-pos hx-pos--proj" data-depth="20">
                    <a href="#projects" class="hx-card hx-proj" data-tilt>
                        <small>My Latest Project</small>
                        <b>{{ $proj['title'] }}</b>
                        <span>{{ $proj['category'] ?? '' }}</span>
                        <em>View Project <svg class="ico"><use href="#i-arrow-r"/></svg></em>
                    </a>
                </div>
            @endif

            <div class="badge">
                <small>INFORMATICS</small><b>STUDENT</b><small>{{ $c['campus_short'] }}</small>
            </div>
        </div>
    </div>
</section>
