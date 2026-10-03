<x-app-layout>

    <x-admin-form-style />

    {{-- HEADER --}}
    <div class="crud-form-header">
        <div>
            <a href="{{ route('experiences.index') }}" class="crud-back-link">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Daftar Pengalaman</span>
            </a>

            <h1 class="crud-form-title">Edit Pengalaman</h1>
            <p class="crud-form-subtitle">
                Perbarui detail pengalaman yang dipilih.
            </p>
        </div>
    </div>


    <div class="crud-form-wrapper">
        <div class="crud-form-card">

            <div class="crud-form-card-header">
                <div class="crud-form-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <div>
                    <h2>Informasi Pengalaman</h2>
                    <p>Perbarui informasi pengalaman di bawah ini.</p>
                </div>
            </div>


            <form action="{{ route('experiences.update', $experience->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- POSISI --}}
                <div class="crud-field">
                    <label for="position">Posisi / Jabatan <span>*</span></label>

                    <div class="crud-input-wrapper">
                        <i class="bi bi-person-badge"></i>
                        <input
                            type="text"
                            id="position"
                            name="position"
                            value="{{ old('position', $experience->position) }}"
                            placeholder="Contoh: Graphic Designer"
                            autocomplete="off"
                            required
                            autofocus
                            class="@error('position') input-error @enderror"
                        >
                    </div>

                    @error('position')
                        <div class="crud-error">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>


                {{-- PERUSAHAAN --}}
                <div class="crud-field">
                    <label for="company">Perusahaan <span>*</span></label>

                    <div class="crud-input-wrapper">
                        <i class="bi bi-building"></i>
                        <input
                            type="text"
                            id="company"
                            name="company"
                            value="{{ old('company', $experience->company) }}"
                            placeholder="Contoh: PT Kreatif Digital"
                            autocomplete="off"
                            required
                            class="@error('company') input-error @enderror"
                        >
                    </div>

                    @error('company')
                        <div class="crud-error">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>


                {{-- TAHUN --}}
                <div class="crud-row">
                    <div class="crud-field">
                        <label for="start_year">Tahun Mulai <span>*</span></label>

                        <div class="crud-input-wrapper">
                            <i class="bi bi-calendar3"></i>
                            <input
                                type="text"
                                id="start_year"
                                name="start_year"
                                value="{{ old('start_year', $experience->start_year) }}"
                                placeholder="2022"
                                maxlength="4"
                                required
                                class="@error('start_year') input-error @enderror"
                            >
                        </div>

                        @error('start_year')
                            <div class="crud-error">
                                <i class="bi bi-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="crud-field">
                        <label for="end_year">Tahun Selesai</label>

                        <div class="crud-input-wrapper">
                            <i class="bi bi-calendar-check"></i>
                            <input
                                type="text"
                                id="end_year"
                                name="end_year"
                                value="{{ old('end_year', $experience->end_year) }}"
                                placeholder="2024"
                                maxlength="4"
                                class="@error('end_year') input-error @enderror"
                            >
                        </div>

                        @error('end_year')
                            <div class="crud-error">
                                <i class="bi bi-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror

                        <div class="crud-help">
                            <i class="bi bi-info-circle"></i>
                            <span>Kosongkan jika masih berjalan.</span>
                        </div>
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
                            placeholder="Ceritakan peran dan tanggung jawabmu..."
                            class="@error('description') input-error @enderror"
                        >{{ old('description', $experience->description) }}</textarea>
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
                            value="{{ old('order', $experience->order) }}"
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
                    <a href="{{ route('experiences.index') }}" class="crud-cancel">
                        <i class="bi bi-x-lg"></i>
                        <span>Batal</span>
                    </a>

                    <button type="submit" class="crud-save">
                        <i class="bi bi-check-lg"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>

            </form>

        </div>
    </div>


    <style>
        .crud-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        @media (max-width: 576px) {
            .crud-row { grid-template-columns: 1fr; gap: 0; }
        }
    </style>

</x-app-layout>
