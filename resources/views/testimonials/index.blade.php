<x-app-layout>

    <x-admin-index-style />

    {{-- HEADER --}}
    <div class="crud-header">
        <div>
            <h1 class="crud-title">Kelola Testimoni</h1>
            <p class="crud-subtitle">
                Kelola testimoni / rekomendasi dari klien & kolega.
            </p>
        </div>

        <a href="{{ route('testimonials.create') }}" class="crud-add-btn">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Testimoni</span>
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
    <form method="GET" action="{{ route('testimonials.index') }}" class="filter-bar">
        <div class="filter-search">
            <i class="bi bi-search"></i>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama, jabatan, atau isi..."
                autocomplete="off"
            >
        </div>

        <button type="submit" class="filter-submit">
            <i class="bi bi-funnel"></i>
            <span>Terapkan</span>
        </button>

        @if(request()->filled('search'))
            <a href="{{ route('testimonials.index') }}" class="filter-reset">
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
                    <i class="bi bi-chat-quote"></i>
                    Daftar Testimoni
                </h2>
                <p class="crud-card-subtitle">
                    Testimoni yang ditampilkan di halaman publik.
                </p>
            </div>

            <div class="crud-count">
                {{ $testimonials->total() }} Testimoni
            </div>
        </div>


        <div class="table-responsive">
            <table class="crud-table">
                <thead>
                    <tr>
                        <th width="70">No</th>
                        <th width="70">Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th width="120">Rating</th>
                        <th width="80">Urutan</th>
                        <th width="120" class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($testimonials as $index => $testimonial)
                        <tr>
                            <td class="cell-number" data-label="No">
                                <span class="crud-number">
                                    {{ $testimonials->firstItem() + $index }}
                                </span>
                            </td>

                            <td data-label="Foto">
                                <div class="testi-thumb">
                                    @if ($testimonial->photo_url)
                                        <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->name }}">
                                    @else
                                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                    @endif
                                </div>
                            </td>

                            <td data-label="Nama">
                                <strong>{{ $testimonial->name }}</strong>
                                <div class="crud-muted">
                                    {{ \Illuminate\Support\Str::limit($testimonial->message, 45) }}
                                </div>
                            </td>

                            <td data-label="Jabatan">
                                <span class="crud-muted">{{ $testimonial->role ?: '-' }}</span>
                            </td>

                            <td data-label="Rating">
                                <div class="testi-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi {{ $i <= $testimonial->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                    @endfor
                                </div>
                            </td>

                            <td data-label="Urutan">
                                <span class="crud-muted">{{ $testimonial->order }}</span>
                            </td>

                            <td class="cell-action" data-label="Aksi">
                                <div class="action-buttons">
                                    <a
                                        href="{{ route('testimonials.edit', $testimonial->id) }}"
                                        class="action-btn edit-btn"
                                        title="Edit Testimoni"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <button
                                        type="button"
                                        class="action-btn delete-btn"
                                        title="Hapus Testimoni"
                                        onclick="openDeleteModal(
                                            '{{ $testimonial->id }}',
                                            @js($testimonial->name)
                                        )"
                                    >
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="row-empty">
                            <td colspan="7" class="cell-empty">
                                <div class="crud-empty">
                                    <div class="crud-empty-icon">
                                        <i class="bi bi-chat-quote"></i>
                                    </div>
                                    <h4>Belum Ada Testimoni</h4>
                                    <p>Belum ada testimoni yang ditambahkan.</p>
                                    <a href="{{ route('testimonials.create') }}" class="crud-add-btn">
                                        <i class="bi bi-plus-lg"></i>
                                        Tambah Testimoni
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        @if($testimonials->hasPages())
            <div class="pagination-wrapper">
                {{ $testimonials->links() }}
            </div>
        @endif

    </div>


    {{-- MODAL HAPUS --}}
    <x-delete-modal
        title="Hapus Testimoni?"
        label="testimoni dari"
        url-prefix="/testimonials"
    />


    <style>
        .testi-thumb {
            width: 42px;
            height: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;
            overflow: hidden;

            background: var(--purple);
            color: #fff;

            font-size: 15px;
            font-weight: 700;
        }

        .testi-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .testi-stars {
            display: inline-flex;
            gap: 2px;

            color: #f3a735;
            font-size: 13px;
        }
    </style>

</x-app-layout>
