<x-guest-layout>

    <div class="auth-page">

        <div class="auth-card">

            <h1>
                Atur Ulang Password
            </h1>

            <p class="auth-text">
                Buat password baru untuk akun Anda.
            </p>


            <form method="POST" action="{{ route('password.store') }}">
                @csrf


                {{-- TOKEN --}}
                <input type="hidden" name="token" value="{{ $request->route('token') }}">


                {{-- EMAIL --}}
                <div class="auth-field">

                    <label for="email">
                        Email
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $request->email) }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Masukkan email Anda"
                    >

                    @error('email')
                        <div class="auth-error">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- PASSWORD --}}
                <div class="auth-field">

                    <label for="password">
                        Password Baru
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Masukkan password baru"
                    >

                    @error('password')
                        <div class="auth-error">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- CONFIRM PASSWORD --}}
                <div class="auth-field">

                    <label for="password_confirmation">
                        Konfirmasi Password
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Ulangi password baru"
                    >

                    @error('password_confirmation')
                        <div class="auth-error">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ACTION --}}
                <div class="auth-actions">

                    <button type="submit" class="auth-btn auth-btn-full">
                        <i class="bi bi-check-lg"></i>
                        <span>Simpan Password Baru</span>
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-guest-layout>
