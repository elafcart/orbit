<?php

return [
    'name' => 'Portfolio',
    'settings' => [
        'success_message' => 'Nastavení byla úspěšně uložena!',
        'email' => [
            'title' => 'Žádosti o nabídku',
            'description' => 'Emailové šablony pro žádosti o nabídku',
            'templates' => [
                'notice_title' => 'Odeslat upozornění administrátorovi',
                'notice_description' => 'Odeslat upozornění administrátorovi při odeslání žádosti o nabídku',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Kategorie služeb',
        'create' => 'Vytvořit kategorii služby',
    ],
    'service' => [
        'name' => 'Služby',
        'create' => 'Vytvořit službu',
    ],
    'package' => [
        'name' => 'Balíčky',
        'create' => 'Vytvořit balíček',
    ],
    'project' => [
        'name' => 'Projekty',
        'create' => 'Vytvořit projekt',
        'author' => 'Autor',
        'client' => 'Klient',
        'place' => 'Místo',
        'start_date' => 'Datum zahájení',
        'metrics' => [
            'title' => 'Metriky projektu (karty případových studií)',
            'helper' => 'Až tři dvojice hodnota/popisek metriky zobrazené na rozvrženích karet případových studií. Ponechejte libovolný pár prázdný, aby se skryl.',
            'value_n' => 'Hodnota metriky :n',
            'label_n' => 'Popisek metriky :n',
            'label_placeholder' => 'např. Efektivita plánování',
        ],
    ],
    'quotation_request' => [
        'name' => 'Žádosti o nabídku',
        'viewing' => 'Zobrazení žádosti o nabídku #:name',
        'information' => 'Informace',
    ],
    'custom_field' => [
        'name' => 'Vlastní pole',
        'create' => 'Vytvořit',
        'type' => 'Typ',
        'options' => 'Možnosti',
        'placeholder' => 'Zástupný text',
        'placeholder_placeholder' => 'Zadejte zástupný text',
        'required' => 'Povinné',
        'option' => [
            'label' => 'Štítek',
            'value' => 'Hodnota',
            'add_row' => 'Přidat nový řádek',
            'add_from_global' => 'Přidat globální vlastní pole',
        ],
        'modal' => [
            'heading' => 'Přidat nové vlastní pole',
            'select_field' => 'Vyberte pole',
            'button' => 'Přidat nové',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Text',
                'number' => 'Číslo',
                'dropdown' => 'Rozbalovací seznam',
                'checkbox' => 'Zaškrtávací políčko',
                'textarea' => 'Textová oblast',
            ],
        ],
        'ask_for_select' => 'Vyberte prosím vlastní pole',
        'add_a_new_custom_field' => 'Přidat nové vlastní pole',
    ],
    'image' => 'Obrázek',
    'category' => 'Kategorie',
    'duration' => 'Doba trvání',
    'price' => 'Cena',
    'annual_price' => 'Roční cena',
    'form' => [
        'none' => 'Žádné',
        'images' => 'Obrázky',
        'name_placeholder' => 'Zadejte název',
        'is_featured' => 'Je zvýrazněné?',
        'price_placeholder' => 'Zadejte cenu',
        'features' => 'Funkce',
        'features_help_block' => 'Oddělte novým řádkem (+ je zahrnuto, - není zahrnuto)',
        'features_placeholder' => 'Příklad:
+ 15denní doprava po celém světě
+ Bezplatné bublinkové balení
- 24/7 Podpora
        ',
        'description_placeholder' => 'Zadejte popis',
        'packages_switch_pricing_plan' => 'Zadejte roční cenu pro aktivaci funkce přepínání cenového plánu',
        'action_url' => 'URL akce',
        'action_label' => 'Štítek akce',
    ],
    'is_popular' => 'Je oblíbené?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Každou hodinu',
            'daily' => 'Denně',
            'weekly' => 'Týdně',
            'monthly' => 'Měsíčně',
            'annually' => 'Ročně',
            'quarterly' => 'Čtvrtletně',
            'one_time' => 'Jednorázově',
        ],
        'quote_statuses' => [
            'read' => 'Přečteno',
            'unread' => 'Nepřečteno',
        ],
    ],
    'edit_this_service' => 'Upravit tuto službu',
    'edit_this_service_category' => 'Upravit tuto kategorii služby',
    'edit_this_project' => 'Upravit tento projekt',
    'edit_this_project_category' => 'Upravit tuto kategorii projektu',
    'edit_this_package' => 'Upravit tento balíček',
    'message' => 'Zpráva',
    'time' => 'Čas',
    'service_categories' => 'Kategorie služeb',
    'services' => 'Služby',
    'projects' => 'Projekty',
    'packages' => 'Balíčky',
];
