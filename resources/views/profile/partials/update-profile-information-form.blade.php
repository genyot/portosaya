<section class="profile-card">

    <!-- HEADER -->
    <div class="profile-card-header">

        <div class="profile-section-icon profile-icon-box">
            <i class="bi bi-person"></i>
        </div>

        <div>

            <h2 class="profile-section-title">
                {{ __('Profile Information') }}
            </h2>

            <p class="profile-section-description">
                {{ __("Update your account's profile information and email address.") }}
            </p>

        </div>

    </div>


    <!-- VERIFICATION FORM -->
    <form
        id="send-verification"
        method="post"
        action="{{ route('verification.send') }}">

        @csrf

    </form>


    <!-- PROFILE FORM -->
    <form
        method="post"
        action="{{ route('profile.update') }}"
        class="profile-form"
        enctype="multipart/form-data">

        @csrf
        @method('patch')


        <!-- FOTO PROFIL -->
        <div class="profile-photo-section">

            <div class="profile-photo-preview">

                @if ($user->photo_url)

                    <img
                        src="{{ $user->photo_url }}"
                        alt="{{ $user->name }}"
                        id="photoPreviewImg"
                    >

                @else

                    <div class="profile-photo-initial" id="photoPreviewInitial">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                @endif

            </div>


            <div class="profile-photo-info">

                <div class="profile-photo-title">
                    Foto Profil
                </div>

                <div class="profile-photo-desc">
                    JPG, PNG, atau WEBP — maksimal 2MB.
                </div>

                <label for="photo" class="profile-photo-btn">
                    <i class="bi bi-camera"></i>
                    <span>Pilih Foto</span>
                </label>

                <input
                    type="file"
                    id="photo"
                    name="photo"
                    accept="image/*"
                    hidden
                >

                <div class="profile-photo-filename" id="photoFileName"></div>

                @if ($errors->get('photo'))
                    <div class="profile-error">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        {{ $errors->first('photo') }}
                    </div>
                @endif

            </div>

        </div>


        <!-- NAME -->
        <div class="profile-field">

            <label
                for="name"
                class="profile-label">

                {{ __('Name') }}

            </label>


            <div class="profile-input-wrapper">

                <i class="bi bi-person profile-input-icon"></i>

                <input
                    id="name"
                    name="name"
                    type="text"
                    class="profile-input"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Masukkan nama"
                >

            </div>


            @if ($errors->get('name'))

                <div class="profile-error">

                    <i class="bi bi-exclamation-circle me-1"></i>

                    {{ $errors->first('name') }}

                </div>

            @endif

        </div>


        <!-- EMAIL -->
        <div class="profile-field">

            <label
                for="email"
                class="profile-label">

                {{ __('Email') }}

            </label>


            <div class="profile-input-wrapper">

                <i class="bi bi-envelope profile-input-icon"></i>

                <input
                    id="email"
                    name="email"
                    type="email"
                    class="profile-input"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                    placeholder="Masukkan email"
                >

            </div>


            @if ($errors->get('email'))

                <div class="profile-error">

                    <i class="bi bi-exclamation-circle me-1"></i>

                    {{ $errors->first('email') }}

                </div>

            @endif


            <!-- EMAIL VERIFICATION -->
            @if (
                $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail
                && ! $user->hasVerifiedEmail()
            )

                <div class="verification-box">

                    <div class="verification-icon">

                        <i class="bi bi-envelope-exclamation"></i>

                    </div>


                    <div class="verification-content">

                        <div class="verification-title">

                            {{ __('Your email address is unverified.') }}

                        </div>


                        <button
                            form="send-verification"
                            type="submit"
                            class="verification-button">

                            {{ __('Click here to re-send the verification email.') }}

                        </button>


                        @if (session('status') === 'verification-link-sent')

                            <div class="verification-success">

                                <i class="bi bi-check-circle-fill"></i>

                                {{ __('A new verification link has been sent to your email address.') }}

                            </div>

                        @endif

                    </div>

                </div>

            @endif

        </div>


        <!-- TAGLINE -->
        <div class="profile-field">
            <label for="tagline" class="profile-label">Tagline / Peran</label>

            <div class="profile-input-wrapper">
                <i class="bi bi-lightning-charge profile-input-icon"></i>
                <input
                    id="tagline"
                    name="tagline"
                    type="text"
                    class="profile-input"
                    value="{{ old('tagline', $user->tagline) }}"
                    placeholder="Contoh: Developer × Graphic Designer"
                >
            </div>

            @if ($errors->get('tagline'))
                <div class="profile-error">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    {{ $errors->first('tagline') }}
                </div>
            @endif
        </div>


        <!-- BIO -->
        <div class="profile-field">
            <label for="bio" class="profile-label">Bio Singkat</label>

            <div class="profile-input-wrapper">
                <i class="bi bi-card-text profile-input-icon"></i>
                <textarea
                    id="bio"
                    name="bio"
                    class="profile-input"
                    rows="3"
                    placeholder="Ceritakan singkat tentang dirimu..."
                >{{ old('bio', $user->bio) }}</textarea>
            </div>

            @if ($errors->get('bio'))
                <div class="profile-error">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    {{ $errors->first('bio') }}
                </div>
            @endif
        </div>


        <!-- KONTAK & SOSIAL MEDIA -->
        <div class="profile-section-divider">
            <i class="bi bi-share"></i>
            Kontak & Sosial Media
        </div>

        <div class="profile-row">
            <div class="profile-field">
                <label for="phone" class="profile-label">Telepon</label>
                <div class="profile-input-wrapper">
                    <i class="bi bi-telephone profile-input-icon"></i>
                    <input id="phone" name="phone" type="text" class="profile-input"
                           value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx">
                </div>
            </div>

            <div class="profile-field">
                <label for="whatsapp" class="profile-label">WhatsApp</label>
                <div class="profile-input-wrapper">
                    <i class="bi bi-whatsapp profile-input-icon"></i>
                    <input id="whatsapp" name="whatsapp" type="text" class="profile-input"
                           value="{{ old('whatsapp', $user->whatsapp) }}" placeholder="08xxxxxxxxxx">
                </div>
            </div>
        </div>

        <div class="profile-row">
            <div class="profile-field">
                <label for="instagram" class="profile-label">Instagram</label>
                <div class="profile-input-wrapper">
                    <i class="bi bi-instagram profile-input-icon"></i>
                    <input id="instagram" name="instagram" type="text" class="profile-input"
                           value="{{ old('instagram', $user->instagram) }}" placeholder="https://instagram.com/...">
                </div>
            </div>

            <div class="profile-field">
                <label for="github" class="profile-label">GitHub</label>
                <div class="profile-input-wrapper">
                    <i class="bi bi-github profile-input-icon"></i>
                    <input id="github" name="github" type="text" class="profile-input"
                           value="{{ old('github', $user->github) }}" placeholder="https://github.com/...">
                </div>
            </div>
        </div>

        <div class="profile-row">
            <div class="profile-field">
                <label for="linkedin" class="profile-label">LinkedIn</label>
                <div class="profile-input-wrapper">
                    <i class="bi bi-linkedin profile-input-icon"></i>
                    <input id="linkedin" name="linkedin" type="text" class="profile-input"
                           value="{{ old('linkedin', $user->linkedin) }}" placeholder="https://linkedin.com/in/...">
                </div>
            </div>

            <div class="profile-field">
                <label for="dribbble" class="profile-label">Dribbble / Behance</label>
                <div class="profile-input-wrapper">
                    <i class="bi bi-dribbble profile-input-icon"></i>
                    <input id="dribbble" name="dribbble" type="text" class="profile-input"
                           value="{{ old('dribbble', $user->dribbble) }}" placeholder="https://dribbble.com/...">
                </div>
            </div>
        </div>


        <!-- CV -->
        <div class="profile-section-divider">
            <i class="bi bi-file-earmark-person"></i>
            Curriculum Vitae (CV)
        </div>

        <div class="profile-field">
            <label for="cv_file" class="profile-label">File CV (PDF/DOC)</label>

            <div class="profile-input-wrapper">
                <i class="bi bi-file-earmark-text profile-input-icon"></i>
                <input
                    id="cv_file"
                    name="cv_file"
                    type="file"
                    class="profile-input profile-file-input"
                    accept=".pdf,.doc,.docx"
                >
            </div>

            @if ($user->cv_url)
                <div class="profile-help">
                    <i class="bi bi-paperclip"></i>
                    CV saat ini:
                    <a href="{{ $user->cv_url }}" target="_blank" rel="noopener">Lihat / Unduh</a>
                </div>
            @else
                <div class="profile-help">
                    <i class="bi bi-info-circle"></i>
                    Belum ada CV. Upload untuk mengaktifkan tombol "Download CV" di halaman publik.
                </div>
            @endif

            @if ($errors->get('cv_file'))
                <div class="profile-error">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    {{ $errors->first('cv_file') }}
                </div>
            @endif
        </div>


        <!-- ACTION -->
        <div class="profile-action">

            <button
                type="submit"
                class="btn-save-profile">

                <i class="bi bi-check2 me-2"></i>

                {{ __('Save') }}

            </button>


            @if (session('status') === 'profile-updated')

                <div class="profile-success">

                    <i class="bi bi-check-circle-fill"></i>

                    {{ __('Saved.') }}

                </div>

            @endif

        </div>

    </form>

