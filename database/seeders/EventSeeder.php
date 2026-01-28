<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Lokasi;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua lokasi
        $lokasis = Lokasi::all();

        $events = [
            [
                'user_id' => 1,
                'judul' => 'Konser Musik Rock',
                'deskripsi' => 'Nikmati malam penuh energi dengan band rock terkenal.',
                'tanggal_waktu' => '2024-08-15 19:00:00',
                'lokasi_id' => $lokasis[0]->id ?? null,
                'kategori_id' => 1,
                'gambar' => 'konser_rock.jpg',
            ],
            [
                'user_id' => 1,
                'judul' => 'Pameran Seni Kontemporer',
                'deskripsi' => 'Jelajahi karya seni modern dari seniman lokal dan internasional.',
                'tanggal_waktu' => '2024-09-10 10:00:00',
                'lokasi_id' => $lokasis[1]->id ?? $lokasis[0]->id ?? null,
                'kategori_id' => 2,
                'gambar' => 'pameran_seni.jpeg',
            ],
            [
                'user_id' => 1,
                'judul' => 'Festival Makanan Internasional',
                'deskripsi' => 'Cicipi berbagai hidangan lezat dari seluruh dunia.',
                'tanggal_waktu' => '2024-10-05 12:00:00',
                'lokasi_id' => $lokasis[2]->id ?? $lokasis[0]->id ?? null,
                'kategori_id' => 3,
                'gambar' => 'festival_makanan.jpg',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
