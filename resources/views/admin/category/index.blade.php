<x-layouts.admin title="Manajemen Kategori">
    <style>
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.6); }
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
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
        
        .cyber-table-header {
            background: linear-gradient(145deg, #1e3a8a, #1e40af);
            border-bottom: 2px solid #3b82f6;
        }
        
        .cyber-table-row {
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
            transition: all 0.3s ease;
        }
        
        .cyber-table-row:hover {
            background: rgba(59, 130, 246, 0.05);
            border-left: 3px solid #3b82f6;
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
        
        .cyber-btn-danger {
            background: linear-gradient(145deg, #dc2626, #b91c1c);
            border: 1px solid #dc2626;
        }
        
        .cyber-btn-danger:hover {
            box-shadow: 0 10px 30px rgba(220, 38, 38, 0.4);
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
        
        .label-cyber {
            color: #3b82f6;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
        }
        
        .toast-cyber {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border: 1px solid rgba(34, 197, 94, 0.5);
            animation: slideIn 0.5s ease, glow 2s ease-in-out infinite;
        }
        
        .modal-cyber {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
    </style>

    @if (session('success'))
        <div class="toast toast-bottom toast-center z-50">
            <div class="alert toast-cyber text-green-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.toast')?.remove()
            }, 3000)
        </script>
    @endif

    <div class="min-h-screen">
        <div class="container mx-auto p-6 md:p-10">

            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <div class="h-8 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                            <h1 class="text-3xl md:text-4xl font-black uppercase tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                                Manajemen Kategori
                            </h1>
                        </div>
                        <p class="text-sm text-gray-400 ml-4 pl-3 border-l border-blue-500/30">
                            [ DATA KATEGORI EVENT ]
                        </p>
                    </div>
                    
                    <button
                        class="cyber-btn px-6 py-3 text-white rounded-lg font-semibold uppercase tracking-wide"
                        onclick="add_modal.showModal()">
                        <span class="relative z-10">+ Tambah Kategori</span>
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="cyber-card rounded-2xl shadow-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead class="cyber-table-header text-blue-100">
                            <tr>
                                <th class="text-xs uppercase tracking-wider">No</th>
                                <th class="text-xs uppercase tracking-wider w-3/4">Nama Kategori</th>
                                <th class="text-xs uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-300">
                            @forelse ($categories as $index => $category)
                                <tr class="cyber-table-row">
                                    <th class="text-blue-400">{{ $index + 1 }}</th>
                                    <td class="font-medium">{{ $category->nama }}</td>
                                    <td class="flex gap-2">
                                        <button
                                            class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-500 text-white rounded-lg font-semibold transition-all hover:scale-105"
                                            onclick="openEditModal(this)"
                                            data-id="{{ $category->id }}"
                                            data-nama="{{ $category->nama }}">
                                            Edit
                                        </button>
                                        <button
                                            class="px-4 py-2 text-sm cyber-btn-danger text-white rounded-lg font-semibold transition-all hover:scale-105"
                                            onclick="openDeleteModal(this)"
                                            data-id="{{ $category->id }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-12">
                                        <div class="text-gray-500">
                                            <div class="text-5xl mb-3">📁</div>
                                            <p class="text-lg font-semibold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                                                BELUM ADA KATEGORI
                                            </p>
                                            <p class="text-sm mt-2">Tambahkan kategori pertama Anda</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Add Modal -->
    <dialog id="add_modal" class="modal">
        <form method="POST" action="{{ route('admin.categories.store') }}" class="modal-box modal-cyber rounded-2xl border-2 border-blue-500/30">
            @csrf
            
            <div class="mb-6">
                <div class="flex items-center gap-2 mb-1">
                    <div class="h-6 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                    <h3 class="text-xl font-black uppercase tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                        Tambah Kategori
                    </h3>
                </div>
                <p class="text-xs text-gray-400 ml-3 pl-2 border-l border-blue-500/30">
                    [ INPUT DATA BARU ]
                </p>
            </div>

            <div class="form-control w-full mb-6">
                <label class="label">
                    <span class="label-cyber">[ Nama Kategori ]</span>
                </label>
                <input
                    type="text"
                    name="nama"
                    required
                    placeholder="Masukkan nama kategori"
                    class="input cyber-input w-full" />
            </div>

            <div class="h-px bg-gradient-to-r from-transparent via-blue-500/50 to-transparent mb-6"></div>

            <div class="flex justify-end gap-3">
                <button class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-semibold transition-all" onclick="add_modal.close()" type="button">
                    Batal
                </button>
                <button class="cyber-btn px-6 py-2 text-white rounded-lg font-semibold" type="submit">
                    <span class="relative z-10">Simpan</span>
                </button>
            </div>
        </form>
    </dialog>

    <!-- Edit Modal -->
    <dialog id="edit_modal" class="modal">
        <form method="POST" class="modal-box modal-cyber rounded-2xl border-2 border-blue-500/30">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit_category_id" name="category_id">

            <div class="mb-6">
                <div class="flex items-center gap-2 mb-1">
                    <div class="h-6 w-1 bg-gradient-to-b from-blue-500 to-purple-500"></div>
                    <h3 class="text-xl font-black uppercase tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                        Edit Kategori
                    </h3>
                </div>
                <p class="text-xs text-gray-400 ml-3 pl-2 border-l border-blue-500/30">
                    [ UPDATE DATA ]
                </p>
            </div>

            <div class="form-control w-full mb-6">
                <label class="label">
                    <span class="label-cyber">[ Nama Kategori ]</span>
                </label>
                <input
                    type="text"
                    id="edit_category_name"
                    name="nama"
                    class="input cyber-input w-full" />
            </div>

            <div class="h-px bg-gradient-to-r from-transparent via-blue-500/50 to-transparent mb-6"></div>

            <div class="flex justify-end gap-3">
                <button class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-semibold transition-all" onclick="edit_modal.close()" type="button">
                    Batal
                </button>
                <button class="cyber-btn px-6 py-2 text-white rounded-lg font-semibold" type="submit">
                    <span class="relative z-10">Simpan</span>
                </button>
            </div>
        </form>
    </dialog>

    <!-- Delete Modal -->
    <dialog id="delete_modal" class="modal">
        <form method="POST" class="modal-box modal-cyber rounded-2xl border-2 border-red-500/30">
            @csrf
            @method('DELETE')

            <input type="hidden" id="delete_category_id" name="category_id">

            <div class="mb-6">
                <div class="flex items-center gap-2 mb-1">
                    <div class="h-6 w-1 bg-gradient-to-b from-red-500 to-orange-500"></div>
                    <h3 class="text-xl font-black uppercase tracking-wide text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-orange-400">
                        Hapus Kategori
                    </h3>
                </div>
                <p class="text-xs text-gray-400 ml-3 pl-2 border-l border-red-500/30">
                    [ KONFIRMASI ]
                </p>
            </div>

            <div class="mb-6 p-4 bg-red-900/20 border border-red-500/30 rounded-lg">
                <p class="text-gray-300 text-sm">Apakah Anda yakin ingin menghapus kategori ini?</p>
                <p class="text-red-400 text-xs mt-2">⚠️ Tindakan ini tidak dapat dibatalkan</p>
            </div>

            <div class="h-px bg-gradient-to-r from-transparent via-red-500/50 to-transparent mb-6"></div>

            <div class="flex justify-end gap-3">
                <button class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-semibold transition-all" onclick="delete_modal.close()" type="button">
                    Batal
                </button>
                <button class="cyber-btn-danger px-6 py-2 text-white rounded-lg font-semibold" type="submit">
                    <span class="relative z-10">Hapus</span>
                </button>
            </div>
        </form>
    </dialog>

    <script>
        function openEditModal(button) {
            const name = button.dataset.nama;
            const id = button.dataset.id;
            const form = document.querySelector('#edit_modal form');

            document.getElementById("edit_category_name").value = name;
            document.getElementById("edit_category_id").value = id;
            form.action = `/admin/categories/${id}`;

            edit_modal.showModal();
        }

        function openDeleteModal(button) {
            const id = button.dataset.id;
            const form = document.querySelector('#delete_modal form');

            document.getElementById("delete_category_id").value = id;
            form.action = `/admin/categories/${id}`;

            delete_modal.showModal();
        }
    </script>

</x-layouts.admin>  