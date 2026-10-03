<x-app-layout>

    <x-admin-form-style />

    {{-- HEADER --}}
    <div class="crud-form-header">
        <div>
            <a href="{{ route('skills.index') }}" class="crud-back-link">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Daftar Skill</span>
            </a>

            <h1 class="crud-form-title">Edit Skill</h1>
            <p class="crud-form-subtitle">
                Perbarui detail skill yang dipilih.
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
                    <h2>Informasi Skill</h2>
                    <p>Perbarui informasi skill di bawah ini.</p>
                </div>
            </div>


            <form action="{{ route('skills.update', $skill->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- NAMA --}}
                <div class="crud-field">
                    <label for="name">Nama Skill <span>*</span></label>

                    <div class="crud-input-wrapper">
                        <i class="bi bi-star"></i>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $skill->name) }}"
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
                            value="{{ old('level', $skill->level) }}"
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
                            value="{{ old('category', $skill->category) }}"
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
                            value="{{ old('order', $skill->order) }}"
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
                    <a href="{{ route('skills.index') }}" class="crud-cancel">
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

</x-app-layout>
