<?php

return [
    'name' => 'Портфоліо',
    'settings' => [
        'success_message' => 'Налаштування успішно збережено!',
        'email' => [
            'title' => 'Запити пропозицій',
            'description' => 'Шаблони електронної пошти для запитів пропозицій',
            'templates' => [
                'notice_title' => 'Надіслати повідомлення адміністратору',
                'notice_description' => 'Надіслати повідомлення адміністратору при надсиланні запиту пропозиції',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Категорії послуг',
        'create' => 'Створити категорію послуг',
    ],
    'service' => [
        'name' => 'Послуги',
        'create' => 'Створити послугу',
    ],
    'package' => [
        'name' => 'Пакети',
        'create' => 'Створити пакет',
    ],
    'project' => [
        'name' => 'Проєкти',
        'create' => 'Створити проєкт',
        'author' => 'Автор',
        'client' => 'Клієнт',
        'place' => 'Місце',
        'start_date' => 'Дата початку',
        'metrics' => [
            'title' => 'Метрики проекту (картки кейсів)',
            'helper' => 'До трьох пар значення/мітка метрики, які відображаються в макетах карток кейсів. Залиште будь-яку пару порожньою, щоб приховати її.',
            'value_n' => 'Значення метрики :n',
            'label_n' => 'Мітка метрики :n',
            'label_placeholder' => 'напр. Ефективність планування',
        ],
    ],
    'quotation_request' => [
        'name' => 'Запити пропозицій',
        'viewing' => 'Перегляд запиту пропозиції #:name',
        'information' => 'Інформація',
    ],
    'custom_field' => [
        'name' => 'Користувацькі поля',
        'create' => 'Створити',
        'type' => 'Тип',
        'options' => 'Параметри',
        'placeholder' => 'Заповнювач',
        'placeholder_placeholder' => 'Введіть заповнювач',
        'required' => 'Обов\'язково',
        'option' => [
            'label' => 'Мітка',
            'value' => 'Значення',
            'add_row' => 'Додати новий рядок',
            'add_from_global' => 'Додати глобальне користувацьке поле',
        ],
        'modal' => [
            'heading' => 'Додати нове користувацьке поле',
            'select_field' => 'Вибрати поле',
            'button' => 'Додати нове',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Текст',
                'number' => 'Число',
                'dropdown' => 'Випадаючий список',
                'checkbox' => 'Прапорець',
                'textarea' => 'Текстова область',
            ],
        ],
        'ask_for_select' => 'Будь ласка, виберіть користувацьке поле',
        'add_a_new_custom_field' => 'Додати нове користувацьке поле',
    ],
    'image' => 'Зображення',
    'category' => 'Категорія',
    'duration' => 'Тривалість',
    'price' => 'Ціна',
    'annual_price' => 'Річна ціна',
    'form' => [
        'none' => 'Немає',
        'images' => 'Зображення',
        'name_placeholder' => 'Введіть назву',
        'is_featured' => 'Рекомендоване?',
        'price_placeholder' => 'Введіть ціну',
        'features' => 'Характеристики',
        'features_help_block' => 'Розділяйте новим рядком (+ включено, - не включено)',
        'features_placeholder' => 'Приклад:
+ 15-денна доставка по всьому світу
+ Безкоштовна бульбашкова плівка
- Підтримка 24/7
        ',
        'description_placeholder' => 'Введіть опис',
        'packages_switch_pricing_plan' => 'Введіть річну ціну для перемикання функції цінового плану',
        'action_url' => 'URL дії',
        'action_label' => 'Мітка дії',
    ],
    'is_popular' => 'Популярне?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Погодинно',
            'daily' => 'Щодня',
            'weekly' => 'Щотижня',
            'monthly' => 'Щомісяця',
            'annually' => 'Щороку',
            'quarterly' => 'Щоквартально',
            'one_time' => 'Одноразово',
        ],
        'quote_statuses' => [
            'read' => 'Прочитано',
            'unread' => 'Не прочитано',
        ],
    ],
    'edit_this_service' => 'Редагувати цю послугу',
    'edit_this_service_category' => 'Редагувати цю категорію послуг',
    'edit_this_project' => 'Редагувати цей проєкт',
    'edit_this_project_category' => 'Редагувати цю категорію проєкту',
    'edit_this_package' => 'Редагувати цей пакет',
    'message' => 'Повідомлення',
    'time' => 'Час',
    'service_categories' => 'Категорії послуг',
    'services' => 'Послуги',
    'projects' => 'Проєкти',
    'packages' => 'Пакети',
];
