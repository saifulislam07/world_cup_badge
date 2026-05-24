# World Cup 2026 Badge Maker

A Laravel application for World Cup 2026 fans. Visitors can create a country supporter badge, download it as a PNG, view country rankings, and browse the full World Cup 2026 fixture schedule in Bangladesh time. The admin panel includes content management, download records, and day-wise visitor logs.

## Features

- Supporter badge generator with country flag, year, and country name overlay
- Browser-side image upload, drag positioning, zoom, preview, and PNG export
- Country ranking based on badge downloads
- IP-based unique download counting per country and World Cup year
- World Cup 2026 fixture schedule page in Bangladesh Standard Time
- Fixture search, country filter, stage filter, and date sorting
- Downloadable fixture schedule PNG
- Admin panel for countries, years, settings, download records, and visitor logs
- Day-wise visitor analytics with IP, path, route, referer, user agent, and time details

## Requirements

- PHP 8.2+
- Composer
- Node.js and npm
- MySQL or a compatible database

## Installation

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
copy .env.example .env
```

Generate the app key:

```bash
php artisan key:generate
```

Update `.env` with your database credentials and admin password:

```env
DB_DATABASE=worldcup_badge
DB_USERNAME=root
DB_PASSWORD=
ADMIN_PASSWORD=your-admin-password
```

Run migrations and seeders:

```bash
php artisan migrate --seed
```

This seeds countries, site settings, World Cup years, and the full World Cup 2026 match schedule.

## Running Locally

Start the Laravel dev server:

```bash
php artisan serve
```

If you need Vite assets:

```bash
npm run dev
```

With Laragon, point the virtual host to this project directory and open it from the local domain.

## Main Routes

- `/` - Badge generator
- `/today-match` - Today match and full World Cup 2026 fixture schedule
- `/country-ranking` - Country ranking
- `/admin/login` - Admin login
- `/admin/dashboard` - Admin dashboard
- `/admin/countries` - Manage countries
- `/admin/years` - Manage World Cup years
- `/admin/settings` - Manage site settings
- `/admin/placard-records` - Download records
- `/admin/visitor-logs` - Day-wise visitor logs and details

## Admin Login

The admin password is controlled by:

```env
ADMIN_PASSWORD=your-admin-password
```

The default value in `.env.example` is `admin123`. Change it before production use.

## Badge Counting Logic

Badge downloads are stored in `placard_records`.

The app counts one download per:

```text
ip_address + country_id + world_cup_year_id
```

That means the same visitor can count once for each country and World Cup year. Re-downloading the same country from the same IP does not increase the ranking again.

## Visitor Logs

Visitor logs are stored in `visitor_logs`.

The app logs public GET visits for:

- `/`
- `/today-match`
- `/country-ranking`

Admin routes are excluded from visitor tracking.

The admin visitor log page shows:

- Day-wise total visits
- Day-wise unique IP count
- Top visited pages for a selected date
- Detailed logs with time, IP, path, route name, referer, and user agent

## Fixture Schedule

World Cup 2026 fixture data is stored in `world_cup_matches` and seeded by:

```text
database/seeders/WorldCupMatchSeeder.php
```

The schedule page converts kickoff times to Bangladesh Standard Time before display.

## Useful Commands

Run tests:

```bash
php artisan test
```

Check migration status:

```bash
php artisan migrate:status
```

Run migrations and seed data:

```bash
php artisan migrate --seed
```

Clear cached views:

```bash
php artisan view:clear
```

Build frontend assets:

```bash
npm run build
```

## Notes

- Uploaded photos are handled in the browser for badge generation.
- PNG export uses `html2canvas` from a CDN.
- Country flags are stored as URLs in the countries table.
- Fixture and badge pages are designed to be mobile responsive.
