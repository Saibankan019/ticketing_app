<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center relative overflow-hidden
                bg-gradient-to-br from-blue-950 via-gray-900 to-purple-950">

        {{-- Background Glow --}}
        <div class="absolute -top-24 -left-24 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-[28rem] h-[28rem] bg-purple-500/20 rounded-full blur-3xl"></div>

        {{-- Login Card --}}
        <div class="relative z-10 w-full max-w-md p-8 rounded-2xl
                    bg-white/5 backdrop-blur-xl
                    border border-white/10
                    shadow-2xl">

            {{-- Logo / Title --}}
            <div class="text-center mb-8">
                <h1 class="text-4xl font-black tracking-wider
                           text-transparent bg-clip-text
                           bg-gradient-to-r from-blue-400 to-purple-400">
                    BENGTIX
                </h1>
                <p class="text-gray-400 mt-2 text-sm">
                    Masuk untuk mulai beli tiket event
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        id="email"
                        class="mt-1 block w-full bg-white/10 border-white/10 text-white focus:border-blue-500 focus:ring-blue-500"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input
                        id="password"
                        class="mt-1 block w-full bg-white/10 border-white/10 text-white focus:border-blue-500 focus:ring-blue-500"
                        type="password"
                        name="password"
                        required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between text-sm">
                    <label class="inline-flex items-center text-gray-400">
                        <input type="checkbox" name="remember"
                               class="rounded border-white/20 bg-white/10 text-blue-500 focus:ring-blue-500">
                        <span class="ms-2">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-blue-400 hover:text-blue-300">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <!-- Button -->
                <div>
                    <x-primary-button class="w-full justify-center
                        bg-gradient-to-r from-blue-600 to-purple-600
                        hover:from-blue-500 hover:to-purple-500
                        border-0">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

                <!-- Register -->
                <p class="text-center text-gray-400 text-sm mt-4">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300">
                        Daftar sekarang
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
