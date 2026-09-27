<?php

return [
    'name' => 'Portfolio',
    'settings' => [
        'success_message' => 'Tetapan telah berjaya disimpan!',
        'email' => [
            'title' => 'Permintaan Sebut Harga',
            'description' => 'Templat e-mel untuk permintaan sebut harga',
            'templates' => [
                'notice_title' => 'Hantar notis kepada pentadbir',
                'notice_description' => 'Hantar notis kepada pentadbir apabila permintaan sebut harga dihantar',
            ],
        ],
    ],
    'service_category' => [
        'name' => 'Kategori Perkhidmatan',
        'create' => 'Cipta Kategori Perkhidmatan',
    ],
    'service' => [
        'name' => 'Perkhidmatan',
        'create' => 'Cipta Perkhidmatan',
    ],
    'package' => [
        'name' => 'Pakej',
        'create' => 'Cipta Pakej',
    ],
    'project' => [
        'name' => 'Projek',
        'create' => 'Cipta Projek',
        'author' => 'Pengarang',
        'client' => 'Klien',
        'place' => 'Tempat',
        'start_date' => 'Tarikh Mula',
        'metrics' => [
            'title' => 'Metrik projek (kad kajian kes)',
            'helper' => 'Sehingga tiga pasangan nilai/label metrik dipaparkan pada susun atur kad kajian kes. Biarkan mana-mana pasangan kosong untuk menyembunyikannya.',
            'value_n' => 'Nilai metrik :n',
            'label_n' => 'Label metrik :n',
            'label_placeholder' => 'cth. Kecekapan perancangan',
        ],
    ],
    'quotation_request' => [
        'name' => 'Permintaan Sebut Harga',
        'viewing' => 'Melihat permintaan sebut harga #:name',
        'information' => 'Maklumat',
    ],
    'custom_field' => [
        'name' => 'Medan Tersuai',
        'create' => 'Cipta',
        'type' => 'Jenis',
        'options' => 'Pilihan',
        'placeholder' => 'Penahan Tempat',
        'placeholder_placeholder' => 'Masukkan penahan tempat',
        'required' => 'Diperlukan',
        'option' => [
            'label' => 'Label',
            'value' => 'Nilai',
            'add_row' => 'Tambah baris baharu',
            'add_from_global' => 'Tambah medan tersuai global',
        ],
        'modal' => [
            'heading' => 'Tambah medan tersuai baharu',
            'select_field' => 'Pilih medan',
            'button' => 'Tambah baharu',
        ],
        'enums' => [
            'fields' => [
                'text' => 'Teks',
                'number' => 'Nombor',
                'dropdown' => 'Dropdown',
                'checkbox' => 'Kotak Semak',
                'textarea' => 'Kawasan Teks',
            ],
        ],
        'ask_for_select' => 'Sila pilih medan tersuai',
        'add_a_new_custom_field' => 'Tambah medan tersuai baharu',
    ],
    'image' => 'Imej',
    'category' => 'Kategori',
    'duration' => 'Tempoh',
    'price' => 'Harga',
    'annual_price' => 'Harga tahunan',
    'form' => [
        'none' => 'Tiada',
        'images' => 'Imej',
        'name_placeholder' => 'Masukkan nama',
        'is_featured' => 'Ditampilkan?',
        'price_placeholder' => 'Masukkan harga',
        'features' => 'Ciri-ciri',
        'features_help_block' => 'Pisahkan dengan baris baharu (+ termasuk, - tidak termasuk)',
        'features_placeholder' => 'Contoh:
+ Penghantaran 15 Hari Ke Seluruh Dunia
+ Pembungkus Gelembung Percuma
- Sokongan 24/7
        ',
        'description_placeholder' => 'Masukkan penerangan',
        'packages_switch_pricing_plan' => 'Masukkan harga tahunan untuk menukar ciri pelan harga',
        'action_url' => 'URL Tindakan',
        'action_label' => 'Label Tindakan',
    ],
    'is_popular' => 'Popular?',
    'enums' => [
        'package_durations' => [
            'hourly' => 'Setiap Jam',
            'daily' => 'Harian',
            'weekly' => 'Mingguan',
            'monthly' => 'Bulanan',
            'annually' => 'Tahunan',
            'quarterly' => 'Suku Tahunan',
            'one_time' => 'Sekali Sahaja',
        ],
        'quote_statuses' => [
            'read' => 'Dibaca',
            'unread' => 'Belum Dibaca',
        ],
    ],
    'edit_this_service' => 'Edit perkhidmatan ini',
    'edit_this_service_category' => 'Edit kategori perkhidmatan ini',
    'edit_this_project' => 'Edit projek ini',
    'edit_this_project_category' => 'Edit kategori projek ini',
    'edit_this_package' => 'Edit pakej ini',
    'message' => 'Mesej',
    'time' => 'Masa',
    'service_categories' => 'Kategori Perkhidmatan',
    'services' => 'Perkhidmatan',
    'projects' => 'Projek',
    'packages' => 'Pakej',
];
