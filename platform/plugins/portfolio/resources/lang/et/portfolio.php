<?php

return [
    'name' => 'Portfoolio',
    'settings' => [
        'success_message' => 'Seaded on edukalt salvestatud!',
        'email' => [
            'title' => 'Hinnapakkumise taotlused',
            'description' => 'E-posti mallid hinnapakkumise taotluste jaoks',
            'templates' => [
                'notice_title' => 'Saada teatis administraatorile',
                'notice_description' => 'Saada teatis administraatorile, kui hinnapakkumise taotlus on saadetud',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Teenuste kategooriad',
        'create' => 'Loo teenuse kategooria',
    ],
    'service' => [
        'name' => 'Teenused',
        'create' => 'Loo teenus',
    ],
    'package' => [
        'name' => 'Paketid',
        'create' => 'Loo pakett',
    ],
    'project' => [
        'name' => 'Projektid',
        'create' => 'Loo projekt',
        'author' => 'Autor',
        'client' => 'Klient',
        'place' => 'Koht',
        'start_date' => 'Alguskuupäev',
        'metrics' => [
            'title' => 'Projekti mõõdikud (juhtumiuuringu kaardid)',
            'helper' => 'Kuni kolm mõõdiku väärtuse/sildi paari, mis kuvatakse juhtumiuuringu kaardi paigutustes. Jätke mõni paar tühjaks, et see peita.',
            'value_n' => 'Mõõdiku :n väärtus',
            'label_n' => 'Mõõdiku :n silt',
            'label_placeholder' => 'nt Planeerimise tõhusus',
        ],
    ],
    'quotation_request' => [
        'name' => 'Hinnapakkumise taotlused',
        'viewing' => 'Vaatan hinnapakkumise taotlust #:name',
        'information' => 'Informatsioon',
    ],
    'custom_field' => [
        'name' => 'Kohandatud väljad',
        'create' => 'Loo',
        'type' => 'Tüüp',
        'options' => 'Valikud',
        'placeholder' => 'Kohatäide',
        'placeholder_placeholder' => 'Sisesta kohatäide',
        'required' => 'Nõutud',
        'option' => [
            'label' => 'Silt',
            'value' => 'Väärtus',
            'add_row' => 'Lisa uus rida',
            'add_from_global' => 'Lisa globaalne kohandatud väli',
        ],
        'modal' => [
            'heading' => 'Lisa uus kohandatud väli',
            'select_field' => 'Vali väli',
            'button' => 'Lisa uus',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Tekst',
                'number' => 'Number',
                'dropdown' => 'Rippmenüü',
                'checkbox' => 'Märkeruut',
                'textarea' => 'Tekstiala',
            ],
        ],
        'ask_for_select' => 'Palun vali kohandatud väli',
        'add_a_new_custom_field' => 'Lisa uus kohandatud väli',
    ],
    'image' => 'Pilt',
    'category' => 'Kategooria',
    'duration' => 'Kestus',
    'price' => 'Hind',
    'annual_price' => 'Aastahind',
    'form' => [
        'none' => 'Puudub',
        'images' => 'Pildid',
        'name_placeholder' => 'Sisesta nimi',
        'is_featured' => 'Esiletõstetud?',
        'price_placeholder' => 'Sisesta hind',
        'features' => 'Omadused',
        'features_help_block' => 'Eralda uue reaga (+ on kaasatud, - ei ole kaasatud)',
        'features_placeholder' => 'Näide:
+ 15-päevane saatmine üle maailma
+ Tasuta mullkile
- 24/7 Tugi
        ',
        'description_placeholder' => 'Sisesta kirjeldus',
        'packages_switch_pricing_plan' => 'Sisesta aastahind hinnaplaani vahetamise funktsiooni aktiveerimiseks',
        'action_url' => 'Tegevuse URL',
        'action_label' => 'Tegevuse silt',
    ],
    'is_popular' => 'Populaarne?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Tunnis',
            'daily' => 'Päevas',
            'weekly' => 'Nädalas',
            'monthly' => 'Kuus',
            'annually' => 'Aastas',
            'quarterly' => 'Kvartalis',
            'one_time' => 'Ühekordne',
        ],
        'quote_statuses' => [
            'read' => 'Loetud',
            'unread' => 'Lugemata',
        ],
    ],
    'edit_this_service' => 'Muuda seda teenust',
    'edit_this_service_category' => 'Muuda seda teenuse kategooriat',
    'edit_this_project' => 'Muuda seda projekti',
    'edit_this_project_category' => 'Muuda seda projekti kategooriat',
    'edit_this_package' => 'Muuda seda paketti',
    'message' => 'Sõnum',
    'time' => 'Aeg',
    'service_categories' => 'Teenuste kategooriad',
    'services' => 'Teenused',
    'projects' => 'Projektid',
    'packages' => 'Paketid',
];
