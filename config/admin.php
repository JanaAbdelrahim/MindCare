<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Credentials
    |--------------------------------------------------------------------------
    | These are loaded from the .env file. Never hardcode credentials here.
    | Add ADMIN_EMAIL and ADMIN_PASSWORD to your .env file.
    |
    | ADMIN_PASSWORD must be stored as a bcrypt hash in .env.
    | Generate one with: php artisan tinker => bcrypt('your-password')
    */

    'email'    => env('ADMIN_EMAIL', 'admin@mindcare.com'),
    'password' => env('ADMIN_PASSWORD'),

];
