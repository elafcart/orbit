<?php

return [
    'name' => 'Portfólió',
    'settings' => [
        'success_message' => 'A beállítások sikeresen mentve!',
        'email' => [
            'title' => 'Árajánlat kérések',
            'description' => 'E-mail sablonok árajánlat kérésekhez',
            'templates' => [
                'notice_title' => 'Értesítés küldése az adminisztrátornak',
                'notice_description' => 'Értesítés küldése az adminisztrátornak, amikor árajánlat kérés érkezik',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Szolgáltatási kategóriák',
        'create' => 'Szolgáltatási kategória létrehozása',
    ],
    'service' => [
        'name' => 'Szolgáltatások',
        'create' => 'Szolgáltatás létrehozása',
    ],
    'package' => [
        'name' => 'Csomagok',
        'create' => 'Csomag létrehozása',
    ],
    'project' => [
        'name' => 'Projektek',
        'create' => 'Projekt létrehozása',
        'author' => 'Szerző',
        'client' => 'Ügyfél',
        'place' => 'Hely',
        'start_date' => 'Kezdő dátum',
        'metrics' => [
            'title' => 'Projekt mutatók (esettanulmány kártyák)',
            'helper' => 'Legfeljebb három mutatóérték/-címke pár jelenik meg az esettanulmány kártyák elrendezésein. Hagyjon üresen egy párt az elrejtéshez.',
            'value_n' => ':n mutató értéke',
            'label_n' => ':n mutató címkéje',
            'label_placeholder' => 'pl. Tervezési hatékonyság',
        ],
    ],
    'quotation_request' => [
        'name' => 'Árajánlat kérések',
        'viewing' => 'Árajánlat kérés megtekintése #:name',
        'information' => 'Információ',
    ],
    'custom_field' => [
        'name' => 'Egyedi mezők',
        'create' => 'Létrehozás',
        'type' => 'Típus',
        'options' => 'Lehetőségek',
        'placeholder' => 'Helyőrző',
        'placeholder_placeholder' => 'Adja meg a helyőrzőt',
        'required' => 'Kötelező',
        'option' => [
            'label' => 'Címke',
            'value' => 'Érték',
            'add_row' => 'Új sor hozzáadása',
            'add_from_global' => 'Globális egyedi mező hozzáadása',
        ],
        'modal' => [
            'heading' => 'Új egyedi mező hozzáadása',
            'select_field' => 'Mező kiválasztása',
            'button' => 'Új hozzáadása',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Szöveg',
                'number' => 'Szám',
                'dropdown' => 'Legördülő',
                'checkbox' => 'Jelölőnégyzet',
                'textarea' => 'Szövegterület',
            ],
        ],
        'ask_for_select' => 'Kérjük, válasszon egy egyedi mezőt',
        'add_a_new_custom_field' => 'Új egyedi mező hozzáadása',
    ],
    'image' => 'Kép',
    'category' => 'Kategória',
    'duration' => 'Időtartam',
    'price' => 'Ár',
    'annual_price' => 'Éves ár',
    'form' => [
        'none' => 'Nincs',
        'images' => 'Képek',
        'name_placeholder' => 'Adja meg a nevet',
        'is_featured' => 'Kiemelt?',
        'price_placeholder' => 'Adja meg az árat',
        'features' => 'Jellemzők',
        'features_help_block' => 'Új sorral válassza el (+ benne van, - nincs benne)',
        'features_placeholder' => 'Példa:
+ 15 napos szállítás világszerte
+ Ingyenes buborékfólia
- 24/7 Támogatás
        ',
        'description_placeholder' => 'Adja meg a leírást',
        'packages_switch_pricing_plan' => 'Adja meg az éves árat az árképzési terv váltás funkciójához',
        'action_url' => 'Művelet URL',
        'action_label' => 'Művelet címke',
    ],
    'is_popular' => 'Népszerű?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Óránként',
            'daily' => 'Naponta',
            'weekly' => 'Hetente',
            'monthly' => 'Havonta',
            'annually' => 'Évente',
            'quarterly' => 'Negyedévente',
            'one_time' => 'Egyszeri',
        ],
        'quote_statuses' => [
            'read' => 'Olvasott',
            'unread' => 'Olvasatlan',
        ],
    ],
    'edit_this_service' => 'Szolgáltatás szerkesztése',
    'edit_this_service_category' => 'Szolgáltatási kategória szerkesztése',
    'edit_this_project' => 'Projekt szerkesztése',
    'edit_this_project_category' => 'Projekt kategória szerkesztése',
    'edit_this_package' => 'Csomag szerkesztése',
    'message' => 'Üzenet',
    'time' => 'Idő',
    'service_categories' => 'Szolgáltatási kategóriák',
    'services' => 'Szolgáltatások',
    'projects' => 'Projektek',
    'packages' => 'Csomagok',
];
