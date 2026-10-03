<x-app-layout>

    <x-admin-form-style />

    {{-- HEADER --}}
    <div class="crud-form-header">
        <div>
            <a href="{{ route('testimonials.index') }}" class="crud-back-link">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Daftar Testimoni</span>
            </a>

            <h1 class="crud-form-title">Edit Testimoni</h1>
            <p class="crud-form-subtitle">
                Perbarui detail testimoni yang dipilih.
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
                    <h2>Informasi Testimoni</h2>
                    <p>Perbarui informasi testimoni di bawah ini.</p>
                </div>
            </div>


            <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- FOTO --}}
                <div class="crud-field">
                    <label for="photo">Foto (Opsional)</label>

                    <div class="crud-photo-row">
                        <div class="crud-photo-preview">
                            @if ($testimonial->photo_url)
                                <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->name }}">
                            @else
                                {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                            @endif
                        </div>

                        <div class="crud-input-wrapper" style="flex: 1;">
                            <i class="bi bi-camera"></i>
                            <input
                                type="file"
                                id="photo"
                                name="photo"
                                accept="image/*"
                                class="crud-file-input @error('photo') input-error @enderror"
                            >
                        </div>
                    </div>

                    @error('photo')
                        <div class="crud-error">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror

                    <div class="crud-help">
                        <i class="bi bi-info-circle"></i>
                        <span>Biarkan kosong jika tidak ingin mengganti foto.</span>
                    </div>
                </div>


                {{-- NAMA --}}
                <div class="crud-field">
                    <label for="name">Nama <span>*</span></label>

                    <div class="crud-input-wrapper">
                        <i class="bi bi-person"></i>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $testimonial->name) }}"
                            placeholder="Contoh: Budi Santoso"
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


                {{-- JABATAN --}}
                <div class="crud-field">
                    <label for="role">Jabatan / Perusahaan</label>

                    <div class="crud-input-wrapper">
                        <i class="bi bi-briefcase"></i>
                        <input
                            type="text"
                            id="role"
                            name="role"
                            value="{{ old('role', $testimonial->role) }}"
                            placeholder="Contoh: CEO di PT Maju Jaya"
                            class="@error('role') input-error @enderror"
                        >
                    </div>

                    @error('role')
                        <div class="crud-error">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>


                {{-- PESAN --}}
                <div class="crud-field">
                    <label for="message">Isi Testimoni <span>*</span></label>

                    <div class="crud-input-wrapper">
                        <i class="bi bi-card-text"></i>
                        <textarea
                            id="message"
                            name="message"
                            placeholder="Tulis testimoni di sini..."
                            required
                            class="@error('message') input-error @enderror"
                        >{{ old('message', $testimonial->message) }}</textarea>
                    </div>

                    @error('message')
                        <div class="crud-error">
                            <i class="bi bi-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>


                {{-- RATING & URUTAN --}}
                <div class="crud-row">
                    <div class="crud-field">
                        <label for="rating">Rating <span>*</span></label>

                        <div class="crud-input-wrapper">
                            <i class="bi bi-star"></i>
                            <select
                                id="rating"
                                name="rating"
                                required
                                class="@error('rating') input-error @enderror"
                            >
                                @for ($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>
                                        {{ str_repeat('★', $i) }} ({{ $i }})
                                    </option>
                                @endfor
                            </select>
                            <i class="bi bi-chevron-down crud-select-arrow"></i>
                        </div>

                        @error('rating')
                            <div class="crud-error">
                                <i class="bi bi-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="crud-field">
                        <label for="order">Urutan Tampil</label>

                        <div class="crud-input-wrapper">
                            <i class="bi bi-sort-numeric-down"></i>
                            <input
                                type="number"
                                id="order"
                                name="order"
                                value="{{ old('order', $testimonial->order) }}"
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
                </div>


                {{-- ACTION --}}
                <div class="crud-actions">
                    <a href="{{ route('testimonials.index') }}" class="crud-cancel">
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

        .crud-file-input {
            padding-top: 10px !important;
            padding-bottom: 10px !important;
            height: auto !important;
            cursor: pointer;
        }

        .crud-photo-row {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .crud-photo-preview {
            width: 54px;
            height: 54px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;
            overflow: hidden;

            background: var(--purple);
            color: #fff;

            font-size: 20px;
            font-weight: 700;
        }

        .crud-photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media (max-width: 576px) {
            .crud-row { grid-template-columns: 1fr; gap: 0; }
        }
    </style>

</x-app-layout>
