<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center relative overflow-hidden
                bg-gradient-to-br from-blue-950 via-gray-900 to-purple-950">

        {{-- Background Glow --}}
        <div class="absolute -top-24 -left-24 w-80 h-80 bg-blue-500/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-[28rem] h-[28rem] bg-purple-500/20 rounded-full blur-3xl"></div>

        {{-- Register Card --}}
        <div class="relative z-10 w-full max-w-md p-8 rounded-2xl
                    bg-white/5 backdrop-blur-xl
                    border border-white/10
                    shadow-2xl">

            {{-- Title --}}
            <div class="text-center mb-8">
                <h1 class="text-4xl font-black tracking-wider
                           text-transparent bg-clip-text
                           bg-gradient-to-r from-blue-400 to-purple-400">
                    BENGTIX
                </h1>
                <p class="text-gray-400 mt-2 text-sm">
                    Daftar dan mulai meriahkan event
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input
                        id="name"
                        class="mt-1 block w-full bg-white/10 border-white/10 text-white focus:border-blue-500 focus:ring-blue-500"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        id="email"
                        class="mt-1 block w-full bg-white/10 border-white/10 text-white focus:border-blue-500 focus:ring-blue-500"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required />
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

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input
                        id="password_confirmation"
                        class="mt-1 block w-full bg-white/10 border-white/10 text-white focus:border-blue-500 focus:ring-blue-500"
                        type="password"
                        name="password_confirmation"
                        required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between text-sm">
                    <a href="{{ route('login') }}"
                       class="text-blue-400 hover:text-blue-300">
                        Sudah punya akun?
                    </a>

                    <x-primary-button class="
                        bg-gradient-to-r from-blue-600 to-purple-600
                        hover:from-blue-500 hover:to-purple-500
                        border-0">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
