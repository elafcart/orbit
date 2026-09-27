<?php

return [
    'name' => 'Portfólio',
    'settings' => [
        'success_message' => 'Nastavenia boli úspešne uložené!',
        'email' => [
            'title' => 'Žiadosti o ponuku',
            'description' => 'Emailové šablóny pre žiadosti o ponuku',
            'templates' => [
                'notice_title' => 'Odoslať oznámenie správcovi',
                'notice_description' => 'Odoslať oznámenie správcovi pri odoslaní žiadosti o ponuku',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Kategórie služieb',
        'create' => 'Vytvoriť kategóriu služby',
    ],
    'service' => [
        'name' => 'Služby',
        'create' => 'Vytvoriť službu',
    ],
    'package' => [
        'name' => 'Balíky',
        'create' => 'Vytvoriť balík',
    ],
    'project' => [
        'name' => 'Projekty',
        'create' => 'Vytvoriť projekt',
        'author' => 'Autor',
        'client' => 'Klient',
        'place' => 'Miesto',
        'start_date' => 'Dátum začiatku',
        'metrics' => [
            'title' => 'Metriky projektu (karty prípadových štúdií)',
            'helper' => 'Až tri dvojice hodnota/popisok metriky zobrazené v rozloženiach kariet prípadových štúdií. Ponechajte ľubovoľnú dvojicu prázdnu, aby sa skryla.',
            'value_n' => 'Hodnota metriky :n',
            'label_n' => 'Popisok metriky :n',
            'label_placeholder' => 'napr. Efektivita plánovania',
        ],
    ],
    'quotation_request' => [
        'name' => 'Žiadosti o ponuku',
        'viewing' => 'Zobrazenie žiadosti o ponuku #:name',
        'information' => 'Informácie',
    ],
    'custom_field' => [
        'name' => 'Vlastné polia',
        'create' => 'Vytvoriť',
        'type' => 'Typ',
        'options' => 'Možnosti',
        'placeholder' => 'Zástupný symbol',
        'placeholder_placeholder' => 'Zadajte zástupný symbol',
        'required' => 'Povinné',
        'option' => [
            'label' => 'Štítok',
            'value' => 'Hodnota',
            'add_row' => 'Pridať nový riadok',
            'add_from_global' => 'Pridať globálne vlastné pole',
        ],
        'modal' => [
            'heading' => 'Pridať nové vlastné pole',
            'select_field' => 'Vyberte pole',
            'button' => 'Pridať nové',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Text',
                'number' => 'Číslo',
                'dropdown' => 'Rozbaľovací zoznam',
                'checkbox' => 'Začiarkavacie políčko',
                'textarea' => 'Textová oblasť',
            ],
        ],
        'ask_for_select' => 'Vyberte prosím vlastné pole',
        'add_a_new_custom_field' => 'Pridať nové vlastné pole',
    ],
    'image' => 'Obrázok',
    'category' => 'Kategória',
    'duration' => 'Trvanie',
    'price' => 'Cena',
    'annual_price' => 'Ročná cena',
    'form' => [
        'none' => 'Žiadne',
        'images' => 'Obrázky',
        'name_placeholder' => 'Zadajte názov',
        'is_featured' => 'Vybrané?',
        'price_placeholder' => 'Zadajte cenu',
        'features' => 'Funkcie',
        'features_help_block' => 'Oddeľte novým riadkom (+ je zahrnuté, - nie je zahrnuté)',
        'features_placeholder' => 'Príklad:
+ 15-dňová doprava po celom svete
+ Bezplatné bublinkové balenie
- 24/7 Podpora
        ',
        'description_placeholder' => 'Zadajte popis',
        'packages_switch_pricing_plan' => 'Zadajte ročnú cenu na prepnutie funkcie cenového plánu',
        'action_url' => 'URL akcie',
        'action_label' => 'Štítok akcie',
    ],
    'is_popular' => 'Populárne?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Hodinovo',
            'daily' => 'Denne',
            'weekly' => 'Týždenne',
            'monthly' => 'Mesačne',
            'annually' => 'Ročne',
            'quarterly' => 'Štvrťročne',
            'one_time' => 'Jednorazovo',
        ],
        'quote_statuses' => [
            'read' => 'Prečítané',
            'unread' => 'Neprečítané',
        ],
    ],
    'edit_this_service' => 'Upraviť túto službu',
    'edit_this_service_category' => 'Upraviť túto kategóriu služby',
    'edit_this_project' => 'Upraviť tento projekt',
    'edit_this_project_category' => 'Upraviť túto kategóriu projektu',
    'edit_this_package' => 'Upraviť tento balík',
    'message' => 'Správa',
    'time' => 'Čas',
    'service_categories' => 'Kategórie služieb',
    'services' => 'Služby',
    'projects' => 'Projekty',
    'packages' => 'Balíky',
];
