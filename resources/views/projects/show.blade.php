<x-app-layout>

    <!-- Header Halaman -->
    <div class="project-detail-header">

        <div>
            <a
                href="{{ route('projects.index') }}"
                class="back-link"
            >
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Daftar Karya</span>
            </a>

            <h1 class="project-detail-title">
                Detail Karya
            </h1>

            <p class="project-detail-subtitle">
                Lihat detail lengkap karya portfolio.
            </p>
        </div>

        <a
            href="{{ route('projects.edit', $project->id) }}"
            class="edit-project-btn"
        >
            <i class="bi bi-pencil-square"></i>
            <span>Edit Karya</span>
        </a>

    </div>


    <!-- Card Detail -->
    <div class="project-detail-card">

        <div class="row g-0">

            <!-- Gambar -->
            <div class="col-lg-5">

                <div class="detail-image-wrapper">
                    <img
                        src="{{ asset('storage/' . $project->image) }}"
                        alt="{{ $project->title }}"
                        class="detail-image"
                    >
                </div>

            </div>


            <!-- Informasi -->
            <div class="col-lg-7">

                <div class="detail-body">

                    <!-- Badge status -->
                    <div class="detail-badges">

                        @if($project->status === 'Published')

                            <span class="status-badge status-published">
                                <span class="status-dot"></span>
                                Published
                            </span>

                        @else

                            <span class="status-badge status-draft">
                                <span class="status-dot"></span>
                                Draft
                            </span>

                        @endif

                        <span class="category-badge">
                            <i class="bi bi-tag"></i>
                            {{ $project->category->name }}
                        </span>

                    </div>


                    <!-- Judul -->
                    <h2 class="detail-title">
                        {{ $project->title }}
                    </h2>


                    <!-- Tahun -->
                    <div class="detail-meta">

                        <span>
                            <i class="bi bi-calendar3"></i>
                            {{ $project->year }}
                        </span>

                    </div>


                    <!-- Deskripsi -->
                    <div class="detail-section">

                        <h3 class="detail-section-title">
                            Deskripsi
                        </h3>

                        <p class="detail-description">
                            {{ $project->description }}
                        </p>

                    </div>


                    <!-- Tools -->
                    @if($project->tools)

                        <div class="detail-section">

                            <h3 class="detail-section-title">
                                Tools
                            </h3>

                            <div class="detail-tools">

                                @foreach(explode(',', $project->tools) as $tool)

                                    <span class="tool-chip">
                                        {{ trim($tool) }}
                                    </span>

                                @endforeach

                            </div>

                        </div>

                    @endif


                    <!-- Link -->
                    @if($project->project_link || $project->instagram_link)

                        <div class="detail-section">

                            <h3 class="detail-section-title">
                                Tautan
                            </h3>

                            <div class="detail-links">

                                @if($project->project_link)

                                    <a
                                        href="{{ $project->project_link }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="detail-link"
                                    >
                                        <i class="bi bi-link-45deg"></i>
                                        Lihat Project
                                    </a>

                                @endif

                                @if($project->instagram_link)

                                    <a
                                        href="{{ $project->instagram_link }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="detail-link instagram-link"
                                    >
                                        <i class="bi bi-instagram"></i>
                                        Instagram
                                    </a>

                                @endif

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>


    <style>

        /* =========================================
           HEADER
        ========================================= */

        .project-detail-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;

            margin-bottom: 25px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            margin-bottom: 12px;

            color: var(--text-muted);
            font-size: 11px;
            font-weight: 500;

            text-decoration: none;

            transition: .2s ease;
        }

        .back-link:hover {
            color: #a397ef;
        }

        .project-detail-title {
            margin: 0 0 5px;

            color: var(--text-primary);

            font-size: 24px;
            font-weight: 600;

            letter-spacing: -.3px;
        }

        .project-detail-subtitle {
            margin: 0;

            color: var(--text-secondary);

            font-size: 13px;
        }


        /* =========================================
           BUTTON EDIT
        ========================================= */

        .edit-project-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 11px 18px;

            background: #6551e8;
            color: var(--text-primary);

            border: 1px solid #6551e8;
            border-radius: 8px;

            font-size: 12px;
            font-weight: 600;

            text-decoration: none;

            white-space: nowrap;

            transition: .2s ease;
        }

        .edit-project-btn:hover {
            background: #7461ed;
            border-color: #7461ed;
            color: var(--text-primary);
            transform: translateY(-1px);
        }


        /* =========================================
           CARD
        ========================================= */

        .project-detail-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
        }


        /* =========================================
           GAMBAR
        ========================================= */

        .detail-image-wrapper {
            height: 100%;
            min-height: 320px;

            background: var(--bg-input);
        }

        .detail-image {
            width: 100%;
            height: 100%;

            object-fit: cover;

            display: block;
        }


        /* =========================================
           BODY
        ========================================= */

        .detail-body {
            padding: 28px;
        }


        /* =========================================
           BADGE
        ========================================= */

        .detail-badges {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;

            margin-bottom: 15px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 5px 9px;

            border-radius: 20px;

            font-size: 10px;
            font-weight: 600;
        }

        .status-dot {
            width: 6px;
            height: 6px;

            border-radius: 50%;
        }

        .status-published {
            background: rgba(54,201,143,.1);
            color: #36c98f;

            border: 1px solid rgba(54,201,143,.18);
        }

        .status-published .status-dot {
            background: #36c98f;
            box-shadow: 0 0 6px rgba(54,201,143,.5);
        }

        .status-draft {
            background: rgba(243,167,53,.1);
            color: #f3a735;

            border: 1px solid rgba(243,167,53,.18);
        }

        .status-draft .status-dot {
            background: #f3a735;
            box-shadow: 0 0 6px rgba(243,167,53,.4);
        }

        .category-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 5px 10px;

            background: rgba(101,81,232,.12);
            color: #a397ef;

            border: 1px solid rgba(101,81,232,.2);
            border-radius: 20px;

            font-size: 10px;
            font-weight: 600;
        }


        /* =========================================
           JUDUL & META
        ========================================= */

        .detail-title {
            margin: 0 0 10px;

            color: var(--text-primary);

            font-size: 22px;
            font-weight: 600;

            line-height: 1.35;
        }

        .detail-meta {
            display: flex;
            align-items: center;
            gap: 15px;

            margin-bottom: 22px;

            color: var(--text-secondary);

            font-size: 11px;
        }

        .detail-meta i {
            color: var(--text-muted);

            margin-right: 4px;
        }


        /* =========================================
           SECTION
        ========================================= */

        .detail-section {
            margin-bottom: 20px;
        }

        .detail-section:last-child {
            margin-bottom: 0;
        }

        .detail-section-title {
            margin: 0 0 9px;

            color: var(--text-muted);

            font-size: 10px;
            font-weight: 600;

            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .detail-description {
            margin: 0;

            color: var(--text-secondary);

            font-size: 12px;

            line-height: 1.8;
        }


        /* =========================================
           TOOLS
        ========================================= */

        .detail-tools {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .tool-chip {
            padding: 5px 11px;

            background: var(--bg-input);
            color: var(--text-secondary);

            border: 1px solid var(--border);
            border-radius: 20px;

            font-size: 10px;
            font-weight: 500;
        }


        /* =========================================
           LINK
        ========================================= */

        .detail-links {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
        }

        .detail-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            padding: 9px 14px;

            background: rgba(77,156,255,.1);
            color: #6badff;

            border: 1px solid rgba(77,156,255,.18);
            border-radius: 7px;

            font-size: 11px;
            font-weight: 600;

            text-decoration: none;

            transition: .2s ease;
        }

        .detail-link:hover {
            background: rgba(77,156,255,.18);
            color: #8bc1ff;

            transform: translateY(-1px);
        }

        .detail-link.instagram-link {
            background: rgba(233,75,98,.1);
            color: #f0738a;

            border-color: rgba(233,75,98,.18);
        }

        .detail-link.instagram-link:hover {
            background: rgba(233,75,98,.18);
            color: #f58ea1;
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 992px) {

            .detail-image-wrapper {
                min-height: 260px;
            }

        }


        @media (max-width: 768px) {

            .project-detail-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .edit-project-btn {
                width: 100%;
                justify-content: center;
            }

            .detail-body {
                padding: 22px;
            }

        }


        @media (max-width: 480px) {

            .project-detail-title {
                font-size: 21px;
            }

            .project-detail-subtitle {
                font-size: 12px;
            }

        }

    </style>

</x-app-layout>
