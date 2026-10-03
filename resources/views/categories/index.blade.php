<x-app-layout>

    {{-- =========================
         HEADER HALAMAN
    ========================== --}}
    <div class="category-header">

        <div>

            <h1 class="category-title">
                Kelola Kategori
            </h1>

            <p class="category-subtitle">
                Tambah, edit, atau hapus kategori portfolio.
            </p>

        </div>


        {{-- TOMBOL TAMBAH --}}
        <a
            href="{{ route('categories.create') }}"
            class="btn-add-category"
        >
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Kategori</span>
        </a>

    </div>


    {{-- =========================
         FLASH MESSAGE
    ========================== --}}

    @if (session('success'))

        <div class="category-alert success-alert">

            <i class="bi bi-check-circle-fill"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    @if (session('error'))

        <div class="category-alert error-alert">

            <i class="bi bi-exclamation-circle-fill"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- =========================
         FILTER & PENCARIAN
    ========================== --}}

    <form
        method="GET"
        action="{{ route('categories.index') }}"
        class="filter-bar"
    >

        <div class="filter-search">

            <i class="bi bi-search"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari kategori..."
                autocomplete="off"
            >

        </div>


        <button type="submit" class="filter-submit">

            <i class="bi bi-funnel"></i>
            <span>Terapkan</span>

        </button>


        @if(request()->filled('search'))

            <a
                href="{{ route('categories.index') }}"
                class="filter-reset"
            >
                <i class="bi bi-x-lg"></i>
                <span>Reset</span>
            </a>

        @endif

    </form>


    {{-- =========================
         TABLE CARD
    ========================== --}}

    <div class="category-card">

        {{-- CARD HEADER --}}
        <div class="category-card-header">

            <div>

                <h2>
                    Daftar Kategori
                </h2>

                <p>
                    Daftar kategori yang tersedia dalam portfolio.
                </p>

            </div>


            <div class="category-count">

                <i class="bi bi-tags"></i>

                <span>
                    {{ $categories->count() }} Kategori
                </span>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="category-table">

                <thead>

                    <tr>

                        <th class="number-column">
                            No
                        </th>

                        <th>
                            Kategori
                        </th>

                        <th>
                            Slug URL
                        </th>

                        <th class="action-column">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($categories as $index => $category)

                        <tr>

                            {{-- NO --}}
                            <td class="number-column cell-number" data-label="No">

                                <span class="number-text">
                                    {{ $categories->firstItem() + $index }}
                                </span>

                            </td>


                            {{-- KATEGORI --}}
                            <td data-label="Kategori">

                                <div class="category-name">

                                    <div class="category-icon">

                                        <i class="bi bi-tag"></i>

                                    </div>


                                    <div>

                                        <span class="category-name-text">
                                            {{ $category->name }}
                                        </span>

                                        <span class="category-name-label">
                                            Kategori portfolio
                                        </span>

                                    </div>

                                </div>

                            </td>


                            {{-- SLUG --}}
                            <td data-label="Slug URL">

                                <span class="slug-badge">
                                    {{ $category->slug }}
                                </span>

                            </td>


                            {{-- AKSI --}}
                            <td class="action-column cell-action" data-label="Aksi">

                                <div class="action-buttons">

                                    {{-- =====================
                                         EDIT
                                    ====================== --}}

                                    <a
                                        href="{{ route('categories.edit', $category->id) }}"
                                        class="action-btn edit-btn"
                                        title="Edit kategori"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>


                                    {{-- =====================
                                         DELETE
                                    ====================== --}}

                                    <form
                                        action="{{ route('categories.destroy', $category->id) }}"
                                        method="POST"
                                        class="delete-form"
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="button"
                                            class="action-btn delete-btn"
                                            title="Hapus kategori"
                                            onclick="openDeleteModal(
                                                '{{ $category->id }}',
                                                @js($category->name)
                                            )"
                                        >

                                            <i class="bi bi-trash3"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        {{-- DATA KOSONG --}}
                        <tr class="row-empty">

                            <td
                                colspan="4"
                                class="empty-data cell-empty"
                            >

                                <div class="empty-icon">

                                    <i class="bi bi-inbox"></i>

                                </div>


                                <h3>
                                    Belum Ada Kategori
                                </h3>


                                <p>
                                    Belum terdapat data kategori portfolio.
                                </p>


                                <a
                                    href="{{ route('categories.create') }}"
                                    class="empty-add-btn"
                                >

                                    <i class="bi bi-plus-lg"></i>

                                    Tambah Kategori

                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($categories->hasPages())

            <div class="pagination-wrapper">
                {{ $categories->links() }}
            </div>

        @endif

    </div>


    {{-- =====================================================
         DELETE MODAL
    ====================================================== --}}

    <div
        class="delete-modal-overlay"
        id="deleteModal"
        onclick="closeDeleteModal(event)"
    >

        <div
            class="delete-modal"
            onclick="event.stopPropagation()"
        >

            {{-- ICON --}}
            <div class="delete-modal-icon">

                <i class="bi bi-trash3"></i>

            </div>


            {{-- CONTENT --}}
            <div class="delete-modal-content">

                <h3>
                    Hapus Kategori?
                </h3>


                <p>
                    Apakah kamu yakin ingin menghapus kategori
                    <strong id="deleteCategoryName"></strong>?
                </p>


                <div class="delete-warning">

                    <i class="bi bi-exclamation-triangle"></i>

                    <span>
                        Data yang sudah dihapus tidak dapat dikembalikan.
                    </span>

                </div>

            </div>


            {{-- ACTION --}}
            <div class="delete-modal-actions">

                {{-- BATAL --}}
                <button
                    type="button"
                    class="modal-cancel-btn"
                    onclick="closeDeleteModal()"
                >
                    Batal
                </button>


                {{-- FORM DELETE --}}
                <form
                    id="deleteCategoryForm"
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


    {{-- =====================================================
         CSS
    ====================================================== --}}

    <style>

        /* =========================
           HEADER
        ========================== */

        .category-header {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 24px;
        }


        .category-title {
            margin: 0 0 6px;

            color: var(--text-primary);

            font-size: 24px;

            font-weight: 600;

            line-height: 1.3;
        }


        .category-subtitle {
            margin: 0;

            color: var(--text-secondary);

            font-size: 13px;

            line-height: 1.5;
        }


        /* =========================
           ADD BUTTON
        ========================== */

        .btn-add-category {
            height: 42px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            padding: 0 17px;

            border-radius: 8px;

            background: #6551e8;

            color: var(--text-primary);

            font-size: 12px;

            font-weight: 600;

            text-decoration: none;

            transition: all 0.2s ease;
        }


        .btn-add-category:hover {
            background: #7461ed;

            color: var(--text-primary);

            transform: translateY(-1px);

            box-shadow:
                0 8px 20px rgba(101,81,232,0.22);
        }


        .btn-add-category i {
            font-size: 14px;
        }


        /* =========================
           ALERT
        ========================== */

        .category-alert {
            display: flex;

            align-items: center;

            gap: 9px;

            padding: 12px 15px;

            margin-bottom: 20px;

            border-radius: 8px;

            font-size: 12px;
        }


        .success-alert {
            background: rgba(54,201,143,0.10);

            border: 1px solid rgba(54,201,143,0.20);

            color: #36c98f;
        }


        .error-alert {
            background: rgba(240,82,104,0.10);

            border: 1px solid rgba(240,82,104,0.20);

            color: #f05268;
        }


        /* =========================
           FILTER BAR
        ========================== */

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

            transition: 0.2s ease;
        }

        .filter-search input::placeholder {
            color: var(--text-dim);
        }

        .filter-search input:focus {
            border-color: #6551e8;

            box-shadow: 0 0 0 0.15rem rgba(101,81,232,0.12);
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

            transition: 0.2s ease;
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

            transition: 0.2s ease;
        }

        .filter-reset:hover {
            background: var(--bg-hover-2);

            color: var(--text-primary);
        }


        /* =========================
           PAGINATION
        ========================== */

        .pagination-wrapper {
            padding: 18px 22px;

            border-top: 1px solid var(--border);
        }

        .pagination-wrapper nav {
            display: flex;
            justify-content: flex-end;
        }


        /* =========================
           CARD
        ========================== */

        .category-card {
            overflow: hidden;

            background: var(--bg-card);

            border: 1px solid var(--border);

            border-radius: 10px;

            box-shadow:
                0 8px 30px rgba(0,0,0,0.10);
        }


        /* =========================
           CARD HEADER
        ========================== */

        .category-card-header {
            min-height: 76px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            padding: 18px 22px;

            border-bottom:
                1px solid var(--border);
        }


        .category-card-header h2 {
            margin: 0 0 5px;

            color: var(--text-primary);

            font-size: 14px;

            font-weight: 600;
        }


        .category-card-header p {
            margin: 0;

            color: var(--text-muted);

            font-size: 11px;
        }


        .category-count {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 7px 11px;

            background:
                rgba(101,81,232,0.10);

            border:
                1px solid rgba(101,81,232,0.18);

            border-radius: 7px;

            color: #b8afff;

            font-size: 11px;

            font-weight: 500;

            white-space: nowrap;
        }


        .category-count i {
            font-size: 13px;
        }


        /* =========================
           TABLE
        ========================== */

        .category-table {
            width: 100%;

            margin: 0;

            border-collapse: collapse;

            color: var(--text-primary);
        }


        .category-table thead {
            background: var(--bg-alt);
        }


        .category-table th {
            padding: 14px 22px;

            border: none;

            color: var(--text-secondary);

            font-size: 11px;

            font-weight: 600;

            text-align: left;

            white-space: nowrap;
        }


        .category-table tbody tr {
            border-top:
                1px solid var(--surface-2);

            transition:
                background 0.2s ease;
        }


        .category-table tbody tr:hover {
            background: var(--bg-hover);
        }


        .category-table td {
            padding: 15px 22px;

            border: none;

            vertical-align: middle;
        }


        .number-column {
            width: 70px;
        }


        .action-column {
            width: 130px;

            text-align: right !important;
        }


        .number-text {
            color: var(--text-dim);

            font-size: 12px;
        }


        /* =========================
           CATEGORY NAME
        ========================== */

        .category-name {
            display: flex;

            align-items: center;

            gap: 11px;
        }


        .category-icon {
            width: 34px;

            height: 34px;

            flex-shrink: 0;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 8px;

            background:
                rgba(101,81,232,0.12);

            color: #9b8ff5;

            font-size: 14px;
        }


        .category-name-text {
            display: block;

            margin-bottom: 3px;

            color: var(--text-primary);

            font-size: 12px;

            font-weight: 500;
        }


        .category-name-label {
            display: block;

            color: var(--text-dim);

            font-size: 10px;
        }


        /* =========================
           SLUG
        ========================== */

        .slug-badge {
            display: inline-block;

            padding: 5px 9px;

            background: var(--bg-input);

            border:
                1px solid var(--border);

            border-radius: 5px;

            color: var(--text-secondary);

            font-family: monospace;

            font-size: 11px;
        }


        /* =========================
           ACTION BUTTONS
        ========================== */

        .action-buttons {
            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: 7px;
        }


        .delete-form {
            display: inline;

            margin: 0;
        }


        .action-btn {
            width: 34px;

            height: 34px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            border-radius: 7px;

            border:
                1px solid transparent;

            font-size: 13px;

            text-decoration: none;

            cursor: pointer;

            transition:
                all 0.2s ease;
        }


        /* EDIT */

        .edit-btn {
            background:
                rgba(77,156,255,0.09);

            border-color:
                rgba(77,156,255,0.14);

            color: #4d9cff;
        }


        .edit-btn:hover {
            background:
                rgba(77,156,255,0.17);

            border-color:
                rgba(77,156,255,0.25);

            color: #73b3ff;
        }


        /* DELETE */

        .delete-btn {
            background:
                rgba(240,82,104,0.09);

            border-color:
                rgba(240,82,104,0.14);

            color: #f05268;
        }


        .delete-btn:hover {
            background:
                rgba(240,82,104,0.17);

            border-color:
                rgba(240,82,104,0.25);

            color: #ff7082;
        }


        /* =========================
           EMPTY DATA
        ========================== */

        .empty-data {
            padding: 65px 20px !important;

            text-align: center;
        }


        .empty-icon {
            width: 58px;

            height: 58px;

            margin: 0 auto 14px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background:
                var(--surface-2);

            color: var(--text-dim);

            font-size: 23px;
        }


        .empty-data h3 {
            margin: 0 0 6px;

            color: var(--text-primary);

            font-size: 14px;

            font-weight: 600;
        }


        .empty-data p {
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

            border-radius: 7px;

            color: var(--text-primary);

            font-size: 11px;

            font-weight: 500;

            text-decoration: none;
        }


        .empty-add-btn:hover {
            background: #7461ed;

            color: var(--text-primary);
        }


        /* =====================================================
           DELETE MODAL
        ====================================================== */

        .delete-modal-overlay {
            position: fixed;

            inset: 0;

            z-index: 9999;

            display: none;

            align-items: center;

            justify-content: center;

            padding: 20px;

            background:
                rgba(5,8,20,0.78);

            backdrop-filter: blur(5px);
        }


        .delete-modal-overlay.show {
            display: flex;

            animation:
                modalFadeIn 0.18s ease;
        }


        .delete-modal {
            width: 100%;

            max-width: 400px;

            background: var(--bg-card);

            border:
                1px solid var(--border);

            border-radius: 12px;

            padding: 28px;

            box-shadow:
                0 25px 70px rgba(0,0,0,0.45);

            animation:
                modalSlideUp 0.20s ease;
        }


        /* MODAL ICON */

        .delete-modal-icon {
            width: 48px;

            height: 48px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 18px;

            border-radius: 10px;

            background:
                rgba(240,82,104,0.12);

            border:
                1px solid rgba(240,82,104,0.18);

            color: #f05268;

            font-size: 19px;
        }


        /* MODAL CONTENT */

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

            background:
                rgba(243,167,53,0.08);

            border:
                1px solid rgba(243,167,53,0.14);

            border-radius: 7px;

            color: #f3b85d;

            font-size: 10px;

            line-height: 1.4;
        }


        .delete-warning i {
            font-size: 12px;

            flex-shrink: 0;
        }


        /* MODAL ACTION */

        .delete-modal-actions {
            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: 8px;

            margin-top: 25px;

            padding-top: 20px;

            border-top:
                1px solid var(--border);
        }


        .delete-modal-actions form {
            margin: 0;
        }


        /* CANCEL */

        .modal-cancel-btn {
            height: 38px;

            padding: 0 16px;

            border-radius: 7px;

            border:
                1px solid var(--border);

            background: var(--bg-input);

            color: var(--text-secondary);

            font-family: 'Inter', sans-serif;

            font-size: 11px;

            font-weight: 500;

            cursor: pointer;

            transition: 0.2s;
        }


        .modal-cancel-btn:hover {
            background: var(--bg-hover);

            color: var(--text-primary);

            border-color:
                var(--border-strong);
        }


        /* DELETE CONFIRM */

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

            transition: 0.2s;
        }


        .modal-delete-btn:hover {
            background: #f05268;

            transform: translateY(-1px);

            box-shadow:
                0 7px 18px rgba(233,75,98,0.20);
        }


        /* =========================
           MODAL ANIMATION
        ========================== */

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

                transform:
                    translateY(10px)
                    scale(0.98);
            }

            to {
                opacity: 1;

                transform:
                    translateY(0)
                    scale(1);
            }

        }


        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 768px) {

            .category-header {
                align-items: flex-start;

                flex-direction: column;
            }


            .btn-add-category {
                width: 100%;
            }


            .category-card-header {
                align-items: flex-start;

                flex-direction: column;
            }


            .category-count {
                align-self: flex-start;
            }


            /* =========================
               TABEL -> KARTU DI MOBILE
            ========================= */

            .category-table { min-width: 0; }

            .category-table thead { display: none; }

            .category-table tbody tr {
                display: block;

                margin-bottom: 12px;
                padding: 16px;

                background: var(--bg-alt);
                border: 1px solid var(--border);
                border-radius: 10px;
            }

            .category-table tbody tr:hover { background: var(--bg-alt); }
            .category-table tbody tr:last-child { margin-bottom: 0; }

            .category-table td {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 15px;

                padding: 9px 0;

                border-bottom: 1px solid var(--surface-2);

                text-align: right;
            }

            .category-table td:first-child { padding-top: 0; }
            .category-table td:last-child { border-bottom: none; padding-bottom: 0; }

            .category-table td::before {
                content: attr(data-label);

                flex-shrink: 0;

                color: var(--text-dim);

                font-size: 10px;
                font-weight: 600;

                text-transform: uppercase;
                letter-spacing: .4px;

                text-align: left;
            }

            .category-table td.cell-number::before,
            .category-table td.cell-action::before { content: none; }

            .category-table td.cell-number { justify-content: flex-start; }
            .category-table td.cell-action { justify-content: flex-end; }

            /* Tombol aksi lebih besar */
            .action-btn {
                width: 42px;
                height: 42px;
            }

            .action-btn i { font-size: 16px; }

            /* Empty state jangan jadi kartu */
            .category-table tbody tr.row-empty {
                background: transparent;
                border: none;
                padding: 0;
            }

            .category-table td.cell-empty {
                display: block;
                text-align: center;
                border-bottom: none;
            }

            .category-table td.cell-empty::before { content: none; }

        }


        @media (max-width: 576px) {

            .category-title {
                font-size: 21px;
            }


            .category-subtitle {
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


    {{-- =====================================================
         JAVASCRIPT
    ====================================================== --}}

    <script>

        function openDeleteModal(id, name) {

            const modal =
                document.getElementById('deleteModal');

            const nameElement =
                document.getElementById('deleteCategoryName');

            const deleteForm =
                document.getElementById('deleteCategoryForm');


            // Tampilkan nama kategori
            nameElement.textContent = name;


            // Set URL DELETE
            deleteForm.action =
                `/categories/${id}`;


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


        /*
         * Tutup modal menggunakan tombol ESC
         */
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