<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', '*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'https://your-vercel-app.vercel.app',  // Your Vercel frontend URL
        'http://localhost:3000',                // Local React/Vue dev
        'http://localhost:5173',                // Local Vite dev
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];
