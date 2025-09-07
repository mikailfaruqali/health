<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Health Check Classes
    |--------------------------------------------------------------------------
    |
    | Register all your health check classes here. Each class must implement
    | the Health\Contracts\HealthCheck interface or extend the
    | AbstractCheck class.
    |
    | These checks will automatically appear in the dashboard UI and can be
    | executed individually or all at once.
    |
    | Example:
    |   \App\HealthChecks\DatabaseConnectionCheck::class,
    |   \App\HealthChecks\StoreDifferenceCheck::class,
    |   \App\HealthChecks\DuplicateJournalCheck::class,
    |
    */

    'checks' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Middleware Configuration
    |--------------------------------------------------------------------------
    |
    | These middleware will be applied to all health dashboard routes.
    | By default, the "web" middleware group is applied for session,
    | CSRF protection, and other standard web middleware.
    |
    | You may add authentication or custom middleware here to protect
    | the health dashboard from unauthorized access.
    |
    | Examples:
    |   ['web', 'auth']                    - Require authentication
    |   ['web', 'auth', 'can:admin']       - Require admin permission
    |   ['web', 'throttle:10,1']           - Rate limiting
    |
    */

    'middleware' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Route Configuration
    |--------------------------------------------------------------------------
    |
    | This prefix will be used for all health dashboard routes. For example,
    | if set to 'health', the dashboard would be available at:
    |
    |   /health
    |
    | Customize the prefix to fit your routing structure:
    |   'health'              => /health
    |   'admin/health'        => /admin/health
    |   'system/diagnostics'  => /system/diagnostics
    |
    */

    'route' => 'health',
];
