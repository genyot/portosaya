<section class="profile-card">

    <!-- HEADER -->
    <div class="profile-card-header">

        <div class="profile-section-icon password-icon-box">
            <i class="bi bi-shield-lock"></i>
        </div>

        <div>

            <h2 class="profile-section-title">
                {{ __('Update Password') }}
            </h2>

            <p class="profile-section-description">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>

        </div>

    </div>


    <!-- FORM -->
    <form method="post"
          action="{{ route('password.update') }}"
          class="password-form">

        @csrf
        @method('put')


        <!-- CURRENT PASSWORD -->
        <div class="password-field">

            <label
                for="update_password_current_password"
                class="profile-label">

                {{ __('Current Password') }}

            </label>

            <div class="profile-input-wrapper">

                <i class="bi bi-lock profile-input-icon"></i>

                <input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    class="profile-input"
                    autocomplete="current-password"
                    placeholder="Masukkan password saat ini"
                >

                <button
                    type="button"
                    class="password-toggle"
                    onclick="togglePassword('update_password_current_password', this)">

                    <i class="bi bi-eye"></i>

                </button>

            </div>

            @if ($errors->updatePassword->get('current_password'))

                <div class="profile-error">

                    <i class="bi bi-exclamation-circle me-1"></i>

                    {{ $errors->updatePassword->first('current_password') }}

                </div>

            @endif

        </div>


        <!-- NEW PASSWORD -->
        <div class="password-field">

            <label
                for="update_password_password"
                class="profile-label">

                {{ __('New Password') }}

            </label>

            <div class="profile-input-wrapper">

                <i class="bi bi-key profile-input-icon"></i>

                <input
                    id="update_password_password"
                    name="password"
                    type="password"
                    class="profile-input"
                    autocomplete="new-password"
                    placeholder="Masukkan password baru"
                >

                <button
                    type="button"
                    class="password-toggle"
                    onclick="togglePassword('update_password_password', this)">

                    <i class="bi bi-eye"></i>

                </button>

            </div>

            @if ($errors->updatePassword->get('password'))

                <div class="profile-error">

                    <i class="bi bi-exclamation-circle me-1"></i>

                    {{ $errors->updatePassword->first('password') }}

                </div>

            @endif

        </div>


        <!-- CONFIRM PASSWORD -->
        <div class="password-field">

            <label
                for="update_password_password_confirmation"
                class="profile-label">

                {{ __('Confirm Password') }}

            </label>

            <div class="profile-input-wrapper">

                <i class="bi bi-check2-circle profile-input-icon"></i>

                <input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="profile-input"
                    autocomplete="new-password"
                    placeholder="Konfirmasi password baru"
                >

                <button
                    type="button"
                    class="password-toggle"
                    onclick="togglePassword('update_password_password_confirmation', this)">

                    <i class="bi bi-eye"></i>

                </button>

            </div>

            @if ($errors->updatePassword->get('password_confirmation'))

                <div class="profile-error">

                    <i class="bi bi-exclamation-circle me-1"></i>

                    {{ $errors->updatePassword->first('password_confirmation') }}

                </div>

            @endif

        </div>


        <!-- ACTION -->
        <div class="password-action">

            <button
                type="submit"
                class="btn-save-profile">

                <i class="bi bi-check2 me-2"></i>

                {{ __('Save') }}

            </button>


            @if (session('status') === 'password-updated')

                <div class="password-success">

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


    .password-icon-box {

        color: #4d9cff;

        background: rgba(77,156,255,.12);

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

    .password-form {

        padding-top: 24px;

    }


    .password-field {

        margin-bottom: 20px;

        max-width: 700px;

    }


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

        padding: 10px 42px;

        font-size: 12px;

        outline: none;

        transition: .2s ease;

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
       PASSWORD TOGGLE
    ================================= */

    .password-toggle {

        position: absolute;

        right: 10px;

        top: 50%;

        transform: translateY(-50%);

        border: none;

        background: transparent;

        color: var(--text-dim);

        font-size: 15px;

        cursor: pointer;

        padding: 5px;

    }


    .password-toggle:hover {

        color: var(--text-primary);

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
       ACTION
    ================================= */

    .password-action {

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

    .password-success {

        display: flex;

        align-items: center;

        gap: 6px;

        color: #36c98f;

        font-size: 12px;

    }


    .password-success i {

        font-size: 14px;

    }

</style>


<script>

    function togglePassword(inputId, button) {

        const input = document.getElementById(inputId);

        const icon = button.querySelector('i');

        if (input.type === 'password') {

            input.type = 'text';

            icon.classList.remove('bi-eye');

            icon.classList.add('bi-eye-slash');

        } else {

            input.type = 'password';

            icon.classList.remove('bi-eye-slash');

            icon.classList.add('bi-eye');

        }

    }

</script>