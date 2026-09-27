<?php

return [
    'name' => '作品集',
    'settings' => [
        'success_message' => '設定已成功儲存！',
        'email' => [
            'title' => '報價請求',
            'description' => '報價請求的電子郵件範本',
            'templates' => [
                'notice_title' => '向管理員發送通知',
                'notice_description' => '在發送報價請求時向管理員發送通知',
            ],
        ],
    ],
    'service_category' => [
        'name' => '服務類別',
        'create' => '建立服務類別',
    ],
    'service' => [
        'name' => '服務',
        'create' => '建立服務',
    ],
    'package' => [
        'name' => '套餐',
        'create' => '建立套餐',
    ],
    'project' => [
        'name' => '項目',
        'create' => '建立項目',
        'author' => '作者',
        'client' => '客戶',
        'place' => '地點',
        'start_date' => '開始日期',
        'metrics' => [
            'title' => '專案指標（案例研究卡片）',
            'helper' => '在案例研究卡片版面中顯示最多三對指標值/標籤。將任何一對留空即可隱藏。',
            'value_n' => '指標 :n 值',
            'label_n' => '指標 :n 標籤',
            'label_placeholder' => '例如：規劃效率',
        ],
    ],
    'quotation_request' => [
        'name' => '報價請求',
        'viewing' => '查看報價請求 #:name',
        'information' => '資訊',
    ],
    'custom_field' => [
        'name' => '自訂欄位',
        'create' => '建立',
        'type' => '類型',
        'options' => '選項',
        'placeholder' => '預留位置',
        'placeholder_placeholder' => '輸入預留位置',
        'required' => '必填',
        'option' => [
            'label' => '標籤',
            'value' => '值',
            'add_row' => '新增列',
            'add_from_global' => '新增全域自訂欄位',
        ],
        'modal' => [
            'heading' => '新增自訂欄位',
            'select_field' => '選擇欄位',
            'button' => '新增',
        ],
        'enums' => [
            'fields' => [
                'text' => '文字',
                'number' => '數字',
                'dropdown' => '下拉式選單',
                'checkbox' => '核取方塊',
                'textarea' => '文字區域',
            ],
        ],
        'ask_for_select' => '請選擇一個自訂欄位',
        'add_a_new_custom_field' => '新增自訂欄位',
    ],
    'image' => '圖片',
    'category' => '類別',
    'duration' => '時長',
    'price' => '價格',
    'annual_price' => '年度價格',
    'form' => [
        'none' => '無',
        'images' => '圖片',
        'name_placeholder' => '輸入名稱',
        'is_featured' => '精選？',
        'price_placeholder' => '輸入價格',
        'features' => '功能',
        'features_help_block' => '用新列分隔（+ 包含，- 不包含）',
        'features_placeholder' => '範例：
+ 全球15天發貨
+ 免費氣泡膜
- 24/7 支援
        ',
        'description_placeholder' => '輸入描述',
        'packages_switch_pricing_plan' => '輸入年度價格以切換定價計劃功能',
        'action_url' => '操作網址',
        'action_label' => '操作標籤',
    ],
    'is_popular' => '熱門？',
    'enums' => [
        'package_durations' => [
            'hourly' => '按小時',
            'daily' => '每日',
            'weekly' => '每週',
            'monthly' => '每月',
            'annually' => '每年',
            'quarterly' => '每季',
            'one_time' => '一次性',
        ],
        'quote_statuses' => [
            'read' => '已讀',
            'unread' => '未讀',
        ],
    ],
    'edit_this_service' => '編輯此服務',
    'edit_this_service_category' => '編輯此服務類別',
    'edit_this_project' => '編輯此項目',
    'edit_this_project_category' => '編輯此項目類別',
    'edit_this_package' => '編輯此套餐',
    'message' => '訊息',
    'time' => '時間',
    'service_categories' => '服務類別',
    'services' => '服務',
    'projects' => '項目',
    'packages' => '套餐',
];
