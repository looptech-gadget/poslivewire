# Laravel Dashboard

A simple Laravel dashboard with user, role, and permission management.

## Features

- User Management
- Role Management
- Permission Management
- Dashboard with statistics
- Bootstrap UI

## Requirements

- PHP 8.2+
- Composer
- SQLite or MySQL

## Installation

1. Clone the repository:

```bash
git clone https://github.com/yourusername/laravel-dashboard.git
cd laravel-dashboard
```

2. Install dependencies:

```bash
composer install
```

3. Copy the environment file:

```bash
cp .env.example .env
```

4. Generate application key:

```bash
php artisan key:generate
```

5. Configure your database in the `.env` file:

```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

6. Run migrations and seeders:

```bash
php artisan migrate --seed
```

7. Start the development server:

```bash
php artisan serve
```

## Default Users

After running the seeders, the following users will be available:

- Admin User:
  - Email: admin@example.com
  - Password: password
  - Role: admin

- Editor User:
  - Email: editor@example.com
  - Password: password
  - Role: editor

- Regular User:
  - Email: user@example.com
  - Password: password
  - Role: user

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
