@extends('layouts.public')

@section('title', $project->title . ' — ' . ($owner->name ?? 'Portfolio'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($project->description), 150))

@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}
    <section class="work-header">
        <div class="container-pub">

            <a href="{{ route('home') }}#portfolio" class="work-back">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Portfolio</span>
            </a>

            <div class="work-meta-top">
                <span class="work-cat-badge">
                    <i class="bi bi-tag"></i>
                    {{ $project->category->name }}
                </span>

                <span class="work-year-badge">
                    <i class="bi bi-calendar3"></i>
                    {{ $project->year }}
                </span>

                @if ($project->status === 'Published')
                    <span class="work-status">
                        <span class="dot"></span> Published
                    </span>
                @endif
            </div>

            <h1 class="work-hero-title">{{ $project->title }}</h1>

        </div>
    </section>


    {{-- =====================================================
         GAMBAR UTAMA
    ====================================================== --}}
    <section class="container-pub">
        <div class="work-main-image reveal">
            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
        </div>
    </section>


    {{-- =====================================================
         DETAIL
    ====================================================== --}}
    <section class="pub-section">
        <div class="container-pub">
            <div class="row g-5">

                {{-- KIRI: Deskripsi --}}
                <div class="col-lg-8">
                    <h2 class="work-sub-title reveal">Tentang Karya Ini</h2>

                    <div class="work-description reveal">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>

                {{-- KANAN: Info --}}
                <div class="col-lg-4">
                    <div class="work-info-card reveal">

                        <div class="work-info-row">
                            <span class="work-info-label">Kategori</span>
                            <span class="work-info-value">{{ $project->category->name }}</span>
                        </div>

                        <div class="work-info-row">
                            <span class="work-info-label">Tahun</span>
                            <span class="work-info-value">{{ $project->year }}</span>
                        </div>

                        @if ($project->tools)
                            <div class="work-info-row">
                                <span class="work-info-label">Tools</span>
                                <div class="work-tools">
                                    @foreach (explode(',', $project->tools) as $tool)
                                        <span class="tool-chip">{{ trim($tool) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($project->project_link || $project->instagram_link)
                            <div class="work-info-actions">
                                @if ($project->project_link)
                                    <a href="{{ $project->project_link }}"
                                       target="_blank" rel="noopener"
                                       class="btn-accent w-100 justify-content-center">
                                        <i class="bi bi-box-arrow-up-right"></i>
                                        Kunjungi Project
                                    </a>
                                @endif

                                @if ($project->instagram_link)
                                    <a href="{{ $project->instagram_link }}"
                                       target="_blank" rel="noopener"
                                       class="btn-ghost w-100 justify-content-center">
                                        <i class="bi bi-instagram"></i>
                                        Lihat Instagram
                                    </a>
                                @endif
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- =====================================================
         KARYA LAIN
    ====================================================== --}}
    @if ($otherProjects->count())
        <section class="pub-section portfolio-section">
            <div class="container-pub">

                <div class="section-head">
                    <span class="section-eyebrow reveal">More Work</span>
                    <h2 class="section-title reveal">
                        Karya <span class="muted">lainnya</span>
                    </h2>
                </div>

                <div class="work-grid">
                    @foreach ($otherProjects as $other)
                        <a href="{{ route('work.show', $other->id) }}" class="work-card reveal">
                            <div class="work-image">
                                <img src="{{ asset('storage/' . $other->image) }}"
                                     alt="{{ $other->title }}" loading="lazy">
                                <span class="work-overlay">
                                    <i class="bi bi-arrow-up-right"></i>
                                </span>
                            </div>

                            <div class="work-body">
                                <div class="work-category">
                                    {{ $other->category->name }} • {{ $other->year }}
                                </div>
                                <h3 class="work-title">{{ $other->title }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        </section>
    @endif


    <style>
        /* HEADER */
        .work-header {
            padding-top: 150px;
            padding-bottom: 30px;
        }

        .work-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 22px;

            color: var(--text-muted);
            font-size: 12.5px;
            font-weight: 500;

            transition: .2s ease;
        }

        .work-back:hover { color: var(--accent); }

        .work-meta-top {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;

            margin-bottom: 16px;
        }

        .work-cat-badge,
        .work-year-badge,
        .work-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            padding: 6px 13px;

            border-radius: 100px;

            font-size: 11px;
            font-weight: 600;
        }

        .work-cat-badge {
            background: var(--accent-soft);
            color: var(--accent);
            border: 1px solid rgba(124, 108, 255, .25);
        }

        .work-year-badge {
            background: var(--surface-2);
            color: var(--text-muted);
            border: 1px solid var(--border);
        }

        .work-status {
            background: rgba(54, 201, 143, .1);
            color: var(--green);
            border: 1px solid rgba(54, 201, 143, .2);
        }

        .work-status .dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--green);
        }

        .work-hero-title {
            margin: 0;

            font-size: clamp(34px, 5vw, 58px);
            font-weight: 800;

            letter-spacing: -2px;
            line-height: 1.05;
        }

        /* GAMBAR UTAMA */
        .work-main-image {
            width: 100%;
            aspect-ratio: 16 / 9;

            border-radius: 20px;
            overflow: hidden;

            border: 1px solid var(--border);

            background: var(--bg-alt);
        }

        .work-main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* DETAIL */
        .work-sub-title {
            margin: 0 0 18px;

            font-size: 22px;
            font-weight: 700;

            letter-spacing: -.5px;
        }

        .work-description {
            color: var(--text-secondary);

            font-size: 15px;
            line-height: 1.9;
        }

        .work-info-card {
            padding: 24px;

            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
        }

        .work-info-row {
            padding-bottom: 16px;
            margin-bottom: 16px;

            border-bottom: 1px solid var(--border);
        }

        .work-info-label {
            display: block;

            color: var(--text-dim);

            font-size: 10px;
            font-weight: 600;

            text-transform: uppercase;
            letter-spacing: .5px;

            margin-bottom: 7px;
        }

        .work-info-value {
            color: var(--text-primary);
            font-size: 14px;
            font-weight: 600;
        }

        .work-tools {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .tool-chip {
            padding: 5px 12px;

            background: var(--surface-2);
            color: var(--text-muted);

            border: 1px solid var(--border);
            border-radius: 100px;

            font-size: 11px;
            font-weight: 500;
        }

        .work-info-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;

            margin-top: 4px;
        }

        @media (max-width: 768px) {
            .work-header { padding-top: 120px; }
            .work-main-image { aspect-ratio: 4 / 3; }
        }
    </style>

@endsection
