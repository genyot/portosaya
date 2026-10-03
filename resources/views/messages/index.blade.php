<x-app-layout>

    <x-admin-index-style />

    {{-- HEADER --}}
    <div class="crud-header">
        <div>
            <h1 class="crud-title">Pesan Masuk</h1>
            <p class="crud-subtitle">
                Pesan dari pengunjung melalui form kontak.
            </p>
        </div>

        @if ($unreadCount > 0)
            <div class="unread-pill">
                <i class="bi bi-envelope-exclamation"></i>
                {{ $unreadCount }} Belum Dibaca
            </div>
        @endif
    </div>


    {{-- FLASH MESSAGE --}}
    @if (session('success'))
        <div class="crud-alert success-alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif


    {{-- FILTER --}}
    <form method="GET" action="{{ route('messages.index') }}" class="filter-bar">

        <div class="filter-search">
            <i class="bi bi-search"></i>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama, email, atau pesan..."
                autocomplete="off"
            >
        </div>

        <select name="status" class="filter-select">
            <option value="">Semua Pesan</option>
            <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>
                Belum Dibaca
            </option>
            <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>
                Sudah Dibaca
            </option>
        </select>

        <button type="submit" class="filter-submit">
            <i class="bi bi-funnel"></i>
            <span>Terapkan</span>
        </button>

        @if(request()->anyFilled(['search', 'status']))
            <a href="{{ route('messages.index') }}" class="filter-reset">
                <i class="bi bi-x-lg"></i>
                <span>Reset</span>
            </a>
        @endif

    </form>


    {{-- CARD --}}
    <div class="crud-card">

        <div class="crud-card-header">
            <div>
                <h2 class="crud-card-title">
                    <i class="bi bi-inbox"></i>
                    Daftar Pesan
                </h2>
                <p class="crud-card-subtitle">
                    Total {{ $totalCount }} pesan masuk.
                </p>
            </div>

            <div class="crud-count">
                {{ $messages->total() }} Pesan
            </div>
        </div>


        <div class="table-responsive">
            <table class="crud-table">
                <thead>
                    <tr>
                        <th width="70">No</th>
                        <th>Pengirim</th>
                        <th>Subjek</th>
                        <th width="170">Waktu</th>
                        <th width="130">Status</th>
                        <th width="150" class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($messages as $index => $message)
                        <tr class="{{ $message->is_read ? '' : 'row-unread' }}">
                            <td class="cell-number" data-label="No">
                                <span class="crud-number">
                                    {{ $messages->firstItem() + $index }}
                                </span>
                            </td>

                            <td data-label="Pengirim">
                                <strong>{{ $message->name }}</strong>
                                <div class="crud-muted">{{ $message->email }}</div>
                            </td>

                            <td data-label="Subjek">
                                <span class="crud-muted">
                                    {{ $message->subject ?: '(Tanpa subjek)' }}
                                </span>
                            </td>

                            <td data-label="Waktu">
                                <span class="crud-muted">
                                    {{ $message->created_at->format('d M Y, H:i') }}
                                </span>
                            </td>

                            <td data-label="Status">
                                @if ($message->is_read)
                                    <span class="status-badge status-read">
                                        <span class="status-dot"></span>
                                        Dibaca
                                    </span>
                                @else
                                    <span class="status-badge status-unread">
                                        <span class="status-dot"></span>
                                        Baru
                                    </span>
                                @endif
                            </td>

                            <td class="cell-action" data-label="Aksi">
                                <div class="action-buttons">
                                    <a
                                        href="{{ route('messages.show', $message->id) }}"
                                        class="action-btn view-btn"
                                        title="Baca Pesan"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <button
                                        type="button"
                                        class="action-btn delete-btn"
                                        title="Hapus Pesan"
                                        onclick="openDeleteModal(
                                            '{{ $message->id }}',
                                            @js($message->name)
                                        )"
                                    >
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="row-empty">
                            <td colspan="6" class="cell-empty">
                                <div class="crud-empty">
                                    <div class="crud-empty-icon">
                                        <i class="bi bi-inbox"></i>
                                    </div>
                                    <h4>Belum Ada Pesan</h4>
                                    <p>Belum ada pesan yang masuk dari pengunjung.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        @if($messages->hasPages())
            <div class="pagination-wrapper">
                {{ $messages->links() }}
            </div>
        @endif

    </div>


    {{-- MODAL HAPUS --}}
    <x-delete-modal
        title="Hapus Pesan?"
        label="pesan dari"
        url-prefix="/messages"
    />


    <style>
        .unread-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 9px 16px;

            background: rgba(101, 81, 232, .12);
            color: var(--purple-light);

            border: 1px solid rgba(101, 81, 232, .25);
            border-radius: 100px;

            font-size: 12px;
            font-weight: 600;

            white-space: nowrap;
        }

        /* Baris belum dibaca: sedikit ditandai */
        .crud-table tbody tr.row-unread {
            background: rgba(101, 81, 232, .05);
        }

        .crud-table tbody tr.row-unread td {
            font-weight: 500;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 10px;
            font-weight: 600;

            white-space: nowrap;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .status-unread {
            background: rgba(101, 81, 232, .12);
            color: var(--purple-light);
            border: 1px solid rgba(101, 81, 232, .22);
        }

        .status-unread .status-dot {
            background: var(--purple-light);
            box-shadow: 0 0 6px rgba(101, 81, 232, .5);
        }

        .status-read {
            background: rgba(54, 201, 143, .1);
            color: var(--green);
            border: 1px solid rgba(54, 201, 143, .18);
        }

        .status-read .status-dot {
            background: var(--green);
        }

        .view-btn {
            background: rgba(54, 201, 143, .09);
            color: var(--green);
            border-color: rgba(54, 201, 143, .16);
        }

        .view-btn:hover {
            background: rgba(54, 201, 143, .18);
            border-color: rgba(54, 201, 143, .3);
            transform: translateY(-1px);
        }
    </style>

</x-app-layout>
