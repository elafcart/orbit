<?php

return [
    'name' => 'Portfolio',
    'settings' => [
        'success_message' => 'Postavke su uspješno spremljene!',
        'email' => [
            'title' => 'Zahtjevi za ponudu',
            'description' => 'Predlošci e-pošte za zahtjeve za ponudu',
            'templates' => [
                'notice_title' => 'Pošalji obavijest administratoru',
                'notice_description' => 'Pošalji obavijest administratoru kada je poslan zahtjev za ponudu',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Kategorije usluga',
        'create' => 'Stvori kategoriju usluge',
    ],
    'service' => [
        'name' => 'Usluge',
        'create' => 'Stvori uslugu',
    ],
    'package' => [
        'name' => 'Paketi',
        'create' => 'Stvori paket',
    ],
    'project' => [
        'name' => 'Projekti',
        'create' => 'Stvori projekt',
        'author' => 'Autor',
        'client' => 'Klijent',
        'place' => 'Mjesto',
        'start_date' => 'Datum početka',
        'metrics' => [
            'title' => 'Metrike projekta (kartice studije slučaja)',
            'helper' => 'Do tri para vrijednost/oznaka metrike prikazana na izgledima kartica studije slučaja. Ostavite bilo koji par praznim da biste ga sakrili.',
            'value_n' => 'Vrijednost metrike :n',
            'label_n' => 'Oznaka metrike :n',
            'label_placeholder' => 'npr. Učinkovitost planiranja',
        ],
    ],
    'quotation_request' => [
        'name' => 'Zahtjevi za ponudu',
        'viewing' => 'Pregled zahtjeva za ponudu #:name',
        'information' => 'Informacije',
    ],
    'custom_field' => [
        'name' => 'Prilagođena polja',
        'create' => 'Stvori',
        'type' => 'Tip',
        'options' => 'Opcije',
        'placeholder' => 'Rezervirano mjesto',
        'placeholder_placeholder' => 'Unesite rezervirano mjesto',
        'required' => 'Obavezno',
        'option' => [
            'label' => 'Oznaka',
            'value' => 'Vrijednost',
            'add_row' => 'Dodaj novi redak',
            'add_from_global' => 'Dodaj globalno prilagođeno polje',
        ],
        'modal' => [
            'heading' => 'Dodaj novo prilagođeno polje',
            'select_field' => 'Odaberi polje',
            'button' => 'Dodaj novo',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Tekst',
                'number' => 'Broj',
                'dropdown' => 'Padajući izbornik',
                'checkbox' => 'Potvrdni okvir',
                'textarea' => 'Tekstualno područje',
            ],
        ],
        'ask_for_select' => 'Molimo odaberite prilagođeno polje',
        'add_a_new_custom_field' => 'Dodaj novo prilagođeno polje',
    ],
    'image' => 'Slika',
    'category' => 'Kategorija',
    'duration' => 'Trajanje',
    'price' => 'Cijena',
    'annual_price' => 'Godišnja cijena',
    'form' => [
        'none' => 'Ništa',
        'images' => 'Slike',
        'name_placeholder' => 'Unesite naziv',
        'is_featured' => 'Istaknuto?',
        'price_placeholder' => 'Unesite cijenu',
        'features' => 'Značajke',
        'features_help_block' => 'Odvojite novim retkom (+ je uključeno, - nije uključeno)',
        'features_placeholder' => 'Primjer:
+ 15-dnevna dostava širom svijeta
+ Besplatna zaštita od mjehurića
- 24/7 Podrška
        ',
        'description_placeholder' => 'Unesite opis',
        'packages_switch_pricing_plan' => 'Unesite godišnju cijenu za prebacivanje značajke cjenovnog plana',
        'action_url' => 'URL radnje',
        'action_label' => 'Oznaka radnje',
    ],
    'is_popular' => 'Popularno?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Satno',
            'daily' => 'Dnevno',
            'weekly' => 'Tjedno',
            'monthly' => 'Mjesečno',
            'annually' => 'Godišnje',
            'quarterly' => 'Kvartalno',
            'one_time' => 'Jednokratno',
        ],
        'quote_statuses' => [
            'read' => 'Pročitano',
            'unread' => 'Nepročitano',
        ],
    ],
    'edit_this_service' => 'Uredi ovu uslugu',
    'edit_this_service_category' => 'Uredi ovu kategoriju usluge',
    'edit_this_project' => 'Uredi ovaj projekt',
    'edit_this_project_category' => 'Uredi ovu kategoriju projekta',
    'edit_this_package' => 'Uredi ovaj paket',
    'message' => 'Poruka',
    'time' => 'Vrijeme',
    'service_categories' => 'Kategorije usluga',
    'services' => 'Usluge',
    'projects' => 'Projekti',
    'packages' => 'Paketi',
];
