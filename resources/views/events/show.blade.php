<x-layouts.app>
<section class="relative max-w-7xl mx-auto py-16 px-6 text-gray-100">

  <!-- Breadcrumb -->
  <nav class="mb-6 text-sm text-gray-400">
    <a href="{{ route('home') }}" class="hover:text-blue-400">Beranda</a>
    <span class="mx-2">/</span>
    <span class="text-gray-500">Event</span>
    <span class="mx-2">/</span>
    <span class="text-blue-400">{{ $event->judul }}</span>
  </nav>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- LEFT -->
    <div class="lg:col-span-2 space-y-8">

      <!-- Event Card -->
      <div class="bg-gray-900 border border-blue-500/20 rounded-xl overflow-hidden">

       <img
          src="{{ $event->gambar
            ? asset('images/events/' . $event->gambar)
            : asset('assets/images/placeholder.jpg') }}"
          class="w-full h-[420px] object-cover">

        <div class="p-8">

          <h1 class="text-3xl font-extrabold text-white">
            {{ $event->judul }}
          </h1>

          <p class="text-sm text-gray-400 mt-2">
            {{ \Carbon\Carbon::parse($event->tanggal_waktu)->locale('id')->translatedFormat('d F Y, H:i') }}
            • 📍 {{ $event->lokasi }}
          </p>

          <div class="flex gap-2 mt-4">
            <span class="px-3 py-1 text-xs rounded-full bg-blue-500/10 text-blue-400">
              {{ $event->kategori?->nama ?? 'Tanpa Kategori' }}
            </span>
            <span class="px-3 py-1 text-xs rounded-full bg-gray-700 text-gray-300">
              {{ $event->user?->name ?? 'Penyelenggara' }}
            </span>
          </div>

          <p class="mt-6 text-gray-300 leading-relaxed">
            {{ $event->deskripsi }}
          </p>
        </div>
      </div>

      <!-- Ticket Section -->
      <div class="bg-gray-900 border border-blue-500/20 rounded-xl p-8">
        <h3 class="text-xl font-bold text-blue-400 mb-6">
          Pilih Tiket
        </h3>

        <div class="space-y-4">
          @forelse($event->tikets as $tiket)
          <div class="flex items-center justify-between border border-gray-700 rounded-lg p-4 hover:border-blue-500/50 transition">

            <div>
              <div class="font-semibold text-white">{{ $tiket->tipe }}</div>
              <div class="text-sm text-gray-400">Stok: {{ $tiket->stok }}</div>
              @if($tiket->keterangan)
                <div class="text-sm text-gray-500 mt-1">{{ $tiket->keterangan }}</div>
              @endif
            </div>

            <div class="text-right space-y-2">
              <div class="text-lg font-bold text-blue-400">
                {{ $tiket->harga ? 'Rp ' . number_format($tiket->harga,0,',','.') : 'Gratis' }}
              </div>

              <div class="flex items-center gap-2">
                <button class="px-3 py-1 border border-gray-600 hover:border-blue-500 rounded transition"
                        data-action="dec" data-id="{{ $tiket->id }}">−</button>

                <input id="qty-{{ $tiket->id }}"
                       data-id="{{ $tiket->id }}"
                       type="number"
                       min="0"
                       max="{{ $tiket->stok }}"
                       value="0"
                       class="w-16 text-center bg-gray-800 border border-gray-600 rounded focus:border-blue-500 focus:outline-none">

                <button class="px-3 py-1 border border-gray-600 hover:border-blue-500 rounded transition"
                        data-action="inc" data-id="{{ $tiket->id }}">+</button>
              </div>

              <div class="text-sm text-gray-400">
                Subtotal: <span id="subtotal-{{ $tiket->id }}">Rp 0</span>
              </div>
            </div>

          </div>
          @empty
            <p class="text-gray-400">Tiket belum tersedia.</p>
          @endforelse
        </div>
      </div>
    </div>

    <!-- RIGHT -->
    <aside class="lg:col-span-1">
      <div class="sticky top-24 bg-gray-900 border border-blue-500/30 rounded-xl p-6">

        <h4 class="text-lg font-bold text-white mb-4">
          Ringkasan Pembelian
        </h4>

        <div class="flex justify-between text-sm text-gray-400">
          <span>Item</span>
          <span id="summaryItems">0</span>
        </div>

        <div class="flex justify-between text-2xl font-extrabold mt-2 text-blue-400">
          <span>Total</span>
          <span id="summaryTotal">Rp 0</span>
        </div>

        <div class="border-t border-gray-700 my-4"></div>

        <div id="selectedList" class="space-y-2 text-sm text-gray-300">
          <p class="text-gray-500">Belum ada tiket dipilih</p>
        </div>

        @auth
          <button id="checkoutButton"
                  onclick="openCheckout()"
                  disabled
                  class="w-full mt-6 py-3 rounded-lg bg-blue-900 text-white font-semibold hover:bg-blue-800 transition disabled:opacity-50 disabled:cursor-not-allowed">
            Checkout
          </button>
        @else
          <a href="{{ route('login') }}"
             class="block text-center mt-6 py-3 rounded-lg bg-blue-900 text-white font-semibold hover:bg-blue-800 transition">
            Login untuk Checkout
          </a>
        @endauth

      </div>
    </aside>

  </div>

  <!-- Checkout Modal -->
  <dialog id="checkout_modal" class="modal">
    <form method="dialog"
          class="modal-box bg-gray-900/95 backdrop-blur border border-blue-500/30 text-white rounded-2xl shadow-xl max-w-lg">

      <!-- TITLE -->
      <h3 class="text-xl font-bold mb-6 text-blue-400">
        Konfirmasi Pembelian
      </h3>

      <!-- CONTENT -->
      <div class="space-y-4">

        <!-- Items List -->
        <div>
          <label class="text-xs text-gray-400 uppercase tracking-wider mb-2 block">Detail Tiket</label>
          <div id="modalItems" class="space-y-2 max-h-48 overflow-y-auto pr-2 bg-gray-950 border border-blue-500/20 rounded-lg p-3">
            <p class="text-gray-400 italic text-sm">Belum ada item.</p>
          </div>
        </div>

        <!-- Payment Type Selection -->
        <div>
          <label class="text-xs text-gray-400 uppercase tracking-wider mb-2 block">Metode Pembayaran</label>
          <select id="payment_type_id" class="select select-bordered w-full bg-gray-800 text-white border-blue-500/30 focus:border-blue-500" required>
            <option value="" disabled selected>Pilih Metode Pembayaran</option>
            @foreach($paymentTypes as $paymentType)
              <option value="{{ $paymentType->id }}">{{ $paymentType->nama }}</option>
            @endforeach
          </select>
        </div>

        <div class="divider my-2"></div>

        <!-- TOTAL -->
        <div class="flex justify-between items-center p-4 rounded-lg bg-gray-950 border border-blue-500/30">
          <span class="font-semibold text-blue-400">Total Pembayaran</span>
          <span class="font-bold text-xl text-white" id="modalTotal">Rp 0</span>
        </div>
      </div>

      <!-- ACTION -->
      <div class="modal-action mt-6">
        <button type="button" class="btn btn-ghost text-gray-300" onclick="checkout_modal.close()">
          Batal
        </button>

        <button type="button"
                id="confirmCheckout"
                class="btn bg-blue-600 hover:bg-blue-500 text-white px-8">
          Konfirmasi
        </button>
      </div>
    </form>
  </dialog>

