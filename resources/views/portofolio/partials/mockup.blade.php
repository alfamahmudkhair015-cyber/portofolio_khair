@switch($key)
    @case('arunika')
        <div class="mk mk--arunika" aria-hidden="true">
            <div class="phone">
                <div class="phone__hero"><b>Discover</b><small>Desa wisata</small></div>
                <div class="phone__row"><i></i><div><u></u><u class="s"></u></div><em>Pesan</em></div>
                <div class="phone__row"><i></i><div><u></u><u class="s"></u></div><em>Pesan</em></div>
            </div>
            <div class="phone phone--2">
                <div class="ticket"><b>E-TICKET</b><span></span></div>
                <div class="ticket ticket--2"><b>TIKET</b><span></span></div>
            </div>
        </div>
        @break

    @case('kasirku')
        <div class="mk mk--kasirku" aria-hidden="true">
            <div class="pos">
                <div class="pos__search">Cari produk...</div>
                <div class="pos__grid">
                    @for ($i = 0; $i < 6; $i++)
                        <div class="pos__item"><i></i><u></u><u class="s"></u></div>
                    @endfor
                </div>
                <div class="pos__cart">
                    <div><u></u><b></b></div>
                    <div><u></u><b></b></div>
                    <strong>BAYAR</strong>
                </div>
            </div>
        </div>
        @break

    @case('web')
        <div class="mk mk--web" aria-hidden="true">
            <div class="win">
                <div class="win__bar"><i></i><i></i><i></i><span>alfa.test</span></div>
                <div class="win__body">
                    <div class="win__text"><u></u><u class="s"></u><p>CURIOUS<br>BY NATURE.</p><em></em></div>
                    <div class="win__pic"></div>
                </div>
            </div>
        </div>
        @break

    @default
        <div class="mk mk--game" aria-hidden="true">
            <span class="g-sun"></span>
            <span class="g-cloud g-cloud--1"></span><span class="g-cloud g-cloud--2"></span>
            <span class="g-hill"></span>
            <span class="g-block g-block--1"></span><span class="g-block g-block--2"></span><span class="g-block g-block--3"></span>
            <span class="g-hero"></span>
            <span class="g-ground"></span>
        </div>
@endswitch