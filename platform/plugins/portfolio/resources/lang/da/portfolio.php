<?php

return [
    'name' => 'Portfolio',
    'settings' => [
        'success_message' => 'Indstillingerne er blevet gemt!',
        'email' => [
            'title' => 'Tilbudsanmodninger',
            'description' => 'E-mail-skabeloner til tilbudsanmodninger',
            'templates' => [
                'notice_title' => 'Send besked til administrator',
                'notice_description' => 'Send besked til administrator, når en tilbudsanmodning sendes',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Servicekategorier',
        'create' => 'Opret servicekategori',
    ],
    'service' => [
        'name' => 'Tjenester',
        'create' => 'Opret tjeneste',
    ],
    'package' => [
        'name' => 'Pakker',
        'create' => 'Opret pakke',
    ],
    'project' => [
        'name' => 'Projekter',
        'create' => 'Opret projekt',
        'author' => 'Forfatter',
        'client' => 'Klient',
        'place' => 'Sted',
        'start_date' => 'Startdato',
        'metrics' => [
            'title' => 'Projektmålinger (case study-kort)',
            'helper' => 'Op til tre par af måling-værdi/etiket vist på case study-kortlayouts. Lad et par være tomt for at skjule det.',
            'value_n' => 'Måling :n værdi',
            'label_n' => 'Måling :n etiket',
            'label_placeholder' => 'f.eks. Planlægningseffektivitet',
        ],
    ],
    'quotation_request' => [
        'name' => 'Tilbudsanmodninger',
        'viewing' => 'Viser tilbudsanmodning #:name',
        'information' => 'Information',
    ],
    'custom_field' => [
        'name' => 'Brugerdefinerede felter',
        'create' => 'Opret',
        'type' => 'Type',
        'options' => 'Muligheder',
        'placeholder' => 'Pladsholder',
        'placeholder_placeholder' => 'Indtast pladsholder',
        'required' => 'Påkrævet',
        'option' => [
            'label' => 'Etiket',
            'value' => 'Værdi',
            'add_row' => 'Tilføj ny række',
            'add_from_global' => 'Tilføj globalt brugerdefineret felt',
        ],
        'modal' => [
            'heading' => 'Tilføj nyt brugerdefineret felt',
            'select_field' => 'Vælg felt',
            'button' => 'Tilføj ny',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Tekst',
                'number' => 'Nummer',
                'dropdown' => 'Rullemenu',
                'checkbox' => 'Afkrydsningsfelt',
                'textarea' => 'Tekstområde',
            ],
        ],
        'ask_for_select' => 'Vælg venligst et brugerdefineret felt',
        'add_a_new_custom_field' => 'Tilføj et nyt brugerdefineret felt',
    ],
    'image' => 'Billede',
    'category' => 'Kategori',
    'duration' => 'Varighed',
    'price' => 'Pris',
    'annual_price' => 'Årlig pris',
    'form' => [
        'none' => 'Ingen',
        'images' => 'Billeder',
        'name_placeholder' => 'Indtast navn',
        'is_featured' => 'Er fremhævet?',
        'price_placeholder' => 'Indtast pris',
        'features' => 'Funktioner',
        'features_help_block' => 'Adskil med ny linje (+ er inkluderet, - er ikke inkluderet)',
        'features_placeholder' => 'Eksempel:
+ 15-dages forsendelse verden over
+ Gratis bubbelindpakning
- 24/7 Support
        ',
        'description_placeholder' => 'Indtast beskrivelse',
        'packages_switch_pricing_plan' => 'Indtast årlig pris for at skifte prisplanfunktion',
        'action_url' => 'Handlings-URL',
        'action_label' => 'Handlingsetiket',
    ],
    'is_popular' => 'Er populær?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Timevis',
            'daily' => 'Daglig',
            'weekly' => 'Ugentlig',
            'monthly' => 'Månedlig',
            'annually' => 'Årlig',
            'quarterly' => 'Kvartalsvis',
            'one_time' => 'Engangs',
        ],
        'quote_statuses' => [
            'read' => 'Læst',
            'unread' => 'Ulæst',
        ],
    ],
    'edit_this_service' => 'Rediger denne tjeneste',
    'edit_this_service_category' => 'Rediger denne servicekategori',
    'edit_this_project' => 'Rediger dette projekt',
    'edit_this_project_category' => 'Rediger denne projektkategori',
    'edit_this_package' => 'Rediger denne pakke',
    'message' => 'Besked',
    'time' => 'Tid',
    'service_categories' => 'Servicekategorier',
    'services' => 'Tjenester',
    'projects' => 'Projekter',
    'packages' => 'Pakker',
];
