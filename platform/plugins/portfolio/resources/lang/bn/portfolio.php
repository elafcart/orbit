<?php

return [
    'name' => 'পোর্টফোলিও',
    'settings' => [
        'success_message' => 'সেটিংস সফলভাবে সংরক্ষিত হয়েছে!',
        'email' => [
            'title' => 'মূল্যের অনুরোধ',
            'description' => 'মূল্যের অনুরোধের জন্য ইমেল টেমপ্লেট',
            'templates' => [
                'notice_title' => 'প্রশাসককে বিজ্ঞপ্তি পাঠান',
                'notice_description' => 'যখন একটি মূল্যের অনুরোধ পাঠানো হয় তখন প্রশাসককে বিজ্ঞপ্তি পাঠান',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'সেবা বিভাগ',
        'create' => 'সেবা বিভাগ তৈরি করুন',
    ],
    'service' => [
        'name' => 'সেবাসমূহ',
        'create' => 'সেবা তৈরি করুন',
    ],
    'package' => [
        'name' => 'প্যাকেজ',
        'create' => 'প্যাকেজ তৈরি করুন',
    ],
    'project' => [
        'name' => 'প্রকল্প',
        'create' => 'প্রকল্প তৈরি করুন',
        'author' => 'লেখক',
        'client' => 'ক্লায়েন্ট',
        'place' => 'স্থান',
        'start_date' => 'শুরুর তারিখ',
        'metrics' => [
            'title' => 'প্রকল্প মেট্রিক্স (কেস-স্টাডি কার্ড)',
            'helper' => 'কেস-স্টাডি কার্ড লেআউটে প্রদর্শিত সর্বাধিক তিনটি মেট্রিক মান/লেবেল জোড়া। কোনো জোড়া লুকাতে এটি খালি রাখুন।',
            'value_n' => 'মেট্রিক :n মান',
            'label_n' => 'মেট্রিক :n লেবেল',
            'label_placeholder' => 'উদা: পরিকল্পনার দক্ষতা',
        ],
    ],
    'quotation_request' => [
        'name' => 'মূল্যের অনুরোধ',
        'viewing' => 'মূল্যের অনুরোধ দেখা হচ্ছে #:name',
        'information' => 'তথ্য',
    ],
    'custom_field' => [
        'name' => 'কাস্টম ফিল্ড',
        'create' => 'তৈরি করুন',
        'type' => 'ধরন',
        'options' => 'বিকল্পসমূহ',
        'placeholder' => 'প্লেসহোল্ডার',
        'placeholder_placeholder' => 'প্লেসহোল্ডার লিখুন',
        'required' => 'আবশ্যক',
        'option' => [
            'label' => 'লেবেল',
            'value' => 'মান',
            'add_row' => 'নতুন সারি যোগ করুন',
            'add_from_global' => 'গ্লোবাল কাস্টম ফিল্ড যোগ করুন',
        ],
        'modal' => [
            'heading' => 'নতুন কাস্টম ফিল্ড যোগ করুন',
            'select_field' => 'ফিল্ড নির্বাচন করুন',
            'button' => 'নতুন যোগ করুন',
        ],
        'enums' => [
            'fields' => [
                'text' => 'টেক্সট',
                'number' => 'নম্বর',
                'dropdown' => 'ড্রপডাউন',
                'checkbox' => 'চেকবক্স',
                'textarea' => 'টেক্সটএরিয়া',
            ],
        ],
        'ask_for_select' => 'অনুগ্রহ করে একটি কাস্টম ফিল্ড নির্বাচন করুন',
        'add_a_new_custom_field' => 'একটি নতুন কাস্টম ফিল্ড যোগ করুন',
    ],
    'image' => 'ছবি',
    'category' => 'বিভাগ',
    'duration' => 'সময়কাল',
    'price' => 'মূল্য',
    'annual_price' => 'বার্ষিক মূল্য',
    'form' => [
        'none' => 'কোনটি নয়',
        'images' => 'ছবিসমূহ',
        'name_placeholder' => 'নাম লিখুন',
        'is_featured' => 'বিশেষভাবে প্রদর্শিত?',
        'price_placeholder' => 'মূল্য লিখুন',
        'features' => 'বৈশিষ্ট্য',
        'features_help_block' => 'নতুন লাইন দ্বারা পৃথক (+ অন্তর্ভুক্ত, - অন্তর্ভুক্ত নয়)',
        'features_placeholder' => 'উদাহরণ:
+ বিশ্বব্যাপী 15 দিনের শিপিং
+ ফ্রি বাবল র্যাপ
- 24/7 সহায়তা
        ',
        'description_placeholder' => 'বর্ণনা লিখুন',
        'packages_switch_pricing_plan' => 'মূল্য পরিকল্পনা স্যুইচ ফিচার সক্রিয় করতে বার্ষিক মূল্য লিখুন',
        'action_url' => 'অ্যাকশন URL',
        'action_label' => 'অ্যাকশন লেবেল',
    ],
    'is_popular' => 'জনপ্রিয়?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'ঘন্টায়',
            'daily' => 'দৈনিক',
            'weekly' => 'সাপ্তাহিক',
            'monthly' => 'মাসিক',
            'annually' => 'বার্ষিক',
            'quarterly' => 'ত্রৈমাসিক',
            'one_time' => 'এক সময়',
        ],
        'quote_statuses' => [
            'read' => 'পড়া হয়েছে',
            'unread' => 'পড়া হয়নি',
        ],
    ],
    'edit_this_service' => 'এই সেবা সম্পাদনা করুন',
    'edit_this_service_category' => 'এই সেবা বিভাগ সম্পাদনা করুন',
    'edit_this_project' => 'এই প্রকল্প সম্পাদনা করুন',
    'edit_this_project_category' => 'এই প্রকল্প বিভাগ সম্পাদনা করুন',
    'edit_this_package' => 'এই প্যাকেজ সম্পাদনা করুন',
    'message' => 'বার্তা',
    'time' => 'সময়',
    'service_categories' => 'সেবা বিভাগ',
    'services' => 'সেবাসমূহ',
    'projects' => 'প্রকল্প',
    'packages' => 'প্যাকেজ',
];
