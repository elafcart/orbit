<?php

return [
    'name' => 'Portfolio',
    'settings' => [
        'success_message' => 'Einstellungen wurden erfolgreich gespeichert!',
        'email' => [
            'title' => 'Angebotsanfragen',
            'description' => 'E-Mail-Vorlagen für Angebotsanfragen',
            'templates' => [
                'notice_title' => 'Benachrichtigung an Administrator senden',
                'notice_description' => 'Benachrichtigung an Administrator senden, wenn eine Angebotsanfrage gesendet wird',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Dienstkategorien',
        'create' => 'Dienstkategorie erstellen',
    ],
    'service' => [
        'name' => 'Dienstleistungen',
        'create' => 'Dienstleistung erstellen',
    ],
    'package' => [
        'name' => 'Pakete',
        'create' => 'Paket erstellen',
    ],
    'project' => [
        'name' => 'Projekte',
        'create' => 'Projekt erstellen',
        'author' => 'Autor',
        'client' => 'Kunde',
        'place' => 'Ort',
        'start_date' => 'Startdatum',
        'metrics' => [
            'title' => 'Projektmetriken (Fallstudienkarten)',
            'helper' => 'Bis zu drei Metrikwert-/Beschriftungspaare, die in Fallstudienkartenlayouts angezeigt werden. Lassen Sie ein Paar leer, um es auszublenden.',
            'value_n' => 'Wert der Metrik :n',
            'label_n' => 'Beschriftung der Metrik :n',
            'label_placeholder' => 'z. B. Planungseffizienz',
        ],
    ],
    'quotation_request' => [
        'name' => 'Angebotsanfragen',
        'viewing' => 'Angebotsanfrage #:name anzeigen',
        'information' => 'Information',
    ],
    'custom_field' => [
        'name' => 'Benutzerdefinierte Felder',
        'create' => 'Erstellen',
        'type' => 'Typ',
        'options' => 'Optionen',
        'placeholder' => 'Platzhalter',
        'placeholder_placeholder' => 'Platzhalter eingeben',
        'required' => 'Erforderlich',
        'option' => [
            'label' => 'Bezeichnung',
            'value' => 'Wert',
            'add_row' => 'Neue Zeile hinzufügen',
            'add_from_global' => 'Globales benutzerdefiniertes Feld hinzufügen',
        ],
        'modal' => [
            'heading' => 'Neues benutzerdefiniertes Feld hinzufügen',
            'select_field' => 'Feld auswählen',
            'button' => 'Neu hinzufügen',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Text',
                'number' => 'Nummer',
                'dropdown' => 'Dropdown',
                'checkbox' => 'Kontrollkästchen',
                'textarea' => 'Textbereich',
            ],
        ],
        'ask_for_select' => 'Bitte wählen Sie ein benutzerdefiniertes Feld aus',
        'add_a_new_custom_field' => 'Ein neues benutzerdefiniertes Feld hinzufügen',
    ],
    'image' => 'Bild',
    'category' => 'Kategorie',
    'duration' => 'Dauer',
    'price' => 'Preis',
    'annual_price' => 'Jahrespreis',
    'form' => [
        'none' => 'Keine',
        'images' => 'Bilder',
        'name_placeholder' => 'Name eingeben',
        'is_featured' => 'Hervorgehoben?',
        'price_placeholder' => 'Preis eingeben',
        'features' => 'Funktionen',
        'features_help_block' => 'Durch neue Zeile trennen (+ ist enthalten, - ist nicht enthalten)',
        'features_placeholder' => 'Beispiel:
+ 15-Tage-Versand weltweit
+ Kostenlose Luftpolsterfolie
- 24/7 Support
        ',
        'description_placeholder' => 'Beschreibung eingeben',
        'packages_switch_pricing_plan' => 'Jahrespreis eingeben, um die Preisplan-Wechselfunktion zu aktivieren',
        'action_url' => 'Aktions-URL',
        'action_label' => 'Aktionsbezeichnung',
    ],
    'is_popular' => 'Ist beliebt?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Stündlich',
            'daily' => 'Täglich',
            'weekly' => 'Wöchentlich',
            'monthly' => 'Monatlich',
            'annually' => 'Jährlich',
            'quarterly' => 'Vierteljährlich',
            'one_time' => 'Einmalig',
        ],
        'quote_statuses' => [
            'read' => 'Gelesen',
            'unread' => 'Ungelesen',
        ],
    ],
    'edit_this_service' => 'Diese Dienstleistung bearbeiten',
    'edit_this_service_category' => 'Diese Dienstkategorie bearbeiten',
    'edit_this_project' => 'Dieses Projekt bearbeiten',
    'edit_this_project_category' => 'Diese Projektkategorie bearbeiten',
    'edit_this_package' => 'Dieses Paket bearbeiten',
    'message' => 'Nachricht',
    'time' => 'Zeit',
    'service_categories' => 'Dienstkategorien',
    'services' => 'Dienstleistungen',
    'projects' => 'Projekte',
    'packages' => 'Pakete',
];
