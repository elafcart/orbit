<?php

return [
    'name' => 'Portfolio',
    'settings' => [
        'success_message' => 'Innstillingene har blitt lagret!',
        'email' => [
            'title' => 'Tilbudsforespørsler',
            'description' => 'E-postmaler for tilbudsforespørsler',
            'templates' => [
                'notice_title' => 'Send varsel til administrator',
                'notice_description' => 'Send varsel til administrator når en tilbudsforespørsel sendes',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Tjenestekategorier',
        'create' => 'Opprett tjenestekategori',
    ],
    'service' => [
        'name' => 'Tjenester',
        'create' => 'Opprett tjeneste',
    ],
    'package' => [
        'name' => 'Pakker',
        'create' => 'Opprett pakke',
    ],
    'project' => [
        'name' => 'Prosjekter',
        'create' => 'Opprett prosjekt',
        'author' => 'Forfatter',
        'client' => 'Klient',
        'place' => 'Sted',
        'start_date' => 'Startdato',
        'metrics' => [
            'title' => 'Prosjektmålinger (case study-kort)',
            'helper' => 'Opptil tre verdi-/etikettpar for målinger som vises på case study-kortoppsett. La et par stå tomt for å skjule det.',
            'value_n' => 'Verdi for måling :n',
            'label_n' => 'Etikett for måling :n',
            'label_placeholder' => 'f.eks. Planleggingseffektivitet',
        ],
    ],
    'quotation_request' => [
        'name' => 'Tilbudsforespørsler',
        'viewing' => 'Viser tilbudsforespørsel #:name',
        'information' => 'Informasjon',
    ],
    'custom_field' => [
        'name' => 'Egendefinerte felt',
        'create' => 'Opprett',
        'type' => 'Type',
        'options' => 'Alternativer',
        'placeholder' => 'Plassholder',
        'placeholder_placeholder' => 'Skriv inn plassholder',
        'required' => 'Påkrevd',
        'option' => [
            'label' => 'Etikett',
            'value' => 'Verdi',
            'add_row' => 'Legg til ny rad',
            'add_from_global' => 'Legg til globalt egendefinert felt',
        ],
        'modal' => [
            'heading' => 'Legg til nytt egendefinert felt',
            'select_field' => 'Velg felt',
            'button' => 'Legg til ny',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Tekst',
                'number' => 'Nummer',
                'dropdown' => 'Rullegardinmeny',
                'checkbox' => 'Avmerkingsboks',
                'textarea' => 'Tekstområde',
            ],
        ],
        'ask_for_select' => 'Vennligst velg et egendefinert felt',
        'add_a_new_custom_field' => 'Legg til et nytt egendefinert felt',
    ],
    'image' => 'Bilde',
    'category' => 'Kategori',
    'duration' => 'Varighet',
    'price' => 'Pris',
    'annual_price' => 'Årlig pris',
    'form' => [
        'none' => 'Ingen',
        'images' => 'Bilder',
        'name_placeholder' => 'Skriv inn navn',
        'is_featured' => 'Fremhevet?',
        'price_placeholder' => 'Skriv inn pris',
        'features' => 'Funksjoner',
        'features_help_block' => 'Skill med ny linje (+ er inkludert, - er ikke inkludert)',
        'features_placeholder' => 'Eksempel:
+ 15-dagers frakt over hele verden
+ Gratis bobleplast
- 24/7 Support
        ',
        'description_placeholder' => 'Skriv inn beskrivelse',
        'packages_switch_pricing_plan' => 'Skriv inn årlig pris for å bytte prisplanfunksjon',
        'action_url' => 'Handlings-URL',
        'action_label' => 'Handlingsetikett',
    ],
    'is_popular' => 'Populær?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Timevis',
            'daily' => 'Daglig',
            'weekly' => 'Ukentlig',
            'monthly' => 'Månedlig',
            'annually' => 'Årlig',
            'quarterly' => 'Kvartalsvis',
            'one_time' => 'Engangs',
        ],
        'quote_statuses' => [
            'read' => 'Lest',
            'unread' => 'Ulest',
        ],
    ],
    'edit_this_service' => 'Rediger denne tjenesten',
    'edit_this_service_category' => 'Rediger denne tjenestekategorien',
    'edit_this_project' => 'Rediger dette prosjektet',
    'edit_this_project_category' => 'Rediger denne prosjektkategorien',
    'edit_this_package' => 'Rediger denne pakken',
    'message' => 'Melding',
    'time' => 'Tid',
    'service_categories' => 'Tjenestekategorier',
    'services' => 'Tjenester',
    'projects' => 'Prosjekter',
    'packages' => 'Pakker',
];
