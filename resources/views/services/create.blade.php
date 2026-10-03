<x-app-layout>

    <x-admin-form-style />

    {{-- HEADER --}}
    <div class="crud-form-header">
        <div>
            <a href="{{ route('services.index') }}" class="crud-back-link">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Daftar Layanan</span>
            </a>

            <h1 class="crud-form-title">Tambah Layanan Baru</h1>
            <p class="crud-form-subtitle">
                Tambahkan layanan yang kamu tawarkan.
            </p>
        </div>
    </div>


    <div class="crud-form-wrapper">
        <div class="crud-form-card">

            <div class="crud-form-card-header">
                <div class="crud-form-icon">
                    <i class="bi bi-grid"></i>
                </div>
                <div>
                    <h2>Informasi Layanan</h2>
                    <p>Lengkapi detail layanan yang ingin ditambahkan.</p>
                </div>
            </div>


            <form action="{{ route('services.store') }}" method="POST">
                @csrf

                {{-- JUDUL --}}
                <div class="crud-field">
                    <label for="title">Judul Layanan <span>*</span></label>

                    <div class="crud-input-wrapper">
                        <i class="bi bi-type"></i>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Contoh: Web Development"
                            autocomplete="off"
                            required
                            autofocus
                            class="@error('title') input-error @enderror"
                        >
                    </div>

                    @error('title')
                        <div class="crud-error">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>


                {{-- IKON --}}
                <div class="crud-field">
                    <label for="icon">Ikon (Bootstrap Icons)</label>

                    <div class="crud-input-wrapper">
                        <i class="bi bi-emoji-smile"></i>
                        <input
                            type="text"
                            id="icon"
                            name="icon"
                            value="{{ old('icon') }}"
                            placeholder="Contoh: bi-code-slash"
                            autocomplete="off"
                            class="@error('icon') input-error @enderror"
                        >
                    </div>

                    @error('icon')
                        <div class="crud-error">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror

                    <div class="crud-help">
                        <i class="bi bi-info-circle"></i>
                        <span>
                            Lihat daftar ikon di
                            <a href="https://icons.getbootstrap.com" target="_blank" rel="noopener">icons.getbootstrap.com</a>.
                            Contoh: bi-code-slash, bi-palette, bi-phone.
                        </span>
                    </div>
                </div>


                {{-- DESKRIPSI --}}
                <div class="crud-field">
                    <label for="description">Deskripsi</label>

                    <div class="crud-input-wrapper">
                        <i class="bi bi-card-text"></i>
                        <textarea
                            id="description"
                            name="description"
                            placeholder="Jelaskan layanan ini..."
                            class="@error('description') input-error @enderror"
                        >{{ old('description') }}</textarea>
                    </div>

                    @error('description')
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
                </div>


                {{-- ACTION --}}
                <div class="crud-actions">
                    <a href="{{ route('services.index') }}" class="crud-cancel">
                        <i class="bi bi-x-lg"></i>
                        <span>Batal</span>
                    </a>

                    <button type="submit" class="crud-save">
                        <i class="bi bi-check-lg"></i>
                        <span>Simpan Layanan</span>
                    </button>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>
