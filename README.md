# Portofolio Khair — Backend: Laravel, Database & REST API

Branch ini menambahkan **REST API (JSON)** di atas Laravel + database.

## Cara menjalankan

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm install && npm run build
php artisan serve
```

## Endpoint API

Base URL: `http://127.0.0.1:8000/api`

| Method | URL | Keterangan |
| --- | --- | --- |
| GET | `/projects` | Daftar proyek (terpaginasi). Query: `q`, `tech`, `per_page` (1–50, default 10) |
| GET | `/projects/{id}` | Detail satu proyek (404 jika tidak ada) |
| POST | `/contact-messages` | Kirim pesan. Body: `name`, `email`, `message`. Maks 10 request/menit per IP |

### Contoh

```bash
curl "http://127.0.0.1:8000/api/projects?tech=Laravel&per_page=5"

curl -X POST http://127.0.0.1:8000/api/contact-messages \
  -H "Accept: application/json" -H "Content-Type: application/json" \
  -d '{"name":"Budi","email":"budi@example.com","message":"Halo!"}'
```

Respons proyek:

```json
{
  "data": [
    {
      "id": 1,
      "title": "Website Wisata Lombok Timur",
      "description": "...",
      "tech_stack": ["Laravel", "MySQL", "Tailwind CSS"],
      "demo_url": null,
      "github_url": null,
      "created_at": "2026-11-09T10:00:00+00:00"
    }
  ],
  "links": {},
  "meta": {}
}
```

Kirim header `Accept: application/json` agar error validasi dikembalikan sebagai JSON (422).

> **Catatan keamanan:** API ini sengaja **hanya-baca** untuk proyek. Endpoint tambah/ubah/hapus proyek belum ada karena butuh autentikasi (mis. Laravel Sanctum) agar tidak bisa diubah sembarang orang.

## Struktur baru

| Lokasi | Fungsi |
| --- | --- |
| `routes/api.php` | Daftar route API |
| `app/Http/Controllers/Api/` | `ProjectController`, `ContactMessageController` |
| `app/Http/Resources/ProjectResource.php` | Bentuk JSON proyek |
| `database/factories/ProjectFactory.php` | Data palsu untuk test |
| `tests/Feature/ApiTest.php` | Test API |

Jalankan test: `php artisan test`.
