<x-app-layout>

    <x-admin-index-style />

    {{-- HEADER --}}
    <div class="crud-header">
        <div>
            <h1 class="crud-title">Kelola Skills</h1>
            <p class="crud-subtitle">
                Tambah, edit, atau hapus keahlian portfolio.
            </p>
        </div>

        <a href="{{ route('skills.create') }}" class="crud-add-btn">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Skill</span>
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
    <form method="GET" action="{{ route('skills.index') }}" class="filter-bar">
        <div class="filter-search">
            <i class="bi bi-search"></i>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari skill..."
                autocomplete="off"
            >
        </div>

        <button type="submit" class="filter-submit">
            <i class="bi bi-funnel"></i>
            <span>Terapkan</span>
        </button>

        @if(request()->filled('search'))
            <a href="{{ route('skills.index') }}" class="filter-reset">
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
                    <i class="bi bi-stars"></i>
                    Daftar Skill
                </h2>
                <p class="crud-card-subtitle">
                    Keahlian yang ditampilkan di portfolio.
                </p>
            </div>

            <div class="crud-count">
                {{ $skills->total() }} Skill
            </div>
        </div>


        <div class="table-responsive">
            <table class="crud-table">
                <thead>
                    <tr>
                        <th width="70">No</th>
                        <th>Nama Skill</th>
                        <th>Kategori</th>
                        <th width="220">Level</th>
                        <th width="80">Urutan</th>
                        <th width="120" class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($skills as $index => $skill)
                        <tr>
                            <td class="cell-number" data-label="No">
                                <span class="crud-number">
                                    {{ $skills->firstItem() + $index }}
                                </span>
                            </td>

                            <td data-label="Nama Skill">
                                <strong>{{ $skill->name }}</strong>
                            </td>

                            <td data-label="Kategori">
                                <span class="crud-muted">
                                    {{ $skill->category ?: '-' }}
                                </span>
                            </td>

                            <td data-label="Level">
                                <div class="skill-bar">
                                    <div class="skill-bar-fill" style="width: {{ $skill->level }}%;"></div>
                                </div>
                                <span class="crud-muted">{{ $skill->level }}%</span>
                            </td>

                            <td data-label="Urutan">
                                <span class="crud-muted">{{ $skill->order }}</span>
                            </td>

                            <td class="cell-action" data-label="Aksi">
                                <div class="action-buttons">
                                    <a
                                        href="{{ route('skills.edit', $skill->id) }}"
                                        class="action-btn edit-btn"
                                        title="Edit Skill"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <button
                                        type="button"
                                        class="action-btn delete-btn"
                                        title="Hapus Skill"
                                        onclick="openDeleteModal(
                                            '{{ $skill->id }}',
                                            @js($skill->name)
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
                                        <i class="bi bi-stars"></i>
                                    </div>
                                    <h4>Belum Ada Skill</h4>
                                    <p>Belum ada skill yang ditambahkan.</p>
                                    <a href="{{ route('skills.create') }}" class="crud-add-btn">
                                        <i class="bi bi-plus-lg"></i>
                                        Tambah Skill
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        @if($skills->hasPages())
            <div class="pagination-wrapper">
                {{ $skills->links() }}
            </div>
        @endif

    </div>


    {{-- MODAL HAPUS --}}
    <x-delete-modal
        title="Hapus Skill?"
        label="skill"
        url-prefix="/skills"
    />


    <style>
        .skill-bar {
            width: 100%;
            max-width: 160px;
            height: 7px;

            margin-bottom: 5px;

            background: var(--bg-hover);
            border-radius: 10px;
            overflow: hidden;
        }

        .skill-bar-fill {
            height: 100%;
            background: #6551e8;
            border-radius: 10px;
        }
    </style>

</x-app-layout>
