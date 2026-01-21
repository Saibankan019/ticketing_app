<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden rounded-xl p-6
                    bg-gradient-to-br from-blue-950 via-gray-900 to-purple-950
                    border border-blue-500/30">

            <!-- Grid Background -->
            <div class="absolute inset-0 opacity-30
                        bg-[linear-gradient(rgba(59,130,246,0.15)_1px,transparent_1px),
                             linear-gradient(90deg,rgba(59,130,246,0.15)_1px,transparent_1px)]
                        bg-[size:40px_40px]">
            </div>

            <div class="relative flex items-center justify-between">
                <h2 class="text-2xl font-black tracking-widest text-transparent
                           bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400">
                    DASHBOARD
                </h2>

                <a href="{{ route('admin.dashboard') }}"
                   class="group relative inline-flex items-center gap-2 px-6 py-3
                          bg-blue-600/90 hover:bg-blue-500 text-white text-sm font-bold
                          rounded-lg transition-all duration-300 hover:scale-105">

                    <!-- Glow -->
                    <span class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600
                                 opacity-0 group-hover:opacity-100 blur-xl transition"></span>

                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="relative w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 7h18M3 12h18M3 17h18" />
                    </svg>

                    <span class="relative">ADMIN PANEL</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Card -->
            <div class="relative overflow-hidden rounded-2xl
                        bg-gradient-to-br from-gray-900 to-black
                        border border-blue-500/30 shadow-xl
                        hover:shadow-blue-500/40 transition-all duration-300">

                <!-- Floating Glow -->
                <div class="absolute -top-20 -right-20 w-72 h-72
                            bg-blue-500/20 rounded-full blur-3xl"></div>

                <div class="relative p-10 text-center">
                    <div class="text-sm tracking-widest text-blue-400 mb-4 uppercase animate-pulse">
                        [ SYSTEM STATUS ]
                    </div>

                    <h3 class="text-3xl font-black mb-4
                               text-transparent bg-clip-text
                               bg-gradient-to-r from-blue-400 to-purple-400">
                        ACCESS GRANTED
                    </h3>

                    <p class="text-gray-400 text-lg mb-8">
                        You're logged in successfully.
                    </p>

                    <div class="flex justify-center gap-4 flex-wrap">
                        <a href="#"
                           class="px-8 py-3 bg-blue-600 hover:bg-blue-500
                                  rounded-lg font-semibold text-white
                                  transition-all duration-300 hover:scale-105">
                            MANAGE DATA
                        </a>

                        <a href="#"
                           class="px-8 py-3 border border-blue-500/40
                                  hover:bg-blue-500/10 rounded-lg
                                  font-semibold text-blue-400
                                  transition-all duration-300">
                            VIEW REPORT
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
