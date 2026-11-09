# Portofolio Khair — Tailwind + Landing Page

Branch ini berisi **setup Tailwind CSS 4 + landing page portofolio** (Hero, About, Projects, Skills, Experience, Contact). Belum ada database: form kontak baru divalidasi, belum disimpan.

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

Buka http://127.0.0.1:8000 untuk melihat landing page. Isi profil, proyek, dan statistik diubah lewat `config/portfolio.php`.

## File penting

| File | Fungsi |
| --- | --- |
| `vite.config.js` | Plugin `laravel-vite-plugin` + `@tailwindcss/vite` |
| `resources/css/app.css` | `@import 'tailwindcss';` dan `@theme` |
| `resources/js/app.js` | Entry JavaScript |
| `resources/views/welcome.blade.php` | Halaman uji Tailwind (`@vite`) |
| `resources/views/portofolio/home.blade.php` | Landing page |
| `resources/views/layouts/portfolio.blade.php` | Layout landing page |
| `config/portfolio.php` | Data profil & proyek |
| `public/css`, `public/js` | Gaya dan efek landing page |

## Branch lain

- `feature/tailwind-landing-page` — Tailwind + landing page portofolio
- `feature/backend-laravel-setup` — Setup Laravel
- `feature/backend-laravel-db` — Laravel + database
- `feature/backend-laravel-db-api` — Laravel + database + REST API
