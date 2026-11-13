<p align="center">
  <img src="public/images/logo-full.png" alt="Bhumi Arohan Engineering & Construction" width="280">
</p>

<h1 align="center">Bhumi Arohan Engineering &amp; Construction Pvt. Ltd.</h1>

<p align="center">
  <em>Building Spaces • Creating Value • Elevating Lives</em><br>
  Official company website, Chitwan, Nepal
</p>

<p align="center">
  <img alt="Laravel 13" src="https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white">
  <img alt="PHP 8.3+" src="https://img.shields.io/badge/PHP-8.3%2B-777BB4?logo=php&logoColor=white">
  <img alt="Tailwind CSS 4" src="https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss&logoColor=white">
  <img alt="Vite" src="https://img.shields.io/badge/Vite-8-646CFF?logo=vite&logoColor=white">
  <img alt="SQLite" src="https://img.shields.io/badge/SQLite-003B57?logo=sqlite&logoColor=white">
</p>

---

## Overview

A fast, mobile-friendly website for an engineering and construction company in Nepal. Visitors can browse the company's services and projects, convert Nepali land units and send an inquiry. The company manages all content from a built-in admin panel, with no code changes needed.

## Features

**Public website**
- **Home**: animated hero section, service overview, "why choose us", work process, and latest projects
- **About**: company story, mission, vision, values and team preview
- **Services**: 8 services, each with its own page:
  - Building Construction
  - Design & Consulting
  - Interior Work & Design
  - Renovation
  - Real Estate
  - Engineering Resources Supply
  - Survey & Lab Testing
  - Infrastructure / Civil Works
- **Projects**: portfolio filterable by category, with a photo gallery and lightbox on each project page
- **Team**: profiles of the founder and engineers
- **Land Unit Converter**: live conversion between Ropani–Aana–Paisa–Daam, Bigha–Kattha–Dhur, sq.ft, m² and acres
- **Contact**: inquiry form (with spam protection and rate limiting), click-to-call numbers and a Google Map
- Smooth slide-up animations for page and section titles, which turn off for visitors whose device is set to reduce motion
- Responsive layout from phones to large screens, plus SEO meta tags

**Admin panel** (`/admin`)
- Secure login, with a page to change the password
- Add, edit and delete **projects** (cover image and gallery uploads), **services** and **team members**
- **Inquiries** inbox with read/unread status
- Every contact-form message is saved to the inbox **and** emailed to the company (Gmail SMTP)

## Tech stack

| Layer | Technology |
|---|---|
| Backend | Laravel 13 (PHP 8.3+) |
| Views | Blade components |
| Styling | Tailwind CSS v4 |
| Scripts | Vanilla JavaScript (no framework) |
| Build | Vite |
| Database | SQLite (MySQL works by changing `.env`) |
| Tests | PHPUnit |

## Getting started

### Requirements
- PHP 8.3+ with the `gd` or `imagick` extension, plus Composer
- Node.js 20.19+ (or 22+) and npm

### Installation

