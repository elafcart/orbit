<?php

return [
    'name' => 'Portfolio',
    'settings' => [
        'success_message' => 'Nastavitve so bile uspešno shranjene!',
        'email' => [
            'title' => 'Zahteve za ponudbo',
            'description' => 'E-poštne predloge za zahteve za ponudbo',
            'templates' => [
                'notice_title' => 'Pošlji obvestilo administratorju',
                'notice_description' => 'Pošlji obvestilo administratorju, ko je poslana zahteva za ponudbo',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Kategorije storitev',
        'create' => 'Ustvari kategorijo storitve',
    ],
    'service' => [
        'name' => 'Storitve',
        'create' => 'Ustvari storitev',
    ],
    'package' => [
        'name' => 'Paketi',
        'create' => 'Ustvari paket',
    ],
    'project' => [
        'name' => 'Projekti',
        'create' => 'Ustvari projekt',
        'author' => 'Avtor',
        'client' => 'Stranka',
        'place' => 'Kraj',
        'start_date' => 'Začetni datum',
        'metrics' => [
            'title' => 'Metrike projekta (kartice študij primerov)',
            'helper' => 'Do trije pari vrednosti/oznak metrik, prikazani v postavitvah kartic študij primerov. Pustite kateri koli par prazen, da ga skrijete.',
            'value_n' => 'Vrednost metrike :n',
            'label_n' => 'Oznaka metrike :n',
            'label_placeholder' => 'npr. Učinkovitost načrtovanja',
        ],
    ],
    'quotation_request' => [
        'name' => 'Zahteve za ponudbo',
        'viewing' => 'Ogled zahteve za ponudbo #:name',
        'information' => 'Informacije',
    ],
    'custom_field' => [
        'name' => 'Polja po meri',
        'create' => 'Ustvari',
        'type' => 'Vrsta',
        'options' => 'Možnosti',
        'placeholder' => 'Označevalec mesta',
        'placeholder_placeholder' => 'Vnesite označevalec mesta',
        'required' => 'Obvezno',
        'option' => [
            'label' => 'Oznaka',
            'value' => 'Vrednost',
            'add_row' => 'Dodaj novo vrstico',
            'add_from_global' => 'Dodaj globalno polje po meri',
        ],
        'modal' => [
            'heading' => 'Dodaj novo polje po meri',
            'select_field' => 'Izberite polje',
            'button' => 'Dodaj novo',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Besedilo',
                'number' => 'Številka',
                'dropdown' => 'Spustni meni',
                'checkbox' => 'Potrditveno polje',
                'textarea' => 'Besedilno območje',
            ],
        ],
        'ask_for_select' => 'Prosimo izberite polje po meri',
        'add_a_new_custom_field' => 'Dodaj novo polje po meri',
    ],
    'image' => 'Slika',
    'category' => 'Kategorija',
    'duration' => 'Trajanje',
    'price' => 'Cena',
    'annual_price' => 'Letna cena',
    'form' => [
        'none' => 'Brez',
        'images' => 'Slike',
        'name_placeholder' => 'Vnesite ime',
        'is_featured' => 'Predstavljeno?',
        'price_placeholder' => 'Vnesite ceno',
        'features' => 'Značilnosti',
        'features_help_block' => 'Ločite z novo vrstico (+ je vključeno, - ni vključeno)',
        'features_placeholder' => 'Primer:
+ 15-dnevna dostava po vsem svetu
+ Brezplačna mehurčasta folija
- 24/7 Podpora
        ',
        'description_placeholder' => 'Vnesite opis',
        'packages_switch_pricing_plan' => 'Vnesite letno ceno za preklop funkcije cenovnega načrta',
        'action_url' => 'URL dejanja',
        'action_label' => 'Oznaka dejanja',
    ],
    'is_popular' => 'Priljubljeno?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Urno',
            'daily' => 'Dnevno',
            'weekly' => 'Tedensko',
            'monthly' => 'Mesečno',
            'annually' => 'Letno',
            'quarterly' => 'Četrtletno',
            'one_time' => 'Enkratno',
        ],
        'quote_statuses' => [
            'read' => 'Prebrano',
            'unread' => 'Neprebrano',
        ],
    ],
    'edit_this_service' => 'Uredi to storitev',
    'edit_this_service_category' => 'Uredi to kategorijo storitve',
    'edit_this_project' => 'Uredi ta projekt',
    'edit_this_project_category' => 'Uredi to kategorijo projekta',
    'edit_this_package' => 'Uredi ta paket',
    'message' => 'Sporočilo',
    'time' => 'Čas',
    'service_categories' => 'Kategorije storitev',
    'services' => 'Storitve',
    'projects' => 'Projekti',
    'packages' => 'Paketi',
];
