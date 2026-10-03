<x-guest-layout>

    <div class="auth-page">

        <div class="auth-card">

            <h1>
                Lupa Password
            </h1>

            <p class="auth-text">
                Masukkan email Anda, kami akan mengirimkan tautan untuk mengatur ulang password.
            </p>


            {{-- SESSION STATUS --}}
            @if (session('status'))
                <div class="auth-status">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif


            <form method="POST" action="{{ route('password.email') }}">
                @csrf


                {{-- EMAIL --}}
                <div class="auth-field">

                    <label for="email">
                        Email
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="Masukkan email Anda"
                    >

                    @error('email')
                        <div class="auth-error">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ACTION --}}
                <div class="auth-actions">

                    <a href="{{ route('login') }}" class="auth-link">
                        Kembali ke login
                    </a>

                    <button type="submit" class="auth-btn">
                        <i class="bi bi-envelope"></i>
                        <span>Kirim Tautan</span>
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-guest-layout>
