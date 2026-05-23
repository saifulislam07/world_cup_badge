# World Cup Badge Generator

A Laravel app for creating and downloading custom World Cup supporter badges. Users select a country, upload a photo, preview the badge in the browser, and download a PNG. The app also tracks country support counts by IP address.

## Features

- Country-based supporter badge generator
- Browser-side photo preview and PNG download
- Country flag, year, and country name overlay
- Flag & Count ranking card
- IP-based unique counting:
  - Same IP + same country + same year counts only once
  - Same IP + different country creates a new count
- Admin panel for countries, years, settings, and records

## Requirements

- PHP 8.2+
- Composer
- Node.js and npm
- MySQL or compatible database

## Setup

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

Update `.env` with your database and admin password:

```env
DB_DATABASE=worldcup_badge
DB_USERNAME=root
DB_PASSWORD=
ADMIN_PASSWORD=your-admin-password
```

Run migrations and seed data:

```bash
php artisan migrate --seed
```

Clear cached views after Blade changes:

```bash
php artisan view:clear
```

## Run Locally

Using Laravel's dev server:

```bash
php artisan serve
```

If Vite assets are needed:

```bash
npm run dev
```

With Laragon, point the site to this project directory and open the local virtual host.

## Main Routes

- `/` - Badge generator
- `/country-ranking` - Full country ranking
- `/admin/login` - Admin login
- `/admin/dashboard` - Admin dashboard
- `/admin/countries` - Manage countries
- `/admin/years` - Manage World Cup years
- `/admin/settings` - Manage site settings
- `/admin/placard-records` - View download records

## Counting Logic

Download records are stored in `placard_records`.

The unique key is:

```text
ip_address + country_id + world_cup_year_id
```

That means one visitor can count once for Argentina, once for Brazil, once for France, and so on. Re-downloading the same country from the same IP does not increase the ranking.

## Useful Commands

Run syntax checks:

```bash
php -l resources/views/home.blade.php
php -l app/Http/Controllers/PlacardController.php
```

Check migration status:

```bash
php artisan migrate:status
```

Build frontend assets:

```bash
npm run build
```

## Notes

- Uploaded photos are handled in the browser for badge generation.
- PNG export uses `html2canvas` from CDN.
- Country flags are saved as URLs in the countries table.
