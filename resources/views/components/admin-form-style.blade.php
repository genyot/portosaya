{{--
    CSS bersama untuk semua halaman form (create/edit) admin.
    Pakai: <x-admin-form-style />
--}}

<style>

    .crud-form-header { margin-bottom: 24px; }

    .crud-back-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;

        margin-bottom: 13px;

        color: var(--text-muted);
        font-size: 11px;

        text-decoration: none;
        transition: 0.2s;
    }

    .crud-back-link:hover { color: #b8afff; }
    .crud-back-link i { font-size: 12px; }

    .crud-form-title {
        margin: 0 0 6px;
        color: var(--text-primary);
        font-size: 24px;
        font-weight: 600;
        line-height: 1.3;
    }

    .crud-form-subtitle {
        margin: 0;
        color: var(--text-secondary);
        font-size: 13px;
        line-height: 1.5;
    }

    .crud-form-wrapper {
        width: 100%;
        max-width: 700px;
        margin: 0 auto;
    }

    .crud-form-card {
        background: var(--bg-card);

        border: 1px solid var(--border);
        border-radius: 10px;

        padding: 28px;

        box-shadow: 0 8px 30px rgba(0,0,0,0.10);
    }

    .crud-form-card-header {
        display: flex;
        align-items: center;
        gap: 13px;

        padding-bottom: 22px;
        margin-bottom: 25px;

        border-bottom: 1px solid var(--border);
    }

    .crud-form-icon {
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

    .crud-form-card-header h2 {
        margin: 0 0 4px;
        color: var(--text-primary);
        font-size: 14px;
        font-weight: 600;
    }

    .crud-form-card-header p {
        margin: 0;
        color: var(--text-muted);
        font-size: 11px;
    }

    .crud-field { margin-bottom: 20px; }

    .crud-field > label {
        display: block;
        margin-bottom: 8px;

        color: var(--text-secondary);
        font-size: 12px;
        font-weight: 500;
    }

    .crud-field > label span { color: #e94b62; }

    .crud-input-wrapper {
        position: relative;
        width: 100%;
    }

    .crud-input-wrapper > i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);

        color: var(--text-muted);
        font-size: 15px;

        pointer-events: none;
        z-index: 2;
    }

    .crud-input-wrapper input,
    .crud-input-wrapper select,
    .crud-input-wrapper textarea {
        width: 100%;

        background: var(--bg-input);

        border: 1px solid var(--border);
        border-radius: 8px;

        outline: none;

        color: var(--text-primary);

        font-family: 'Inter', sans-serif;
        font-size: 13px;

        transition: all 0.2s ease;
    }

    .crud-input-wrapper input,
    .crud-input-wrapper select {
        height: 46px;
        padding: 0 15px 0 43px;
    }

    .crud-input-wrapper textarea {
        min-height: 120px;
        padding: 13px 15px 13px 43px;
        resize: vertical;
        line-height: 1.6;
    }

    .crud-input-wrapper select {
        appearance: none;
        cursor: pointer;
        padding-right: 40px;
    }

    .crud-input-wrapper select option {
        background: var(--bg-input);
        color: var(--text-primary);
    }

    .crud-input-wrapper input::placeholder,
    .crud-input-wrapper textarea::placeholder {
        color: var(--text-dim);
        opacity: 1;
    }

    .crud-input-wrapper input:focus,
    .crud-input-wrapper select:focus,
    .crud-input-wrapper textarea:focus {
        border-color: #6551e8;
        box-shadow: 0 0 0 3px rgba(101,81,232,0.14);
    }

    .crud-input-wrapper input.input-error,
    .crud-input-wrapper select.input-error,
    .crud-input-wrapper textarea.input-error {
        border-color: #f05268;
    }

    .crud-select-arrow {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);

        color: var(--text-dim);
        font-size: 12px;

        pointer-events: none;
    }

    .crud-error {
        display: flex;
        align-items: center;
        gap: 6px;

        margin-top: 8px;

        color: #f05268;
        font-size: 11px;
        line-height: 1.4;
    }

    .crud-error i { font-size: 12px; }

    .crud-help {
        display: flex;
        align-items: center;
        gap: 6px;

        margin-top: 9px;

        color: var(--text-dim);
        font-size: 10px;
        line-height: 1.5;
    }

    .crud-help i { color: var(--text-muted); font-size: 11px; }

    .crud-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 9px;

        margin-top: 30px;
        padding-top: 22px;

        border-top: 1px solid var(--border);
    }

    .crud-cancel {
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

    .crud-cancel:hover {
        background: var(--bg-hover);
        border-color: var(--border-strong);
        color: var(--text-primary);
    }

    .crud-save {
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

    .crud-save:hover {
        background: #7461ed;
        color: var(--text-primary);
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(101,81,232,0.22);
    }

    .crud-save:active { transform: translateY(0); }

    .crud-save i,
    .crud-cancel i { font-size: 12px; }

    @media (max-width: 768px) {
        .crud-form-title { font-size: 21px; }
        .crud-form-subtitle { font-size: 12px; }
        .crud-form-card { padding: 22px; }
    }

    @media (max-width: 576px) {
        .crud-form-wrapper { max-width: 100%; }

        .crud-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .crud-cancel,
        .crud-save { width: 100%; }
    }

</style>
