<?php

return [
    'name' => '作品集',
    'settings' => [
        'success_message' => '设置已成功保存！',
        'email' => [
            'title' => '报价请求',
            'description' => '报价请求的电子邮件模板',
            'templates' => [
                'notice_title' => '向管理员发送通知',
                'notice_description' => '在发送报价请求时向管理员发送通知',
            ],
        ],
    ],
    'service_category' => [
        'name' => '服务类别',
        'create' => '创建服务类别',
    ],
    'service' => [
        'name' => '服务',
        'create' => '创建服务',
    ],
    'package' => [
        'name' => '套餐',
        'create' => '创建套餐',
    ],
    'project' => [
        'name' => '项目',
        'create' => '创建项目',
        'author' => '作者',
        'client' => '客户',
        'place' => '地点',
        'start_date' => '开始日期',
        'metrics' => [
            'title' => '项目指标（案例研究卡片）',
            'helper' => '在案例研究卡片布局中显示最多三对指标值/标签。将任何一对留空即可隐藏。',
            'value_n' => '指标 :n 值',
            'label_n' => '指标 :n 标签',
            'label_placeholder' => '例如：规划效率',
        ],
    ],
    'quotation_request' => [
        'name' => '报价请求',
        'viewing' => '查看报价请求 #:name',
        'information' => '信息',
    ],
    'custom_field' => [
        'name' => '自定义字段',
        'create' => '创建',
        'type' => '类型',
        'options' => '选项',
        'placeholder' => '占位符',
        'placeholder_placeholder' => '输入占位符',
        'required' => '必填',
        'option' => [
            'label' => '标签',
            'value' => '值',
            'add_row' => '添加新行',
            'add_from_global' => '添加全局自定义字段',
        ],
        'modal' => [
            'heading' => '添加新的自定义字段',
            'select_field' => '选择字段',
            'button' => '添加新的',
        ],
        'enums' => [
            'fields' => [
                'text' => '文本',
                'number' => '数字',
                'dropdown' => '下拉菜单',
                'checkbox' => '复选框',
                'textarea' => '文本区域',
            ],
        ],
        'ask_for_select' => '请选择一个自定义字段',
        'add_a_new_custom_field' => '添加新的自定义字段',
    ],
    'image' => '图片',
    'category' => '类别',
    'duration' => '时长',
    'price' => '价格',
    'annual_price' => '年度价格',
    'form' => [
        'none' => '无',
        'images' => '图片',
        'name_placeholder' => '输入名称',
        'is_featured' => '精选？',
        'price_placeholder' => '输入价格',
        'features' => '功能',
        'features_help_block' => '用新行分隔（+ 包含，- 不包含）',
        'features_placeholder' => '示例：
+ 全球15天发货
+ 免费气泡膜
- 24/7 支持
        ',
        'description_placeholder' => '输入描述',
        'packages_switch_pricing_plan' => '输入年度价格以切换定价计划功能',
        'action_url' => '操作网址',
        'action_label' => '操作标签',
    ],
    'is_popular' => '热门？',
    'enums' => [
        'package_durations' => [
            'hourly' => '按小时',
            'daily' => '每日',
            'weekly' => '每周',
            'monthly' => '每月',
            'annually' => '每年',
            'quarterly' => '每季度',
            'one_time' => '一次性',
        ],
        'quote_statuses' => [
            'read' => '已读',
            'unread' => '未读',
        ],
    ],
    'edit_this_service' => '编辑此服务',
    'edit_this_service_category' => '编辑此服务类别',
    'edit_this_project' => '编辑此项目',
    'edit_this_project_category' => '编辑此项目类别',
    'edit_this_package' => '编辑此套餐',
    'message' => '消息',
    'time' => '时间',
    'service_categories' => '服务类别',
    'services' => '服务',
    'projects' => '项目',
    'packages' => '套餐',
];
