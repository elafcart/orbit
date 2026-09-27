<?php

return [
    'name' => 'Portfolio',
    'settings' => [
        'success_message' => 'Matagumpay na na-save ang mga setting!',
        'email' => [
            'title' => 'Mga Kahilingan ng Quotation',
            'description' => 'Mga email template para sa mga kahilingan ng quotation',
            'templates' => [
                'notice_title' => 'Magpadala ng abiso sa administrator',
                'notice_description' => 'Magpadala ng abiso sa administrator kapag may ipinadala na kahilingan ng quotation',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Mga Kategorya ng Serbisyo',
        'create' => 'Lumikha ng Kategorya ng Serbisyo',
    ],
    'service' => [
        'name' => 'Mga Serbisyo',
        'create' => 'Lumikha ng Serbisyo',
    ],
    'package' => [
        'name' => 'Mga Package',
        'create' => 'Lumikha ng Package',
    ],
    'project' => [
        'name' => 'Mga Proyekto',
        'create' => 'Lumikha ng Proyekto',
        'author' => 'May-akda',
        'client' => 'Kliyente',
        'place' => 'Lugar',
        'start_date' => 'Petsa ng Pagsisimula',
        'metrics' => [
            'title' => 'Mga sukatan ng proyekto (mga card ng case study)',
            'helper' => 'Hanggang tatlong pares ng halaga/label ng sukatan na ipinapakita sa mga layout ng card ng case study. Iwanang walang laman ang anumang pares upang itago ito.',
            'value_n' => 'Halaga ng sukatan :n',
            'label_n' => 'Label ng sukatan :n',
            'label_placeholder' => 'hal. Kahusayan sa pagpaplano',
        ],
    ],
    'quotation_request' => [
        'name' => 'Mga Kahilingan ng Quotation',
        'viewing' => 'Tinitingnan ang kahilingan ng quotation #:name',
        'information' => 'Impormasyon',
    ],
    'custom_field' => [
        'name' => 'Mga Custom Field',
        'create' => 'Lumikha',
        'type' => 'Uri',
        'options' => 'Mga Opsyon',
        'placeholder' => 'Placeholder',
        'placeholder_placeholder' => 'Maglagay ng placeholder',
        'required' => 'Kinakailangan',
        'option' => [
            'label' => 'Label',
            'value' => 'Halaga',
            'add_row' => 'Magdagdag ng bagong row',
            'add_from_global' => 'Magdagdag ng global custom field',
        ],
        'modal' => [
            'heading' => 'Magdagdag ng bagong custom field',
            'select_field' => 'Pumili ng field',
            'button' => 'Magdagdag ng bago',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Teksto',
                'number' => 'Numero',
                'dropdown' => 'Dropdown',
                'checkbox' => 'Checkbox',
                'textarea' => 'Textarea',
            ],
        ],
        'ask_for_select' => 'Pakipili ng custom field',
        'add_a_new_custom_field' => 'Magdagdag ng bagong custom field',
    ],
    'image' => 'Larawan',
    'category' => 'Kategorya',
    'duration' => 'Tagal',
    'price' => 'Presyo',
    'annual_price' => 'Taunang presyo',
    'form' => [
        'none' => 'Wala',
        'images' => 'Mga Larawan',
        'name_placeholder' => 'Maglagay ng pangalan',
        'is_featured' => 'Featured?',
        'price_placeholder' => 'Maglagay ng presyo',
        'features' => 'Mga Tampok',
        'features_help_block' => 'Paghiwalayin sa pamamagitan ng bagong linya (+ ay kasama, - ay hindi kasama)',
        'features_placeholder' => 'Halimbawa:
+ 15-Araw na Pagpapadala sa Buong Mundo
+ Libreng Bubble Wrap
- 24/7 na Suporta
        ',
        'description_placeholder' => 'Maglagay ng paglalarawan',
        'packages_switch_pricing_plan' => 'Maglagay ng taunang presyo upang i-switch ang pricing plan feature',
        'action_url' => 'URL ng Aksyon',
        'action_label' => 'Label ng Aksyon',
    ],
    'is_popular' => 'Sikat?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Bawat Oras',
            'daily' => 'Araw-araw',
            'weekly' => 'Lingguhan',
            'monthly' => 'Buwanan',
            'annually' => 'Taunang',
            'quarterly' => 'Quarterly',
            'one_time' => 'Isang Beses',
        ],
        'quote_statuses' => [
            'read' => 'Nabasa na',
            'unread' => 'Hindi pa nabasa',
        ],
    ],
    'edit_this_service' => 'I-edit ang serbisyong ito',
    'edit_this_service_category' => 'I-edit ang kategorya ng serbisyong ito',
    'edit_this_project' => 'I-edit ang proyektong ito',
    'edit_this_project_category' => 'I-edit ang kategorya ng proyektong ito',
    'edit_this_package' => 'I-edit ang package na ito',
    'message' => 'Mensahe',
    'time' => 'Oras',
    'service_categories' => 'Mga Kategorya ng Serbisyo',
    'services' => 'Mga Serbisyo',
    'projects' => 'Mga Proyekto',
    'packages' => 'Mga Package',
];
