<x-app-layout>

    <x-admin-index-style />

    {{-- HEADER --}}
    <div class="crud-header">
        <div>
            <h1 class="crud-title">Kelola Layanan</h1>
            <p class="crud-subtitle">
                Tambah, edit, atau hapus layanan yang kamu tawarkan.
            </p>
        </div>

        <a href="{{ route('services.create') }}" class="crud-add-btn">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Layanan</span>
        </a>
    </div>


    {{-- FLASH MESSAGE --}}
    @if (session('success'))
        <div class="crud-alert success-alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif


    {{-- FILTER --}}
    <form method="GET" action="{{ route('services.index') }}" class="filter-bar">
        <div class="filter-search">
            <i class="bi bi-search"></i>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari layanan..."
                autocomplete="off"
            >
        </div>

        <button type="submit" class="filter-submit">
            <i class="bi bi-funnel"></i>
            <span>Terapkan</span>
        </button>

        @if(request()->filled('search'))
            <a href="{{ route('services.index') }}" class="filter-reset">
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
                    <i class="bi bi-grid"></i>
                    Daftar Layanan
                </h2>
                <p class="crud-card-subtitle">
                    Layanan yang ditawarkan ke pengunjung.
                </p>
            </div>

            <div class="crud-count">
                {{ $services->total() }} Layanan
            </div>
        </div>


        <div class="table-responsive">
            <table class="crud-table">
                <thead>
                    <tr>
                        <th width="70">No</th>
                        <th width="70">Ikon</th>
                        <th>Judul Layanan</th>
                        <th>Deskripsi</th>
                        <th width="80">Urutan</th>
                        <th width="120" class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($services as $index => $service)
                        <tr>
                            <td class="cell-number" data-label="No">
                                <span class="crud-number">
                                    {{ $services->firstItem() + $index }}
                                </span>
                            </td>

                            <td data-label="Ikon">
                                <div class="service-icon-box">
                                    <i class="bi {{ $service->icon ?: 'bi-grid' }}"></i>
                                </div>
                            </td>

                            <td data-label="Judul Layanan">
                                <strong>{{ $service->title }}</strong>
                            </td>

                            <td data-label="Deskripsi">
                                <span class="crud-muted">
                                    {{ $service->description ? \Illuminate\Support\Str::limit($service->description, 60) : '-' }}
                                </span>
                            </td>

                            <td data-label="Urutan">
                                <span class="crud-muted">{{ $service->order }}</span>
                            </td>

                            <td class="cell-action" data-label="Aksi">
                                <div class="action-buttons">
                                    <a
                                        href="{{ route('services.edit', $service->id) }}"
                                        class="action-btn edit-btn"
                                        title="Edit Layanan"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <button
                                        type="button"
                                        class="action-btn delete-btn"
                                        title="Hapus Layanan"
                                        onclick="openDeleteModal(
                                            '{{ $service->id }}',
                                            @js($service->title)
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
                                        <i class="bi bi-grid"></i>
                                    </div>
                                    <h4>Belum Ada Layanan</h4>
                                    <p>Belum ada layanan yang ditambahkan.</p>
                                    <a href="{{ route('services.create') }}" class="crud-add-btn">
                                        <i class="bi bi-plus-lg"></i>
                                        Tambah Layanan
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        @if($services->hasPages())
            <div class="pagination-wrapper">
                {{ $services->links() }}
            </div>
        @endif

    </div>


    {{-- MODAL HAPUS --}}
    <x-delete-modal
        title="Hapus Layanan?"
        label="layanan"
        url-prefix="/services"
    />


    <style>
        .service-icon-box {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: rgba(101,81,232,.12);
            border: 1px solid rgba(101,81,232,.18);
            border-radius: 8px;
        }

        .service-icon-box i {
            color: #9b8ff5;
            font-size: 17px;
        }
    </style>

</x-app-layout>
