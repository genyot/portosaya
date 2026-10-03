<x-app-layout>

    <!-- Header Halaman -->
    <div class="project-header">
        <div>
            <h1 class="project-title">Kelola Karya</h1>
            <p class="project-subtitle">
                Tambah, edit, atau hapus karya portfolio.
            </p>
        </div>

        <a href="{{ route('projects.create') }}" class="add-project-btn">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Karya</span>
        </a>
    </div>


    <!-- Filter & Pencarian -->
    <form method="GET" action="{{ route('projects.index') }}" class="filter-bar">

        <div class="filter-search">
            <i class="bi bi-search"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari karya..."
                autocomplete="off"
            >
        </div>

        <select name="category" class="filter-select">
            <option value="">Semua Kategori</option>

            @foreach($categories as $category)
                <option
                    value="{{ $category->id }}"
                    {{ request('category') == $category->id ? 'selected' : '' }}
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <select name="status" class="filter-select">
            <option value="">Semua Status</option>

            <option value="Published" {{ request('status') === 'Published' ? 'selected' : '' }}>
                Published
            </option>

            <option value="Draft" {{ request('status') === 'Draft' ? 'selected' : '' }}>
                Draft
            </option>
        </select>

        <button type="submit" class="filter-submit">
            <i class="bi bi-funnel"></i>
            <span>Terapkan</span>
        </button>

        @if(request()->anyFilled(['search', 'category', 'status']))
            <a href="{{ route('projects.index') }}" class="filter-reset">
                <i class="bi bi-x-lg"></i>
                <span>Reset</span>
            </a>
        @endif

    </form>


    <!-- Card Tabel -->
    <div class="project-card">

        <!-- Header Card -->
        <div class="project-card-header">
            <div>
                <h3 class="project-card-title">
                    <i class="bi bi-grid-3x3-gap"></i>
                    Daftar Karya
                </h3>

                <p class="project-card-subtitle">
                    Daftar karya portfolio yang telah ditambahkan.
                </p>
            </div>

            <div class="project-count">
                {{ $projects->count() }} Karya
            </div>
        </div>


        <!-- Tabel -->
        <div class="table-responsive">
            <table class="project-table">

                <thead>
                    <tr>
                        <th width="70">No</th>
                        <th width="110">Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th width="100">Tahun</th>
                        <th width="120">Status</th>
                        <th width="120" class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($projects as $index => $project)

                        <tr>

                            <!-- No -->
                            <td class="cell-number" data-label="No">
                                <span class="number-text">
                                    {{ $projects->firstItem() + $index }}
                                </span>
                            </td>


                            <!-- Gambar -->
                            <td data-label="Gambar">
                                <div class="project-image-wrapper">
                                    <img
                                        src="{{ asset('storage/' . $project->image) }}"
                                        alt="{{ $project->title }}"
                                        class="project-image"
                                    >
                                </div>
                            </td>


                            <!-- Judul -->
                            <td data-label="Judul">
                                <div class="project-title-cell">
                                    {{ $project->title }}
                                </div>
                            </td>


                            <!-- Kategori -->
                            <td data-label="Kategori">
                                <span class="category-text">
                                    {{ $project->category->name }}
                                </span>
                            </td>


                            <!-- Tahun -->
                            <td data-label="Tahun">
                                <span class="year-text">
                                    {{ $project->year }}
                                </span>
                            </td>


                            <!-- Status -->
                            <td data-label="Status">

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

                            </td>


                            <!-- Aksi -->
                            <td class="cell-action" data-label="Aksi">

                                <div class="action-buttons">

                                    <!-- Lihat Detail -->
                                    <a
                                        href="{{ route('projects.show', $project->id) }}"
                                        class="action-btn view-btn"
                                        title="Lihat Detail Karya"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>


                                    <!-- Edit -->
                                    <a
                                        href="{{ route('projects.edit', $project->id) }}"
                                        class="action-btn edit-btn"
                                        title="Edit Karya"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>


                                    <!-- Hapus -->
                                    <form
                                        action="{{ route('projects.destroy', $project->id) }}"
                                        method="POST"
                                        class="delete-form"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="button"
                                            class="action-btn delete-btn"
                                            title="Hapus Karya"
                                            onclick="openDeleteModal(
                                                '{{ $project->id }}',
                                                @js($project->title)
                                            )"
                                        >
                                            <i class="bi bi-trash3"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <!-- Empty State -->
                        <tr class="row-empty">
                            <td colspan="7" class="cell-empty">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="bi bi-folder2-open"></i>
                                    </div>

                                    <h4>Belum Ada Karya</h4>

                                    <p>
                                        Belum ada data karya yang diunggah.
                                    </p>

                                    <a
                                        href="{{ route('projects.create') }}"
                                        class="empty-add-btn"
                                    >
                                        <i class="bi bi-plus-lg"></i>
                                        Tambah Karya
                                    </a>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>


        <!-- Pagination -->
        @if($projects->hasPages())

            <div class="pagination-wrapper">
                {{ $projects->links() }}
            </div>

        @endif

    </div>


    <!-- =====================================================
         DELETE MODAL
    ====================================================== -->

    <div
        class="delete-modal-overlay"
        id="deleteModal"
        onclick="closeDeleteModal(event)"
    >

        <div
            class="delete-modal"
            onclick="event.stopPropagation()"
        >

            <!-- ICON -->
            <div class="delete-modal-icon">
                <i class="bi bi-trash3"></i>
            </div>


            <!-- CONTENT -->
            <div class="delete-modal-content">

                <h3>
                    Hapus Karya?
                </h3>

                <p>
                    Apakah kamu yakin ingin menghapus karya
                    <strong id="deleteProjectTitle"></strong>?
                </p>

                <div class="delete-warning">
                    <i class="bi bi-exclamation-triangle"></i>
                    <span>
                        Data dan gambar yang sudah dihapus tidak dapat dikembalikan.
                    </span>
                </div>

            </div>


            <!-- ACTION -->
            <div class="delete-modal-actions">

                <!-- BATAL -->
                <button
                    type="button"
                    class="modal-cancel-btn"
                    onclick="closeDeleteModal()"
                >
                    Batal
                </button>


                <!-- FORM DELETE -->
                <form
                    id="deleteProjectForm"
                    method="POST"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="modal-delete-btn"
                    >
                        <i class="bi bi-trash3"></i>
                        <span>
                            Ya, Hapus
                        </span>
                    </button>

                </form>

            </div>

        </div>

    </div>


    <style>

        /* =========================================
           HEADER
        ========================================= */

        .project-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .project-title {
            margin: 0 0 5px;
            color: var(--text-primary);
            font-size: 24px;
            font-weight: 600;
            letter-spacing: -.3px;
        }

        .project-subtitle {
            margin: 0;
            color: var(--text-secondary);
            font-size: 13px;
        }


        /* =========================================
           BUTTON TAMBAH
        ========================================= */

        .add-project-btn {
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

            transition: .2s ease;
        }

        .add-project-btn:hover {
            background: #7461ed;
            border-color: #7461ed;
            color: var(--text-primary);
            transform: translateY(-1px);
        }


        /* =========================================
           FILTER BAR
        ========================================= */

        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;

            margin-bottom: 20px;
        }

        .filter-search {
            position: relative;

            flex: 1 1 220px;

            min-width: 180px;
        }

        .filter-search i {
            position: absolute;

            left: 14px;
            top: 50%;

            transform: translateY(-50%);

            color: var(--text-dim);

            font-size: 13px;

            pointer-events: none;
        }

        .filter-search input {
            width: 100%;
            height: 42px;

            padding: 0 14px 0 38px;

            background: var(--bg-card);
            color: var(--text-primary);

            border: 1px solid var(--border);
            border-radius: 8px;

            outline: none;

            font-family: inherit;
            font-size: 12px;

            transition: .2s ease;
        }

        .filter-search input::placeholder {
            color: var(--text-dim);
        }

        .filter-search input:focus {
            border-color: #6551e8;
            box-shadow: 0 0 0 .15rem rgba(101,81,232,.12);
        }

        .filter-select {
            height: 42px;

            padding: 0 34px 0 14px;

            background: var(--bg-card);
            color: var(--text-secondary);

            border: 1px solid var(--border);
            border-radius: 8px;

            outline: none;

            font-family: inherit;
            font-size: 12px;

            cursor: pointer;

            appearance: none;

            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2378839c' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 13px center;

            transition: .2s ease;
        }

        .filter-select:focus {
            border-color: #6551e8;
        }

        .filter-select option {
            background: var(--bg-input);
            color: var(--text-primary);
        }

        .filter-submit {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            height: 42px;

            padding: 0 16px;

            background: #6551e8;
            color: var(--text-primary);

            border: 1px solid #6551e8;
            border-radius: 8px;

            font-family: inherit;
            font-size: 11px;
            font-weight: 600;

            cursor: pointer;

            transition: .2s ease;
        }

        .filter-submit:hover {
            background: #7461ed;
            border-color: #7461ed;
        }

        .filter-reset {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            height: 42px;

            padding: 0 14px;

            background: var(--bg-hover);
            color: var(--text-secondary);

            border: 1px solid var(--border);
            border-radius: 8px;

            font-size: 11px;
            font-weight: 500;

            text-decoration: none;

            transition: .2s ease;
        }

        .filter-reset:hover {
            background: var(--bg-hover-2);
            color: var(--text-primary);
        }


        /* =========================================
           PAGINATION
        ========================================= */

        .pagination-wrapper {
            padding: 18px 22px;

            border-top: 1px solid var(--border);
        }

        .pagination-wrapper nav {
            display: flex;
            justify-content: flex-end;
        }


        /* =========================================
           CARD
        ========================================= */

        .project-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
        }

        .project-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            padding: 20px 22px;

            border-bottom: 1px solid var(--border);
        }

        .project-card-title {
            display: flex;
            align-items: center;
            gap: 9px;

            margin: 0 0 4px;

            color: var(--text-primary);
            font-size: 14px;
            font-weight: 600;
        }

        .project-card-title i {
            color: #6551e8;
            font-size: 15px;
        }

        .project-card-subtitle {
            margin: 0;

            color: var(--text-muted);
            font-size: 11px;
        }

        .project-count {
            padding: 6px 11px;

            background: rgba(101,81,232,.12);
            color: #a397ef;

            border: 1px solid rgba(101,81,232,.2);
            border-radius: 6px;

            font-size: 10px;
            font-weight: 600;
        }


        /* =========================================
           TABLE
        ========================================= */

        .project-table {
            width: 100%;
            margin: 0;

            border-collapse: collapse;
        }

        .project-table thead {
            background: var(--bg-alt);
        }

        .project-table th {
            padding: 13px 20px;

            color: var(--text-secondary);

            border-bottom: 1px solid var(--border);

            font-size: 10px;
            font-weight: 600;

            text-transform: uppercase;
            letter-spacing: .4px;

            white-space: nowrap;
        }

        .project-table td {
            padding: 15px 20px;

            color: var(--text-primary);

            border-bottom: 1px solid var(--surface-2);

            font-size: 12px;

            vertical-align: middle;
        }

        .project-table tbody tr {
            transition: .2s ease;
        }

        .project-table tbody tr:hover {
            background: var(--bg-hover);
        }

        .project-table tbody tr:last-child td {
            border-bottom: none;
        }


        /* =========================================
           NOMOR
        ========================================= */

        .number-text {
            color: var(--text-dim);
            font-size: 11px;
        }


        /* =========================================
           GAMBAR
        ========================================= */

        .project-image-wrapper {
            width: 70px;
            height: 45px;

            overflow: hidden;

            background: var(--bg-input);

            border: 1px solid var(--border);
            border-radius: 6px;
        }

        .project-image {
            width: 100%;
            height: 100%;

            object-fit: cover;

            display: block;

            transition: .25s ease;
        }

        .project-image:hover {
            transform: scale(1.05);
        }


        /* =========================================
           JUDUL
        ========================================= */

        .project-title-cell {
            max-width: 280px;

            color: var(--text-primary);

            font-size: 12px;
            font-weight: 500;

            line-height: 1.5;
        }


        /* =========================================
           KATEGORI & TAHUN
        ========================================= */

        .category-text {
            color: var(--text-secondary);
            font-size: 11px;
        }

        .year-text {
            color: var(--text-secondary);
            font-size: 11px;
        }


        /* =========================================
           STATUS
        ========================================= */

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


        /* Published */

        .status-published {
            background: rgba(54,201,143,.1);
            color: #36c98f;

            border: 1px solid rgba(54,201,143,.18);
        }

        .status-published .status-dot {
            background: #36c98f;
            box-shadow: 0 0 6px rgba(54,201,143,.5);
        }


        /* Draft */

        .status-draft {
            background: rgba(243,167,53,.1);
            color: #f3a735;

            border: 1px solid rgba(243,167,53,.18);
        }

        .status-draft .status-dot {
            background: #f3a735;
            box-shadow: 0 0 6px rgba(243,167,53,.4);
        }


        /* =========================================
           ACTION BUTTON
        ========================================= */

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 7px;
        }

        .action-btn {
            width: 32px;
            height: 32px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 7px;

            border: 1px solid transparent;

            text-decoration: none;

            cursor: pointer;

            transition: .2s ease;
        }

        .action-btn i {
            font-size: 13px;
        }


        /* Edit */

        .edit-btn {
            background: rgba(77,156,255,.09);
            color: #4d9cff;

            border-color: rgba(77,156,255,.16);
        }

        .edit-btn:hover {
            background: rgba(77,156,255,.18);
            color: #6badff;

            border-color: rgba(77,156,255,.3);

            transform: translateY(-1px);
        }


        /* View / Detail */

        .view-btn {
            background: rgba(54,201,143,.09);
            color: #36c98f;

            border-color: rgba(54,201,143,.16);
        }

        .view-btn:hover {
            background: rgba(54,201,143,.18);
            color: #4ddba2;

            border-color: rgba(54,201,143,.3);

            transform: translateY(-1px);
        }


        /* Delete */

        .delete-btn {
            background: rgba(233,75,98,.09);
            color: #e94b62;

            border-color: rgba(233,75,98,.16);
        }

        .delete-btn:hover {
            background: rgba(233,75,98,.18);
            color: #f05268;

            border-color: rgba(233,75,98,.3);

            transform: translateY(-1px);
        }


        /* =========================================
           EMPTY STATE
        ========================================= */

        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            padding: 65px 20px;

            text-align: center;
        }

        .empty-icon {
            width: 55px;
            height: 55px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 15px;

            background: rgba(101,81,232,.1);

            border: 1px solid rgba(101,81,232,.15);
            border-radius: 10px;
        }

        .empty-icon i {
            color: #7461ed;
            font-size: 23px;
        }

        .empty-state h4 {
            margin: 0 0 6px;

            color: var(--text-primary);

            font-size: 14px;
            font-weight: 600;
        }

        .empty-state p {
            margin: 0 0 18px;

            color: var(--text-muted);

            font-size: 11px;
        }

        .empty-add-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            padding: 9px 14px;

            background: #6551e8;
            color: var(--text-primary);

            border-radius: 7px;

            font-size: 11px;
            font-weight: 600;

            text-decoration: none;

            transition: .2s ease;
        }

        .empty-add-btn:hover {
            background: #7461ed;
            color: var(--text-primary);
        }


        /* =========================================
           DELETE MODAL
        ========================================= */

        .delete-modal-overlay {
            position: fixed;

            inset: 0;

            z-index: 9999;

            display: none;

            align-items: center;
            justify-content: center;

            padding: 20px;

            background: rgba(5,8,20,.78);

            backdrop-filter: blur(5px);
        }

        .delete-modal-overlay.show {
            display: flex;

            animation: modalFadeIn .18s ease;
        }

        .delete-modal {
            width: 100%;

            max-width: 400px;

            background: var(--bg-card);

            border: 1px solid var(--border);
            border-radius: 12px;

            padding: 28px;

            box-shadow: 0 25px 70px rgba(0,0,0,.45);

            animation: modalSlideUp .20s ease;
        }

        .delete-modal-icon {
            width: 48px;
            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 18px;

            background: rgba(240,82,104,.12);

            border: 1px solid rgba(240,82,104,.18);
            border-radius: 10px;

            color: #f05268;

            font-size: 19px;
        }

        .delete-modal-content h3 {
            margin: 0 0 8px;

            color: var(--text-primary);

            font-size: 17px;
            font-weight: 600;
        }

        .delete-modal-content p {
            margin: 0;

            color: var(--text-secondary);

            font-size: 12px;

            line-height: 1.7;
        }

        .delete-modal-content strong {
            color: var(--text-primary);

            font-weight: 600;
        }

        .delete-warning {
            display: flex;
            align-items: center;
            gap: 7px;

            margin-top: 13px;

            padding: 9px 11px;

            background: rgba(243,167,53,.08);

            border: 1px solid rgba(243,167,53,.14);
            border-radius: 7px;

            color: #f3b85d;

            font-size: 10px;

            line-height: 1.4;
        }

        .delete-warning i {
            font-size: 12px;

            flex-shrink: 0;
        }

        .delete-modal-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;

            margin-top: 25px;
            padding-top: 20px;

            border-top: 1px solid var(--border);
        }

        .delete-modal-actions form {
            margin: 0;
        }

        .modal-cancel-btn {
            height: 38px;

            padding: 0 16px;

            border-radius: 7px;

            border: 1px solid var(--border);

            background: var(--bg-input);
            color: var(--text-secondary);

            font-family: 'Inter', sans-serif;

            font-size: 11px;
            font-weight: 500;

            cursor: pointer;

            transition: .2s;
        }

        .modal-cancel-btn:hover {
            background: var(--bg-hover);
            color: var(--text-primary);

            border-color: var(--border-strong);
        }

        .modal-delete-btn {
            height: 38px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            padding: 0 16px;

            border: none;
            border-radius: 7px;

            background: #e94b62;
            color: var(--text-primary);

            font-family: 'Inter', sans-serif;

            font-size: 11px;
            font-weight: 600;

            cursor: pointer;

            transition: .2s;
        }

        .modal-delete-btn:hover {
            background: #f05268;

            transform: translateY(-1px);

            box-shadow: 0 7px 18px rgba(233,75,98,.20);
        }


        /* =========================================
           MODAL ANIMATION
        ========================================= */

        @keyframes modalFadeIn {

            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }

        }

        @keyframes modalSlideUp {

            from {
                opacity: 0;

                transform: translateY(10px) scale(.98);
            }

            to {
                opacity: 1;

                transform: translateY(0) scale(1);
            }

        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 992px) {

            .project-table th,
            .project-table td {
                padding: 13px 14px;
            }

            .project-title-cell {
                max-width: 200px;
            }

        }


        @media (max-width: 768px) {

            .project-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .add-project-btn {
                width: 100%;
                justify-content: center;
            }

            .project-card-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
            }

            /* =========================
               TABEL -> KARTU DI MOBILE
            ========================= */

            .project-table { min-width: 0; }

            .project-table thead { display: none; }

            .project-table tbody tr {
                display: block;

                margin-bottom: 12px;
                padding: 16px;

                background: var(--bg-alt);
                border: 1px solid var(--border);
                border-radius: 10px;
            }

            .project-table tbody tr:hover { background: var(--bg-alt); }
            .project-table tbody tr:last-child { margin-bottom: 0; }

            .project-table td {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 15px;

                padding: 9px 0;

                border-bottom: 1px solid var(--surface-2);

                text-align: right;
            }

            .project-table td:first-child { padding-top: 0; }
            .project-table td:last-child { border-bottom: none; padding-bottom: 0; }

            .project-table td::before {
                content: attr(data-label);

                flex-shrink: 0;

                color: var(--text-dim);

                font-size: 10px;
                font-weight: 600;

                text-transform: uppercase;
                letter-spacing: .4px;

                text-align: left;
            }

            .project-table td.cell-number::before,
            .project-table td.cell-action::before { content: none; }

            .project-table td.cell-number { justify-content: flex-start; }
            .project-table td.cell-action { justify-content: flex-end; }

            /* Gambar ditampilkan agak besar di kartu */
            .project-image-wrapper {
                width: 90px;
                height: 58px;
            }

            .project-title-cell { max-width: none; }

            /* Tombol aksi lebih besar */
            .action-btn {
                width: 42px;
                height: 42px;
            }

            .action-btn i { font-size: 16px; }

            /* Empty state jangan jadi kartu */
            .project-table tbody tr.row-empty {
                background: transparent;
                border: none;
                padding: 0;
            }

            .project-table td.cell-empty {
                display: block;
                text-align: center;
                border-bottom: none;
            }

            .project-table td.cell-empty::before { content: none; }
        }


        @media (max-width: 480px) {

            .project-title {
                font-size: 21px;
            }

            .project-subtitle {
                font-size: 12px;
            }

            .delete-modal {
                padding: 22px;
            }

            .delete-modal-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .modal-cancel-btn,
            .modal-delete-btn {
                width: 100%;
            }

        }

    </style>


    <script>

        function openDeleteModal(id, title) {

            const modal =
                document.getElementById('deleteModal');

            const titleElement =
                document.getElementById('deleteProjectTitle');

            const deleteForm =
                document.getElementById('deleteProjectForm');


            // Tampilkan judul karya
            titleElement.textContent = title;


            // Set URL DELETE
            deleteForm.action =
                `/projects/${id}`;


            // Tampilkan modal
            modal.classList.add('show');


            // Kunci scroll halaman
            document.body.style.overflow = 'hidden';

        }


        function closeDeleteModal(event) {

            /*
             * Jika klik bagian isi modal,
             * jangan tutup modal.
             */
            if (
                event &&
                event.target !== event.currentTarget
            ) {
                return;
            }


            const modal =
                document.getElementById('deleteModal');


            // Tutup modal
            modal.classList.remove('show');


            // Aktifkan kembali scroll
            document.body.style.overflow = '';

        }


        // Tutup modal menggunakan tombol ESC
        document.addEventListener(
            'keydown',
            function(event) {

                if (event.key === 'Escape') {

                    closeDeleteModal();

                }

            }
        );

    </script>

</x-app-layout>