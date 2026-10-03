{{--
    CSS bersama untuk semua halaman index CRUD admin.
    Pakai: <x-admin-index-style />
--}}

<style>

    /* HEADER */
    .crud-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .crud-title {
        margin: 0 0 5px;
        color: var(--text-primary);
        font-size: 24px;
        font-weight: 600;
        letter-spacing: -.3px;
    }

    .crud-subtitle {
        margin: 0;
        color: var(--text-secondary);
        font-size: 13px;
    }

    /* BUTTON TAMBAH */
    .crud-add-btn {
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

    .crud-add-btn:hover {
        background: #7461ed;
        border-color: #7461ed;
        color: var(--text-primary);
        transform: translateY(-1px);
    }

    /* ALERT */
    .crud-alert {
        display: flex;
        align-items: center;
        gap: 9px;

        margin-bottom: 18px;
        padding: 13px 16px;

        border-radius: 8px;

        font-size: 12px;
    }

    .crud-alert.success-alert {
        background: rgba(54,201,143,.10);
        border: 1px solid rgba(54,201,143,.20);
        color: #36c98f;
    }

    .crud-alert.error-alert {
        background: rgba(240,82,104,.10);
        border: 1px solid rgba(240,82,104,.20);
        color: #f05268;
    }

    /* FILTER BAR */
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

    .filter-search input::placeholder { color: var(--text-dim); }

    .filter-search input:focus {
        border-color: #6551e8;
        box-shadow: 0 0 0 .15rem rgba(101,81,232,.12);
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

    /* CARD & TABLE */
    .crud-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
    }

    .crud-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;

        padding: 20px 22px;

        border-bottom: 1px solid var(--border);
    }

    .crud-card-title {
        display: flex;
        align-items: center;
        gap: 9px;

        margin: 0 0 4px;

        color: var(--text-primary);
        font-size: 14px;
        font-weight: 600;
    }

    .crud-card-title i { color: #6551e8; font-size: 15px; }

    .crud-card-subtitle {
        margin: 0;
        color: var(--text-muted);
        font-size: 11px;
    }

    .crud-count {
        padding: 6px 11px;

        background: rgba(101,81,232,.12);
        color: #a397ef;

        border: 1px solid rgba(101,81,232,.2);
        border-radius: 6px;

        font-size: 10px;
        font-weight: 600;

        white-space: nowrap;
    }

    .crud-table {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
    }

    .crud-table thead { background: var(--bg-alt); }

    .crud-table th {
        padding: 13px 20px;

        color: var(--text-secondary);

        border-bottom: 1px solid var(--border);

        font-size: 10px;
        font-weight: 600;

        text-transform: uppercase;
        letter-spacing: .4px;

        white-space: nowrap;
        text-align: left;
    }

    .crud-table td {
        padding: 15px 20px;

        color: var(--text-primary);

        border-bottom: 1px solid var(--surface-2);

        font-size: 12px;
        vertical-align: middle;
    }

    .crud-table tbody tr { transition: .2s ease; }
    .crud-table tbody tr:hover { background: var(--bg-hover); }
    .crud-table tbody tr:last-child td { border-bottom: none; }

    .crud-number { color: var(--text-dim); font-size: 11px; }
    .crud-muted { color: var(--text-secondary); font-size: 11px; }

    /* ACTION BUTTON */
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

    .action-btn i { font-size: 13px; }

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

    /* EMPTY STATE */
    .crud-empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        padding: 65px 20px;
        text-align: center;
    }

    .crud-empty-icon {
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

    .crud-empty-icon i { color: #7461ed; font-size: 23px; }

    .crud-empty h4 {
        margin: 0 0 6px;
        color: var(--text-primary);
        font-size: 14px;
        font-weight: 600;
    }

    .crud-empty p {
        margin: 0 0 18px;
        color: var(--text-muted);
        font-size: 11px;
    }

    /* PAGINATION */
    .pagination-wrapper {
        padding: 18px 22px;
        border-top: 1px solid var(--border);
    }

    .pagination-wrapper nav { display: flex; justify-content: flex-end; }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .crud-header { align-items: flex-start; flex-direction: column; }
        .crud-add-btn { width: 100%; justify-content: center; }
        .crud-card-header { align-items: flex-start; flex-direction: column; }

        /* =========================
           TABEL -> KARTU DI MOBILE
        ========================= */

        .crud-table { min-width: 0; }

        /* Sembunyikan header tabel */
        .crud-table thead { display: none; }

        /* Tiap baris jadi kartu */
        .crud-table tbody tr {
            display: block;

            margin-bottom: 12px;
            padding: 16px;

            background: var(--bg-alt);
            border: 1px solid var(--border);
            border-radius: 10px;
        }

        .crud-table tbody tr:hover { background: var(--bg-alt); }

        .crud-table tbody tr:last-child { margin-bottom: 0; }

        /* Tiap sel jadi baris label : nilai */
        .crud-table td {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;

            padding: 9px 0;

            border-bottom: 1px solid var(--surface-2);

            text-align: right;
        }

        .crud-table td:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .crud-table td:first-child { padding-top: 0; }

        /* Label otomatis dari atribut data-label */
        .crud-table td::before {
            content: attr(data-label);

            flex-shrink: 0;

            color: var(--text-dim);

            font-size: 10px;
            font-weight: 600;

            text-transform: uppercase;
            letter-spacing: .4px;

            text-align: left;
        }

        /* Sel nomor & aksi tidak butuh label */
        .crud-table td.cell-number::before,
        .crud-table td.cell-action::before { content: none; }

        .crud-table td.cell-number,
        .crud-table td.cell-action { justify-content: flex-start; }

        .crud-table td.cell-action { justify-content: flex-end; }

        /* Tombol aksi lebih besar & nyaman disentuh */
        .action-btn {
            width: 42px;
            height: 42px;
        }

        .action-btn i { font-size: 16px; }

        /* Empty state & pagination tetap normal */
        .crud-empty { padding: 45px 15px; }

        /* Baris empty state: jangan dijadikan kartu */
        .crud-table tbody tr.row-empty {
            background: transparent;
            border: none;
            padding: 0;
        }

        .crud-table td.cell-empty {
            display: block;
            text-align: center;
            border-bottom: none;
        }

        .crud-table td.cell-empty::before { content: none; }
    }

    @media (max-width: 480px) {
        .crud-title { font-size: 21px; }
        .crud-subtitle { font-size: 12px; }
    }

</style>
