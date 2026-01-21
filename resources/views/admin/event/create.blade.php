<x-layouts.admin title="Tambah Event Baru">
    <style>
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.6); }
        }
        
        .cyber-card {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border: 1px solid rgba(59, 130, 246, 0.3);
            position: relative;
        }
        
        .cyber-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #3b82f6, transparent);
        }
        
        .cyber-input {
            background: rgba(15, 23, 42, 0.5) !important;
            border: 1px solid rgba(59, 130, 246, 0.3) !important;
            color: #e2e8f0 !important;
            transition: all 0.3s ease;
        }
        
        .cyber-input:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.3) !important;
            outline: none !important;
        }
        
        .cyber-btn {
            background: linear-gradient(145deg, #3b82f6, #2563eb);
            border: 1px solid #3b82f6;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .cyber-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }
        
        .cyber-btn:hover::before {
            transform: translateX(100%);
        }
        
        .cyber-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
        }
        
        .label-cyber {
            color: #3b82f6;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
        }
        
        .toast-cyber {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border: 1px solid rgba(239, 68, 68, 0.5);
            animation: glow 2s ease-in-out infinite;
        }
    </style>

    @if ($errors->any())
        <div class="toast toast-bottom toast-center z-50">
            <div class="alert toast-cyber text-red-300">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.toast')?.remove()
            }, 5000)
        </script>
    @endif

    <div class="container mx-auto p-10">
        <!-- Header dengan efek futuristik -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-8 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                <h1 class="text-3xl font-black uppercase tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                    Tambah Event Baru
                </h1>
            </div>
            <p class="text-sm text-gray-400 ml-4 pl-3 border-l border-blue-500/30">
                [ FORM INPUT DATA EVENT ]
            </p>
        </div>

        <div class="cyber-card rounded-2xl shadow-2xl overflow-hidden">
            <div class="card-body p-8">
                <form id="eventForm" class="space-y-6" method="post" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Nama Event -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-cyber">[ Judul Event ]</span>
                        </label>
                        <input
                            type="text"
                            name="judul"
                            placeholder="Contoh: Konser Musik Rock"
                            class="input cyber-input w-full"
                            required />
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-cyber">[ Deskripsi ]</span>
                        </label>
                        <textarea
                            name="deskripsi"
                            placeholder="Deskripsi lengkap tentang event..."
                            class="textarea cyber-input h-32 w-full resize-none"
                            required></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tanggal & Waktu -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-cyber">[ Tanggal & Waktu ]</span>
                            </label>
                            <input
                                type="datetime-local"
                                name="tanggal_waktu"
                                class="input cyber-input w-full"
                                required />
                        </div>

                        <!-- Lokasi -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-cyber">[ Lokasi ]</span>
                            </label>
                            <input
                                type="text"
                                name="lokasi"
                                placeholder="Contoh: Stadion Utama"
                                class="input cyber-input w-full"
                                required />
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-cyber">[ Kategori ]</span>
                        </label>
                        <select name="kategori_id" class="select cyber-input w-full" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-cyber">[ Gambar Event ]</span>
                        </label>
                        <input
                            type="file"
                            name="gambar"
                            accept="image/*"
                            class="file-input cyber-input w-full"
                            required />
                        <label class="label">
                            <span class="label-text-alt text-gray-500">Format: JPG, PNG, max 5MB</span>
                        </label>
                    </div>

                    <!-- Preview Gambar -->
                    <div id="imagePreview" class="hidden overflow-hidden">
                        <label class="label">
                            <span class="label-cyber">[ Preview Gambar ]</span>
                        </label>
                        <div class="relative max-w-sm mt-3">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg blur opacity-25"></div>
                            <div class="relative rounded-lg overflow-hidden border-2 border-blue-500/30">
                                <img id="previewImg" src="" alt="Preview" class="w-full h-auto">
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="h-px bg-gradient-to-r from-transparent via-blue-500/50 to-transparent my-8"></div>

                    <!-- Tombol Submit -->
                    <div class="flex justify-end gap-4">
                        <button type="reset" class="btn btn-ghost text-gray-400 hover:text-white hover:bg-gray-800">
                            Reset
                        </button>
                        <button type="submit" class="btn cyber-btn text-white border-0 px-8">
                            <span class="relative z-10">Simpan Event</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Alert Success -->
        <div id="successAlert" class="alert alert-success mt-4 hidden border border-green-500/50 bg-gradient-to-r from-green-900/50 to-emerald-900/50">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Event berhasil disimpan!</span>
        </div>
    </div>

    <script>
        const form = document.getElementById('eventForm');
        const fileInput = form.querySelector('input[type="file"]');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const successAlert = document.getElementById('successAlert');

        // Preview gambar saat dipilih
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle reset
        form.addEventListener('reset', function() {
            imagePreview.classList.add('hidden');
            successAlert.classList.add('hidden');
        });
    </script>
</x-layouts.admin>