<x-app-layout>

    {{-- =========================
         HEADER
    ========================== --}}
    <div class="category-form-header">

        <div>

            <a
                href="{{ route('categories.index') }}"
                class="back-link"
            >
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Daftar Kategori</span>
            </a>

            <h1 class="category-form-title">
                Tambah Kategori Baru
            </h1>

            <p class="category-form-subtitle">
                Buat kategori untuk mengelompokkan karya portofoliomu.
            </p>

        </div>

    </div>


    {{-- =========================
         FORM CARD
    ========================== --}}
    <div class="category-form-wrapper">

        <div class="category-form-card">

            {{-- CARD HEADER --}}
            <div class="form-card-header">

                <div class="form-header-icon">
                    <i class="bi bi-tags"></i>
                </div>

                <div>
                    <h2>
                        Informasi Kategori
                    </h2>

                    <p>
                        Masukkan nama kategori yang ingin ditambahkan.
                    </p>
                </div>

            </div>


            {{-- FORM --}}
            <form
                action="{{ route('categories.store') }}"
                method="POST"
            >

                @csrf


                {{-- NAMA KATEGORI --}}
                <div class="form-group">

                    <label for="name">
                        Nama Kategori
                    </label>

                    <div class="form-input-wrapper">

                        <i class="bi bi-tag"></i>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: Web Development"
                            autocomplete="off"
                            required
                            autofocus
                            class="@error('name') input-error @enderror"
                        >

                    </div>


                    {{-- ERROR --}}
                    @error('name')

                        <div class="form-error">

                            <i class="bi bi-exclamation-circle"></i>

                            <span>
                                {{ $message }}
                            </span>

                        </div>

                    @enderror


                    <div class="form-help">

                        <i class="bi bi-info-circle"></i>

                        <span>
                            Gunakan nama kategori yang singkat dan mudah dikenali.
                        </span>

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="form-actions">

                    <a
                        href="{{ route('categories.index') }}"
                        class="cancel-button"
                    >
                        <i class="bi bi-x-lg"></i>
                        <span>Batal</span>
                    </a>


                    <button
                        type="submit"
                        class="save-button"
                    >
                        <i class="bi bi-check-lg"></i>
                        <span>Simpan Kategori</span>
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================
         CSS
    ========================== --}}
    <style>

        /* =========================
           HEADER
        ========================== */

        .category-form-header {
            margin-bottom: 24px;
        }


        .back-link {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            margin-bottom: 13px;

            color: var(--text-muted);

            font-size: 11px;

            text-decoration: none;

            transition: 0.2s;
        }


        .back-link:hover {
            color: #b8afff;
        }


        .back-link i {
            font-size: 12px;
        }


        .category-form-title {
            margin: 0 0 6px;

            color: var(--text-primary);

            font-size: 24px;

            font-weight: 600;

            line-height: 1.3;
        }


        .category-form-subtitle {
            margin: 0;

            color: var(--text-secondary);

            font-size: 13px;

            line-height: 1.5;
        }


        /* =========================
           FORM WRAPPER
        ========================== */

        .category-form-wrapper {
            width: 100%;

            max-width: 650px;

            margin: 0 auto;
        }


        /* =========================
           FORM CARD
        ========================== */

        .category-form-card {
            background: var(--bg-card);

            border: 1px solid var(--border);

            border-radius: 10px;

            padding: 28px;

            box-shadow:
                0 8px 30px rgba(0,0,0,0.10);
        }


        /* =========================
           CARD HEADER
        ========================== */

        .form-card-header {
            display: flex;

            align-items: center;

            gap: 13px;

            padding-bottom: 22px;

            margin-bottom: 25px;

            border-bottom: 1px solid var(--border);
        }


        .form-header-icon {
            width: 42px;
            height: 42px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: rgba(101,81,232,0.12);

            color: #9b8ff5;

            font-size: 18px;
        }


        .form-card-header h2 {
            margin: 0 0 4px;

            color: var(--text-primary);

            font-size: 14px;

            font-weight: 600;
        }


        .form-card-header p {
            margin: 0;

            color: var(--text-muted);

            font-size: 11px;
        }


        /* =========================
           FORM GROUP
        ========================== */

        .form-group {
            margin-bottom: 10px;
        }


        .form-group > label {
            display: block;

            margin-bottom: 8px;

            color: var(--text-secondary);

            font-size: 12px;

            font-weight: 500;
        }


        /* =========================
           INPUT
        ========================== */

        .form-input-wrapper {
            position: relative;

            width: 100%;
        }


        .form-input-wrapper > i {
            position: absolute;

            left: 15px;

            top: 50%;

            transform: translateY(-50%);

            color: var(--text-muted);

            font-size: 15px;

            pointer-events: none;

            z-index: 2;
        }


        .form-input-wrapper input {
            width: 100%;

            height: 46px;

            padding: 0 15px 0 43px;

            background: var(--bg-input);

            border: 1px solid var(--border);

            border-radius: 8px;

            outline: none;

            color: var(--text-primary);

            font-family: 'Inter', sans-serif;

            font-size: 13px;

            transition: all 0.2s ease;
        }


        .form-input-wrapper input::placeholder {
            color: var(--text-dim);

            opacity: 1;
        }


        .form-input-wrapper input:focus {
            background: var(--bg-input);

            border-color: #6551e8;

            color: var(--text-primary);

            box-shadow:
                0 0 0 3px rgba(101,81,232,0.14);
        }


        .form-input-wrapper input.input-error {
            border-color: #f05268;
        }


        .form-input-wrapper input.input-error:focus {
            border-color: #f05268;

            box-shadow:
                0 0 0 3px rgba(240,82,104,0.10);
        }


        /* =========================
           ERROR
        ========================== */

        .form-error {
            display: flex;

            align-items: center;

            gap: 6px;

            margin-top: 8px;

            color: #f05268;

            font-size: 11px;

            line-height: 1.4;
        }


        .form-error i {
            font-size: 12px;
        }


        /* =========================
           HELP TEXT
        ========================== */

        .form-help {
            display: flex;

            align-items: center;

            gap: 6px;

            margin-top: 9px;

            color: var(--text-dim);

            font-size: 10px;

            line-height: 1.5;
        }


        .form-help i {
            color: var(--text-muted);

            font-size: 11px;
        }


        /* =========================
           ACTION
        ========================== */

        .form-actions {
            display: flex;

            justify-content: flex-end;

            align-items: center;

            gap: 9px;

            margin-top: 30px;

            padding-top: 22px;

            border-top: 1px solid var(--border);
        }


        /* =========================
           CANCEL BUTTON
        ========================== */

        .cancel-button {
            height: 40px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 0 16px;

            background: var(--bg-input);

            border: 1px solid var(--border);

            border-radius: 7px;

            color: var(--text-secondary);

            font-size: 11px;

            font-weight: 500;

            text-decoration: none;

            transition: all 0.2s ease;
        }


        .cancel-button:hover {
            background: var(--bg-hover);

            border-color: var(--border-strong);

            color: var(--text-primary);
        }


        /* =========================
           SAVE BUTTON
        ========================== */

        .save-button {
            height: 40px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 0 17px;

            background: #6551e8;

            border: none;

            border-radius: 7px;

            color: var(--text-primary);

            font-family: 'Inter', sans-serif;

            font-size: 11px;

            font-weight: 600;

            cursor: pointer;

            transition: all 0.2s ease;
        }


        .save-button:hover {
            background: #7461ed;

            color: var(--text-primary);

            transform: translateY(-1px);

            box-shadow:
                0 8px 18px rgba(101,81,232,0.22);
        }


        .save-button:active {
            transform: translateY(0);
        }


        .save-button i,
        .cancel-button i {
            font-size: 12px;
        }


        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 768px) {

            .category-form-title {
                font-size: 21px;
            }


            .category-form-subtitle {
                font-size: 12px;
            }


            .category-form-card {
                padding: 22px;
            }

        }


        @media (max-width: 576px) {

            .category-form-wrapper {
                max-width: 100%;
            }


            .form-actions {
                flex-direction: column-reverse;

                align-items: stretch;
            }


            .cancel-button,
            .save-button {
                width: 100%;
            }

        }

    </style>

</x-app-layout>