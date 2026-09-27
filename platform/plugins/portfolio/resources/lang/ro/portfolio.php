<?php

return [
    'name' => 'Portofoliu',
    'settings' => [
        'success_message' => 'Setările au fost salvate cu succes!',
        'email' => [
            'title' => 'Solicitări de ofertă',
            'description' => 'Șabloane de e-mail pentru solicitări de ofertă',
            'templates' => [
                'notice_title' => 'Trimite notificare administratorului',
                'notice_description' => 'Trimite notificare administratorului când este trimisă o solicitare de ofertă',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Categorii de servicii',
        'create' => 'Creează categorie de servicii',
    ],
    'service' => [
        'name' => 'Servicii',
        'create' => 'Creează serviciu',
    ],
    'package' => [
        'name' => 'Pachete',
        'create' => 'Creează pachet',
    ],
    'project' => [
        'name' => 'Proiecte',
        'create' => 'Creează proiect',
        'author' => 'Autor',
        'client' => 'Client',
        'place' => 'Loc',
        'start_date' => 'Data de început',
        'metrics' => [
            'title' => 'Metrici de proiect (carduri de studii de caz)',
            'helper' => 'Până la trei perechi valoare/etichetă de metrică afișate în machetele cardurilor de studii de caz. Lăsați orice pereche goală pentru a o ascunde.',
            'value_n' => 'Valoarea metricii :n',
            'label_n' => 'Eticheta metricii :n',
            'label_placeholder' => 'ex. Eficiența planificării',
        ],
    ],
    'quotation_request' => [
        'name' => 'Solicitări de ofertă',
        'viewing' => 'Vizualizare solicitare de ofertă #:name',
        'information' => 'Informații',
    ],
    'custom_field' => [
        'name' => 'Câmpuri personalizate',
        'create' => 'Creează',
        'type' => 'Tip',
        'options' => 'Opțiuni',
        'placeholder' => 'Substituent',
        'placeholder_placeholder' => 'Introduceți substituent',
        'required' => 'Obligatoriu',
        'option' => [
            'label' => 'Etichetă',
            'value' => 'Valoare',
            'add_row' => 'Adaugă rând nou',
            'add_from_global' => 'Adaugă câmp personalizat global',
        ],
        'modal' => [
            'heading' => 'Adaugă câmp personalizat nou',
            'select_field' => 'Selectează câmp',
            'button' => 'Adaugă nou',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Text',
                'number' => 'Număr',
                'dropdown' => 'Meniu derulant',
                'checkbox' => 'Casetă de selectare',
                'textarea' => 'Zonă de text',
            ],
        ],
        'ask_for_select' => 'Vă rugăm să selectați un câmp personalizat',
        'add_a_new_custom_field' => 'Adaugă un câmp personalizat nou',
    ],
    'image' => 'Imagine',
    'category' => 'Categorie',
    'duration' => 'Durată',
    'price' => 'Preț',
    'annual_price' => 'Preț anual',
    'form' => [
        'none' => 'Niciunul',
        'images' => 'Imagini',
        'name_placeholder' => 'Introduceți numele',
        'is_featured' => 'Recomandat?',
        'price_placeholder' => 'Introduceți prețul',
        'features' => 'Caracteristici',
        'features_help_block' => 'Separați prin linie nouă (+ este inclus, - nu este inclus)',
        'features_placeholder' => 'Exemplu:
+ Livrare 15 zile în întreaga lume
+ Folie cu bule gratuită
- Asistență 24/7
        ',
        'description_placeholder' => 'Introduceți descrierea',
        'packages_switch_pricing_plan' => 'Introduceți prețul anual pentru a comuta funcția de plan de prețuri',
        'action_url' => 'URL acțiune',
        'action_label' => 'Etichetă acțiune',
    ],
    'is_popular' => 'Popular?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Orar',
            'daily' => 'Zilnic',
            'weekly' => 'Săptămânal',
            'monthly' => 'Lunar',
            'annually' => 'Anual',
            'quarterly' => 'Trimestrial',
            'one_time' => 'O singură dată',
        ],
        'quote_statuses' => [
            'read' => 'Citit',
            'unread' => 'Necitit',
        ],
    ],
    'edit_this_service' => 'Editează acest serviciu',
    'edit_this_service_category' => 'Editează această categorie de servicii',
    'edit_this_project' => 'Editează acest proiect',
    'edit_this_project_category' => 'Editează această categorie de proiect',
    'edit_this_package' => 'Editează acest pachet',
    'message' => 'Mesaj',
    'time' => 'Timp',
    'service_categories' => 'Categorii de servicii',
    'services' => 'Servicii',
    'projects' => 'Proiecte',
    'packages' => 'Pachete',
];
