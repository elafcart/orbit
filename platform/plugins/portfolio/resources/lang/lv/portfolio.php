<?php

return [
    'name' => 'Portfelis',
    'settings' => [
        'success_message' => 'Iestatījumi veiksmīgi saglabāti!',
        'email' => [
            'title' => 'Cenu piedāvājumu pieprasījumi',
            'description' => 'E-pasta veidnes cenu piedāvājumu pieprasījumiem',
            'templates' => [
                'notice_title' => 'Nosūtīt paziņojumu administratoram',
                'notice_description' => 'Nosūtīt paziņojumu administratoram, kad tiek nosūtīts cenu piedāvājuma pieprasījums',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Pakalpojumu kategorijas',
        'create' => 'Izveidot pakalpojuma kategoriju',
    ],
    'service' => [
        'name' => 'Pakalpojumi',
        'create' => 'Izveidot pakalpojumu',
    ],
    'package' => [
        'name' => 'Paketes',
        'create' => 'Izveidot paketi',
    ],
    'project' => [
        'name' => 'Projekti',
        'create' => 'Izveidot projektu',
        'author' => 'Autors',
        'client' => 'Klients',
        'place' => 'Vieta',
        'start_date' => 'Sākuma datums',
        'metrics' => [
            'title' => 'Projekta metrikas (gadījumu izpētes kartes)',
            'helper' => 'Līdz trim metrikas vērtības/etiķetes pāriem, kas tiek parādīti gadījumu izpētes karšu izkārtojumos. Atstājiet jebkuru pāri tukšu, lai to paslēptu.',
            'value_n' => 'Metrikas :n vērtība',
            'label_n' => 'Metrikas :n etiķete',
            'label_placeholder' => 'piem. Plānošanas efektivitāte',
        ],
    ],
    'quotation_request' => [
        'name' => 'Cenu piedāvājumu pieprasījumi',
        'viewing' => 'Skatīšanās cenu piedāvājuma pieprasījums #:name',
        'information' => 'Informācija',
    ],
    'custom_field' => [
        'name' => 'Pielāgoti lauki',
        'create' => 'Izveidot',
        'type' => 'Tips',
        'options' => 'Opcijas',
        'placeholder' => 'Vietturis',
        'placeholder_placeholder' => 'Ievadiet vietturi',
        'required' => 'Obligāts',
        'option' => [
            'label' => 'Etiķete',
            'value' => 'Vērtība',
            'add_row' => 'Pievienot jaunu rindu',
            'add_from_global' => 'Pievienot globālo pielāgoto lauku',
        ],
        'modal' => [
            'heading' => 'Pievienot jaunu pielāgoto lauku',
            'select_field' => 'Atlasīt lauku',
            'button' => 'Pievienot jaunu',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Teksts',
                'number' => 'Numurs',
                'dropdown' => 'Nolaižamā izvēlne',
                'checkbox' => 'Izvēles rūtiņa',
                'textarea' => 'Teksta lauks',
            ],
        ],
        'ask_for_select' => 'Lūdzu, atlasiet pielāgoto lauku',
        'add_a_new_custom_field' => 'Pievienot jaunu pielāgoto lauku',
    ],
    'image' => 'Attēls',
    'category' => 'Kategorija',
    'duration' => 'Ilgums',
    'price' => 'Cena',
    'annual_price' => 'Gada cena',
    'form' => [
        'none' => 'Nav',
        'images' => 'Attēli',
        'name_placeholder' => 'Ievadiet nosaukumu',
        'is_featured' => 'Izceltais?',
        'price_placeholder' => 'Ievadiet cenu',
        'features' => 'Funkcijas',
        'features_help_block' => 'Atdalīt ar jaunu rindu (+ ir iekļauts, - nav iekļauts)',
        'features_placeholder' => 'Piemērs:
+ 15 dienu piegāde visā pasaulē
+ Bezmaksas burbuļplēve
- 24/7 Atbalsts
        ',
        'description_placeholder' => 'Ievadiet aprakstu',
        'packages_switch_pricing_plan' => 'Ievadiet gada cenu, lai pārslēgtu cenu plāna funkciju',
        'action_url' => 'Darbības URL',
        'action_label' => 'Darbības etiķete',
    ],
    'is_popular' => 'Populārs?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Stundas',
            'daily' => 'Dienas',
            'weekly' => 'Nedēļas',
            'monthly' => 'Mēneša',
            'annually' => 'Gada',
            'quarterly' => 'Ceturkšņa',
            'one_time' => 'Vienreizējs',
        ],
        'quote_statuses' => [
            'read' => 'Lasīts',
            'unread' => 'Nelasīts',
        ],
    ],
    'edit_this_service' => 'Rediģēt šo pakalpojumu',
    'edit_this_service_category' => 'Rediģēt šo pakalpojuma kategoriju',
    'edit_this_project' => 'Rediģēt šo projektu',
    'edit_this_project_category' => 'Rediģēt šo projekta kategoriju',
    'edit_this_package' => 'Rediģēt šo paketi',
    'message' => 'Ziņojums',
    'time' => 'Laiks',
    'service_categories' => 'Pakalpojumu kategorijas',
    'services' => 'Pakalpojumi',
    'projects' => 'Projekti',
    'packages' => 'Paketes',
];