```bash
git clone https://github.com/EmOn9999-9/Bhumiarohan-.git bhumiarohan
cd bhumiarohan

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Open `.env` and set at least the admin login:

```env
ADMIN_EMAIL=admin@bhumiarohan.com
ADMIN_PASSWORD=choose-a-strong-password
```

Then create the database, link the uploads folder and build the assets:

```bash
touch database/database.sqlite
php artisan migrate --seed
php artisan storage:link
npm run build
```

### Run

```bash
php artisan serve
```

Visit **http://localhost:8000**. The admin panel is at **http://localhost:8000/admin**.

When editing styles or scripts, run `npm run dev` in a second terminal for live reloading.

## Configuration

Company details are kept in `config/company.php`, and each one can be overridden in `.env`:

| Variable | Purpose |
|---|---|
| `COMPANY_PHONE`, `COMPANY_PHONE_ALT` | Contact numbers |
| `COMPANY_EMAIL` | Public email address |
| `COMPANY_ADDRESS`, `COMPANY_MAP_EMBED` | Office address and Google Maps embed URL |
| `COMPANY_INSTAGRAM`, `COMPANY_FACEBOOK`, `COMPANY_WHATSAPP` | Social links (empty links are hidden) |
| `COMPANY_REGISTRATION_PENDING`, `COMPANY_REGISTRATION_NO` | Company registration status shown on the site |
| `COMPANY_INQUIRY_NOTIFY` | Address that receives contact-form emails |

### Email notifications (Gmail)

Contact-form messages are emailed using Gmail SMTP. Gmail requires an **App Password** for this, not the normal account password:

1. Google Account → **Security** → turn on **2-Step Verification**
2. Search for **App passwords** and create one (for example, "Website")
3. Add it to `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=bhumiarohan.engg@gmail.com
MAIL_PASSWORD=your-16-character-app-password
MAIL_FROM_ADDRESS="bhumiarohan.engg@gmail.com"
MAIL_FROM_NAME="Bhumi Arohan Website"
```

If email isn't configured or fails, inquiries are still saved in the admin panel.

### Branding

| What | Where |
|---|---|
| Logo & favicon | `public/images/` (`logo-mark*.png`, `logo-full*.png`, `favicon.png`, `apple-touch-icon.png`) |
| Brand colours | `resources/css/app.css`: the `--color-brand-*` (navy) and `--color-accent-*` (gold) values in `@theme` |

## Project structure

```
app/
├── Http/Controllers/        # Public pages + Admin/ controllers
├── Mail/NewInquiryMail.php  # Contact-form email
└── Models/                  # Service, Project, ProjectImage, TeamMember, Inquiry
config/company.php           # Company details
database/seeders/            # Default services, owner and admin user
resources/
├── css/app.css              # Tailwind theme, components and animations
├── js/app.js                # Menu, animations, project filter, lightbox, converter
├── js/admin.js              # Admin panel helpers
└── views/
    ├── components/          # Layouts, header, footer, cards, icons
    ├── pages/               # Home, About, Team, Converter, Contact
    ├── services/ projects/  # Listing and detail pages
    ├── admin/               # Admin panel views
    └── mail/                # Email templates
routes/web.php               # All routes
tests/Feature/               # Feature tests
```

## Testing

```bash
php artisan test
```

## Deploying to Railway

The site deploys from this GitHub repository to [Railway](https://railway.com). Every push to `main` builds and redeploys it automatically. The included `Dockerfile` and `railway.json` handle the build. On each start, `docker/start.sh` runs the migrations, seeds the database only if it's empty, and caches the config.

### 1. Create the service
1. Sign in at [railway.com](https://railway.com) with GitHub.
2. **New Project** → **Deploy from GitHub repo** → choose this repository.
   Railway detects the `Dockerfile` and starts the first build. It's fine if that build fails; finish steps 2–3 first.

### 2. Add a volume (keeps the database and uploaded photos)
In the service, open the **⋮ menu → Attach Volume** (or right-click the service → *Attach Volume*) and set the **mount path** to:
```
/app/storage
```
> Without the volume, every redeploy would wipe the database, the admin login, inquiries and uploaded photos.

### 3. Set the variables
In the service's **Variables** tab → **Raw Editor**, paste and fill in:

```env
APP_NAME="Bhumi Arohan"
APP_KEY=                          # run `php artisan key:generate --show` locally and paste the result
APP_URL=https://your-app.up.railway.app   # your Railway (or custom) domain, with https

ADMIN_EMAIL=admin@bhumiarohan.com
ADMIN_PASSWORD=                   # strong password for the first admin login

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=bhumiarohan.engg@gmail.com
MAIL_PASSWORD=                    # Gmail App Password (see "Email notifications")
MAIL_FROM_ADDRESS=bhumiarohan.engg@gmail.com
MAIL_FROM_NAME="Bhumi Arohan Website"
```

`APP_ENV=production`, `APP_DEBUG=false`, logging and the SQLite path are already set in the `Dockerfile`.

### 4. Get the link
**Settings → Networking → Generate Domain** gives a free `*.up.railway.app` address. Put that address in `APP_URL`; Railway redeploys automatically. To use your own domain (e.g. `bhumiarohan.com.np`), choose **Custom Domain** and add the DNS record Railway shows.

### Notes
- `ADMIN_PASSWORD` is only used to create the **first** admin account. Later redeploys never change the password or overwrite content edited in the admin panel; change the password from the admin panel itself.
- Health check: `/up`. Logs: the service's **Deployments → View logs**.
- To test the production image locally: `docker build -t bhumiarohan .` and then `docker run -p 8080:8080 -e APP_KEY=... -e ADMIN_PASSWORD=... bhumiarohan`.
- Never commit `.env`: it contains the admin and email passwords.

## License

© Bhumi Arohan Engineering & Construction Pvt. Ltd. All rights reserved. This is proprietary software for the company's own use.
