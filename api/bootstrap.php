<?php

// Vercel environment detection
if (!function_exists('is_vercel')) {
    function is_vercel(): bool {
        return !empty(getenv('VERCEL'));
    }
}

// Setup writable paths
if (is_vercel()) {
    @mkdir('/tmp/laravel', 0755, true);
    @mkdir('/tmp/laravel/app/private', 0755, true);
    @mkdir('/tmp/laravel/app/public', 0755, true);
    @mkdir('/tmp/laravel/cache', 0755, true);
    @mkdir('/tmp/laravel/framework', 0755, true);
    
    putenv('LARAVEL_STORAGE_PATH=/tmp/laravel');
}

// Load Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Load Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Handle request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();
$kernel->terminate($request, $response);
