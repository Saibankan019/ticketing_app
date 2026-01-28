<x-layouts.admin title="Detail Event">

    {{-- TOAST SUCCESS --}}
    @if (session('success'))
        <div class="toast toast-bottom toast-center z-50">
            <div class="alert alert-success">
                <span>{{ session('success') }}</span>
            </div>
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.toast')?.remove()
            }, 3000)
        </script>
    @endif

    {{-- DETAIL EVENT --}}
    <div class="max-w-7xl mx-auto mb-10
                rounded-2xl
                bg-gray-900/80 backdrop-blur
                border border-blue-500/30
                shadow-lg">

        <div class="p-8">
            <h2 class="card-title text-2xl mb-6 text-blue-400 neon-text">
                Detail Event
            </h2>

            <form id="eventForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Judul --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold text-blue-400">Judul Event</span>
                    </label>
                    <input type="text"
                           class="input input-bordered w-full
                                  bg-gray-950 text-white
                                  border-blue-500/30
                                  disabled:opacity-80 disabled:text-white"
                           value="{{ $event->judul }}" disabled>
                </div>

                {{-- Kategori --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-blue-400 font-semibold">Kategori</span>
                    </label>
                    <select class="select select-bordered w-full
                                   bg-gray-950 text-white
                                   border-blue-500/30
                                   disabled:opacity-80"
                            disabled>
                        @foreach ($categories as $category)
                            <option {{ $category->id == $event->kategori_id ? 'selected' : '' }}>
                                {{ $category->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Deskripsi --}}
                <div class="form-control md:col-span-2">
                    <label class="label">
                        <span class="label-text text-blue-400 font-semibold">Deskripsi</span>
                    </label>
                    <textarea
                        class="textarea textarea-bordered w-full
                               bg-gray-950 text-white
                               border-blue-500/30
                               disabled:opacity-80 disabled:text-white"
                        disabled>{{ $event->deskripsi }}</textarea>
                </div>

                {{-- Tanggal --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-blue-400 font-semibold">Tanggal & Waktu</span>
                    </label>
                    <input type="datetime-local"
                           class="input input-bordered w-full
                                  bg-gray-950 text-white
                                  border-blue-500/30
                                  disabled:opacity-80"
                           value="{{ $event->tanggal_waktu->format('Y-m-d\TH:i') }}" disabled>
                </div>

                {{-- Lokasi - Dari Database --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-blue-400 font-semibold">Lokasi</span>
                    </label>
                    <input type="text"
                           class="input input-bordered w-full
                                  bg-gray-950 text-white
                                  border-blue-500/30
                                  disabled:opacity-80 disabled:text-white"
                           value="{{ $event->lokasi->nama_lokasi ?? 'Lokasi tidak tersedia' }}" disabled>
                </div>

                {{-- Gambar --}}
                <div class="md:col-span-2">
                    <label class="label">
                        <span class="label-text text-blue-400 font-semibold">Poster Event</span>
                    </label>

                    @if ($event->gambar)
                        <div class="mt-3 max-w-md rounded-xl overflow-hidden
                                    border border-blue-500/30 shadow-lg">
                            <img src="{{ asset('images/events/' . $event->gambar) }}"
                                 class="w-full object-cover">
                        </div>
                    @else
                        <p class="text-gray-400 italic">Tidak ada gambar</p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- LIST TICKET --}}
    <div class="max-w-7xl mx-auto">

        <div class="flex items-center mb-4">
            <h1 class="text-3xl font-black neon-text">List Ticket</h1>

            <button onclick="add_ticket_modal.showModal()"
                    class="btn ml-auto bg-blue-600 hover:bg-blue-500 text-white">
                + Tambah Ticket
            </button>
        </div>

        <div class="rounded-2xl
                    bg-gray-900/80 backdrop-blur
                    border border-blue-500/30
                    shadow-lg overflow-x-auto">

            <table class="table text-gray-200">
                <thead class="text-blue-400">
                    <tr>
                        <th>No</th>
                        <th>Tipe</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $index => $ticket)
                        <tr class="hover:bg-blue-500/10">
                            <th>{{ $index + 1 }}</th>
                            <td>{{ ucfirst($ticket->tipe) }}</td>
                            <td>Rp {{ number_format($ticket->harga) }}</td>
                            <td>{{ $ticket->stok }}</td>
                            <td class="space-x-1">
                                <button class="btn btn-xs bg-blue-600 text-white"
                                        onclick="openEditModal(this)"
                                        data-id="{{ $ticket->id }}"
                                        data-tipe="{{ $ticket->tipe }}"
                                        data-harga="{{ $ticket->harga }}"
                                        data-stok="{{ $ticket->stok }}">
                                    Edit
                                </button>
                                <button class="btn btn-xs bg-red-600 text-white"
                                        onclick="openDeleteModal(this)"
                                        data-id="{{ $ticket->id }}">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-400 py-6">
                                Tidak ada ticket tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    {{-- ===================== --}}
    {{-- MODALS --}}
    {{-- ===================== --}}

    {{-- ADD --}}
    <dialog id="add_ticket_modal" class="modal">
        <form method="POST" action="{{ route('admin.tickets.store') }}"
              class="modal-box bg-gray-900 border border-blue-500/30 text-white">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">

            <h3 class="text-lg font-bold mb-4 neon-text">Tambah Ticket</h3>

            <select name="tipe" class="select select-bordered w-full mb-3 bg-gray-950" required>
                <option disabled selected>Pilih Tipe</option>
                <option value="reguler">Regular</option>
                <option value="premium">Premium</option>
            </select>

            <input type="number" name="harga" class="input input-bordered w-full mb-3 bg-gray-950" placeholder="Harga" required>
            <input type="number" name="stok" class="input input-bordered w-full bg-gray-950" placeholder="Stok" required>

            <div class="modal-action">
                <button class="btn bg-blue-600 text-white">Tambah</button>
                <button class="btn" type="reset" onclick="add_ticket_modal.close()">Batal</button>
            </div>
        </form>
    </dialog>

    {{-- EDIT --}}
    <dialog id="edit_ticket_modal" class="modal">
        <form method="POST"
              class="modal-box bg-gray-900 border border-blue-500/30 text-white">
            @csrf
            @method('PUT')

            <h3 class="text-lg font-bold mb-4 neon-text">Edit Ticket</h3>

            <select id="edit_tipe" name="tipe" class="select select-bordered w-full mb-3 bg-gray-950" required>
                <option value="reguler">Regular</option>
                <option value="premium">Premium</option>
            </select>

            <input id="edit_harga" type="number" name="harga"
                   class="input input-bordered w-full mb-3 bg-gray-950" required>
            <input id="edit_stok" type="number" name="stok"
                   class="input input-bordered w-full bg-gray-950" required>

            <div class="modal-action">
                <button class="btn bg-blue-600 text-white">Simpan</button>
                <button class="btn" type="reset" onclick="edit_ticket_modal.close()">Batal</button>
            </div>
        </form>
    </dialog>

    {{-- DELETE --}}
    <dialog id="delete_modal" class="modal">
        <form method="POST"
              class="modal-box bg-gray-900 border border-red-500/40 text-white">
            @csrf
            @method('DELETE')

            <h3 class="text-lg font-bold mb-4 text-red-400">Hapus Ticket</h3>
            <p class="text-gray-300">Yakin ingin menghapus ticket ini?</p>

            <div class="modal-action">
                <button class="btn bg-red-600 text-white">Hapus</button>
                <button class="btn" type="reset" onclick="delete_modal.close()">Batal</button>
            </div>
        </form>
    </dialog>



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

        function openDeleteModal(button) {
            const id = button.dataset.id;
            const form = document.querySelector('#delete_modal form');
            document.getElementById("delete_ticket_id").value = id;

            // Set action dengan parameter ID
            form.action = `/admin/tickets/${id}`;
            delete_modal.showModal();
        }

        function openEditModal(button) {
            const id = button.dataset.id;
            const tipe = button.dataset.tipe;
            const harga = button.dataset.harga;
            const stok = button.dataset.stok;

            const form = document.querySelector('#edit_ticket_modal form');
            document.getElementById("edit_ticket_id").value = id;
            document.getElementById("edit_tipe").value = tipe;
            document.getElementById("edit_harga").value = harga;
            document.getElementById("edit_stok").value = stok;

            // Set action dengan parameter ID
            form.action = `/admin/tickets/${id}`;
            edit_ticket_modal.showModal();
        }
    </script>
</x-layouts.admin>