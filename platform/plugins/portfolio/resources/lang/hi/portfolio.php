<?php

return [
    'name' => 'पोर्टफोलियो',
    'settings' => [
        'success_message' => 'सेटिंग्स सफलतापूर्वक सहेजी गई हैं!',
        'email' => [
            'title' => 'कोटेशन अनुरोध',
            'description' => 'कोटेशन अनुरोधों के लिए ईमेल टेम्प्लेट',
            'templates' => [
                'notice_title' => 'व्यवस्थापक को सूचना भेजें',
                'notice_description' => 'कोटेशन अनुरोध भेजे जाने पर व्यवस्थापक को सूचना भेजें',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'सेवा श्रेणियाँ',
        'create' => 'सेवा श्रेणी बनाएं',
    ],
    'service' => [
        'name' => 'सेवाएं',
        'create' => 'सेवा बनाएं',
    ],
    'package' => [
        'name' => 'पैकेज',
        'create' => 'पैकेज बनाएं',
    ],
    'project' => [
        'name' => 'परियोजनाएं',
        'create' => 'परियोजना बनाएं',
        'author' => 'लेखक',
        'client' => 'ग्राहक',
        'place' => 'स्थान',
        'start_date' => 'प्रारंभ तिथि',
        'metrics' => [
            'title' => 'प्रोजेक्ट मेट्रिक्स (केस-स्टडी कार्ड)',
            'helper' => 'केस-स्टडी कार्ड लेआउट में प्रदर्शित अधिकतम तीन मेट्रिक मान/लेबल जोड़े। किसी भी जोड़े को छिपाने के लिए उसे खाली छोड़ें।',
            'value_n' => 'मेट्रिक :n मान',
            'label_n' => 'मेट्रिक :n लेबल',
            'label_placeholder' => 'उदा. प्लानिंग दक्षता',
        ],
    ],
    'quotation_request' => [
        'name' => 'कोटेशन अनुरोध',
        'viewing' => 'कोटेशन अनुरोध देख रहे हैं #:name',
        'information' => 'जानकारी',
    ],
    'custom_field' => [
        'name' => 'कस्टम फील्ड',
        'create' => 'बनाएं',
        'type' => 'प्रकार',
        'options' => 'विकल्प',
        'placeholder' => 'प्लेसहोल्डर',
        'placeholder_placeholder' => 'प्लेसहोल्डर दर्ज करें',
        'required' => 'आवश्यक',
        'option' => [
            'label' => 'लेबल',
            'value' => 'मान',
            'add_row' => 'नई पंक्ति जोड़ें',
            'add_from_global' => 'वैश्विक कस्टम फील्ड जोड़ें',
        ],
        'modal' => [
            'heading' => 'नया कस्टम फील्ड जोड़ें',
            'select_field' => 'फील्ड चुनें',
            'button' => 'नया जोड़ें',
        ],
        'enums' => [
            'fields' => [
                'text' => 'टेक्स्ट',
                'number' => 'संख्या',
                'dropdown' => 'ड्रॉपडाउन',
                'checkbox' => 'चेकबॉक्स',
                'textarea' => 'टेक्स्ट एरिया',
            ],
        ],
        'ask_for_select' => 'कृपया एक कस्टम फील्ड चुनें',
        'add_a_new_custom_field' => 'नया कस्टम फील्ड जोड़ें',
    ],
    'image' => 'छवि',
    'category' => 'श्रेणी',
    'duration' => 'अवधि',
    'price' => 'मूल्य',
    'annual_price' => 'वार्षिक मूल्य',
    'form' => [
        'none' => 'कोई नहीं',
        'images' => 'छवियाँ',
        'name_placeholder' => 'नाम दर्ज करें',
        'is_featured' => 'फीचर्ड है?',
        'price_placeholder' => 'मूल्य दर्ज करें',
        'features' => 'विशेषताएं',
        'features_help_block' => 'नई लाइन से अलग करें (+ शामिल है, - शामिल नहीं है)',
        'features_placeholder' => 'उदाहरण:
+ 15-दिनों में विश्वव्यापी शिपिंग
+ मुफ्त बबल रैप
- 24/7 समर्थन
        ',
        'description_placeholder' => 'विवरण दर्ज करें',
        'packages_switch_pricing_plan' => 'मूल्य योजना स्विच सुविधा के लिए वार्षिक मूल्य दर्ज करें',
        'action_url' => 'कार्रवाई URL',
        'action_label' => 'कार्रवाई लेबल',
    ],
    'is_popular' => 'लोकप्रिय है?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'प्रति घंटा',
            'daily' => 'दैनिक',
            'weekly' => 'साप्ताहिक',
            'monthly' => 'मासिक',
            'annually' => 'वार्षिक',
            'quarterly' => 'त्रैमासिक',
            'one_time' => 'एक बार',
        ],
        'quote_statuses' => [
            'read' => 'पढ़ा गया',
            'unread' => 'अपठित',
        ],
    ],
    'edit_this_service' => 'इस सेवा को संपादित करें',
    'edit_this_service_category' => 'इस सेवा श्रेणी को संपादित करें',
    'edit_this_project' => 'इस परियोजना को संपादित करें',
    'edit_this_project_category' => 'इस परियोजना श्रेणी को संपादित करें',
    'edit_this_package' => 'इस पैकेज को संपादित करें',
    'message' => 'संदेश',
    'time' => 'समय',
    'service_categories' => 'सेवा श्रेणियाँ',
    'services' => 'सेवाएं',
    'projects' => 'परियोजनाएं',
    'packages' => 'पैकेज',
];