<section class="profile-danger-card">

    <div class="danger-header">

        <div class="danger-icon">
            <i class="bi bi-shield-exclamation"></i>
        </div>

        <div>
            <h2 class="danger-title">
                {{ __('Delete Account') }}
            </h2>

            <p class="danger-description">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>
        </div>

    </div>


    <div class="danger-action">

        <button
            type="button"
            class="btn btn-danger-custom"
            data-bs-toggle="modal"
            data-bs-target="#confirmUserDeletion">

            <i class="bi bi-trash3 me-2"></i>

            {{ __('Delete Account') }}

        </button>

    </div>

</section>


<!-- DELETE ACCOUNT MODAL -->
<div
    class="modal fade"
    id="confirmUserDeletion"
    tabindex="-1"
    aria-labelledby="confirmUserDeletionLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content delete-modal">

            <form
                method="post"
                action="{{ route('profile.destroy') }}">

                @csrf

                @method('delete')


                <!-- MODAL HEADER -->
                <div class="modal-header delete-modal-header">

                    <div class="d-flex align-items-center gap-3">

                        <div class="modal-danger-icon">

                            <i class="bi bi-exclamation-triangle"></i>

                        </div>

                        <div>

                            <h5
                                class="modal-title"
                                id="confirmUserDeletionLabel">

                                {{ __('Delete Account') }}

                            </h5>

                            <small>
                                This action cannot be undone
                            </small>

                        </div>

                    </div>


                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>

                </div>


                <!-- MODAL BODY -->
                <div class="modal-body p-4">

                    <p class="delete-warning">

                        <i class="bi bi-info-circle me-2"></i>

                        {{ __('Are you sure you want to delete your account?') }}

                    </p>


                    <p class="delete-description">

                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}

                    </p>


                    <!-- PASSWORD -->
                    <div class="mt-4">

                        <label
                            for="password"
                            class="form-label delete-label">

                            {{ __('Password') }}

                        </label>


                        <div class="password-wrapper">

                            <i class="bi bi-lock password-icon"></i>

                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control delete-input"
                                placeholder="{{ __('Enter your password') }}"
                                required
                            >

                        </div>


                        @if ($errors->userDeletion->get('password'))

                            <div class="text-danger small mt-2">

                                @foreach ($errors->userDeletion->get('password') as $message)

                                    <div>
                                        {{ $message }}
                                    </div>

                                @endforeach

                            </div>

                        @endif

                    </div>

                </div>


                <!-- MODAL FOOTER -->
                <div class="modal-footer delete-modal-footer">

                    <button
                        type="button"
                        class="btn btn-cancel"
                        data-bs-dismiss="modal">

                        {{ __('Cancel') }}

                    </button>


                    <button
                        type="submit"
                        class="btn btn-danger-custom">

                        <i class="bi bi-trash3 me-2"></i>

                        {{ __('Delete Account') }}

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<style>

    /* ==============================
       DELETE ACCOUNT CARD
    ============================== */

    .profile-danger-card {
        background: var(--bg-card);

        border: 1px solid rgba(240,82,104,.18);

        border-radius: 10px;

        padding: 25px;

        margin-top: 25px;
    }


    .danger-header {
        display: flex;

        align-items: flex-start;

        gap: 18px;
    }


    .danger-icon {
        width: 45px;
        height: 45px;

        flex-shrink: 0;

        border-radius: 10px;

        display: flex;

        align-items: center;
        justify-content: center;

        background: rgba(240,82,104,.12);

        color: #f05268;

        font-size: 20px;
    }


    .danger-title {
        color: var(--text-primary);

        font-size: 16px;

        font-weight: 600;

        margin: 0 0 7px;
    }


    .danger-description {
        color: var(--text-muted);

        font-size: 12px;

        line-height: 1.7;

        max-width: 750px;

        margin: 0;
    }


    .danger-action {
        margin-top: 22px;

        padding-top: 20px;

        border-top: 1px solid var(--border);
    }


    /* ==============================
       DELETE BUTTON
    ============================== */

    .btn-danger-custom {
        background: #e94b62;

        border: none;

        color: var(--text-primary);

        border-radius: 7px;

        padding: 9px 16px;

        font-size: 12px;

        font-weight: 500;

        transition: .2s ease;
    }


    .btn-danger-custom:hover {
        background: #d83f56;

        color: var(--text-primary);

        transform: translateY(-1px);

        box-shadow: 0 7px 18px rgba(240,82,104,.20);
    }


    /* ==============================
       MODAL
    ============================== */

    .delete-modal {
        background: var(--bg-card);

        border: 1px solid var(--border);

        border-radius: 12px;

        overflow: hidden;

        color: var(--text-primary);
    }


    .delete-modal-header {
        padding: 20px 22px;

        border-bottom: 1px solid var(--border);
    }


    .modal-danger-icon {
        width: 42px;
        height: 42px;

        border-radius: 9px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: rgba(240,82,104,.12);

        color: #f05268;

        font-size: 18px;
    }


    .delete-modal-header .modal-title {
        font-size: 15px;

        font-weight: 600;

        color: var(--text-primary);
    }


    .delete-modal-header small {
        color: var(--text-dim);

        font-size: 10px;
    }


    .delete-modal-header .btn-close {
        opacity: .7;
    }


    .delete-modal-header .btn-close:hover {
        opacity: 1;
    }


    /* ==============================
       MODAL BODY
    ============================== */

    .delete-warning {
        background: rgba(240,82,104,.08);

        border: 1px solid rgba(240,82,104,.15);

        border-radius: 7px;

        padding: 12px 14px;

        color: #f17888;

        font-size: 12px;

        margin-bottom: 15px;
    }


    .delete-description {
        color: var(--text-muted);

        font-size: 12px;

        line-height: 1.7;

        margin: 0;
    }


    .delete-label {
        color: var(--text-secondary);

        font-size: 11px;

        font-weight: 500;
    }


    /* ==============================
       PASSWORD INPUT
    ============================== */

    .password-wrapper {
        position: relative;
    }


    .password-icon {
        position: absolute;

        left: 13px;

        top: 50%;

        transform: translateY(-50%);

        color: var(--text-dim);

        font-size: 14px;

        z-index: 2;
    }


    .delete-input {
        background: var(--bg-input);

        border: 1px solid var(--border);

        color: var(--text-primary);

        border-radius: 7px;

        padding: 10px 12px 10px 38px;

        font-size: 12px;
    }


    .delete-input::placeholder {
        color: var(--text-dim);
    }


    .delete-input:focus {
        background: var(--bg-input);

        border-color: #6551e8;

        color: var(--text-primary);

        box-shadow: 0 0 0 .15rem rgba(101,81,232,.15);
    }


    /* ==============================
       MODAL FOOTER
    ============================== */

    .delete-modal-footer {
        border-top: 1px solid var(--border);

        padding: 15px 22px;
    }


    .btn-cancel {
        background: #2b344e;

        border: none;

        color: var(--text-secondary);

        border-radius: 7px;

        padding: 9px 16px;

        font-size: 12px;
    }


    .btn-cancel:hover {
        background: #343e59;

        color: var(--text-primary);
    }

</style>