</section>


<style>

    /* =================================
       PROFILE CARD
    ================================= */

    .profile-card {

        background: var(--bg-card);

        border: 1px solid var(--border);

        border-radius: 10px;

        padding: 25px;

        color: var(--text-primary);

    }


    /* =================================
       HEADER
    ================================= */

    .profile-card-header {

        display: flex;

        align-items: flex-start;

        gap: 17px;

        padding-bottom: 22px;

        border-bottom: 1px solid var(--border);

    }


    .profile-section-icon {

        width: 45px;

        height: 45px;

        flex-shrink: 0;

        border-radius: 10px;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 19px;

    }


    .profile-icon-box {

        color: #6551e8;

        background: rgba(101,81,232,.13);

    }


    .profile-section-title {

        margin: 0 0 6px;

        font-size: 16px;

        font-weight: 600;

        color: var(--text-primary);

    }


    .profile-section-description {

        margin: 0;

        color: var(--text-muted);

        font-size: 12px;

        line-height: 1.6;

    }


    /* =================================
       FORM
    ================================= */

    .profile-form {

        padding-top: 24px;

    }


    /* =================================
       FOTO PROFIL
    ================================= */

    .profile-photo-section {

        display: flex;

        align-items: center;

        gap: 22px;

        margin-bottom: 28px;

        padding-bottom: 24px;

        border-bottom: 1px solid var(--border);

    }


    .profile-photo-preview {

        width: 96px;

        height: 96px;

        flex-shrink: 0;

        border-radius: 50%;

        overflow: hidden;

        background: var(--bg-input);

        border: 2px solid rgba(101,81,232,.35);

        display: flex;

        align-items: center;

        justify-content: center;

    }


    .profile-photo-preview img {

        width: 100%;

        height: 100%;

        object-fit: cover;

        display: block;

    }


    .profile-photo-initial {

        width: 100%;

        height: 100%;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #6551e8;

        color: var(--text-primary);

        font-size: 34px;

        font-weight: 600;

    }


    .profile-photo-info {

        min-width: 0;

    }


    .profile-photo-title {

        color: var(--text-primary);

        font-size: 13px;

        font-weight: 600;

        margin-bottom: 4px;

    }


    .profile-photo-desc {

        color: var(--text-muted);

        font-size: 11px;

        margin-bottom: 12px;

    }


    .profile-photo-btn {

        display: inline-flex;

        align-items: center;

        gap: 7px;

        padding: 8px 14px;

        background: rgba(101,81,232,.12);

        border: 1px solid rgba(101,81,232,.25);

        border-radius: 7px;

        color: #a397ef;

        font-size: 11px;

        font-weight: 600;

        cursor: pointer;

        transition: .2s ease;

    }


    .profile-photo-btn:hover {

        background: #6551e8;

        border-color: #6551e8;

        color: var(--text-primary);

    }


    .profile-photo-filename {

        margin-top: 8px;

        color: #36c98f;

        font-size: 11px;

    }


    .profile-field {

        margin-bottom: 20px;

        max-width: 700px;

    }


    /* Dua kolom untuk field berdampingan */
    .profile-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;

        max-width: 700px;
    }


    /* Judul pemisah bagian */
    .profile-section-divider {
        display: flex;
        align-items: center;
        gap: 9px;

        max-width: 700px;

        margin: 8px 0 18px;

        padding-top: 18px;

        border-top: 1px solid var(--border);

        color: var(--text-secondary);

        font-size: 12px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: .5px;
    }


    .profile-section-divider i {
        color: var(--accent);
        font-size: 14px;
    }


    /* Input file */
    .profile-file-input {
        padding-top: 9px !important;
        padding-bottom: 9px !important;

        height: auto !important;

        color: var(--text-muted);
        font-size: 12px;

        cursor: pointer;
    }


    .profile-file-input::file-selector-button {
        margin-right: 12px;

        padding: 7px 14px;

        background: var(--accent-soft);
        color: var(--accent);

        border: 1px solid rgba(124, 108, 255, .25);
        border-radius: 7px;

        font-family: inherit;
        font-size: 11px;
        font-weight: 600;

        cursor: pointer;
    }


    /* Teks bantuan */
    .profile-help {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;

        margin-top: 9px;

        color: var(--text-dim);
        font-size: 11px;
    }


    .profile-help a {
        color: var(--accent);
        font-weight: 600;
        text-decoration: none;
    }


    .profile-help a:hover { text-decoration: underline; }


    .profile-label {

        display: block;

        margin-bottom: 8px;

        color: var(--text-secondary);

        font-size: 11px;

        font-weight: 500;

    }


    /* =================================
       INPUT
    ================================= */

    .profile-input-wrapper {

        position: relative;

    }


    .profile-input {

        width: 100%;

        height: 43px;

        background: var(--bg-input);

        border: 1px solid var(--border);

        border-radius: 7px;

        color: var(--text-primary);

        padding: 10px 14px 10px 40px;

        font-size: 12px;

        font-family: inherit;

        outline: none;

        transition: .2s ease;

    }


    /* Textarea di dalam form profil */
    textarea.profile-input {
        height: auto;
        min-height: 90px;
        resize: vertical;
        line-height: 1.6;
    }


    .profile-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 .15rem var(--accent-soft);
    }


    .profile-input::placeholder {

        color: var(--text-dim);

    }


    .profile-input:focus {

        background: var(--bg-input);

        border-color: #6551e8;

        box-shadow: 0 0 0 .15rem rgba(101,81,232,.12);

        color: var(--text-primary);

    }


    .profile-input-icon {

        position: absolute;

        left: 14px;

        top: 50%;

        transform: translateY(-50%);

        color: var(--text-dim);

        font-size: 14px;

        z-index: 2;

    }


    /* =================================
       ERROR
    ================================= */

    .profile-error {

        color: #f05268;

        font-size: 11px;

        margin-top: 7px;

    }


    /* =================================
       EMAIL VERIFICATION
    ================================= */

    .verification-box {

        display: flex;

        gap: 12px;

        margin-top: 12px;

        padding: 13px;

        background: rgba(243,167,53,.07);

        border: 1px solid rgba(243,167,53,.15);

        border-radius: 7px;

    }


    .verification-icon {

        width: 30px;

        height: 30px;

        flex-shrink: 0;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 6px;

        background: rgba(243,167,53,.12);

        color: #f3a735;

        font-size: 14px;

    }


    .verification-content {

        flex: 1;

    }


    .verification-title {

        color: #d8bd82;

        font-size: 11px;

        margin-bottom: 5px;

    }


    .verification-button {

        padding: 0;

        border: none;

        background: transparent;

        color: var(--accent);

        font-size: 11px;

        cursor: pointer;

    }


    .verification-button:hover {

        color: #c0b2f1;

        text-decoration: underline;

    }


    .verification-success {

        display: flex;

        align-items: center;

        gap: 5px;

        color: #36c98f;

        font-size: 11px;

        margin-top: 8px;

    }


    /* =================================
       ACTION
    ================================= */

    .profile-action {

        display: flex;

        align-items: center;

        gap: 15px;

        padding-top: 5px;

    }


    .btn-save-profile {

        border: none;

        background: #6551e8;

        color: var(--text-primary);

        border-radius: 7px;

        padding: 10px 18px;

        font-size: 12px;

        font-weight: 500;

        transition: .2s ease;

    }


    .btn-save-profile:hover {

        background: #7461ed;

        color: var(--text-primary);

        transform: translateY(-1px);

        box-shadow: 0 7px 18px rgba(101,81,232,.2);

    }


    /* =================================
       SUCCESS
    ================================= */

    .profile-success {

        display: flex;

        align-items: center;

        gap: 6px;

        color: #36c98f;

        font-size: 12px;

    }


    .profile-success i {

        font-size: 14px;

    }


    /* =================================
       RESPONSIVE
    ================================= */

    @media (max-width: 576px) {

        .profile-card {

            padding: 18px;

        }


        .profile-card-header {

            gap: 12px;

        }


        .profile-section-icon {

            width: 40px;

            height: 40px;

        }


        .profile-photo-section {

            flex-direction: column;

            align-items: flex-start;

            gap: 16px;

        }


        .profile-row {

            grid-template-columns: 1fr;

            gap: 0;

        }

    }

</style>


<script>

    /*
     * Preview foto sebelum diupload + tampilkan nama file.
     */
    document.getElementById('photo')?.addEventListener('change', function () {

        const file = this.files && this.files[0];

        if (!file) return;

        // Tampilkan nama file
        document.getElementById('photoFileName').textContent = file.name;

        // Tampilkan preview
        const reader = new FileReader();

        reader.onload = function (e) {

            const preview = document.querySelector('.profile-photo-preview');

            preview.innerHTML =
                '<img src="' + e.target.result + '" alt="Preview">';

        };

        reader.readAsDataURL(file);

    });

</script>