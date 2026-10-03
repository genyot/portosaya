<x-app-layout>

    <!-- Header Halaman -->
    <div class="project-form-header">

        <div>
            <a
                href="{{ route('projects.index') }}"
                class="back-link"
            >
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Daftar Karya</span>
            </a>

            <h1 class="project-form-title">
                Tambah Karya Baru
            </h1>

            <p class="project-form-subtitle">
                Unggah detail dan gambar karyamu ke portfolio.
            </p>
        </div>

    </div>


    <!-- Form Card -->
    <div class="project-form-wrapper">

        <div class="project-form-card">

            <!-- Card Header -->
            <div class="project-form-card-header">

                <div class="form-header-icon">
                    <i class="bi bi-plus-lg"></i>
                </div>

                <div>
                    <h3>Informasi Karya</h3>
                    <p>
                        Lengkapi informasi karya yang ingin ditambahkan.
                    </p>
                </div>

            </div>


            <!-- Form -->
            <form
                action="{{ route('projects.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                <div class="project-form-body">

                    <div class="row g-4">

                        <!-- Judul Karya -->
                        <div class="col-md-6">

                            <label for="title" class="form-label-custom">
                                Judul Karya
                                <span>*</span>
                            </label>

                            <div class="input-wrapper">
                                <i class="bi bi-type"></i>

                                <input
                                    type="text"
                                    id="title"
                                    class="form-control-custom @error('title') is-invalid-custom @enderror"
                                    name="title"
                                    value="{{ old('title') }}"
                                    required
                                    autofocus
                                    placeholder="Misal: Eksistensi Typography"
                                >
                            </div>

                            @error('title')
                                <div class="form-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- Kategori -->
                        <div class="col-md-6">

                            <label for="category_id" class="form-label-custom">
                                Kategori
                                <span>*</span>
                            </label>

                            <div class="input-wrapper">
                                <i class="bi bi-tags"></i>

                                <select
                                    id="category_id"
                                    class="form-control-custom select-custom @error('category_id') is-invalid-custom @enderror"
                                    name="category_id"
                                    required
                                >
                                    <option value="" disabled
                                        {{ old('category_id') ? '' : 'selected' }}>
                                        Pilih Kategori...
                                    </option>

                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                                        >
                                            {{ $category->name }}
                                        </option>
                                    @endforeach

                                </select>

                                <i class="bi bi-chevron-down select-arrow"></i>
                            </div>

                            @error('category_id')
                                <div class="form-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- Tahun -->
                        <div class="col-md-6">

                            <label for="year" class="form-label-custom">
                                Tahun
                                <span>*</span>
                            </label>

                            <div class="input-wrapper">
                                <i class="bi bi-calendar3"></i>

                                <input
                                    type="text"
                                    id="year"
                                    class="form-control-custom @error('year') is-invalid-custom @enderror"
                                    name="year"
                                    value="{{ old('year') }}"
                                    required
                                    placeholder="Misal: 2026"
                                >
                            </div>

                            @error('year')
                                <div class="form-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- Status -->
                        <div class="col-md-6">

                            <label for="status" class="form-label-custom">
                                Status
                                <span>*</span>
                            </label>

                            <div class="input-wrapper">
                                <i class="bi bi-toggle-on"></i>

                                <select
                                    id="status"
                                    class="form-control-custom select-custom"
                                    name="status"
                                >
                                    <option
                                        value="Published"
                                        {{ old('status', 'Published') === 'Published' ? 'selected' : '' }}
                                    >
                                        Published
                                    </option>

                                    <option
                                        value="Draft"
                                        {{ old('status') === 'Draft' ? 'selected' : '' }}
                                    >
                                        Draft
                                    </option>
                                </select>

                                <i class="bi bi-chevron-down select-arrow"></i>
                            </div>

                            @error('status')
                                <div class="form-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- Deskripsi -->
                        <div class="col-12">

                            <label for="description" class="form-label-custom">
                                Deskripsi
                                <span>*</span>
                            </label>

                            <div class="textarea-wrapper">

                                <i class="bi bi-card-text"></i>

                                <textarea
                                    id="description"
                                    class="form-control-custom textarea-custom @error('description') is-invalid-custom @enderror"
                                    name="description"
                                    rows="5"
                                    required
                                    placeholder="Ceritakan tentang karya ini..."
                                >{{ old('description') }}</textarea>

                            </div>

                            @error('description')
                                <div class="form-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- Tools -->
                        <div class="col-12">

                            <label for="tools" class="form-label-custom">
                                Tools yang Digunakan
                            </label>

                            <div class="input-wrapper">

                                <i class="bi bi-tools"></i>

                                <input
                                    type="text"
                                    id="tools"
                                    class="form-control-custom @error('tools') is-invalid-custom @enderror"
                                    name="tools"
                                    value="{{ old('tools') }}"
                                    placeholder="Misal: Adobe Illustrator, Photoshop (Opsional)"
                                >

                            </div>

                            <div class="form-help">
                                <i class="bi bi-info-circle"></i>
                                Pisahkan beberapa tools dengan koma.
                            </div>

                            @error('tools')
                                <div class="form-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- Link Project -->
                        <div class="col-md-6">

                            <label for="project_link" class="form-label-custom">
                                Link Project
                            </label>

                            <div class="input-wrapper">

                                <i class="bi bi-link-45deg"></i>

                                <input
                                    type="url"
                                    id="project_link"
                                    class="form-control-custom @error('project_link') is-invalid-custom @enderror"
                                    name="project_link"
                                    value="{{ old('project_link') }}"
                                    placeholder="https://..."
                                >

                            </div>

                            <div class="form-help">
                                <i class="bi bi-info-circle"></i>
                                Opsional.
                            </div>

                            @error('project_link')
                                <div class="form-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- Instagram -->
                        <div class="col-md-6">

                            <label for="instagram_link" class="form-label-custom">
                                Link Instagram
                            </label>

                            <div class="input-wrapper">

                                <i class="bi bi-instagram"></i>

                                <input
                                    type="url"
                                    id="instagram_link"
                                    class="form-control-custom @error('instagram_link') is-invalid-custom @enderror"
                                    name="instagram_link"
                                    value="{{ old('instagram_link') }}"
                                    placeholder="https://instagram.com/..."
                                >

                            </div>

                            <div class="form-help">
                                <i class="bi bi-info-circle"></i>
                                Opsional.
                            </div>

                            @error('instagram_link')
                                <div class="form-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- Upload Gambar -->
                        <div class="col-12">

                            <label for="image" class="form-label-custom">
                                Gambar Karya
                                <span>*</span>
                            </label>

                            <div class="upload-box">

                                <div class="upload-icon">
                                    <i class="bi bi-cloud-arrow-up"></i>
                                </div>

                                <div class="upload-content">

                                    <div class="upload-title">
                                        Upload gambar karya
                                    </div>

                                    <div class="upload-description">
                                        JPG, JPEG, atau PNG — maksimal 2MB
                                    </div>

                                    <label
                                        for="image"
                                        class="upload-button"
                                    >
                                        <i class="bi bi-folder2-open"></i>
                                        Pilih Gambar
                                    </label>

                                    <input
                                        type="file"
                                        id="image"
                                        name="image"
                                        accept="image/*"
                                        required
                                        hidden
                                    >

                                    <div
                                        class="selected-file"
                                        id="selectedFile"
                                    >
                                    </div>

                                </div>

                            </div>

                            @error('image')
                                <div class="form-error">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>


                <!-- Form Footer -->
                <div class="project-form-footer">

                    <a
                        href="{{ route('projects.index') }}"
                        class="cancel-btn"
                    >
                        <i class="bi bi-x-lg"></i>
                        <span>Batal</span>
                    </a>

                    <button
                        type="submit"
                        class="save-project-btn"
                    >
                        <i class="bi bi-check-lg"></i>
                        <span>Simpan Karya</span>
                    </button>

                </div>

            </form>

        </div>

    </div>


    <style>

        /* =========================================
           PAGE HEADER
        ========================================= */

        .project-form-header {
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

        .project-form-title {
            margin: 0 0 5px;

            color: var(--text-primary);

            font-size: 24px;
            font-weight: 600;

            letter-spacing: -.3px;
        }

        .project-form-subtitle {
            margin: 0;

            color: var(--text-secondary);

            font-size: 13px;
        }


        /* =========================================
           FORM WRAPPER
        ========================================= */

        .project-form-wrapper {
            max-width: 900px;
        }

        .project-form-card {
            overflow: hidden;

            background: var(--bg-card);

            border: 1px solid var(--border);
            border-radius: 10px;
        }


        /* =========================================
           CARD HEADER
        ========================================= */

        .project-form-card-header {
            display: flex;
            align-items: center;
            gap: 13px;

            padding: 21px 24px;

            border-bottom: 1px solid var(--border);
        }

        .form-header-icon {
            width: 40px;
            height: 40px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            background: rgba(101,81,232,.12);

            border: 1px solid rgba(101,81,232,.18);
            border-radius: 9px;
        }

        .form-header-icon i {
            color: #7461ed;
            font-size: 17px;
        }

        .project-form-card-header h3 {
            margin: 0 0 4px;

            color: var(--text-primary);

            font-size: 14px;
            font-weight: 600;
        }

        .project-form-card-header p {
            margin: 0;

            color: var(--text-muted);

            font-size: 11px;
        }


        /* =========================================
           FORM BODY
        ========================================= */

        .project-form-body {
            padding: 25px 24px;
        }


        /* =========================================
           LABEL
        ========================================= */

        .form-label-custom {
            display: block;

            margin-bottom: 8px;

            color: var(--text-secondary);

            font-size: 12px;
            font-weight: 500;
        }

        .form-label-custom span {
            color: #e94b62;
        }


        /* =========================================
           INPUT
        ========================================= */

        .input-wrapper {
            position: relative;
        }

        .input-wrapper > i:first-child {
            position: absolute;

            left: 14px;
            top: 50%;

            z-index: 2;

            color: var(--text-dim);

            font-size: 14px;

            transform: translateY(-50%);

            pointer-events: none;
        }

        .form-control-custom {
            width: 100%;
            height: 45px;

            padding: 0 14px 0 40px;

            background: var(--bg-input);

            color: var(--text-primary);

            border: 1px solid var(--border);
            border-radius: 7px;

            outline: none;

            font-family: inherit;
            font-size: 12px;

            transition: .2s ease;
        }

        .form-control-custom::placeholder {
            color: var(--text-dim);
        }

        .form-control-custom:focus {
            background: var(--bg-input);

            color: var(--text-primary);

            border-color: #6551e8;

            box-shadow: 0 0 0 .15rem rgba(101,81,232,.12);
        }


        /* =========================================
           SELECT
        ========================================= */

        .select-custom {
            appearance: none;

            padding-right: 40px;

            cursor: pointer;
        }

        .select-custom option {
            background: var(--bg-input);
            color: var(--text-primary);
        }

        .select-arrow {
            position: absolute;

            right: 14px;
            top: 50%;

            color: var(--text-dim);

            font-size: 11px;

            transform: translateY(-50%);

            pointer-events: none;
        }


        /* =========================================
           TEXTAREA
        ========================================= */

        .textarea-wrapper {
            position: relative;
        }

        .textarea-wrapper > i {
            position: absolute;

            top: 15px;
            left: 14px;

            color: var(--text-dim);

            font-size: 14px;

            pointer-events: none;
        }

        .textarea-custom {
            height: auto;

            min-height: 125px;

            padding: 13px 14px 13px 40px;

            resize: vertical;

            line-height: 1.6;
        }


        /* =========================================
           HELP TEXT
        ========================================= */

        .form-help {
            display: flex;
            align-items: center;
            gap: 5px;

            margin-top: 6px;

            color: var(--text-dim);

            font-size: 10px;
        }

        .form-help i {
            font-size: 10px;
        }


        /* =========================================
           ERROR
        ========================================= */

        .form-error {
            display: flex;
            align-items: center;
            gap: 5px;

            margin-top: 7px;

            color: #f05268;

            font-size: 10px;
        }

        .is-invalid-custom {
            border-color: rgba(233,75,98,.55) !important;
        }


        /* =========================================
           UPLOAD
        ========================================= */

        .upload-box {
            display: flex;
            align-items: center;
            gap: 18px;

            padding: 22px;

            background: var(--bg-input);

            border: 1px dashed var(--border-strong);
            border-radius: 8px;

            transition: .2s ease;
        }

        .upload-box:hover {
            border-color: rgba(101,81,232,.55);

            background: rgba(101,81,232,.04);
        }

        .upload-icon {
            width: 52px;
            height: 52px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            background: rgba(101,81,232,.1);

            border: 1px solid rgba(101,81,232,.15);
            border-radius: 9px;
        }

        .upload-icon i {
            color: #7461ed;
            font-size: 22px;
        }

        .upload-content {
            min-width: 0;
        }

        .upload-title {
            margin-bottom: 4px;

            color: var(--text-primary);

            font-size: 12px;
            font-weight: 600;
        }

        .upload-description {
            margin-bottom: 12px;

            color: var(--text-dim);

            font-size: 10px;
        }

        .upload-button {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 7px 11px;

            background: rgba(101,81,232,.12);

            color: #a397ef;

            border: 1px solid rgba(101,81,232,.2);
            border-radius: 6px;

            font-size: 10px;
            font-weight: 600;

            cursor: pointer;

            transition: .2s ease;
        }

        .upload-button:hover {
            background: #6551e8;
            color: var(--text-primary);

            border-color: #6551e8;
        }

        .selected-file {
            margin-top: 8px;

            color: #36c98f;

            font-size: 10px;
        }


        /* =========================================
           FORM FOOTER
        ========================================= */

        .project-form-footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 9px;

            padding: 17px 24px;

            border-top: 1px solid var(--border);
        }


        /* Batal */

        .cancel-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            min-height: 40px;

            padding: 0 16px;

            background: var(--bg-hover);

            color: var(--text-secondary);

            border: 1px solid var(--border);
            border-radius: 7px;

            font-size: 11px;
            font-weight: 500;

            text-decoration: none;

            transition: .2s ease;
        }

        .cancel-btn:hover {
            background: var(--bg-hover-2);
            color: var(--text-primary);
        }


        /* Simpan */

        .save-project-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            min-height: 40px;

            padding: 0 18px;

            background: #6551e8;
            color: var(--text-primary);

            border: 1px solid #6551e8;
            border-radius: 7px;

            font-size: 11px;
            font-weight: 600;

            cursor: pointer;

            transition: .2s ease;
        }

        .save-project-btn:hover {
            background: #7461ed;
            border-color: #7461ed;
            color: var(--text-primary);

            transform: translateY(-1px);
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 768px) {

            .project-form-title {
                font-size: 21px;
            }

            .project-form-subtitle {
                font-size: 12px;
            }

            .project-form-body {
                padding: 20px 17px;
            }

            .project-form-card-header {
                padding: 18px;
            }

            .project-form-footer {
                padding: 15px 17px;
            }

            .upload-box {
                align-items: flex-start;
            }

        }


        @media (max-width: 480px) {

            .upload-box {
                flex-direction: column;
            }

            .project-form-footer {
                flex-direction: column-reverse;
            }

            .cancel-btn,
            .save-project-btn {
                width: 100%;
            }

        }

    </style>


    <script>

        // Menampilkan nama file yang dipilih
        document.getElementById('image')?.addEventListener('change', function () {

            const selectedFile = document.getElementById('selectedFile');

            if (this.files && this.files.length > 0) {

                selectedFile.innerHTML =
                    '<i class="bi bi-check-circle"></i> ' +
                    this.files[0].name;

            } else {

                selectedFile.innerHTML = '';

            }

        });

    </script>

</x-app-layout>