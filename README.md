# Laravel Health Dashboard

A beautiful, responsive Laravel package for creating dynamic health checks and system diagnostics. Simply add backend check methods and they automatically appear in a stunning dashboard UI - no frontend work needed!

## ✨ Features

- 🎨 **Beautiful UI** - Modern, responsive design that works perfectly on all devices
- 🚀 **Zero Configuration** - Works out of the box with sensible defaults
- 📱 **Mobile Optimized** - Fully responsive with mobile-specific card views for data
- ⚡ **Dynamic Checks** - Just add a PHP class and it appears in the dashboard
- 🔍 **Real-time Execution** - Run checks individually or all at once
- ⏱️ **Performance Metrics** - See execution time for each check
- 🎯 **Status Indicators** - Clear visual feedback with color-coded results
- 🔒 **Secure** - Add middleware protection to restrict access
- 📊 **Smart Tables** - Responsive tables that transform to cards on mobile
- 🪶 **Lightweight** - No database tables or background processes required

## 📋 Requirements

- PHP >= 8.0
- Laravel >= 9.0

## 🚀 Installation

Install the package via Composer:

```bash
composer require snawbar/health-dashboard
```

Publish the configuration file:

```bash
php artisan vendor:publish --tag=health-config
```

That's it! Visit `/health` in your browser to see the dashboard.

## 🔧 Configuration

The configuration file will be published to `config/health.php`:

```php
return [
    'checks' => [
        // Your check classes will be registered here
    ],
    'middleware' => ['web'],
    'route' => 'health',
];
```

## 📝 Creating Health Checks

### Quick Start

Create a check class in `app/HealthChecks`:

```php
<?php

namespace App\HealthChecks;

use Snawbar\HealthDashboard\Checks\AbstractCheck;
use Illuminate\Support\Facades\DB;

class DatabaseConnectionCheck extends AbstractCheck
{
    public function name(): string
    {
        return 'Database Connection';
    }
    
    protected function run()
    {
        try {
            DB::connection()->getPdo();
            return []; // Empty array means success
        } catch (\Exception $e) {
            return [
                ['error' => $e->getMessage()]
            ];
        }
    }
}
```

Register the check in `config/health.php`:

```php
'checks' => [
    \App\HealthChecks\DatabaseConnectionCheck::class,
],
```

Visit `/health` to see your check in the dashboard!

## 📚 Example Health Checks

### Store Balance Check

```php
class StoreDifferenceCheck extends AbstractCheck
{
    public function name(): string
    {
        return 'Store Balance Check';
    }
    
    protected function run()
    {
        return DB::table('stores')
            ->leftJoin('inventories', 'inventories.store_id', '=', 'stores.id')
            ->select('stores.name', DB::raw('inventories.total - stores.balance as difference'))
            ->havingRaw('difference <> 0')
            ->get()
            ->toArray();
    }
}
```

### Duplicate Records Check

```php
class DuplicateCheck extends AbstractCheck
{
    public function name(): string
    {
        return 'Duplicate Records';
    }
    
    protected function run()
    {
        return DB::table('users')
            ->select('email', DB::raw('COUNT(*) as count'))
            ->groupBy('email')
            ->having('count', '>', 1)
            ->get()
            ->toArray();
    }
}
```

## 🔒 Security

### Adding Authentication

```php
// config/health.php
'middleware' => ['web', 'auth'],
```

### Role-Based Access

```php
// config/health.php
'middleware' => ['web', 'auth', 'can:admin'],
```

## 🎨 Customization

### Change the Route

```php
// config/health.php
'route' => 'admin/health', // Access at: /admin/health
```

### Return Values

- **Empty array `[]`** - Check passed successfully
- **Array with data** - Issues found (displayed in table/cards)
- **Exception thrown** - Check failed with error

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## 👨‍💻 Author

Created with ❤️ by [Snawbar](https://snawbar.com)