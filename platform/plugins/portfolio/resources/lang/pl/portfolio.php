<?php

return [
    'name' => 'Portfolio',
    'settings' => [
        'success_message' => 'Ustawienia zostały pomyślnie zapisane!',
        'email' => [
            'title' => 'Zapytania ofertowe',
            'description' => 'Szablony e-mail dla zapytań ofertowych',
            'templates' => [
                'notice_title' => 'Wyślij powiadomienie do administratora',
                'notice_description' => 'Wyślij powiadomienie do administratora, gdy zostanie wysłane zapytanie ofertowe',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Kategorie usług',
        'create' => 'Utwórz kategorię usługi',
    ],
    'service' => [
        'name' => 'Usługi',
        'create' => 'Utwórz usługę',
    ],
    'package' => [
        'name' => 'Pakiety',
        'create' => 'Utwórz pakiet',
    ],
    'project' => [
        'name' => 'Projekty',
        'create' => 'Utwórz projekt',
        'author' => 'Autor',
        'client' => 'Klient',
        'place' => 'Miejsce',
        'start_date' => 'Data rozpoczęcia',
        'metrics' => [
            'title' => 'Metryki projektu (karty studiów przypadku)',
            'helper' => 'Do trzech par wartość/etykieta metryki wyświetlanych w układach kart studiów przypadku. Pozostaw dowolną parę pustą, aby ją ukryć.',
            'value_n' => 'Wartość metryki :n',
            'label_n' => 'Etykieta metryki :n',
            'label_placeholder' => 'np. Wydajność planowania',
        ],
    ],
    'quotation_request' => [
        'name' => 'Zapytania ofertowe',
        'viewing' => 'Przeglądanie zapytania ofertowego #:name',
        'information' => 'Informacje',
    ],
    'custom_field' => [
        'name' => 'Pola niestandardowe',
        'create' => 'Utwórz',
        'type' => 'Typ',
        'options' => 'Opcje',
        'placeholder' => 'Symbol zastępczy',
        'placeholder_placeholder' => 'Wprowadź symbol zastępczy',
        'required' => 'Wymagane',
        'option' => [
            'label' => 'Etykieta',
            'value' => 'Wartość',
            'add_row' => 'Dodaj nowy wiersz',
            'add_from_global' => 'Dodaj globalne pole niestandardowe',
        ],
        'modal' => [
            'heading' => 'Dodaj nowe pole niestandardowe',
            'select_field' => 'Wybierz pole',
            'button' => 'Dodaj nowe',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Tekst',
                'number' => 'Liczba',
                'dropdown' => 'Lista rozwijana',
                'checkbox' => 'Pole wyboru',
                'textarea' => 'Obszar tekstowy',
            ],
        ],
        'ask_for_select' => 'Proszę wybrać pole niestandardowe',
        'add_a_new_custom_field' => 'Dodaj nowe pole niestandardowe',
    ],
    'image' => 'Obraz',
    'category' => 'Kategoria',
    'duration' => 'Czas trwania',
    'price' => 'Cena',
    'annual_price' => 'Cena roczna',
    'form' => [
        'none' => 'Brak',
        'images' => 'Obrazy',
        'name_placeholder' => 'Wprowadź nazwę',
        'is_featured' => 'Wyróżnione?',
        'price_placeholder' => 'Wprowadź cenę',
        'features' => 'Funkcje',
        'features_help_block' => 'Oddziel nową linią (+ jest wliczone, - nie jest wliczone)',
        'features_placeholder' => 'Przykład:
+ 15-dniowa wysyłka na cały świat
+ Bezpłatna folia bąbelkowa
- Wsparcie 24/7
        ',
        'description_placeholder' => 'Wprowadź opis',
        'packages_switch_pricing_plan' => 'Wprowadź cenę roczną, aby przełączyć funkcję planu cenowego',
        'action_url' => 'URL akcji',
        'action_label' => 'Etykieta akcji',
    ],
    'is_popular' => 'Popularne?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Godzinowo',
            'daily' => 'Dziennie',
            'weekly' => 'Tygodniowo',
            'monthly' => 'Miesięcznie',
            'annually' => 'Rocznie',
            'quarterly' => 'Kwartalnie',
            'one_time' => 'Jednorazowo',
        ],
        'quote_statuses' => [
            'read' => 'Przeczytane',
            'unread' => 'Nieprzeczytane',
        ],
    ],
    'edit_this_service' => 'Edytuj tę usługę',
    'edit_this_service_category' => 'Edytuj tę kategorię usługi',
    'edit_this_project' => 'Edytuj ten projekt',
    'edit_this_project_category' => 'Edytuj tę kategorię projektu',
    'edit_this_package' => 'Edytuj ten pakiet',
    'message' => 'Wiadomość',
    'time' => 'Czas',
    'service_categories' => 'Kategorie usług',
    'services' => 'Usługi',
    'projects' => 'Projekty',
    'packages' => 'Pakiety',
];
