# Portofolio Khair — Backend: Laravel & Database

Branch ini menambahkan **database** di atas setup Laravel: migration, model Eloquent, seeder, daftar proyek dari DB, dan form kontak yang tersimpan.

## Cara menjalankan

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed      # buat tabel + isi 4 proyek contoh
npm install && npm run build    # asset Tailwind untuk halaman
php artisan serve
```

Untuk MySQL, ubah `DB_CONNECTION=mysql` dan isi `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` di `.env`.

## Database

| Tabel | Kolom |
| --- | --- |
| `projects` | `title`, `description`, `tech_stack`, `demo_url`, `github_url`, timestamps |
| `contact_messages` | `name`, `email`, `message`, timestamps |

## Route

| Method | URL | Fungsi |
| --- | --- | --- |
| GET | `/` | Beranda + 3 proyek terbaru |
| GET | `/about` | Tentang |
| GET | `/projects` | Semua proyek (dari DB) |
| GET | `/projects/{id}` | Detail proyek |
| GET | `/contact` | Form kontak |
| POST | `/contact` | Validasi + simpan ke `contact_messages` |

Data profil diatur di `config/profile.php`. Jalankan test: `php artisan test`.

## Branch berikutnya

- `feature/backend-laravel-db-api` — REST API untuk proyek dan pesan kontak
