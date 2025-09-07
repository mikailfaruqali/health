<?php

use Illuminate\Support\Facades\Route;
use Snawbar\Health\Http\Controllers\HealthController;

Route::get(config()->string('snawbar-health.route', 'health'), HealthController::class)
    ->middleware(config()->array('snawbar-health.middleware', ['web']));
