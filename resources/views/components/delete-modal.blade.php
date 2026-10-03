@props([
    'title'     => 'Hapus Data?',
    'label'     => 'data ini',
    'urlPrefix' => '',
    'warning'   => 'Data yang sudah dihapus tidak dapat dikembalikan.',
])

{{--
    Komponen modal konfirmasi hapus (reusable).
    Pemakaian:
        <x-delete-modal
            title="Hapus Skill?"
            label="skill"
            url-prefix="/skills"
        />
    Lalu tombol hapus memanggil: openDeleteModal(id, nama)
--}}

<div
    class="delete-modal-overlay"
    id="deleteModal"
    data-prefix="{{ $urlPrefix }}"
    onclick="closeDeleteModal(event)"
>

    <div
        class="delete-modal"
        onclick="event.stopPropagation()"
    >

        <div class="delete-modal-icon">
            <i class="bi bi-trash3"></i>
        </div>

        <div class="delete-modal-content">

            <h3>{{ $title }}</h3>

            <p>
                Apakah kamu yakin ingin menghapus {{ $label }}
                <strong id="deleteItemName"></strong>?
            </p>

            <div class="delete-warning">
                <i class="bi bi-exclamation-triangle"></i>
                <span>{{ $warning }}</span>
            </div>

        </div>

        <div class="delete-modal-actions">

            <button
                type="button"
                class="modal-cancel-btn"
                onclick="closeDeleteModal()"
            >
                Batal
            </button>

            <form id="deleteForm" method="POST">

                @csrf
                @method('DELETE')

                <button type="submit" class="modal-delete-btn">
                    <i class="bi bi-trash3"></i>
                    <span>Ya, Hapus</span>
                </button>

            </form>

        </div>

    </div>

</div>


<style>

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
        animation: deleteModalFadeIn .18s ease;
    }

    .delete-modal {
        width: 100%;
        max-width: 400px;

        background: var(--bg-card);

        border: 1px solid var(--border);
        border-radius: 12px;

        padding: 28px;

        box-shadow: 0 25px 70px rgba(0,0,0,.45);

        animation: deleteModalSlideUp .20s ease;
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

    @keyframes deleteModalFadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    @keyframes deleteModalSlideUp {
        from { opacity: 0; transform: translateY(10px) scale(.98); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    @media (max-width: 480px) {
        .delete-modal { padding: 22px; }

        .delete-modal-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .modal-cancel-btn,
        .modal-delete-btn { width: 100%; }
    }

</style>


<script>

    function openDeleteModal(id, name) {

        const modal = document.getElementById('deleteModal');

        document.getElementById('deleteItemName').textContent = name;

        // URL dibangun dari prefix yang dikirim komponen, mis. "/skills"
        document.getElementById('deleteForm').action =
            modal.dataset.prefix + '/' + id;

        modal.classList.add('show');

        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal(event) {

        if (event && event.target !== event.currentTarget) {
            return;
        }

        document.getElementById('deleteModal').classList.remove('show');

        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeDeleteModal();
        }
    });

</script>
