<x-app-layout>

    <!-- ==============================
         HEADER DASHBOARD
    =============================== -->

    <div class="dashboard-header">

        <h1 class="dashboard-title">
            Dashboard
        </h1>

        <p class="dashboard-subtitle">
            Selamat datang kembali,
            <strong>{{ Auth::user()->name }}</strong> 👋
        </p>

        <p class="dashboard-description">
            Kelola semua konten portfolio kamu di sini.
        </p>

    </div>


    <!-- ==============================
         STATISTIK
    =============================== -->

    <div class="row g-4 mb-4">


        <!-- TOTAL KARYA -->
        <div class="col-xl-3 col-md-6">

            <div class="dashboard-stat-card">

                <div class="stat-content">

                    <div>

                        <p class="stat-label">
                            Total Karya
                        </p>

                        <h2 class="stat-number">
                            {{ $totalProjects }}
                        </h2>

                        <p class="stat-info">
                            Karya portfolio
                        </p>

                    </div>


                    <div class="stat-icon stat-icon-purple">

                        <i class="bi bi-briefcase"></i>

                    </div>

                </div>

            </div>

        </div>


        <!-- KATEGORI -->
        <div class="col-xl-3 col-md-6">

            <div class="dashboard-stat-card">

                <div class="stat-content">

                    <div>

                        <p class="stat-label">
                            Kategori
                        </p>

                        <h2 class="stat-number">
                            {{ $totalCategories }}
                        </h2>

                        <p class="stat-info">
                            Kategori portfolio
                        </p>

                    </div>


                    <div class="stat-icon stat-icon-blue">

                        <i class="bi bi-tags"></i>

                    </div>

                </div>

            </div>

        </div>


        <!-- PUBLISHED -->
        <div class="col-xl-3 col-md-6">

            <div class="dashboard-stat-card">

                <div class="stat-content">

                    <div>

                        <p class="stat-label">
                            Published
                        </p>

                        <h2 class="stat-number">
                            {{ $totalPublished }}
                        </h2>

                        <p class="stat-info">
                            Karya terbit
                        </p>

                    </div>


                    <div class="stat-icon stat-icon-green">

                        <i class="bi bi-check-circle"></i>

                    </div>

                </div>

            </div>

        </div>


        <!-- DRAFT -->
        <div class="col-xl-3 col-md-6">

            <div class="dashboard-stat-card">

                <div class="stat-content">

                    <div>

                        <p class="stat-label">
                            Draft
                        </p>

                        <h2 class="stat-number">
                            {{ $totalDraft }}
                        </h2>

                        <p class="stat-info">
                            Karya belum terbit
                        </p>

                    </div>


                    <div class="stat-icon stat-icon-red">

                        <i class="bi bi-file-earmark-text"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ==============================
         KONTEN DASHBOARD
    ============================== -->

    <div class="row g-4">


        <!-- KARYA TERBARU -->
        <div class="col-xl-8">

            <div class="dashboard-content-card">

                <div class="content-card-header">

                    <div>

                        <h3 class="content-card-title">
                            Karya Terbaru
                        </h3>

                        <p class="content-card-subtitle">
                            Daftar karya yang baru ditambahkan
                        </p>

                    </div>


                    <a href="{{ route('projects.index') }}"
                       class="btn-view-all">

                        Lihat Semua

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>


                <!-- TABLE -->

                <div class="table-responsive">

                    <table class="dashboard-table">

                        <thead>

                            <tr>

                                <th>
                                    Judul Karya
                                </th>

                                <th>
                                    Kategori
                                </th>

                                <th>
                                    Tahun
                                </th>

                                <th>
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($latestProjects as $project)

                                <tr>

                                    <td class="cell-title">

                                        <div class="work-title">

                                            {{ $project->title }}

                                        </div>

                                        <div class="work-description">

                                            {{ \Illuminate\Support\Str::limit($project->description, 45) }}

                                        </div>

                                    </td>


                                    <td data-label="Kategori">
                                        {{ $project->category->name }}
                                    </td>


                                    <td data-label="Tahun">
                                        {{ $project->year }}
                                    </td>


                                    <td data-label="Status">

                                        @if($project->status === 'Published')

                                            <span class="status-published">
                                                Published
                                            </span>

                                        @else

                                            <span class="status-pending">
                                                Draft
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr class="row-empty">

                                    <td colspan="4" class="cell-empty"
                                        style="text-align:center; color: var(--text-dim); padding:30px 10px;">

                                        Belum ada karya yang ditambahkan.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        <!-- RINGKASAN -->
        <div class="col-xl-4">

            <div class="dashboard-content-card">

                <div class="content-card-header">

                    <div>

                        <h3 class="content-card-title">
                            Ringkasan Portfolio
                        </h3>

                        <p class="content-card-subtitle">
                            Statistik konten portfolio
                        </p>

                    </div>

                </div>


                <!-- SUMMARY ITEM -->

                @foreach ($summary as $item)

                    <div class="summary-item">

                        <div class="summary-top">

                            <span>
                                {{ $item['label'] }}
                            </span>

                            <strong>
                                {{ $item['value'] }}
                            </strong>

                        </div>

                        <div class="summary-bar">

                            <div
                                class="summary-progress {{ $item['color'] }}"
                                style="width: {{ $item['percent'] }}%;">
                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>


    <!-- ==============================
         STYLE DASHBOARD
    ============================== -->

    <style>

        /* =================================
           HEADER
        ================================= */

        .dashboard-header {

            margin-bottom: 28px;

        }


        .dashboard-title {

            color: var(--text-primary);

            font-size: 24px;

            font-weight: 600;

            margin: 0 0 6px;

        }


        .dashboard-subtitle {

            color: var(--text-secondary);

            font-size: 13px;

            margin: 0;

        }


        .dashboard-subtitle strong {

            color: var(--text-primary);

            font-weight: 600;

        }


        .dashboard-description {

            color: var(--text-muted);

            font-size: 12px;

            margin: 4px 0 0;

        }


        /* =================================
           STAT CARD
        ================================= */

        .dashboard-stat-card {

            height: 100%;

            background: var(--bg-card);

            border: 1px solid var(--border);

            border-radius: 10px;

            padding: 21px;

            transition: .2s ease;

        }


        .dashboard-stat-card:hover {

            background: var(--bg-hover);

            transform: translateY(-2px);

        }


        .stat-content {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

        }


        .stat-label {

            color: var(--text-secondary);

            font-size: 12px;

            margin: 0 0 5px;

        }


        .stat-number {

            color: var(--text-primary);

            font-size: 27px;

            font-weight: 700;

            margin: 0;

        }


        .stat-info {

            color: var(--text-dim);

            font-size: 10px;

            margin: 3px 0 0;

        }


        /* =================================
           ICON
        ================================= */

        .stat-icon {

            width: 48px;

            height: 48px;

            flex-shrink: 0;

            border-radius: 10px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 20px;

        }


        .stat-icon-purple {

            color: #9b8ef1;

            background: rgba(101,81,232,.15);

        }


        .stat-icon-blue {

            color: #55a8ff;

            background: rgba(77,156,255,.15);

        }


        .stat-icon-red {

            color: #f06b7d;

            background: rgba(240,82,104,.15);

        }


        .stat-icon-green {

            color: #46d49d;

            background: rgba(54,201,143,.15);

        }


        /* =================================
           CONTENT CARD
        ================================= */

        .dashboard-content-card {

            background: var(--bg-card);

            border: 1px solid var(--border);

            border-radius: 10px;

            padding: 22px;

            height: 100%;

        }


        .content-card-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            padding-bottom: 18px;

            margin-bottom: 5px;

            border-bottom: 1px solid var(--border);

        }


        .content-card-title {

            color: var(--text-primary);

            font-size: 14px;

            font-weight: 600;

            margin: 0 0 5px;

        }


        .content-card-subtitle {

            color: var(--text-muted);

            font-size: 10px;

            margin: 0;

        }


        .btn-view-all {

            color: #9b8ef1;

            font-size: 10px;

            white-space: nowrap;

        }


        .btn-view-all:hover {

            color: #c0b8ff;

        }


        /* =================================
           TABLE
        ================================= */

        .dashboard-table {

            width: 100%;

            border-collapse: collapse;

            margin-top: 10px;

        }


        .dashboard-table th {

            color: var(--text-dim);

            font-size: 10px;

            font-weight: 500;

            text-align: left;

            padding: 12px 10px;

            border-bottom: 1px solid var(--border);

        }


        .dashboard-table td {

            color: var(--text-secondary);

            font-size: 11px;

            padding: 14px 10px;

            border-bottom: 1px solid var(--surface-2);

            vertical-align: middle;

        }


        .dashboard-table tbody tr:last-child td {

            border-bottom: none;

        }


        .work-title {

            color: var(--text-primary);

            font-weight: 500;

            margin-bottom: 3px;

        }


        .work-description {

            color: var(--text-dim);

            font-size: 9px;

        }


        /* =================================
           STATUS
        ================================= */

        .status-published {

            display: inline-block;

            padding: 5px 9px;

            border-radius: 5px;

            color: #43d39c;

            background: rgba(54,201,143,.12);

            font-size: 9px;

            font-weight: 500;

        }


        .status-pending {

            display: inline-block;

            padding: 5px 9px;

            border-radius: 5px;

            color: #f3b454;

            background: rgba(243,167,53,.12);

            font-size: 9px;

            font-weight: 500;

        }


        /* =================================
           SUMMARY
        ================================= */

        .summary-item {

            padding: 15px 0;

            border-bottom: 1px solid var(--surface-2);

        }


        .summary-item:last-child {

            border-bottom: none;

        }


        .summary-top {

            display: flex;

            justify-content: space-between;

            margin-bottom: 8px;

        }


        .summary-top span {

            color: var(--text-secondary);

            font-size: 11px;

        }


        .summary-top strong {

            color: var(--text-primary);

            font-size: 11px;

        }


        .summary-bar {

            height: 6px;

            background: var(--bg-hover);

            border-radius: 10px;

            overflow: hidden;

        }


        .summary-progress {

            height: 100%;

            border-radius: 10px;

        }


        .summary-progress.purple {

            background: #6551e8;

        }


        .summary-progress.blue {

            background: #4d9cff;

        }


        .summary-progress.red {

            background: #e94b62;

        }


        .summary-progress.green {

            background: #36c98f;

        }


        /* =================================
           RESPONSIVE
        ================================= */

        @media (max-width: 768px) {

            .dashboard-title {

                font-size: 21px;

            }


            .dashboard-stat-card {

                padding: 18px;

            }


            .dashboard-content-card {

                padding: 17px;

            }


            /* =========================
               TABEL KARYA -> KARTU
            ========================= */

            .dashboard-table { min-width: 0; }

            .dashboard-table thead { display: none; }

            .dashboard-table tbody tr {
                display: block;

                margin-top: 12px;
                padding: 14px;

                background: var(--bg-alt);
                border: 1px solid var(--border);
                border-radius: 10px;
            }

            .dashboard-table td {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 15px;

                padding: 8px 0;

                border-bottom: 1px solid var(--surface-2);

                text-align: right;
            }

            .dashboard-table td:first-child { padding-top: 0; }
            .dashboard-table td:last-child { border-bottom: none; padding-bottom: 0; }

            .dashboard-table td::before {
                content: attr(data-label);

                flex-shrink: 0;

                color: var(--text-dim);

                font-size: 10px;
                font-weight: 600;

                text-transform: uppercase;
                letter-spacing: .4px;

                text-align: left;
            }

            /* Kolom judul jadi blok di atas (tanpa label) */
            .dashboard-table td.cell-title {
                display: block;
                text-align: left;
            }

            .dashboard-table td.cell-title::before { content: none; }

            /* Baris kosong jangan jadi kartu */
            .dashboard-table tbody tr.row-empty {
                background: transparent;
                border: none;
                padding: 0;
            }

            .dashboard-table td.cell-empty {
                display: block;
                text-align: center;
                border-bottom: none;
            }

            .dashboard-table td.cell-empty::before { content: none; }

        }

    </style>

</x-app-layout>