</section>

<script>
(function () {
  // Helper to format Indonesian currency
  const formatRupiah = (value) => {
    return 'Rp ' + Number(value).toLocaleString('id-ID');
  }

  const tickets = {
    @foreach($event->tikets as $tiket)
      {{ $tiket->id }}: {
        id: {{ $tiket->id }},
        price: {{ $tiket->harga ?? 0 }},
        stock: {{ $tiket->stok }},
        tipe: "{{ addslashes($tiket->tipe) }}"
      },
    @endforeach
  };

  const summaryItemsEl = document.getElementById('summaryItems');
  const summaryTotalEl = document.getElementById('summaryTotal');
  const selectedListEl = document.getElementById('selectedList');
  const checkoutButton = document.getElementById('checkoutButton');

  function updateSummary() {
    let totalQty = 0;
    let totalPrice = 0;
    let selectedHtml = '';

    Object.values(tickets).forEach(t => {
      const qtyInput = document.getElementById('qty-' + t.id);
      if (!qtyInput) return;
      const qty = Number(qtyInput.value || 0);
      if (qty > 0) {
        totalQty += qty;
        totalPrice += qty * t.price;
        selectedHtml += `<div class="flex justify-between text-sm"><span>${t.tipe} x ${qty}</span><span class="font-semibold">${formatRupiah(qty * t.price)}</span></div>`;
      }
    });

    summaryItemsEl.textContent = totalQty;
    summaryTotalEl.textContent = formatRupiah(totalPrice);
    selectedListEl.innerHTML = selectedHtml || '<p class="text-gray-500 text-sm">Belum ada tiket dipilih</p>';
    
    if (checkoutButton) {
      checkoutButton.disabled = totalQty === 0;
    }
  }

  // Wire up plus/minus buttons
  document.querySelectorAll('[data-action="inc"]').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const id = e.currentTarget.dataset.id;
      const input = document.getElementById('qty-' + id);
      const info = tickets[id];
      if (!input || !info) return;
      let val = Number(input.value || 0);
      if (val < info.stock) val++;
      input.value = val;
      updateTicketSubtotal(id);
      updateSummary();
    });
  });

  document.querySelectorAll('[data-action="dec"]').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const id = e.currentTarget.dataset.id;
      const input = document.getElementById('qty-' + id);
      if (!input) return;
      let val = Number(input.value || 0);
      if (val > 0) val--;
      input.value = val;
      updateTicketSubtotal(id);
      updateSummary();
    });
  });

  document.querySelectorAll('input[id^="qty-"]').forEach(input => {
    input.addEventListener('change', (e) => {
      const el = e.currentTarget;
      const id = el.dataset.id;
      const info = tickets[id];
      let val = Number(el.value || 0);
      if (val < 0) val = 0;
      if (val > info.stock) val = info.stock;
      el.value = val;
      updateTicketSubtotal(id);
      updateSummary();
    });
  });

  function updateTicketSubtotal(id) {
    const t = tickets[id];
    const qty = Number(document.getElementById('qty-' + id).value || 0);
    const subtotalEl = document.getElementById('subtotal-' + id);
    if (subtotalEl) subtotalEl.textContent = formatRupiah(qty * t.price);
  }

  // Checkout modal
  window.openCheckout = function () {
    const modal = document.getElementById('checkout_modal');
    const modalItems = document.getElementById('modalItems');
    const modalTotal = document.getElementById('modalTotal');

    let itemsHtml = '';
    let total = 0;
    Object.values(tickets).forEach(t => {
      const qty = Number(document.getElementById('qty-' + t.id).value || 0);
      if (qty > 0) {
        itemsHtml += `<div class="flex justify-between text-sm py-1"><span>${t.tipe} x ${qty}</span><span class="font-semibold">${formatRupiah(qty * t.price)}</span></div>`;
        total += qty * t.price;
      }
    });

    modalItems.innerHTML = itemsHtml || '<p class="text-gray-400 italic text-sm">Belum ada item.</p>';
    modalTotal.textContent = formatRupiah(total);

    if (typeof modal.showModal === 'function') {
      modal.showModal();
    }
  }

  // Checkout confirmation
  document.getElementById('confirmCheckout').addEventListener('click', async () => {
    const btn = document.getElementById('confirmCheckout');
    const paymentTypeId = document.getElementById('payment_type_id').value;
    
    // Validasi payment type
    if (!paymentTypeId) {
      alert('Silakan pilih metode pembayaran');
      return;
    }

    btn.setAttribute('disabled', 'disabled');
    btn.textContent = 'Memproses...';

    // Gather items
    const items = [];
    Object.values(tickets).forEach(t => {
      const qty = Number(document.getElementById('qty-' + t.id).value || 0);
      if (qty > 0) items.push({ tiket_id: t.id, jumlah: qty });
    });

    if (items.length === 0) {
      alert('Tidak ada tiket dipilih');
      btn.removeAttribute('disabled');
      btn.textContent = 'Konfirmasi';
      return;
    }

    try {
      const res = await fetch("{{ route('orders.store') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ 
          event_id: {{ $event->id }}, 
          payment_type_id: paymentTypeId,
          items 
        })
      });

      if (!res.ok) {
        const errorData = await res.json().catch(() => ({ message: 'Gagal membuat pesanan' }));
        throw new Error(errorData.message || 'Gagal membuat pesanan');
      }

      const data = await res.json();
      window.location.href = data.redirect || '{{ route('orders.index') }}';
    } catch (err) {
      console.error('Checkout error:', err);
      alert('Terjadi kesalahan saat memproses pesanan: ' + err.message);
      btn.removeAttribute('disabled');
      btn.textContent = 'Konfirmasi';
    }
  });

  // Initialize
  updateSummary();
})();
</script>
</x-layouts.app>