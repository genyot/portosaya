<?php

// Ensure /tmp directories exist for Vercel
if (getenv('VERCEL')) {
    @mkdir('/tmp/laravel', 0755, true);
    @mkdir('/tmp/laravel/app/private', 0755, true);
    @mkdir('/tmp/laravel/app/public', 0755, true);
    @mkdir('/tmp/laravel/cache', 0755, true);
}

// Call the main index
require __DIR__ . '/index.php';
