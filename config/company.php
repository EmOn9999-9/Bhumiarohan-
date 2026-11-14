<?php

/*
| Company details shown across the website.
| Replace the placeholder values below with real details.
*/

return [
    'name' => 'Bhumi Arohan',
    'owner' => 'Er. Rohan Sharma Paudel',

    /*
     * Number of projects shown as a headline on the Projects page (e.g. "20+").
     */
    'projects_count' => env('COMPANY_PROJECTS_COUNT', '20+'),

    /*
    | Founder profile used to create the founder's team entry. After that, edit it
    | in the admin panel (Team → Er. Rohan Sharma Paudel).
    */
    'founder' => [
        'role' => 'Founder & Managing Director',
        'qualification' => 'Civil Engineer',
        'bio' => "Er. Rohan Sharma Paudel is a civil engineer and the founder and Managing Director of Bhumi Arohan Engineering & Construction Pvt. Ltd. He leads the company's engineering and construction work, from site survey and structural design to supervision on site and final handover.\n\n"
            ."Based in Chitwan, Rohan started Bhumi Arohan with a clear goal: to give families, businesses and communities in Nepal a construction partner they can trust. He believes every structure, from a family home to public infrastructure, should be safe, earthquake-resistant, built to the National Building Code and delivered with complete transparency in cost and time.\n\n"
            .'Under his leadership, Bhumi Arohan brings design and consulting, survey and lab testing, construction, renovation, interiors, real estate and engineering resources supply under one roof, so every client works with one accountable team from the first drawing to the final key.',
        'quote' => 'Our promise is simple: build every structure as if our own family will live in it. With honest engineering, transparent costs and respect for every rupee our clients invest, we build spaces, create value and elevate lives.',
    ],
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
