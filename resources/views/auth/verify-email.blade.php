<x-guest-layout>

    <div class="auth-page">

        <div class="auth-card">

            <h1>
                Verifikasi Email
            </h1>

            <p class="auth-text">
                Terima kasih telah mendaftar. Sebelum memulai, silakan verifikasi email Anda
                melalui tautan yang telah kami kirimkan. Jika tidak menerima email, kami dapat mengirim ulang.
            </p>


            @if (session('status') == 'verification-link-sent')
                <div class="auth-status">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Tautan verifikasi baru telah dikirim ke email Anda.</span>
                </div>
            @endif


            <div class="auth-actions" style="justify-content: space-between;">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="auth-link"
                            style="background:none; border:none; padding:0; cursor:pointer;">
                        Keluar
                    </button>
                </form>


                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button type="submit" class="auth-btn">
                        <i class="bi bi-envelope-arrow-up"></i>
                        <span>Kirim Ulang</span>
                    </button>
                </form>

            </div>

        </div>

    </div>

</x-guest-layout>
