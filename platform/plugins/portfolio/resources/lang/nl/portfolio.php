<?php

return [
    'name' => 'Portfolio',
    'settings' => [
        'success_message' => 'Instellingen zijn succesvol opgeslagen!',
        'email' => [
            'title' => 'Offerteaanvragen',
            'description' => 'E-mailsjablonen voor offerteaanvragen',
            'templates' => [
                'notice_title' => 'Verstuur melding naar beheerder',
                'notice_description' => 'Verstuur melding naar beheerder wanneer een offerteaanvraag wordt verzonden',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Servicecategorieën',
        'create' => 'Servicecategorie aanmaken',
    ],
    'service' => [
        'name' => 'Services',
        'create' => 'Service aanmaken',
    ],
    'package' => [
        'name' => 'Pakketten',
        'create' => 'Pakket aanmaken',
    ],
    'project' => [
        'name' => 'Projecten',
        'create' => 'Project aanmaken',
        'author' => 'Auteur',
        'client' => 'Klant',
        'place' => 'Plaats',
        'start_date' => 'Startdatum',
        'metrics' => [
            'title' => 'Projectmetingen (case-studykaarten)',
            'helper' => 'Maximaal drie waarde/label-paren voor metingen weergegeven op case-studykaartlayouts. Laat een paar leeg om het te verbergen.',
            'value_n' => 'Waarde van meting :n',
            'label_n' => 'Label van meting :n',
            'label_placeholder' => 'bv. Planningsefficiëntie',
        ],
    ],
    'quotation_request' => [
        'name' => 'Offerteaanvragen',
        'viewing' => 'Offerteaanvraag bekijken #:name',
        'information' => 'Informatie',
    ],
    'custom_field' => [
        'name' => 'Aangepaste velden',
        'create' => 'Aanmaken',
        'type' => 'Type',
        'options' => 'Opties',
        'placeholder' => 'Tijdelijke aanduiding',
        'placeholder_placeholder' => 'Voer tijdelijke aanduiding in',
        'required' => 'Verplicht',
        'option' => [
            'label' => 'Label',
            'value' => 'Waarde',
            'add_row' => 'Nieuwe rij toevoegen',
            'add_from_global' => 'Globaal aangepast veld toevoegen',
        ],
        'modal' => [
            'heading' => 'Nieuw aangepast veld toevoegen',
            'select_field' => 'Veld selecteren',
            'button' => 'Nieuwe toevoegen',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Tekst',
                'number' => 'Nummer',
                'dropdown' => 'Dropdown',
                'checkbox' => 'Selectievakje',
                'textarea' => 'Tekstgebied',
            ],
        ],
        'ask_for_select' => 'Selecteer een aangepast veld',
        'add_a_new_custom_field' => 'Een nieuw aangepast veld toevoegen',
    ],
    'image' => 'Afbeelding',
    'category' => 'Categorie',
    'duration' => 'Duur',
    'price' => 'Prijs',
    'annual_price' => 'Jaarprijs',
    'form' => [
        'none' => 'Geen',
        'images' => 'Afbeeldingen',
        'name_placeholder' => 'Voer naam in',
        'is_featured' => 'Uitgelicht?',
        'price_placeholder' => 'Voer prijs in',
        'features' => 'Kenmerken',
        'features_help_block' => 'Scheid door nieuwe regel (+ is inbegrepen, - is niet inbegrepen)',
        'features_placeholder' => 'Voorbeeld:
+ 15 dagen verzending wereldwijd
+ Gratis bubbelfolie
- 24/7 Ondersteuning
        ',
        'description_placeholder' => 'Voer beschrijving in',
        'packages_switch_pricing_plan' => 'Voer jaarprijs in om prijsplan wissel functie in te schakelen',
        'action_url' => 'Actie-URL',
        'action_label' => 'Actielabel',
    ],
    'is_popular' => 'Populair?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Per uur',
            'daily' => 'Dagelijks',
            'weekly' => 'Wekelijks',
            'monthly' => 'Maandelijks',
            'annually' => 'Jaarlijks',
            'quarterly' => 'Per kwartaal',
            'one_time' => 'Eenmalig',
        ],
        'quote_statuses' => [
            'read' => 'Gelezen',
            'unread' => 'Ongelezen',
        ],
    ],
    'edit_this_service' => 'Deze service bewerken',
    'edit_this_service_category' => 'Deze servicecategorie bewerken',
    'edit_this_project' => 'Dit project bewerken',
    'edit_this_project_category' => 'Deze projectcategorie bewerken',
    'edit_this_package' => 'Dit pakket bewerken',
    'message' => 'Bericht',
    'time' => 'Tijd',
    'service_categories' => 'Servicecategorieën',
    'services' => 'Services',
    'projects' => 'Projecten',
    'packages' => 'Pakketten',
];
