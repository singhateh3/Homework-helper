<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'register', 'logout', '*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'https://homework-helper-frontend-cflg5ai39-singhateh3s-projects.vercel.app',
        'https://*.vercel.app',  // Allow all Vercel preview deployments
        'http://localhost:3000',
        'http://localhost:5173',
        'http://localhost:8000',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];
