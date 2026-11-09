# Portofolio Khair — Tailwind Setup

Branch ini hanya berisi **setup Tailwind CSS 4 di Laravel 12** (lewat Vite). Belum ada landing page maupun fitur backend.

## Cara menjalankan

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite && php artisan migrate
npm install
npm run dev          # terminal 1
php artisan serve    # terminal 2
```

Buka http://127.0.0.1:8000 — kartu gelap dengan tombol biru menandakan Tailwind sudah jalan.

## File penting

| File | Fungsi |
| --- | --- |
| `vite.config.js` | Plugin `laravel-vite-plugin` + `@tailwindcss/vite` |
| `resources/css/app.css` | `@import 'tailwindcss';` dan `@theme` |
| `resources/js/app.js` | Entry JavaScript |
| `resources/views/welcome.blade.php` | Halaman uji Tailwind (`@vite`) |

## Branch lain

- `feature/tailwind-landing-page` — Tailwind + landing page portofolio
- `feature/backend-laravel-setup` — Setup Laravel
- `feature/backend-laravel-db` — Laravel + database
- `feature/backend-laravel-db-api` — Laravel + database + REST API
