<?php

return [
    'name' => 'Портфолио',
    'settings' => [
        'success_message' => 'Подешавања су успешно сачувана!',
        'email' => [
            'title' => 'Захтеви за понуду',
            'description' => 'Шаблони е-поште за захтеве за понуду',
            'templates' => [
                'notice_title' => 'Пошаљи обавештење администратору',
                'notice_description' => 'Пошаљи обавештење администратору када се пошаље захтев за понуду',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Категорије услуга',
        'create' => 'Направи категорију услуге',
    ],
    'service' => [
        'name' => 'Услуге',
        'create' => 'Направи услугу',
    ],
    'package' => [
        'name' => 'Пакети',
        'create' => 'Направи пакет',
    ],
    'project' => [
        'name' => 'Пројекти',
        'create' => 'Направи пројекат',
        'author' => 'Аутор',
        'client' => 'Клијент',
        'place' => 'Место',
        'start_date' => 'Датум почетка',
        'metrics' => [
            'title' => 'Метрике пројекта (картице студија случаја)',
            'helper' => 'До три пара вредности/ознаке метрике приказана у распоредима картица студија случаја. Оставите било који пар празан да бисте га сакрили.',
            'value_n' => 'Вредност метрике :n',
            'label_n' => 'Ознака метрике :n',
            'label_placeholder' => 'нпр. Ефикасност планирања',
        ],
    ],
    'quotation_request' => [
        'name' => 'Захтеви за понуду',
        'viewing' => 'Преглед захтева за понуду #:name',
        'information' => 'Информације',
    ],
    'custom_field' => [
        'name' => 'Прилагођена поља',
        'create' => 'Направи',
        'type' => 'Тип',
        'options' => 'Опције',
        'placeholder' => 'Чувар места',
        'placeholder_placeholder' => 'Унесите чувара места',
        'required' => 'Обавезно',
        'option' => [
            'label' => 'Ознака',
            'value' => 'Вредност',
            'add_row' => 'Додај нови ред',
            'add_from_global' => 'Додај глобално прилагођено поље',
        ],
        'modal' => [
            'heading' => 'Додај ново прилагођено поље',
            'select_field' => 'Изабери поље',
            'button' => 'Додај ново',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Текст',
                'number' => 'Број',
                'dropdown' => 'Падајући мени',
                'checkbox' => 'Поље за потврду',
                'textarea' => 'Текстуално подручје',
            ],
        ],
        'ask_for_select' => 'Молимо изаберите прилагођено поље',
        'add_a_new_custom_field' => 'Додај ново прилагођено поље',
    ],
    'image' => 'Слика',
    'category' => 'Категорија',
    'duration' => 'Трајање',
    'price' => 'Цена',
    'annual_price' => 'Годишња цена',
    'form' => [
        'none' => 'Ништа',
        'images' => 'Слике',
        'name_placeholder' => 'Унесите име',
        'is_featured' => 'Истакнуто?',
        'price_placeholder' => 'Унесите цену',
        'features' => 'Карактеристике',
        'features_help_block' => 'Одвојите новим редом (+ је укључено, - није укључено)',
        'features_placeholder' => 'Пример:
+ 15-дневна достава широм света
+ Бесплатна заштита од мехурића
- 24/7 Подршка
        ',
        'description_placeholder' => 'Унесите опис',
        'packages_switch_pricing_plan' => 'Унесите годишњу цену за пребацивање функције ценовног плана',
        'action_url' => 'УРЛ радње',
        'action_label' => 'Ознака радње',
    ],
    'is_popular' => 'Популарно?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Сатно',
            'daily' => 'Дневно',
            'weekly' => 'Недељно',
            'monthly' => 'Месечно',
            'annually' => 'Годишње',
            'quarterly' => 'Квартално',
            'one_time' => 'Једнократно',
        ],
        'quote_statuses' => [
            'read' => 'Прочитано',
            'unread' => 'Непрочитано',
        ],
    ],
    'edit_this_service' => 'Измени ову услугу',
    'edit_this_service_category' => 'Измени ову категорију услуге',
    'edit_this_project' => 'Измени овај пројекат',
    'edit_this_project_category' => 'Измени ову категорију пројекта',
    'edit_this_package' => 'Измени овај пакет',
    'message' => 'Порука',
    'time' => 'Време',
    'service_categories' => 'Категорије услуга',
    'services' => 'Услуге',
    'projects' => 'Пројекти',
    'packages' => 'Пакети',
];
