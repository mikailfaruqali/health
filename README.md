# 🩺 Laravel Health Dashboard

> A beautiful, responsive Laravel package for creating dynamic health checks and system diagnostics with a stunning UI. Run custom database queries, monitor system health, and troubleshoot issues through an elegant dashboard interface.

[![Latest Stable Version](https://img.shields.io/packagist/v/mikailfaruqali/health.svg)](https://packagist.org/packages/mikailfaruqali/health)
[![Total Downloads](https://img.shields.io/packagist/dt/mikailfaruqali/health.svg)](https://packagist.org/packages/mikailfaruqali/health)
[![License](https://img.shields.io/packagist/l/mikailfaruqali/health.svg)](https://packagist.org/packages/mikailfaruqali/health)
[![PHP Version](https://img.shields.io/packagist/php-v/mikailfaruqali/health.svg)](https://packagist.org/packages/mikailfaruqali/health)

## ✨ Features

### 🎨 **Beautiful & Modern UI**
- Sleek, responsive design built with Tailwind CSS
- Mobile-first approach with adaptive layouts
- Dark mode friendly with smooth animations
- Professional dashboard that fits any Laravel application

### 🚀 **Zero Configuration Setup**
- Works out of the box with sensible defaults
- Auto-discovery of health check classes
- No database migrations or complex setup required
- Simply install and start adding checks

### 📱 **Mobile-First Responsive Design**
- Fully responsive across all device sizes
- Tables automatically transform to cards on mobile
- Touch-friendly interface with optimized interactions
- Perfect viewing experience on phones, tablets, and desktops

### ⚡ **Dynamic Health Checks**
- Just create a PHP class and it automatically appears
- Run checks individually or execute all at once
- Real-time execution with live status updates
- Smart data presentation with automatic table generation

### 🔍 **Advanced Monitoring**
- Performance metrics with execution time tracking
- Color-coded status indicators (Success, Warning, Error)
- Detailed error reporting with exception handling
- Data count and issue tracking

### 🔒 **Security & Access Control**
- Configurable middleware protection
- Support for authentication and authorization
- Rate limiting and custom middleware support
- Secure by default with web middleware

### 📊 **Smart Data Visualization**
- Automatic table generation from array data
- Responsive tables that adapt to screen size
- Mobile card views for complex data
- Syntax highlighting for differences and issues

### 🎯 **Developer Experience**
- Abstract base class for quick implementation
- Interface-based architecture for flexibility
- Comprehensive error handling and recovery
- Clean, intuitive API design

## 📋 Requirements

- **PHP** >= 7.4
- **Laravel** >= 5.0 (supports Laravel 5.x through 11.x)
- **illuminate/contracts** >= 5.0

## 🚀 Quick Start

### 1. Installation

Install the package via Composer:

```bash
composer require mikailfaruqali/health
```

### 2. Publish Configuration (Optional)

```bash
php artisan vendor:publish --tag=health-config
```

### 3. Access Dashboard

Visit `/health` in your browser to see the dashboard!

## 🔧 Configuration

The configuration file is published to `config/snawbar-health.php`:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Health Check Classes
    |--------------------------------------------------------------------------
    |
    | Register all your health check classes here. Each class must implement
    | the HealthCheck interface or extend the AbstractCheck class.
    |
    */
    'checks' => [
        \App\HealthChecks\DatabaseConnectionCheck::class,
        \App\HealthChecks\StoreDifferenceCheck::class,
        \App\HealthChecks\DuplicateJournalCheck::class,
        // Add your custom health checks here
    ],

    /*
    |--------------------------------------------------------------------------
    | Middleware Configuration
    |--------------------------------------------------------------------------
    |
    | Applied to all health dashboard routes for security and access control.
    |
    */
    'middleware' => ['web'], // Add 'auth' or custom middleware

    /*
    |--------------------------------------------------------------------------
    | Route Configuration
    |--------------------------------------------------------------------------
    |
    | Customize the URL prefix for the health dashboard.
    |
    */
    'route' => 'health', // Accessible at /health
];
```

## 📝 Creating Health Checks

### Method 1: Extend AbstractCheck (Recommended)

Create a check class by extending the `AbstractCheck` base class:

```php
<?php

namespace App\HealthChecks;

use Snawbar\Health\Checks\AbstractCheck;
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
            return []; // Empty array = success ✅
        } catch (\Exception $e) {
            throw $e; // Will be caught and shown as error ❌
        }
    }
}
```

### Method 2: Implement HealthCheck Interface

For full control, implement the interface directly:

```php
<?php

namespace App\HealthChecks;

use Snawbar\Health\Contracts\HealthCheck;

class CustomCheck implements HealthCheck
{
    public function name(): string
    {
        return 'Custom System Check';
    }
    
    public function check(): array
    {
        $startTime = microtime(true);
        
        try {
            $issues = $this->performChecks();
            
            return [
                'name' => $this->name(),
                'status' => empty($issues) ? 'success' : 'warning',
                'message' => empty($issues) ? 'All checks passed' : count($issues) . ' issues found',
                'data' => $issues,
                'count' => count($issues),
                'execution_time' => round((microtime(true) - $startTime) * 1000, 2),
            ];
        } catch (\Exception $e) {
            return [
                'name' => $this->name(),
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => [],
                'count' => 0,
                'execution_time' => round((microtime(true) - $startTime) * 1000, 2),
            ];
        }
    }
    
    private function performChecks(): array
    {
        // Your custom logic here
        return [];
    }
}
```

### Register Your Checks

Add your checks to the configuration file:

```php
// config/snawbar-health.php
'checks' => [
    \App\HealthChecks\DatabaseConnectionCheck::class,
    \App\HealthChecks\CustomCheck::class,
    // Add more checks here...
],
```

## 📚 Real-World Examples

### 1. Database Connection Check

```php
class DatabaseConnectionCheck extends AbstractCheck
{
    public function name(): string
    {
        return 'Database Connection';
    }
    
    protected function run()
    {
        DB::connection()->getPdo();
        return []; // Success if no exception
    }
}
```

### 2. Store Balance Verification

```php
class StoreDifferenceCheck extends AbstractCheck
{
    public function name(): string
    {
        return 'Store Balance Differences';
    }
    
    protected function run()
    {
        return DB::select("
            SELECT 
                store_id,
                store_name,
                calculated_balance,
                actual_balance,
                (calculated_balance - actual_balance) as difference
            FROM store_balances 
            WHERE calculated_balance != actual_balance
        ");
    }
}
```

### 3. Duplicate Records Check

```php
class DuplicateJournalCheck extends AbstractCheck
{
    public function name(): string
    {
        return 'Duplicate Journal Entries';
    }
    
    protected function run()
    {
        return DB::select("
            SELECT 
                reference_number,
                COUNT(*) as duplicate_count,
                GROUP_CONCAT(id) as entry_ids
            FROM journal_entries
            GROUP BY reference_number
            HAVING COUNT(*) > 1
        ");
    }
}
```

### 4. File Permission Check

```php
class FilePermissionCheck extends AbstractCheck
{
    public function name(): string
    {
        return 'File Permissions';
    }
    
    protected function run()
    {
        $issues = [];
        $directories = ['storage', 'bootstrap/cache'];
        
        foreach ($directories as $dir) {
            $path = base_path($dir);
            if (!is_writable($path)) {
                $issues[] = [
                    'directory' => $dir,
                    'path' => $path,
                    'permission' => substr(sprintf('%o', fileperms($path)), -4),
                    'required' => '0755'
                ];
            }
        }
        
        return $issues;
    }
}
```

### 5. Queue Status Check

```php
class QueueStatusCheck extends AbstractCheck
{
    public function name(): string
    {
        return 'Failed Queue Jobs';
    }
    
    protected function run()
    {
        return DB::table('failed_jobs')
            ->select(['id', 'queue', 'failed_at', 'exception'])
            ->latest('failed_at')
            ->limit(10)
            ->get()
            ->toArray();
    }
}
```

## 🎨 Dashboard Features

### Status Indicators
- **🟢 Success**: Empty data array or no issues found
- **🟡 Warning**: Issues found but not critical errors
- **🔴 Error**: Exceptions thrown during execution

### Responsive Design
- **Desktop**: Full table view with sortable columns
- **Mobile**: Card-based layout for easy reading
- **Tablet**: Optimized hybrid view

### Performance Monitoring
- Execution time tracking in milliseconds
- Memory usage optimization
- Concurrent check execution support

### Data Visualization
- Automatic table generation from array data
- Smart column formatting and highlighting
- Mobile-responsive data cards
- Pagination for large datasets

## 🔧 Advanced Configuration

### Custom Route Prefix

```php
// config/snawbar-health.php
'route' => 'admin/diagnostics', // Access at /admin/diagnostics
```

### Security Middleware

```php
'middleware' => ['web', 'auth', 'can:admin'], // Require admin permission
```

### Multiple Middleware Groups

```php
'middleware' => [
    'web',
    'auth:admin',
    'throttle:10,1' // Rate limiting
],
```

## 🖥️ Command Line Usage

Run health checks from the command line:

```bash
# Run all registered health checks
php artisan app:health
```

Example output:
```
Database Connection PASSED in 12.34 ms
Store Balance Differences FAILED in 45.67 ms
Duplicate Journal Entries PASSED in 23.45 ms
File Permissions ERROR

Health Check Summary: 2 passed, 1 failed, 1 errors.
```

## 🎯 Best Practices

### 1. Keep Checks Fast
```php
// ✅ Good - Targeted query
protected function run()
{
    return DB::select("SELECT * FROM users WHERE status = 'invalid' LIMIT 100");
}

// ❌ Avoid - Expensive operation
protected function run()
{
    return DB::table('users')->get(); // Could return millions of records
}
```

### 2. Handle Exceptions Gracefully
```php
protected function run()
{
    try {
        return $this->performExpensiveCheck();
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('Health check failed: ' . $e->getMessage());
        
        // Re-throw to trigger error status
        throw $e;
    }
}
```

### 3. Provide Meaningful Names
```php
// ✅ Good - Descriptive
public function name(): string
{
    return 'Database Connection Validation';
}

// ❌ Avoid - Vague
public function name(): string
{
    return 'Check';
}
```

### 4. Return Structured Data
```php
protected function run()
{
    return [
        [
            'table' => 'users',
            'issue' => 'Missing email',
            'count' => 5,
            'severity' => 'high'
        ],
        [
            'table' => 'orders',
            'issue' => 'Invalid status',
            'count' => 2,
            'severity' => 'medium'
        ]
    ];
}
```

## 🔧 Customization

### Custom Status Logic

Override status evaluation in AbstractCheck:

```php
class CustomStatusCheck extends AbstractCheck
{
    protected function evaluateStatus(): void
    {
        $criticalCount = collect($this->data)->where('severity', 'critical')->count();
        
        if ($criticalCount > 0) {
            $this->status = 'error';
        } elseif ($this->getDataCount() > 10) {
            $this->status = 'warning';
        } else {
            $this->status = 'success';
        }
    }
}
```

### Custom Messages

```php
protected function getMessage(): string
{
    if ($this->isDataEmpty()) {
        return 'All systems operational! 🚀';
    }
    
    $count = $this->getDataCount();
    return "Found {$count} issue(s) requiring attention 📋";
}
```

## � Performance Tips

### 1. Use Database Indexes
Ensure your health check queries use proper indexes:

```sql
-- For store difference check
CREATE INDEX idx_store_balances_diff ON store_balances(calculated_balance, actual_balance);

-- For duplicate journal entries
CREATE INDEX idx_journal_reference ON journal_entries(reference_number);
```

### 2. Limit Result Sets
```php
protected function run()
{
    return DB::select("
        SELECT * FROM problematic_table 
        WHERE condition = 'bad'
        LIMIT 100 -- Prevent memory issues
    ");
}
```

### 3. Use Query Builder for Complex Queries
```php
protected function run()
{
    return DB::table('orders')
        ->select(['id', 'status', 'created_at'])
        ->where('status', 'invalid')
        ->where('created_at', '>', now()->subDays(7))
        ->limit(50)
        ->get()
        ->toArray();
}
```

## 🛠️ Troubleshooting

### Common Issues

**1. "Class not found" error**
```bash
# Make sure to run composer autoload
composer dump-autoload
```

**2. "Route not found" error**
```php
// Check your config file is published
php artisan vendor:publish --tag=health-config

// Clear config cache
php artisan config:clear
```

**3. Middleware blocking access**
```php
// Temporarily remove auth middleware for testing
'middleware' => ['web'], // Remove 'auth' temporarily
```

**4. Memory issues with large datasets**
```php
// Use chunking for large datasets
protected function run()
{
    $issues = [];
    DB::table('large_table')
        ->where('status', 'problematic')
        ->chunk(1000, function ($records) use (&$issues) {
            foreach ($records as $record) {
                if ($this->hasIssue($record)) {
                    $issues[] = $record;
                }
            }
        });
    
    return array_slice($issues, 0, 100); // Limit results
}
```

## 📖 API Reference

### AbstractCheck Methods

```php
abstract public function name(): string;           // Display name for the check
abstract protected function run();                 // Your check logic
protected function evaluateStatus(): void;         // Custom status logic
protected function getMessage(): string;           // Custom success/failure messages
protected function handleException(Throwable $e);  // Custom exception handling
```

### HealthCheck Interface

```php
public function name(): string;    // Display name
public function check(): array;    // Execute check and return result
```

### Result Array Structure

```php
[
    'name' => 'Check Name',
    'status' => 'success|warning|error',
    'message' => 'Human readable message',
    'data' => [], // Array of issues or empty for success
    'count' => 0, // Number of issues found
    'execution_time' => 123.45 // Milliseconds
]
```

## 🤝 Contributing

We welcome contributions! Please feel free to submit a Pull Request. For major changes, please open an issue first to discuss what you would like to change.

### Development Setup

```bash
git clone https://github.com/mikailfaruqali/health.git
cd health
composer install
```

### Running Tests

```bash
./vendor/bin/phpunit
```

### Code Style

```bash
./vendor/bin/pint
```

## 📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

## 🙏 Credits

- **[Snawbar](https://snawbar.com)** - Original development
- **[Mikail Faruqali](https://github.com/mikailfaruqali)** - Package maintainer
- Built with ❤️ using [Laravel](https://laravel.com) and [Tailwind CSS](https://tailwindcss.com)

## 📞 Support

- 🐛 **Bug Reports**: [GitHub Issues](https://github.com/mikailfaruqali/health/issues)
- 💡 **Feature Requests**: [GitHub Discussions](https://github.com/mikailfaruqali/health/discussions)
- 📧 **Email**: alanfaruq85@gmail.com
- 🌐 **Website**: [snawbar.com](https://snawbar.com)

---

<div align="center">

**[⭐ Star this repo](https://github.com/mikailfaruqali/health)** if you find it helpful!

Made with ❤️ by [Snawbar](https://snawbar.com)

</div>
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