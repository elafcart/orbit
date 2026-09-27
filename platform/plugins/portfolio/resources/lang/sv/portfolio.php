<?php

return [
    'name' => 'Portfolio',
    'settings' => [
        'success_message' => 'Inställningarna har sparats framgångsrikt!',
        'email' => [
            'title' => 'Offertförfrågningar',
            'description' => 'E-postmallar för offertförfrågningar',
            'templates' => [
                'notice_title' => 'Skicka meddelande till administratör',
                'notice_description' => 'Skicka meddelande till administratör när en offertförfrågan skickas',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Tjänstekategorier',
        'create' => 'Skapa tjänstekategori',
    ],
    'service' => [
        'name' => 'Tjänster',
        'create' => 'Skapa tjänst',
    ],
    'package' => [
        'name' => 'Paket',
        'create' => 'Skapa paket',
    ],
    'project' => [
        'name' => 'Projekt',
        'create' => 'Skapa projekt',
        'author' => 'Författare',
        'client' => 'Klient',
        'place' => 'Plats',
        'start_date' => 'Startdatum',
        'metrics' => [
            'title' => 'Projektmått (fallstudiekort)',
            'helper' => 'Upp till tre värde-/etikett-par för mått som visas i fallstudiekortlayouter. Lämna ett par tomt för att dölja det.',
            'value_n' => 'Mått :n värde',
            'label_n' => 'Mått :n etikett',
            'label_placeholder' => 't.ex. Planeringseffektivitet',
        ],
    ],
    'quotation_request' => [
        'name' => 'Offertförfrågningar',
        'viewing' => 'Visar offertförfrågan #:name',
        'information' => 'Information',
    ],
    'custom_field' => [
        'name' => 'Anpassade fält',
        'create' => 'Skapa',
        'type' => 'Typ',
        'options' => 'Alternativ',
        'placeholder' => 'Platshållare',
        'placeholder_placeholder' => 'Ange platshållare',
        'required' => 'Obligatorisk',
        'option' => [
            'label' => 'Etikett',
            'value' => 'Värde',
            'add_row' => 'Lägg till ny rad',
            'add_from_global' => 'Lägg till globalt anpassat fält',
        ],
        'modal' => [
            'heading' => 'Lägg till nytt anpassat fält',
            'select_field' => 'Välj fält',
            'button' => 'Lägg till nytt',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Text',
                'number' => 'Nummer',
                'dropdown' => 'Rullgardinsmeny',
                'checkbox' => 'Kryssruta',
                'textarea' => 'Textområde',
            ],
        ],
        'ask_for_select' => 'Vänligen välj ett anpassat fält',
        'add_a_new_custom_field' => 'Lägg till ett nytt anpassat fält',
    ],
    'image' => 'Bild',
    'category' => 'Kategori',
    'duration' => 'Varaktighet',
    'price' => 'Pris',
    'annual_price' => 'Årspris',
    'form' => [
        'none' => 'Ingen',
        'images' => 'Bilder',
        'name_placeholder' => 'Ange namn',
        'is_featured' => 'Framhävd?',
        'price_placeholder' => 'Ange pris',
        'features' => 'Funktioner',
        'features_help_block' => 'Separera med ny rad (+ ingår, - ingår inte)',
        'features_placeholder' => 'Exempel:
+ 15-dagars frakt världen över
+ Gratis bubbelplast
- 24/7 Support
        ',
        'description_placeholder' => 'Ange beskrivning',
        'packages_switch_pricing_plan' => 'Ange årspris för att byta prisplansfunktion',
        'action_url' => 'Åtgärds-URL',
        'action_label' => 'Åtgärdsetikett',
    ],
    'is_popular' => 'Populär?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Timvis',
            'daily' => 'Dagligen',
            'weekly' => 'Veckovis',
            'monthly' => 'Månadsvis',
            'annually' => 'Årligen',
            'quarterly' => 'Kvartalsvis',
            'one_time' => 'Engångs',
        ],
        'quote_statuses' => [
            'read' => 'Läst',
            'unread' => 'Oläst',
        ],
    ],
    'edit_this_service' => 'Redigera denna tjänst',
    'edit_this_service_category' => 'Redigera denna tjänstekategori',
    'edit_this_project' => 'Redigera detta projekt',
    'edit_this_project_category' => 'Redigera denna projektkategori',
    'edit_this_package' => 'Redigera detta paket',
    'message' => 'Meddelande',
    'time' => 'Tid',
    'service_categories' => 'Tjänstekategorier',
    'services' => 'Tjänster',
    'projects' => 'Projekt',
    'packages' => 'Paket',
];
