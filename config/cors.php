<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'register', 'logout', '*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'https://homework-helper-frontend-cflg5ai39-singhateh3s-projects.vercel.app',
        'https://*.vercel.app',
        'http://localhost:3000',
        'http://localhost:5173',
        'http://127.0.0.1:5173',  // Add this for local development
        'http://localhost:8000',
        'http://127.0.0.1:8000',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => [
        'Content-Type',
        'Authorization',
        'X-Requested-With',
        'Accept',
        'Origin',
        'X-CSRF-TOKEN',
    ],

    'exposed_headers' => [
        'Authorization',
    ],

    'max_age' => 86400,  // Cache preflight requests for 24 hours

    'supports_credentials' => true,  // CHANGE THIS TO true
];
