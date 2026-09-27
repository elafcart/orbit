<?php

return [
    'name' => 'תיק עבודות',
    'settings' => [
        'success_message' => 'ההגדרות נשמרו בהצלחה!',
        'email' => [
            'title' => 'בקשות הצעת מחיר',
            'description' => 'תבניות אימייל לבקשות הצעת מחיר',
            'templates' => [
                'notice_title' => 'שלח הודעה למנהל',
                'notice_description' => 'שלח הודעה למנהל כאשר נשלחת בקשת הצעת מחיר',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'קטגוריות שירות',
        'create' => 'צור קטגוריית שירות',
    ],
    'service' => [
        'name' => 'שירותים',
        'create' => 'צור שירות',
    ],
    'package' => [
        'name' => 'חבילות',
        'create' => 'צור חבילה',
    ],
    'project' => [
        'name' => 'פרויקטים',
        'create' => 'צור פרויקט',
        'author' => 'מחבר',
        'client' => 'לקוח',
        'place' => 'מקום',
        'start_date' => 'תאריך התחלה',
        'metrics' => [
            'title' => 'מדדי הפרויקט (כרטיסי מקרה בוחן)',
            'helper' => 'עד שלושה זוגות של ערך/תווית של מדד המוצגים בפריסות של כרטיסי מקרה בוחן. השאר זוג ריק כדי להסתירו.',
            'value_n' => 'ערך המדד :n',
            'label_n' => 'תווית המדד :n',
            'label_placeholder' => 'לדוגמה: יעילות תכנון',
        ],
    ],
    'quotation_request' => [
        'name' => 'בקשות הצעת מחיר',
        'viewing' => 'צפייה בבקשת הצעת מחיר #:name',
        'information' => 'מידע',
    ],
    'custom_field' => [
        'name' => 'שדות מותאמים אישית',
        'create' => 'צור',
        'type' => 'סוג',
        'options' => 'אפשרויות',
        'placeholder' => 'מציין מקום',
        'placeholder_placeholder' => 'הזן מציין מקום',
        'required' => 'נדרש',
        'option' => [
            'label' => 'תווית',
            'value' => 'ערך',
            'add_row' => 'הוסף שורה חדשה',
            'add_from_global' => 'הוסף שדה מותאם אישית גלובלי',
        ],
        'modal' => [
            'heading' => 'הוסף שדה מותאם אישית חדש',
            'select_field' => 'בחר שדה',
            'button' => 'הוסף חדש',
        ],
        'enums' => [
            'fields' => [
                'text' => 'טקסט',
                'number' => 'מספר',
                'dropdown' => 'תפריט נפתח',
                'checkbox' => 'תיבת סימון',
                'textarea' => 'אזור טקסט',
            ],
        ],
        'ask_for_select' => 'אנא בחר שדה מותאם אישית',
        'add_a_new_custom_field' => 'הוסף שדה מותאם אישית חדש',
    ],
    'image' => 'תמונה',
    'category' => 'קטגוריה',
    'duration' => 'משך זמן',
    'price' => 'מחיר',
    'annual_price' => 'מחיר שנתי',
    'form' => [
        'none' => 'ללא',
        'images' => 'תמונות',
        'name_placeholder' => 'הזן שם',
        'is_featured' => 'מומלץ?',
        'price_placeholder' => 'הזן מחיר',
        'features' => 'תכונות',
        'features_help_block' => 'הפרד בשורה חדשה (+ כלול, - לא כלול)',
        'features_placeholder' => 'דוגמה:
+ משלוח 15 יום ברחבי העולם
+ עטיפת בועות חינם
- תמיכה 24/7
        ',
        'description_placeholder' => 'הזן תיאור',
        'packages_switch_pricing_plan' => 'הזן מחיר שנתי להפעלת תכונת החלפת תוכנית תמחור',
        'action_url' => 'כתובת URL של פעולה',
        'action_label' => 'תווית פעולה',
    ],
    'is_popular' => 'פופולרי?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'שעתי',
            'daily' => 'יומי',
            'weekly' => 'שבועי',
            'monthly' => 'חודשי',
            'annually' => 'שנתי',
            'quarterly' => 'רבעוני',
            'one_time' => 'חד פעמי',
        ],
        'quote_statuses' => [
            'read' => 'נקרא',
            'unread' => 'לא נקרא',
        ],
    ],
    'edit_this_service' => 'ערוך שירות זה',
    'edit_this_service_category' => 'ערוך קטגוריית שירות זו',
    'edit_this_project' => 'ערוך פרויקט זה',
    'edit_this_project_category' => 'ערוך קטגוריית פרויקט זו',
    'edit_this_package' => 'ערוך חבילה זו',
    'message' => 'הודעה',
    'time' => 'זמן',
    'service_categories' => 'קטגוריות שירות',
    'services' => 'שירותים',
    'projects' => 'פרויקטים',
    'packages' => 'חבילות',
];
