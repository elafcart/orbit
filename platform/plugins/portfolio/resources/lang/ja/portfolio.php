<?php

return [
    'name' => 'ポートフォリオ',
    'settings' => [
        'success_message' => '設定が正常に保存されました！',
        'email' => [
            'title' => '見積もりリクエスト',
            'description' => '見積もりリクエストのメールテンプレート',
            'templates' => [
                'notice_title' => '管理者に通知を送信',
                'notice_description' => '見積もりリクエストが送信されたときに管理者に通知を送信',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'サービスカテゴリー',
        'create' => 'サービスカテゴリーを作成',
    ],
    'service' => [
        'name' => 'サービス',
        'create' => 'サービスを作成',
    ],
    'package' => [
        'name' => 'パッケージ',
        'create' => 'パッケージを作成',
    ],
    'project' => [
        'name' => 'プロジェクト',
        'create' => 'プロジェクトを作成',
        'author' => '著者',
        'client' => 'クライアント',
        'place' => '場所',
        'start_date' => '開始日',
        'metrics' => [
            'title' => 'プロジェクトの指標（ケーススタディカード）',
            'helper' => 'ケーススタディカードのレイアウトに表示される最大3つの指標の値/ラベルのペア。ペアを非表示にするには空のままにしてください。',
            'value_n' => '指標 :n の値',
            'label_n' => '指標 :n のラベル',
            'label_placeholder' => '例: プランニング効率',
        ],
    ],
    'quotation_request' => [
        'name' => '見積もりリクエスト',
        'viewing' => '見積もりリクエストを表示中 #:name',
        'information' => '情報',
    ],
    'custom_field' => [
        'name' => 'カスタムフィールド',
        'create' => '作成',
        'type' => 'タイプ',
        'options' => 'オプション',
        'placeholder' => 'プレースホルダー',
        'placeholder_placeholder' => 'プレースホルダーを入力',
        'required' => '必須',
        'option' => [
            'label' => 'ラベル',
            'value' => '値',
            'add_row' => '新しい行を追加',
            'add_from_global' => 'グローバルカスタムフィールドを追加',
        ],
        'modal' => [
            'heading' => '新しいカスタムフィールドを追加',
            'select_field' => 'フィールドを選択',
            'button' => '新規追加',
        ],
        'enums' => [
            'fields' => [
                'text' => 'テキスト',
                'number' => '数値',
                'dropdown' => 'ドロップダウン',
                'checkbox' => 'チェックボックス',
                'textarea' => 'テキストエリア',
            ],
        ],
        'ask_for_select' => 'カスタムフィールドを選択してください',
        'add_a_new_custom_field' => '新しいカスタムフィールドを追加',
    ],
    'image' => '画像',
    'category' => 'カテゴリー',
    'duration' => '期間',
    'price' => '価格',
    'annual_price' => '年間価格',
    'form' => [
        'none' => 'なし',
        'images' => '画像',
        'name_placeholder' => '名前を入力',
        'is_featured' => '注目？',
        'price_placeholder' => '価格を入力',
        'features' => '機能',
        'features_help_block' => '改行で区切る（+は含まれる、-は含まれない）',
        'features_placeholder' => '例：
+ 世界中への15日配送
+ 無料バブルラップ
- 24時間年中無休サポート
        ',
        'description_placeholder' => '説明を入力',
        'packages_switch_pricing_plan' => '価格プラン切り替え機能を有効にするには年間価格を入力してください',
        'action_url' => 'アクションURL',
        'action_label' => 'アクションラベル',
    ],
    'is_popular' => '人気？',
    'enums' => [
        'package_durations' => [
            'hourly' => '時間単位',
            'daily' => '日次',
            'weekly' => '週次',
            'monthly' => '月次',
            'annually' => '年次',
            'quarterly' => '四半期',
            'one_time' => '1回限り',
        ],
        'quote_statuses' => [
            'read' => '既読',
            'unread' => '未読',
        ],
    ],
    'edit_this_service' => 'このサービスを編集',
    'edit_this_service_category' => 'このサービスカテゴリーを編集',
    'edit_this_project' => 'このプロジェクトを編集',
    'edit_this_project_category' => 'このプロジェクトカテゴリーを編集',
    'edit_this_package' => 'このパッケージを編集',
    'message' => 'メッセージ',
    'time' => '時間',
    'service_categories' => 'サービスカテゴリー',
    'services' => 'サービス',
    'projects' => 'プロジェクト',
    'packages' => 'パッケージ',
];
