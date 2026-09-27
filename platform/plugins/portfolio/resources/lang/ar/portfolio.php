<?php

return [
    'name' => 'محفظة الأعمال',
    'settings' => [
        'success_message' => 'تم حفظ الإعدادات بنجاح!',
        'email' => [
            'title' => 'طلبات عروض الأسعار',
            'description' => 'قوالب البريد الإلكتروني لطلبات عروض الأسعار',
            'templates' => [
                'notice_title' => 'إرسال إشعار إلى المسؤول',
                'notice_description' => 'إرسال إشعار إلى المسؤول عند إرسال طلب عرض أسعار',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'فئات الخدمات',
        'create' => 'إنشاء فئة خدمة',
    ],
    'service' => [
        'name' => 'الخدمات',
        'create' => 'إنشاء خدمة',
    ],
    'package' => [
        'name' => 'الباقات',
        'create' => 'إنشاء باقة',
    ],
    'project' => [
        'name' => 'المشاريع',
        'create' => 'إنشاء مشروع',
        'author' => 'المؤلف',
        'client' => 'العميل',
        'place' => 'المكان',
        'start_date' => 'تاريخ البداية',
        'metrics' => [
            'title' => 'مقاييس المشروع (بطاقات دراسة الحالة)',
            'helper' => 'حتى ثلاثة أزواج من القيمة/التسمية للمقياس تُعرض في تخطيطات بطاقات دراسة الحالة. اترك أي زوج فارغًا لإخفائه.',
            'value_n' => 'قيمة المقياس :n',
            'label_n' => 'تسمية المقياس :n',
            'label_placeholder' => 'مثال: كفاءة التخطيط',
        ],
    ],
    'quotation_request' => [
        'name' => 'طلبات عروض الأسعار',
        'viewing' => 'عرض طلب عرض الأسعار #:name',
        'information' => 'المعلومات',
    ],
    'custom_field' => [
        'name' => 'الحقول المخصصة',
        'create' => 'إنشاء',
        'type' => 'النوع',
        'options' => 'الخيارات',
        'placeholder' => 'نص توضيحي',
        'placeholder_placeholder' => 'أدخل النص التوضيحي',
        'required' => 'مطلوب',
        'option' => [
            'label' => 'التسمية',
            'value' => 'القيمة',
            'add_row' => 'إضافة صف جديد',
            'add_from_global' => 'إضافة حقل مخصص عام',
        ],
        'modal' => [
            'heading' => 'إضافة حقل مخصص جديد',
            'select_field' => 'اختر الحقل',
            'button' => 'إضافة جديد',
        ],
        'enums' => [
            'fields' => [
                'text' => 'نص',
                'number' => 'رقم',
                'dropdown' => 'قائمة منسدلة',
                'checkbox' => 'خانة اختيار',
                'textarea' => 'منطقة نص',
            ],
        ],
        'ask_for_select' => 'الرجاء اختيار حقل مخصص',
        'add_a_new_custom_field' => 'إضافة حقل مخصص جديد',
    ],
    'image' => 'صورة',
    'category' => 'الفئة',
    'duration' => 'المدة',
    'price' => 'السعر',
    'annual_price' => 'السعر السنوي',
    'form' => [
        'none' => 'لا شيء',
        'images' => 'الصور',
        'name_placeholder' => 'أدخل الاسم',
        'is_featured' => 'مميز؟',
        'price_placeholder' => 'أدخل السعر',
        'features' => 'المميزات',
        'features_help_block' => 'افصل بسطر جديد (+ مضمن، - غير مضمن)',
        'features_placeholder' => 'مثال:
+ شحن لمدة 15 يوم حول العالم
+ تغليف فقاعي مجاني
- دعم 24/7
        ',
        'description_placeholder' => 'أدخل الوصف',
        'packages_switch_pricing_plan' => 'أدخل السعر السنوي لتفعيل ميزة تبديل خطة الأسعار',
        'action_url' => 'رابط الإجراء',
        'action_label' => 'تسمية الإجراء',
    ],
    'is_popular' => 'شائع؟',
    'enums' => [
        'package_durations' => [
            'hourly' => 'بالساعة',
            'daily' => 'يومي',
            'weekly' => 'أسبوعي',
            'monthly' => 'شهري',
            'annually' => 'سنوي',
            'quarterly' => 'ربع سنوي',
            'one_time' => 'مرة واحدة',
        ],
        'quote_statuses' => [
            'read' => 'مقروء',
            'unread' => 'غير مقروء',
        ],
    ],
    'edit_this_service' => 'تحرير هذه الخدمة',
    'edit_this_service_category' => 'تحرير فئة الخدمة هذه',
    'edit_this_project' => 'تحرير هذا المشروع',
    'edit_this_project_category' => 'تحرير فئة المشروع هذه',
    'edit_this_package' => 'تحرير هذه الباقة',
    'message' => 'رسالة',
    'time' => 'الوقت',
    'service_categories' => 'فئات الخدمات',
    'services' => 'الخدمات',
    'projects' => 'المشاريع',
    'packages' => 'الباقات',
];