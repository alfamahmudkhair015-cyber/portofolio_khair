# Portofolio Khair — Backend: Setup Laravel

Branch ini berisi **instalasi dan struktur dasar Laravel 12**: routing, controller, layout Blade, dan test. Belum memakai database.

## Cara menjalankan

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

Buka http://127.0.0.1:8000. Jalankan test dengan `php artisan test`.

## Struktur

| Lokasi | Fungsi |
| --- | --- |
| `routes/web.php` | Daftar route (`/`, `/about`, `/contact`) |
| `app/Http/Controllers/PageController.php` | Mengembalikan view tiap halaman |
| `resources/views/layouts/app.blade.php` | Layout + navigasi |
| `resources/views/pages/` | Halaman Home, About, Contact |
| `tests/Feature/PageTest.php` | Memastikan semua halaman terbuka |

## Branch berikutnya

- `feature/backend-laravel-db` — migration, model, seeder, form kontak tersimpan ke DB
- `feature/backend-laravel-db-api` — REST API (`/api/projects`, `/api/contact-messages`)
