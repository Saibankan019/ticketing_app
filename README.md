# 🎟️ Ticketing App (Laravel)
Berikut adalah contoh langkah dan deskripsi untuk menjalankan project Ticketing App

---

# Proyek Laravel 12 - Bengkod WD01

Nama: **Muhammad Fadhlan Hakim**  
NIM: **A11.2022.14619**  
Kelas: **BK-WEBDEV SIANG**
Aplikasi **Ticketing App** 

berbasis Laravel untuk mengelola event, kategori, tiket, dan transaksi pemesanan. Project ini menggunakan **Laravel Breeze**, **DaisyUI**, dan **Tailwind CSS**.

---

## 📋 Persyaratan Sistem

Pastikan environment kamu sudah memenuhi kebutuhan berikut:

* PHP >= 8.1
* Composer
* Node.js & NPM
* MySQL / MariaDB
* Git

---

## 🚀 Langkah Menjalankan Project

### 1️⃣ Clone Repository

```bash
   git clone https://github.com/Saibankan019/ticketing_app
   ```

---

### 2️⃣ Install Dependency PHP

```bash
composer install
```

---

### 3️⃣ Copy File Environment

```bash
cp .env.example .env
```

Lalu sesuaikan konfigurasi database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ticketing_app
DB_USERNAME=root
DB_PASSWORD=
DB_TIMEZONE=+07:00
```

---

### 4️⃣ Generate Application Key

```bash
php artisan key:generate
```

---

### 5️⃣ Install Dependency Frontend

```bash
npm install
npm run dev
```

---

### 6️⃣ Migrasi & Seeder Database

> ⚠️ Perintah ini akan **menghapus semua data lama** (khusus development)

```bash
php artisan migrate:fresh --seed
```

Seeder akan mengisi:

* User (admin & user)
* Kategori
* Event
* Data dummy transaksi

---

### 7️⃣ Jalankan Server Laravel

```bash
php artisan serve
```

Akses aplikasi di:

```
http://127.0.0.1:8000
```

---

## 🔐 Akun Default (Seeder)

### Admin

* Email: `admin@gmail.com`
* Password: `password`

### User

* Email: `user@gmail.com`
* Password: `password`

---

## 🗂️ Struktur Folder Penting

```bash
app/
 ├── Http/Controllers/Admin
 ├── Models

public/
 └── assets/images/events

resources/views/
 ├── admin
 ├── components
 └── layouts
```

---

## 🖼️ Manajemen Gambar Event

* Gambar event disimpan di:

  ```
  public/assets/images/events
  ```
* Database hanya menyimpan path relatif:

  ```
  events/nama_file.jpg
  ```
* Akses di Blade:

  ```blade
  asset('assets/images/' . $event->gambar)
  ```

---

## 🧪 Perintah Artisan Berguna

| Kebutuhan               | Command                                   |
| ----------------------- | ----------------------------------------- |
| Reset database + seeder | `php artisan migrate:fresh --seed`        |
| Seeder tertentu         | `php artisan db:seed --class=EventSeeder` |
| Clear cache             | `php artisan optimize:clear`              |

---

## 🛠️ Teknologi yang Digunakan

* Laravel 11
* Laravel Breeze (Auth)
* Tailwind CSS
* DaisyUI
* MySQL
