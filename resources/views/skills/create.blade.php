<x-app-layout>

    <x-admin-form-style />

    {{-- HEADER --}}
    <div class="crud-form-header">
        <div>
            <a href="{{ route('skills.index') }}" class="crud-back-link">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Daftar Skill</span>
            </a>

            <h1 class="crud-form-title">Tambah Skill Baru</h1>
            <p class="crud-form-subtitle">
                Tambahkan keahlian yang ingin ditampilkan di portfolio.
            </p>
        </div>
    </div>


    <div class="crud-form-wrapper">
        <div class="crud-form-card">

            <div class="crud-form-card-header">
                <div class="crud-form-icon">
                    <i class="bi bi-stars"></i>
                </div>
                <div>
                    <h2>Informasi Skill</h2>
                    <p>Lengkapi detail skill yang ingin ditambahkan.</p>
                </div>
            </div>


            <form action="{{ route('skills.store') }}" method="POST">
                @csrf

                {{-- NAMA --}}
                <div class="crud-field">
                    <label for="name">Nama Skill <span>*</span></label>

                    <div class="crud-input-wrapper">
                        <i class="bi bi-star"></i>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: Adobe Illustrator"
                            autocomplete="off"
                            required
                            autofocus
                            class="@error('name') input-error @enderror"
                        >
                    </div>

                    @error('name')
                        <div class="crud-error">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>


                {{-- LEVEL --}}
                <div class="crud-field">
                    <label for="level">Level (0 - 100) <span>*</span></label>

                    <div class="crud-input-wrapper">
                        <i class="bi bi-bar-chart"></i>
                        <input
                            type="number"
                            id="level"
                            name="level"
                            value="{{ old('level', 80) }}"
                            min="0"
                            max="100"
                            required
                            class="@error('level') input-error @enderror"
                        >
                    </div>

                    @error('level')
                        <div class="crud-error">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror

                    <div class="crud-help">
                        <i class="bi bi-info-circle"></i>
                        <span>Persentase tingkat penguasaan (misal 85).</span>
                    </div>
                </div>


                {{-- KATEGORI --}}
                <div class="crud-field">
                    <label for="category">Kategori</label>

                    <div class="crud-input-wrapper">
                        <i class="bi bi-tag"></i>
                        <input
                            type="text"
                            id="category"
                            name="category"
                            value="{{ old('category') }}"
                            placeholder="Contoh: Design, Programming (Opsional)"
                            autocomplete="off"
                            class="@error('category') input-error @enderror"
                        >
                    </div>

                    @error('category')
                        <div class="crud-error">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>


                {{-- URUTAN --}}
                <div class="crud-field">
                    <label for="order">Urutan Tampil</label>

                    <div class="crud-input-wrapper">
                        <i class="bi bi-sort-numeric-down"></i>
                        <input
                            type="number"
                            id="order"
                            name="order"
                            value="{{ old('order', 0) }}"
                            min="0"
                            class="@error('order') input-error @enderror"
                        >
                    </div>

                    @error('order')
                        <div class="crud-error">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror

                    <div class="crud-help">
                        <i class="bi bi-info-circle"></i>
                        <span>Angka lebih kecil tampil lebih dulu.</span>
                    </div>
                </div>


                {{-- ACTION --}}
                <div class="crud-actions">
                    <a href="{{ route('skills.index') }}" class="crud-cancel">
                        <i class="bi bi-x-lg"></i>
                        <span>Batal</span>
                    </a>

                    <button type="submit" class="crud-save">
                        <i class="bi bi-check-lg"></i>
                        <span>Simpan Skill</span>
                    </button>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>
