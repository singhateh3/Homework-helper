<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'register', 'logout', '*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'https://homework-helper-frontend-cflg5ai39-singhateh3s-projects.vercel.app',
        'https://*.vercel.app',
        'http://localhost:3000',
        'http://localhost:5173',
        'http://127.0.0.1:5173',
        'http://localhost:8000',
        'http://127.0.0.1:8000',
        'http://localhost:5174', // Add this if your Vite uses a different port
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

    'max_age' => 86400,

    'supports_credentials' => true, // CHANGE THIS TO true (you already did this 👍)
];
