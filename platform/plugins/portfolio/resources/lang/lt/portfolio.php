<?php

return [
    'name' => 'Portfelis',
    'settings' => [
        'success_message' => 'Nustatymai sėkmingai išsaugoti!',
        'email' => [
            'title' => 'Pasiūlymų užklausos',
            'description' => 'El. pašto šablonai pasiūlymų užklausoms',
            'templates' => [
                'notice_title' => 'Siųsti pranešimą administratoriui',
                'notice_description' => 'Siųsti pranešimą administratoriui, kai išsiunčiama pasiūlymo užklausa',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Paslaugų kategorijos',
        'create' => 'Sukurti paslaugos kategoriją',
    ],
    'service' => [
        'name' => 'Paslaugos',
        'create' => 'Sukurti paslaugą',
    ],
    'package' => [
        'name' => 'Paketai',
        'create' => 'Sukurti paketą',
    ],
    'project' => [
        'name' => 'Projektai',
        'create' => 'Sukurti projektą',
        'author' => 'Autorius',
        'client' => 'Klientas',
        'place' => 'Vieta',
        'start_date' => 'Pradžios data',
        'metrics' => [
            'title' => 'Projekto metrika (atvejo studijų kortelės)',
            'helper' => 'Iki trijų metrikos vertės/etiketės porų, rodomų atvejo studijų kortelių išdėstymuose. Palikite bet kurią porą tuščią, kad ji būtų paslėpta.',
            'value_n' => 'Metrikos :n vertė',
            'label_n' => 'Metrikos :n etiketė',
            'label_placeholder' => 'pvz. Planavimo efektyvumas',
        ],
    ],
    'quotation_request' => [
        'name' => 'Pasiūlymų užklausos',
        'viewing' => 'Pasiūlymo užklausos peržiūra #:name',
        'information' => 'Informacija',
    ],
    'custom_field' => [
        'name' => 'Pasirinktiniai laukai',
        'create' => 'Sukurti',
        'type' => 'Tipas',
        'options' => 'Parinktys',
        'placeholder' => 'Vietos rezervavimas',
        'placeholder_placeholder' => 'Įveskite vietos rezervavimą',
        'required' => 'Privaloma',
        'option' => [
            'label' => 'Žyma',
            'value' => 'Reikšmė',
            'add_row' => 'Pridėti naują eilutę',
            'add_from_global' => 'Pridėti globalų pasirinktinį lauką',
        ],
        'modal' => [
            'heading' => 'Pridėti naują pasirinktinį lauką',
            'select_field' => 'Pasirinkti lauką',
            'button' => 'Pridėti naują',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Tekstas',
                'number' => 'Skaičius',
                'dropdown' => 'Išskleidžiamasis sąrašas',
                'checkbox' => 'Žymės langelis',
                'textarea' => 'Teksto sritis',
            ],
        ],
        'ask_for_select' => 'Prašome pasirinkti pasirinktinį lauką',
        'add_a_new_custom_field' => 'Pridėti naują pasirinktinį lauką',
    ],
    'image' => 'Vaizdas',
    'category' => 'Kategorija',
    'duration' => 'Trukmė',
    'price' => 'Kaina',
    'annual_price' => 'Metinė kaina',
    'form' => [
        'none' => 'Nėra',
        'images' => 'Vaizdai',
        'name_placeholder' => 'Įveskite pavadinimą',
        'is_featured' => 'Rekomenduojama?',
        'price_placeholder' => 'Įveskite kainą',
        'features' => 'Funkcijos',
        'features_help_block' => 'Atskirkite nauja eilute (+ įtraukta, - neįtraukta)',
        'features_placeholder' => 'Pavyzdys:
+ 15 dienų pristatymas visame pasaulyje
+ Nemokama burbulinė plėvelė
- 24/7 Palaikymas
        ',
        'description_placeholder' => 'Įveskite aprašymą',
        'packages_switch_pricing_plan' => 'Įveskite metinę kainą, kad įjungtumėte kainų plano perjungimo funkciją',
        'action_url' => 'Veiksmo URL',
        'action_label' => 'Veiksmo žyma',
    ],
    'is_popular' => 'Populiaru?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Valandinis',
            'daily' => 'Kasdien',
            'weekly' => 'Savaitinis',
            'monthly' => 'Mėnesinis',
            'annually' => 'Metinis',
            'quarterly' => 'Ketvirtinis',
            'one_time' => 'Vienkartinis',
        ],
        'quote_statuses' => [
            'read' => 'Perskaityta',
            'unread' => 'Neperskaityta',
        ],
    ],
    'edit_this_service' => 'Redaguoti šią paslaugą',
    'edit_this_service_category' => 'Redaguoti šią paslaugos kategoriją',
    'edit_this_project' => 'Redaguoti šį projektą',
    'edit_this_project_category' => 'Redaguoti šią projekto kategoriją',
    'edit_this_package' => 'Redaguoti šį paketą',
    'message' => 'Pranešimas',
    'time' => 'Laikas',
    'service_categories' => 'Paslaugų kategorijos',
    'services' => 'Paslaugos',
    'projects' => 'Projektai',
    'packages' => 'Paketai',
];
