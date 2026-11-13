<?php

/*
| Company details shown across the website.
| Replace the placeholder values below with real details.
*/

return [
    'name' => 'Bhumi Arohan',
    'owner' => 'Rohan Sharma Poudel',
    'legal_name' => 'Bhumi Arohan Engineering and Construction Pvt. Ltd.',
    'tagline' => 'Building Spaces • Creating Value • Elevating Lives',
    'description' => 'A Nepal-based engineering firm delivering construction, design, survey and infrastructure solutions with integrity and precision.',

    // Set to false once the company registration is complete.
    'registration_pending' => env('COMPANY_REGISTRATION_PENDING', true),
    'registration_no' => env('COMPANY_REGISTRATION_NO'),

    'phone' => env('COMPANY_PHONE', '+977 9866567419'),
    'phone_alt' => env('COMPANY_PHONE_ALT', '+977 9804286049'),
    'email' => env('COMPANY_EMAIL', 'bhumiarohan.engg@gmail.com'),
    'address' => env('COMPANY_ADDRESS', 'Chitwan, Nepal'),
    'hours' => 'Sun – Fri, 10:00 AM – 6:00 PM',

    // Google Maps embed URL (Share → Embed a map → copy the src value).
    'map_embed' => env('COMPANY_MAP_EMBED', 'https://www.google.com/maps?q=Chitwan,Nepal&output=embed'),

    'social' => [
        // Empty links are hidden in the footer. Add the Facebook page URL when it is ready.
        'facebook' => env('COMPANY_FACEBOOK', ''),
        'instagram' => env('COMPANY_INSTAGRAM', 'https://www.instagram.com/bhumiarohan.engg/'),
        'whatsapp' => env('COMPANY_WHATSAPP', ''),
    ],

    // First admin account, created by the database seeder on an empty database.
    'admin' => [
        'email' => env('ADMIN_EMAIL', 'admin@bhumiarohan.com'),
        'password' => env('ADMIN_PASSWORD'),
    ],

    // Email address that receives contact-form messages (defaults to the company email).
    'inquiry_notify' => env('COMPANY_INQUIRY_NOTIFY', 'bhumiarohan.engg@gmail.com'),
];
