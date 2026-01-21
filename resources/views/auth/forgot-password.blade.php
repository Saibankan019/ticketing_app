<x-guest-layout>
    <section class="min-h-screen flex items-center justify-center px-6
                    bg-gradient-to-br from-blue-950 via-gray-900 to-purple-950">

        <div class="relative w-full max-w-md p-8 rounded-2xl
                    bg-white/5 backdrop-blur-xl
                    border border-blue-500/20
                    shadow-2xl shadow-blue-500/20">

            {{-- Title --}}
            <h1 class="text-3xl font-black text-center mb-2
                       text-transparent bg-clip-text
                       bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400">
                RESET PASSWORD
            </h1>

            <p class="text-sm text-gray-400 text-center mb-6">
                Masukkan email kamu, kami akan kirim link reset password.
            </p>

            {{-- Status --}}
            <x-auth-session-status class="mb-4 text-blue-400" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="text-sm text-gray-300">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="mt-1 w-full px-4 py-3 rounded-lg
                               bg-gray-900/70 border border-gray-700
                               text-gray-100 placeholder-gray-500
                               focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full py-3 rounded-lg font-bold
                           bg-gradient-to-r from-blue-600 to-purple-600
                           hover:from-blue-500 hover:to-purple-500
                           transition-all duration-300 shadow-lg shadow-blue-500/30">
                    KIRIM LINK RESET
                </button>
            </form>

            <div class="text-center mt-6">
                <a href="{{ route('login') }}"
                   class="text-sm text-blue-400 hover:underline">
                    ← Kembali ke Login
                </a>
            </div>

        </div>
    </section>
</x-guest-layout>
