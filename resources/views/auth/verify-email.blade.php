<x-guest-layout>
    <section class="min-h-screen flex items-center justify-center px-6
                    bg-gradient-to-br from-blue-950 via-gray-900 to-purple-950">

        <div class="relative w-full max-w-md p-8 rounded-2xl
                    bg-white/5 backdrop-blur-xl
                    border border-blue-500/20
                    shadow-2xl shadow-blue-500/20 text-center">

            {{-- Icon --}}
            <div class="mb-4 text-blue-400 text-4xl">✉️</div>

            {{-- Title --}}
            <h1 class="text-3xl font-black mb-3
                       text-transparent bg-clip-text
                       bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400">
                VERIFIKASI EMAIL
            </h1>

            <p class="text-sm text-gray-400 mb-6">
                Terima kasih sudah mendaftar!  
                Silakan cek email kamu dan klik link verifikasi untuk melanjutkan.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 text-sm text-green-400 font-medium">
                    Link verifikasi baru telah dikirim ke email kamu ✅
                </div>
            @endif

            <div class="flex flex-col gap-4">
                {{-- Resend --}}
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-full py-3 rounded-lg font-bold
                               bg-gradient-to-r from-blue-600 to-purple-600
                               hover:from-blue-500 hover:to-purple-500
                               transition-all duration-300 shadow-lg shadow-blue-500/30">
                        KIRIM ULANG EMAIL
                    </button>
                </form>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="text-sm text-gray-400 hover:text-red-400 transition">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </section>
</x-guest-layout>
