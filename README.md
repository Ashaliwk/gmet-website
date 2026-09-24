# Hostily — Admin Panel (extracted)

This is the **backend/admin panel** extracted from
[Ashaliwk/Laravel-hostily](https://github.com/Ashaliwk/Laravel-hostily) as a
standalone, runnable Laravel 11 project. The public-facing hotel website
(the `frontend` controllers/models/views, and its `blog`, `contact`,
`account`, `login` tables) has been removed.

## What's included

- `app/Http/Controllers/backend/*` — all admin controllers (login, dashboard,
  admins, team, reviews, FAQs, shops, bookings, rooms, projects, cart)
- `app/Models/backend/*` — the models those controllers use, plus
  `App\Models\frontend\Booking` (the one frontend model the booking-management
  screen reads from) and the default `App\Models\User` (kept only because
  Laravel's `auth` config references it — admin login actually uses the
  `Admins` model/table, not this one)
- `app/Http/Middleware/CheckRole.php`
- `resources/views/backend/*` — every admin Blade view and layout
- `routes/web.php` — rewritten to contain **only** the `/admin/*` and
  `/cart` routes (renamed/trimmed from the original mixed `web.php`); `/`
  now redirects straight to `/admin/login`
- `public/backend/*` — the full admin theme (CSS/JS/vendor/images)
- `public/uploads/team/*` — the only upload folder the admin views actually
  read from (`asset('uploads/team/...')` in `team.blade.php`)
- `database/migrations/*` — only the tables the admin models touch
  (`admins`, `faqs`, `projects`, `reviews`, `teams`, `rooms`, `cart`,
  `product`, `shops`, `bookings`, plus Laravel's own `sessions` and
  `password_resets`)
- The rest of the standard Laravel skeleton (`bootstrap/`, `config/`,
  `storage/`, `artisan`, `composer.json`, etc.) needed to actually boot
  the app

## What's deliberately left out

- Everything under the original `frontend` namespace (controllers, models,
  views, routes) and its migrations (`blog`, `contacts`, `email`,
  `account`, `login` tables)
- `public/assets` (the frontend theme) and `public/uploads/fitems`, except
  for one favicon the admin layout happens to reference
- `tests/`, `database/factories/` (aside from what the admin side needs) —
  none of it targets the admin panel specifically

## One pre-existing thing worth knowing

The original repo has an `App\Models\User` class and a `UserFactory`, but
**no migration that creates a `users` table** — that gap exists in the
source project itself, not something this extraction introduced. Since
admin auth runs entirely through the `Admins` model/table, `DatabaseSeeder`
here has been simplified to not seed a `User`, so `php artisan migrate` and
`db:seed` run cleanly out of the box.

## Getting it running

```bash
composer install
cp .env.example .env
php artisan key:generate
# point .env at a database, then:
php artisan migrate
php artisan storage:link   # AdminroomsController expects storage/qrcodes to exist
```

Create your first admin the same way the original app does — via
`POST /admin/register` (there's a form at `/admin/register`), since
there's no seeded admin account. Then log in at `/admin/login`.

```bash
php artisan serve
```

Visit `http://localhost:8000/admin/login`.
