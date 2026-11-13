# Bhumi Arohan: Company Website

Laravel + Blade + Tailwind CSS v4 + vanilla JS, with an SQLite database.

## Run locally
```bash
composer install && npm install
php artisan migrate --seed   # first time only
npm run build                # or `npm run dev` while editing
php artisan serve            # http://localhost:8000
```

## Admin panel
`/admin`. The login comes from `ADMIN_EMAIL` / `ADMIN_PASSWORD` in `.env` (set when seeding). You can change the password from the panel.
From the panel you can manage projects (with photos), services, team members, and contact-form inquiries.

## Things to customise
| What | Where |
|---|---|
| Logo / favicon | `public/images/`: `logo-mark*.png` (header icon), `logo-full-light.png` (footer), `favicon.png`, `apple-touch-icon.png`. Markup in `resources/views/components/logo.blade.php` |
| Brand colours | `resources/css/app.css`, `--color-brand-*` (logo navy) and `--color-accent-*` (logo gold) in `@theme` |
| Phone, email, address, map, social links | `.env` (`COMPANY_*`) or `config/company.php` |
| "Registration in progress" note | set `COMPANY_REGISTRATION_PENDING=false` and `COMPANY_REGISTRATION_NO=...` in `.env` |
| Home / About images | the `<x-media src="" ...>` placeholders in `resources/views/pages/home.blade.php` and `about.blade.php` |
| Inquiry email notifications | set `COMPANY_INQUIRY_NOTIFY` and the `MAIL_*` settings in `.env` |
