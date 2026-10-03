@extends('layouts.public')

@section('title', ($owner->name ?? 'Portfolio') . ' — Developer × Graphic Designer')

@section('content')

    {{-- =====================================================
         HERO
    ====================================================== --}}
    <section class="pub-section hero" id="home">
        <div class="container-pub">
            <div class="row align-items-center g-5">

                <div class="col-lg-7">
                    <span class="section-eyebrow hero-anim hero-anim-1">
                        Hey there, I'm
                    </span>

                    <h1 class="hero-title hero-anim hero-anim-2">
                        {{ $owner->name ?? 'Your Name' }}
                        <span class="hero-dot">.</span>
                    </h1>

                    <p class="hero-role hero-anim hero-anim-3">
                        <span class="role-accent">
                            {{ $services->first()->title ?? 'Developer' }}
                        </span>
                        &nbsp;×&nbsp;
                        {{ $skills->first()->category ?? 'Graphic Designer' }}
                    </p>

                    <p class="hero-desc hero-anim hero-anim-4">
                        {{ $owner->bio ?? 'Membangun pengalaman digital yang bersih, fungsional, dan berkarakter — memadukan sisi teknis dengan sentuhan visual.' }}
                    </p>

                    <div class="hero-actions hero-anim hero-anim-5">
                        <a href="#portfolio" class="btn-accent">
                            Lihat Karya
                            <i class="bi bi-arrow-down-right"></i>
                        </a>

                        @if ($owner && $owner->cv_url)
                            <a href="{{ $owner->cv_url }}" download class="btn-ghost">
                                <i class="bi bi-download"></i>
                                Download CV
                            </a>
                        @else
                            <a href="#contact" class="btn-ghost">
                                Hubungi Saya
                            </a>
                        @endif
                    </div>

                    {{-- SOSIAL MEDIA --}}
                    @if ($owner)
                        <div class="hero-social hero-anim hero-anim-5">
                            @if ($owner->whatsapp_link)
                                <a href="{{ $owner->whatsapp_link }}" target="_blank" rel="noopener" title="WhatsApp">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                            @endif

                            @if ($owner->instagram)
                                <a href="{{ $owner->instagram }}" target="_blank" rel="noopener" title="Instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>
                            @endif

                            @if ($owner->github)
                                <a href="{{ $owner->github }}" target="_blank" rel="noopener" title="GitHub">
                                    <i class="bi bi-github"></i>
                                </a>
                            @endif

                            @if ($owner->linkedin)
                                <a href="{{ $owner->linkedin }}" target="_blank" rel="noopener" title="LinkedIn">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            @endif

                            @if ($owner->dribbble)
                                <a href="{{ $owner->dribbble }}" target="_blank" rel="noopener" title="Dribbble">
                                    <i class="bi bi-dribbble"></i>
                                </a>
                            @endif

                            <a href="mailto:{{ $owner->email }}" title="Email">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </div>
                    @endif
                </div>

                <div class="col-lg-5">
                    <div class="hero-photo-wrap hero-anim hero-anim-photo">

                        <div class="hero-photo">

                            @if ($owner && $owner->photo_url)
                                <img src="{{ $owner->photo_url }}" alt="{{ $owner->name }}">
                            @else
                                <div class="hero-photo-initial">
                                    {{ strtoupper(substr($owner->name ?? 'P', 0, 1)) }}
                                </div>
                            @endif

                        </div>

                    </div>

                    {{-- JAM + LOKASI (di bawah foto) --}}
                    <div class="hero-meta hero-anim hero-anim-6">

                        {{-- JAM ESTETIK (angka Romawi) --}}
                        <div class="clock-wrap">
                            <div class="clock" id="wallClock">
                                <div class="clock-face">
                                    @foreach (['XII','I','II','III','IV','V','VI','VII','VIII','IX','X','XI'] as $i => $roman)
                                        <span class="clock-num clock-num-{{ $i + 1 }}">{{ $roman }}</span>
                                    @endforeach

                                    <span class="clock-center"></span>

                                    <span class="clock-hand clock-hour" id="clockHour"></span>
                                    <span class="clock-hand clock-minute" id="clockMinute"></span>
                                    <span class="clock-hand clock-second" id="clockSecond"></span>
                                </div>
                            </div>

                            <div class="clock-info">
                                <div class="clock-time" id="clockDigital">--:--:--</div>
                                <div class="clock-date" id="clockDate">Memuat tanggal...</div>
                            </div>
                        </div>

                        {{-- LOKASI --}}
                        <a
                            href="https://www.google.com/maps?q=-8.551629,116.104735"
                            target="_blank"
                            rel="noopener"
                            class="location-chip"
                        >
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>-8.551629, 116.104735</span>
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- =====================================================
         STATS
    ====================================================== --}}
    <section class="stats-strip">
        <div class="container-pub">
            <div class="stats-grid">

                <div class="stat-box reveal">
                    <div class="stat-value">
                        <span data-count="{{ $projects->count() }}">0</span>+
                    </div>
                    <div class="stat-label">Karya</div>
                </div>

                <div class="stat-box reveal reveal-delay-1">
                    <div class="stat-value">
                        <span data-count="{{ $services->count() }}">0</span>
                    </div>
                    <div class="stat-label">Layanan</div>
                </div>

                <div class="stat-box reveal reveal-delay-2">
                    <div class="stat-value">
                        <span data-count="{{ $skills->count() }}">0</span>
                    </div>
                    <div class="stat-label">Skills</div>
                </div>

                <div class="stat-box reveal reveal-delay-3">
                    <div class="stat-value">
                        <span data-count="{{ $experiences->count() }}">0</span>
                    </div>
                    <div class="stat-label">Pengalaman</div>
                </div>

            </div>
        </div>
    </section>


    {{-- =====================================================
         SERVICES
    ====================================================== --}}
    @if ($services->count())
        <section class="pub-section" id="services">
            <div class="container-pub">

                <div class="section-head">
                    <span class="section-eyebrow reveal">What I Do</span>
                    <h2 class="section-title reveal">
                        Layanan <span class="muted">yang saya tawarkan</span>
                    </h2>
                </div>

                <div class="row g-4">
                    @foreach ($services as $service)
                        <div class="col-md-6 reveal reveal-delay-{{ ($loop->index % 2) + 1 }}">
                            <div class="service-card">
                                <div class="service-top">
                                    <div class="service-icon">
                                        <i class="bi {{ $service->icon ?: 'bi-grid' }}"></i>
                                    </div>

                                    <i class="bi bi-arrow-up-right service-arrow"></i>
                                </div>

                                <div class="service-body">
                                    <h3>{{ $service->title }}</h3>

                                    @if ($service->description)
                                        <p>{{ $service->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    @endif


    {{-- =====================================================
         PORTFOLIO (asymmetric gallery)
    ====================================================== --}}
    @if ($projects->count())
        <section class="pub-section portfolio-section" id="portfolio">
            <div class="container-pub">

                <div class="section-head">
                    <span class="section-eyebrow reveal">Selected Work</span>
                    <h2 class="section-title reveal">
                        Karya <span class="muted">pilihan</span>
                    </h2>
                </div>

                <div class="work-grid">
                    @foreach ($projects as $project)
                        <a
                            href="{{ route('work.show', $project->id) }}"
                            class="work-card reveal {{ $loop->first ? 'work-card-lg' : '' }}"
                        >
                            <div class="work-image">
                                <img
                                    src="{{ asset('storage/' . $project->image) }}"
                                    alt="{{ $project->title }}"
                                    loading="lazy"
                                >

                                <span class="work-overlay">
                                    <i class="bi bi-arrow-up-right"></i>
                                </span>
                            </div>

                            <div class="work-body">
                                <div class="work-category">
                                    {{ $project->category->name }} • {{ $project->year }}
                                </div>

                                <h3 class="work-title">
                                    {{ $project->title }}
                                </h3>

                                <p class="work-desc">
                                    {{ \Illuminate\Support\Str::limit($project->description, 80) }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        </section>
    @endif


    {{-- =====================================================
         ABOUT (Skills + Experience)
    ====================================================== --}}
    <section class="pub-section" id="about">
        <div class="container-pub">

            <div class="section-head">
                <span class="section-eyebrow reveal">About Me</span>
                <h2 class="section-title reveal">
                    Keahlian <span class="muted">& pengalaman</span>
                </h2>
            </div>

            <div class="row g-5">

                {{-- SKILLS --}}
                <div class="col-lg-6">
                    @if ($skills->count())

                        {{-- BAR CHART VERTIKAL (konsep: Distribution chart) --}}
                        <div class="skill-chart reveal">

                            <div class="chart-head">
                                <div class="chart-title">
                                    Distribution Of Skills By Proficiency
                                </div>
                                <div class="chart-subtitle">
                                    Tingkat penguasaan tiap keahlian (%)
                                </div>
                            </div>

                            {{-- Sumbu Y (skala) --}}
                            <div class="chart-scale">
                                <span>100</span>
                                <span>75</span>
                                <span>50</span>
                                <span>25</span>
                                <span>0</span>
                            </div>

                            {{-- Area bar --}}
                            <div class="chart-plot">

                                <div class="chart-grid">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>

                                <div class="chart-bars">
                                    @foreach ($skills as $skill)
                                        <div class="chart-col">

                                            <div class="chart-col-track">
                                                <div
                                                    class="chart-col-bar"
                                                    data-height="{{ $skill->level }}"
                                                    style="height: 0%;"
                                                >
                                                    <span class="chart-col-value">
                                                        <span data-count="{{ $skill->level }}">0</span>%
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="chart-col-label">
                                                {{ $skill->name }}
                                            </div>

                                        </div>
                                    @endforeach
                                </div>

                            </div>

                        </div>
                    @else
                        <p class="section-text reveal">Belum ada skill yang ditambahkan.</p>
                    @endif
                </div>


                {{-- EXPERIENCE --}}
                <div class="col-lg-6">
                    @if ($experiences->count())
                        <div class="exp-list">
                            @foreach ($experiences as $experience)
                                <div class="exp-item reveal reveal-delay-{{ ($loop->index % 3) + 1 }}">
                                    <div class="exp-period">{{ $experience->period }}</div>

                                    <h3 class="exp-position">{{ $experience->position }}</h3>

                                    <div class="exp-company">{{ $experience->company }}</div>

                                    @if ($experience->description)
                                        <p class="exp-desc">{{ $experience->description }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="section-text reveal">Belum ada pengalaman yang ditambahkan.</p>
                    @endif
                </div>

            </div>
        </div>
    </section>


    {{-- =====================================================
         TESTIMONI
    ====================================================== --}}
    @if (($testimonials ?? collect())->count())
        <section class="pub-section testimonial-section" id="testimonials">
            <div class="container-pub">

                <div class="section-head">
                    <span class="section-eyebrow reveal">Testimonials</span>
                    <h2 class="section-title reveal">
                        Apa kata <span class="muted">mereka</span>
                    </h2>
                </div>

                <div class="testi-grid">
                    @foreach ($testimonials as $testi)
                        <div class="testi-card reveal reveal-delay-{{ ($loop->index % 3) + 1 }}">

                            {{-- Bintang --}}
                            <div class="testi-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= $testi->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                            </div>

                            {{-- Isi --}}
                            <p class="testi-message">
                                "{{ $testi->message }}"
                            </p>

                            {{-- Profil --}}
                            <div class="testi-author">
                                <div class="testi-avatar">
                                    @if ($testi->photo_url)
                                        <img src="{{ $testi->photo_url }}" alt="{{ $testi->name }}">
                                    @else
                                        {{ strtoupper(substr($testi->name, 0, 1)) }}
                                    @endif
                                </div>

                                <div>
                                    <div class="testi-name">{{ $testi->name }}</div>
                                    @if ($testi->role)
                                        <div class="testi-role">{{ $testi->role }}</div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    @endif


    {{-- =====================================================
         CONTACT
    ====================================================== --}}
    <section class="pub-section contact-section" id="contact">
        <div class="container-pub">
            <div class="row g-5">

                <div class="col-lg-5">
                    <span class="section-eyebrow reveal">Let's Talk</span>

                    <h2 class="section-title reveal">
                        Punya proyek <span class="muted">dalam pikiran?</span>
                    </h2>

                    <p class="section-text reveal">
                        Ceritakan idemu. Kirim pesan lewat form ini dan saya akan
                        segera membalasnya.
                    </p>

                    @if ($owner)
                        <div class="contact-info reveal">
                            <a href="mailto:{{ $owner->email }}" class="contact-info-item">
                                <i class="bi bi-envelope"></i>
                                <span>{{ $owner->email }}</span>
                            </a>
                        </div>
                    @endif
                </div>


                <div class="col-lg-7">
                    <div class="contact-card reveal reveal-delay-1">

                        @if (session('contact_success'))
                            <div class="contact-alert success">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>{{ session('contact_success') }}</span>
                            </div>
                        @endif

                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="contact-label" for="name">
                                        Nama <span>*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        class="contact-input @error('name') input-error @enderror"
                                        value="{{ old('name') }}"
                                        placeholder="Nama kamu"
                                        required
                                    >

                                    @error('name')
                                        <div class="contact-error">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-6">
                                    <label class="contact-label" for="email">
                                        Email <span>*</span>
                                    </label>

                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        class="contact-input @error('email') input-error @enderror"
                                        value="{{ old('email') }}"
                                        placeholder="email@contoh.com"
                                        required
                                    >

                                    @error('email')
                                        <div class="contact-error">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-12">
                                    <label class="contact-label" for="subject">
                                        Subjek
                                    </label>

                                    <input
                                        type="text"
                                        id="subject"
                                        name="subject"
                                        class="contact-input @error('subject') input-error @enderror"
                                        value="{{ old('subject') }}"
                                        placeholder="Subjek pesan (opsional)"
                                    >

                                    @error('subject')
                                        <div class="contact-error">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-12">
                                    <label class="contact-label" for="message">
                                        Pesan <span>*</span>
                                    </label>

                                    <textarea
                                        id="message"
                                        name="message"
                                        rows="5"
                                        class="contact-input contact-textarea @error('message') input-error @enderror"
                                        placeholder="Tulis pesanmu di sini..."
                                        required
                                    >{{ old('message') }}</textarea>

                                    @error('message')
                                        <div class="contact-error">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-12">
                                    <button type="submit" class="btn-accent w-100 justify-content-center">
                                        Kirim Pesan
                                        <i class="bi bi-send"></i>
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>


    <style>
        /* =========================
           SECTION HEAD
        ========================= */

        .section-head { margin-bottom: 46px; }

        /* =========================
           HERO
        ========================= */

        .hero {
            padding-top: 170px;
            padding-bottom: 90px;
        }

        .hero-title {
            font-size: clamp(52px, 8vw, 92px);
            font-weight: 900;

            line-height: .98;
            letter-spacing: -3.5px;

            margin: 0 0 22px;
        }

        .hero-dot { color: var(--accent); }

        .hero-role {
            display: inline-flex;
            align-items: center;
            flex-wrap: wrap;

            padding: 9px 18px;

            background: var(--accent-soft);
            border: 1px solid rgba(124,108,255,.25);
            border-radius: 100px;

            font-size: 13px;
            font-weight: 600;

            margin: 0 0 24px;
        }

        .role-accent { color: var(--accent); }

        .hero-desc {
            color: var(--text-muted);

            font-size: 16px;
            line-height: 1.85;

            max-width: 540px;

            margin: 0;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;

            margin-top: 34px;
        }

        /* Sosial media di hero */
        .hero-social {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;

            margin-top: 26px;
        }

        .hero-social a {
            width: 42px;
            height: 42px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 50%;

            color: var(--text-muted);
            font-size: 17px;

            transition: .2s ease;
        }

        .hero-social a:hover {
            color: #fff;
            background: var(--accent);
            border-color: var(--accent);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(124, 108, 255, .35);
        }

        /* Pembungkus: menyediakan ruang untuk glow di sekeliling foto */
        .hero-photo-wrap {
            position: relative;

            width: 100%;
            max-width: 330px;

            margin: 0 auto;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Cincin glow berdenyut di belakang foto */
        .hero-photo-wrap::before {
            content: '';

            position: absolute;

            inset: -6%;

            border-radius: 50%;

            background:
                radial-gradient(circle, rgba(124,108,255,.55), transparent 68%);

            filter: blur(38px);

            opacity: .85;

            z-index: 0;

            animation: photoPulse 4.5s ease-in-out infinite;
        }

        @keyframes photoPulse {
            0%, 100% { opacity: .7; transform: scale(1); }
            50%      { opacity: 1;  transform: scale(1.05); }
        }

        /* Foto bulat dengan border bercahaya */
        .hero-photo {
            position: relative;
            z-index: 1;

            width: 100%;
            aspect-ratio: 1 / 1;

            border-radius: 50%;

            overflow: hidden;

            background: var(--bg-card);

            /* Border tipis + ring glow ungu */
            border: 3px solid rgba(124,108,255,.85);

            box-shadow:
                0 0 0 8px rgba(124,108,255,.08),
                0 0 60px rgba(124,108,255,.45),
                inset 0 0 40px rgba(124,108,255,.12);
        }

        .hero-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-photo-initial {
            width: 100%;
            height: 100%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 120px;
            font-weight: 900;

            color: var(--accent);
        }

        /* =========================
           HERO ENTRANCE ANIMATION
        ========================= */

        .hero-anim {
            opacity: 0;
            transform: translateY(28px);

            animation: heroUp .9s cubic-bezier(.2, .7, .2, 1) forwards;
        }

        .hero-anim-1 { animation-delay: .05s; }
        .hero-anim-2 { animation-delay: .15s; }
        .hero-anim-3 { animation-delay: .25s; }
        .hero-anim-4 { animation-delay: .35s; }
        .hero-anim-5 { animation-delay: .45s; }
        .hero-anim-6 { animation-delay: .55s; }

        .hero-anim-photo {
            opacity: 0;
            transform: scale(.95) translateY(18px);

            animation: heroPhoto .95s cubic-bezier(.2, .7, .2, 1) .25s forwards;
        }

        @keyframes heroUp {
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes heroPhoto {
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        /* =========================
           STATS
        ========================= */

        .stats-strip {
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);

            background: var(--bg-soft);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }

        .stat-box {
            padding: 36px 20px;
            text-align: center;

            border-right: 1px solid var(--border);
        }

        .stat-box:last-child { border-right: none; }

        .stat-value {
            font-size: 40px;
            font-weight: 800;

            letter-spacing: -1.5px;

            line-height: 1;
            margin-bottom: 10px;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 500;

            letter-spacing: .5px;
            text-transform: uppercase;
        }

        /* =========================
           SERVICES
        ========================= */

        .service-card {
            height: 100%;

            padding: 28px;

            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 18px;

            transition: .3s cubic-bezier(.2, .7, .2, 1);
        }

        .service-card:hover {
            transform: translateY(-6px);

            border-color: rgba(124,108,255,.4);

            background: var(--bg-card-2);

            box-shadow: 0 20px 50px rgba(0,0,0,.4);
        }

        .service-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 22px;
        }

        .service-icon {
            width: 54px;
            height: 54px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: var(--accent-soft);
            border: 1px solid rgba(124,108,255,.2);
            border-radius: 14px;

            color: var(--accent);
            font-size: 22px;
        }

        .service-arrow {
            color: var(--text-muted);
            font-size: 18px;

            transition: .3s ease;
        }

        .service-card:hover .service-arrow {
            color: var(--accent);
            transform: translate(3px, -3px);
        }

        .service-body h3 {
            margin: 0 0 9px;

            font-size: 19px;
            font-weight: 700;

            letter-spacing: -.4px;
        }

        .service-body p {
            margin: 0;

            color: var(--text-muted);
            font-size: 13.5px;
            line-height: 1.8;
        }

        /* =========================
           PORTFOLIO (asymmetric grid)
        ========================= */

        .portfolio-section { background: var(--bg-soft); }

        .work-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
        }

        .work-card {
            display: block;

            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 18px;

            overflow: hidden;

            transition: .3s cubic-bezier(.2, .7, .2, 1);
        }

        .work-card:hover {
            transform: translateY(-6px);

            border-color: rgba(124,108,255,.4);

            box-shadow: 0 24px 60px rgba(0,0,0,.5);
        }

        /* Kartu pertama lebih besar (asymmetric) */
        .work-card-lg {
            grid-column: span 2;
        }

        .work-image {
            position: relative;

            width: 100%;
            aspect-ratio: 16 / 10;

            overflow: hidden;
            background: var(--bg-alt);
        }

        .work-card-lg .work-image { aspect-ratio: 21 / 9; }

        .work-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;

            transition: transform .6s cubic-bezier(.2, .7, .2, 1);
        }

        .work-card:hover .work-image img { transform: scale(1.06); }

        .work-overlay {
            position: absolute;
            top: 16px;
            right: 16px;

            width: 42px;
            height: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: rgba(124,108,255,.9);
            color: var(--text-primary);

            border-radius: 50%;

            font-size: 17px;

            opacity: 0;
            transform: scale(.8);

            transition: .3s cubic-bezier(.2, .7, .2, 1);
        }

        .work-card:hover .work-overlay {
            opacity: 1;
            transform: scale(1);
        }

        .work-body { padding: 24px; }

        .work-category {
            color: var(--accent);

            font-size: 11px;
            font-weight: 600;

            letter-spacing: 1.2px;
            text-transform: uppercase;

            margin-bottom: 10px;
        }

        .work-title {
            margin: 0 0 9px;

            font-size: 21px;
            font-weight: 700;

            letter-spacing: -.5px;
        }

        .work-desc {
            margin: 0;

            color: var(--text-muted);
            font-size: 13.5px;
            line-height: 1.75;
        }

        /* =========================
           SKILLS
        ========================= */

        /* =========================
           SKILL CHART (bar vertikal)
        ========================= */

        .skill-chart {
            padding: 24px 22px 18px;

            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
        }

        .chart-head { margin-bottom: 24px; }

        .chart-title {
            color: var(--text-primary);

            font-size: 17px;
            font-weight: 700;

            letter-spacing: -.3px;

            margin-bottom: 5px;
        }

        .chart-subtitle {
            color: var(--text-muted);
            font-size: 12px;
        }

        /* Pembungkus: skala Y + area plot */
        .skill-chart {
            position: relative;
        }

        .chart-scale {
            position: absolute;
            left: 22px;
            top: 92px;
            bottom: 46px;

            width: 30px;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            color: var(--text-dim);
            font-size: 10px;
            font-weight: 500;

            text-align: right;
        }

        /* Area plot */
        .chart-plot {
            position: relative;

            margin-left: 40px;
            height: 240px;
        }

        /* Garis grid horizontal */
        .chart-grid {
            position: absolute;
            inset: 0;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            pointer-events: none;
        }

        .chart-grid span {
            width: 100%;
            height: 1px;

            background: var(--border);
        }

        /* Bar */
        .chart-bars {
            position: absolute;
            inset: 0;

            display: flex;
            align-items: flex-end;
            justify-content: space-around;

            gap: 12px;
        }

        .chart-col {
            flex: 1;

            display: flex;
            flex-direction: column;
            align-items: center;

            height: 100%;
        }

        .chart-col-track {
            position: relative;

            width: 100%;
            max-width: 54px;

            height: 100%;

            display: flex;
            align-items: flex-end;
        }

        /* Bar vertikal */
        .chart-col-bar {
            position: relative;

            width: 100%;

            background: linear-gradient(180deg, var(--accent-2), var(--accent));
            border-radius: 6px 6px 0 0;

            /* Tumbuh dari bawah via JS */
            transition: height 1.6s cubic-bezier(.16, .8, .24, 1);

            box-shadow: 0 0 16px rgba(124, 108, 255, .35);
        }

        /* Nilai persen di atas bar */
        .chart-col-value {
            position: absolute;
            top: -22px;
            left: 50%;

            transform: translateX(-50%);

            color: var(--text-primary);

            font-size: 11px;
            font-weight: 700;

            font-variant-numeric: tabular-nums;

            white-space: nowrap;
        }

        /* Label nama skill di bawah */
        .chart-col-label {
            position: absolute;
            bottom: -30px;

            width: 100%;

            color: var(--text-muted);

            font-size: 10.5px;
            font-weight: 500;

            text-align: center;

            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* =========================
           EXPERIENCE
        ========================= */

        .exp-list {
            display: flex;
            flex-direction: column;
            gap: 26px;
        }

        .exp-item {
            position: relative;

            padding-left: 24px;

            border-left: 1px solid var(--border-strong);
        }

        .exp-item::before {
            content: '';

            position: absolute;
            left: -5px;
            top: 4px;

            width: 9px;
            height: 9px;

            border-radius: 50%;

            background: var(--accent);
            box-shadow: 0 0 0 4px rgba(124,108,255,.15);
        }

        .exp-period {
            color: var(--accent);

            font-size: 11px;
            font-weight: 700;

            letter-spacing: 1.2px;
            text-transform: uppercase;

            margin-bottom: 7px;
        }

        .exp-position {
            margin: 0 0 4px;

            font-size: 18px;
            font-weight: 700;

            letter-spacing: -.3px;
        }

        .exp-company {
            color: var(--text-muted);
            font-size: 13.5px;
            margin-bottom: 9px;
        }

        .exp-desc {
            margin: 0;
            color: var(--text-muted);
            font-size: 13.5px;
            line-height: 1.8;
        }

        /* =========================
           TESTIMONI
        ========================= */

        .testimonial-section { background: var(--bg-soft); }

        .testi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .testi-card {
            display: flex;
            flex-direction: column;

            padding: 26px;

            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;

            transition: .3s cubic-bezier(.2, .7, .2, 1);
        }

        .testi-card:hover {
            transform: translateY(-5px);
            border-color: rgba(124, 108, 255, .4);
            box-shadow: 0 20px 50px rgba(0, 0, 0, .35);
        }

        .testi-stars {
            display: flex;
            gap: 3px;

            margin-bottom: 16px;

            color: #f3a735;
            font-size: 14px;
        }

        .testi-message {
            flex: 1;

            margin: 0 0 22px;

            color: var(--text-secondary);
            font-size: 13.5px;
            line-height: 1.85;

            font-style: italic;
        }

        .testi-author {
            display: flex;
            align-items: center;
            gap: 13px;

            padding-top: 18px;

            border-top: 1px solid var(--border);
        }

        .testi-avatar {
            width: 46px;
            height: 46px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            overflow: hidden;

            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            color: #fff;

            font-size: 17px;
            font-weight: 700;
        }

        .testi-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .testi-name {
            color: var(--text-primary);
            font-size: 14px;
            font-weight: 600;
        }

        .testi-role {
            color: var(--text-muted);
            font-size: 11.5px;
            margin-top: 2px;
        }

        /* =========================
           CONTACT
        ========================= */

        .contact-section { background: var(--bg-soft); }

        .contact-info { margin-top: 26px; }

        .contact-info-item {
            display: inline-flex;
            align-items: center;
            gap: 11px;

            color: var(--text-muted);
            font-size: 14px;

            transition: .2s ease;
        }

        .contact-info-item:hover { color: var(--accent); }

        .contact-info-item i { color: var(--accent); font-size: 18px; }

        /* =========================
           JAM ESTETIK (angka Romawi)
        ========================= */

        /* Baris meta di hero: jam + lokasi */
        /* Baris meta di hero (di bawah foto): jam + lokasi */
        .hero-meta {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 26px;

            max-width: 330px;

            margin: 26px auto 0;

            padding-top: 26px;

            border-top: 1px solid var(--border);
        }

        .clock-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .clock {
            position: relative;

            --clock-r: 45px;

            width: 134px;
            height: 134px;

            flex-shrink: 0;

            border-radius: 50%;

            /* Cincin emas bergaya jam dinding */
            background:
                radial-gradient(circle at 50% 50%, transparent 62%, rgba(198, 160, 76, .12) 62%),
                var(--bg-card);

            border: 3px solid #c6a04c;

            box-shadow:
                0 0 0 6px rgba(198, 160, 76, .1),
                0 12px 30px rgba(0, 0, 0, .3),
                inset 0 0 24px rgba(198, 160, 76, .12);
        }

        /* Cincin dalam */
        .clock-face {
            position: absolute;
            inset: 10px;

            border-radius: 50%;

            border: 1px solid rgba(198, 160, 76, .35);
        }

        /* Angka Romawi diposisikan melingkar */
        .clock-num {
            position: absolute;

            left: 50%;
            top: 50%;

            width: 26px;
            height: 18px;

            margin: -9px 0 0 -13px;

            line-height: 18px;
            text-align: center;

            color: #c6a04c;

            font-family: 'Times New Roman', serif;
            font-size: 11px;
            font-weight: 700;

            pointer-events: none;
        }

        /* Rotasi tiap angka + tarik keluar dari pusat */
        .clock-num-1  { transform: rotate(0deg)   translateY(calc(-1 * var(--clock-r))); }
        .clock-num-2  { transform: rotate(30deg)  translateY(calc(-1 * var(--clock-r))); }
        .clock-num-3  { transform: rotate(60deg)  translateY(calc(-1 * var(--clock-r))); }
        .clock-num-4  { transform: rotate(90deg)  translateY(calc(-1 * var(--clock-r))); }
        .clock-num-5  { transform: rotate(120deg) translateY(calc(-1 * var(--clock-r))); }
        .clock-num-6  { transform: rotate(150deg) translateY(calc(-1 * var(--clock-r))); }
        .clock-num-7  { transform: rotate(180deg) translateY(calc(-1 * var(--clock-r))); }
        .clock-num-8  { transform: rotate(210deg) translateY(calc(-1 * var(--clock-r))); }
        .clock-num-9  { transform: rotate(240deg) translateY(calc(-1 * var(--clock-r))); }
        .clock-num-10 { transform: rotate(270deg) translateY(calc(-1 * var(--clock-r))); }
        .clock-num-11 { transform: rotate(300deg) translateY(calc(-1 * var(--clock-r))); }
        .clock-num-12 { transform: rotate(330deg) translateY(calc(-1 * var(--clock-r))); }

        /* Titik tengah */
        .clock-center {
            position: absolute;
            left: 50%;
            top: 50%;

            width: 10px;
            height: 10px;

            margin: -5px 0 0 -5px;

            background: #c6a04c;
            border-radius: 50%;

            box-shadow: 0 0 8px rgba(198, 160, 76, .6);

            z-index: 5;
        }

        /* Jarum jam */
        .clock-hand {
            position: absolute;
            left: 50%;
            bottom: 50%;

            transform-origin: bottom center;

            border-radius: 4px;

            z-index: 3;
        }

        .clock-hour {
            width: 4px;
            height: 38px;

            margin-left: -2px;

            background: #c6a04c;
        }

        .clock-minute {
            width: 3px;
            height: 52px;

            margin-left: -1.5px;

            background: #d8b866;
        }

        .clock-second {
            width: 1.5px;
            height: 58px;

            margin-left: -.75px;

            background: #ff5c7a;
        }

        /* Info jam digital */
        .clock-info { min-width: 0; }

        .clock-time {
            color: #c6a04c;

            font-size: 26px;
            font-weight: 700;

            letter-spacing: 1px;

            font-variant-numeric: tabular-nums;
        }

        .clock-date {
            color: var(--text-muted);
            font-size: 12px;

            margin-top: 4px;
        }

        /* =========================
           LOKASI
        ========================= */

        .location-chip {
            display: inline-flex;
            align-items: center;
            gap: 9px;

            padding: 11px 16px;

            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 100px;

            color: var(--text-muted);

            font-size: 12.5px;

            font-variant-numeric: tabular-nums;
            letter-spacing: .3px;

            transition: .2s ease;
        }

        .location-chip i { color: var(--accent); font-size: 16px; }

        .location-chip:hover {
            color: var(--text-primary);
            border-color: var(--accent);
            background: var(--accent-soft);
            transform: translateY(-2px);
        }

        .contact-card {
            padding: 32px;

            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
        }

        .contact-label {
            display: block;
            margin-bottom: 8px;

            color: var(--text-secondary);
            font-size: 12px;
            font-weight: 600;
        }

        .contact-label span { color: var(--accent); }

        .contact-input {
            width: 100%;

            padding: 13px 15px;

            background: var(--bg-alt);
            color: var(--text-primary);

            border: 1px solid var(--border);
            border-radius: 12px;

            outline: none;

            font-family: inherit;
            font-size: 13.5px;

            transition: .2s ease;
        }

        .contact-input::placeholder { color: #5c5c6e; }

        .contact-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(124,108,255,.14);
        }

        .contact-input.input-error { border-color: #ff5c7a; }

        .contact-textarea { resize: vertical; min-height: 130px; }

        .contact-error {
            margin-top: 7px;
            color: #ff7d94;
            font-size: 11px;
        }

        .contact-alert {
            display: flex;
            align-items: center;
            gap: 10px;

            margin-bottom: 22px;
            padding: 14px 16px;

            border-radius: 12px;

            font-size: 13px;
        }

        .contact-alert.success {
            background: rgba(54,201,143,.1);
            border: 1px solid rgba(54,201,143,.2);
            color: #36c98f;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 992px) {
            .hero { padding-top: 140px; }

            .hero-photo-wrap {
                max-width: 320px;
                margin: 0 auto;
            }

            .stats-grid { grid-template-columns: repeat(2, 1fr); }

            .stat-box:nth-child(2) { border-right: none; }
            .stat-box:nth-child(1),
            .stat-box:nth-child(2) { border-bottom: 1px solid var(--border); }

            .work-grid { grid-template-columns: 1fr; }
            .work-card-lg { grid-column: span 1; }
            .work-card-lg .work-image { aspect-ratio: 16 / 10; }

            .testi-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 576px) {
            .hero { padding-top: 120px; }
            .hero-title { letter-spacing: -2px; }
            .hero-photo-wrap { max-width: 250px; }
            .hero-photo-initial { font-size: 90px; }
            .contact-card { padding: 22px; }
            .work-body { padding: 20px; }

            /* Chart skill di HP: lebih ringkas */
            .skill-chart { padding: 20px 14px 14px; }
            .chart-scale { left: 14px; top: 88px; }
            .chart-plot { margin-left: 34px; height: 200px; }
            .chart-col-value { font-size: 10px; }
            .chart-col-label { font-size: 9.5px; }

            /* Jam di HP */
            .clock-wrap { flex-direction: column; align-items: flex-start; gap: 16px; }
            .clock { width: 130px; height: 130px; --clock-r: 44px; }
            .clock-num { font-size: 10.5px; }
        }
    </style>

@endsection

@push('scripts')
<script>
    /*
     * =====================================================
     * JAM ESTETIK (real-time)
     * =====================================================
     */

    (function () {
        var hourHand   = document.getElementById('clockHour');
        var minuteHand = document.getElementById('clockMinute');
        var secondHand = document.getElementById('clockSecond');
        var digital    = document.getElementById('clockDigital');
        var dateEl     = document.getElementById('clockDate');

        if (!hourHand) return;

        var hari  = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        var bulan = ['Januari','Februari','Maret','April','Mei','Juni',
                     'Juli','Agustus','September','Oktober','November','Desember'];

        function pad(n) { return n < 10 ? '0' + n : '' + n; }

        function tick() {
            var now = new Date();

            var h = now.getHours();
            var m = now.getMinutes();
            var s = now.getSeconds();

            // Sudut jarum (derajat)
            var secDeg  = s * 6;
            var minDeg  = m * 6 + s * 0.1;
            var hourDeg = (h % 12) * 30 + m * 0.5;

            secondHand.style.transform = 'rotate(' + secDeg + 'deg)';
            minuteHand.style.transform = 'rotate(' + minDeg + 'deg)';
            hourHand.style.transform   = 'rotate(' + hourDeg + 'deg)';

            // Jam digital
            if (digital) {
                digital.textContent = pad(h) + ':' + pad(m) + ':' + pad(s);
            }

            // Tanggal
            if (dateEl) {
                dateEl.textContent =
                    hari[now.getDay()] + ', ' +
                    now.getDate() + ' ' +
                    bulan[now.getMonth()] + ' ' +
                    now.getFullYear();
            }
        }

        tick();
        setInterval(tick, 1000);
    })();
</script>
@endpush
