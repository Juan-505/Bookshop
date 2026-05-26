<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Shop metadata
    |--------------------------------------------------------------------------
    | Set `SHOP_NAME` and `SHOP_TAGLINE` in your `.env` to override defaults.
    */
    'name' => env('SHOP_NAME', env('APP_NAME', 'NewChapter')),
    'tagline' => env('SHOP_TAGLINE', 'Fresh reads for every chapter of life'),
];
