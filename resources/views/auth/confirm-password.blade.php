<x-guest-layout>

    <div class="auth-page">

        <div class="auth-card">

            <h1>
                Konfirmasi Password
            </h1>

            <p class="auth-text">
                Ini area aman. Silakan konfirmasi password Anda sebelum melanjutkan.
            </p>


            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf


                {{-- PASSWORD --}}
                <div class="auth-field">

                    <label for="password">
                        Password
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autofocus
                        autocomplete="current-password"
                        placeholder="Masukkan password Anda"
                    >

                    @error('password')
                        <div class="auth-error">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ACTION --}}
                <div class="auth-actions">

                    <button type="submit" class="auth-btn auth-btn-full">
                        <i class="bi bi-shield-check"></i>
                        <span>Konfirmasi</span>
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-guest-layout>
